<?php
    require 'connexion.php';

    if (!isset($_POST['typeRecherche'], $_POST['termeRecherche'])) {
        die("Type de recherche ou terme de recherche manquant.");
    }

    $typeRecherche = $_POST['typeRecherche'];
    $termeRecherche = $_POST['termeRecherche'];

    $colonnesAutorisees = ['title', 'author', 'isbn'];
    if (!in_array($typeRecherche, $colonnesAutorisees)) {
        die("Type de recherche invalide.");
    }
        $nblivre = 0;
        $sql = 'SELECT count(*) FROM books WHERE ' . $typeRecherche . ' like "%' . $termeRecherche . '%"';
        $table = $connection->query($sql);
        $ligne = $table->fetch();
        $nblivre = $ligne['count(*)'];
        
        if ($nblivre <= 0) {
            echo 'Aucun livre trouvé pour la recherche "' . $termeRecherche . '" dans la catégorie "' . $typeRecherche . '".<br>';
            exit;
        } else 
            echo 'Nombre de livres trouvés : ' . $nblivre . '<br><br>';

        $sql = "SELECT * FROM books WHERE $typeRecherche LIKE :terme";
        $requete = $connection->prepare($sql);
        $terme = "%$termeRecherche%";
        $requete->bindParam(':terme', $terme, PDO::PARAM_STR);
        $requete->execute();
        while($ligne = $requete->fetch()) {
            echo '<b>Titre = '.$ligne['title'].'</b><br>Auteur = ' .$ligne['author'].' <br>ISBN = '.$ligne['isbn'].'<br> Prix = '.$ligne['price'].'€<br><br>';
        }
        $requete->closeCursor();

