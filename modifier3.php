<?php

    include 'connexion.php';
    include 'check.php';

    if (
    (isset($_REQUEST['Titre'])) && (is_string($_REQUEST['Titre'])) || 
    (isset($_REQUEST['Auteur'])) && (is_string($_REQUEST['Auteur'])) || 
    (isset($_REQUEST['Prix'])) && (is_numeric($_REQUEST['Prix']))
    ) {
        $isbn = $_REQUEST['isbn'];
        $sql = "SELECT title, author, isbn, price FROM books WHERE isbn = '$isbn'";
        $table = $connection->query($sql);
        $ligne = $table->fetch();

        if (empty($_REQUEST['Titre'])) {
            $Titre = htmlspecialchars($ligne['title']);
        } else {
            $Titre = $_REQUEST['Titre'];
        }
        if (empty($_REQUEST['Auteur'])) {
            $Auteur = htmlspecialchars($ligne['author']);
        } else {
            $Auteur = $_REQUEST['Auteur'];
        }
        if (empty($_REQUEST['Prix'])) {
            $Prix = htmlspecialchars($ligne['price']);
        } else {
            $Prix = $_REQUEST['Prix'];
        }
        
        $OldTitle = $_REQUEST['AncienTitre'];
        $sql2 = "SELECT isbn FROM books WHERE title = :oldTitle";
        $requete = $connection->prepare($sql2);
        $requete->bindParam(':oldTitle', $OldTitle, PDO::PARAM_STR);
        $requete->execute();
        $ligne = $requete->fetch();
        $sql = "UPDATE books SET title = :title, author = :author, price = :price WHERE title = :oldTitle";
        $requete = $connection->prepare($sql);
        $requete->bindParam(':title', $Titre, PDO::PARAM_STR);
        $requete->bindParam(':author', $Auteur, PDO::PARAM_STR);
        $requete->bindParam(':price', $Prix, PDO::PARAM_STR);
        $requete->bindParam(':oldTitle', $OldTitle, PDO::PARAM_STR);
        $requete->execute();
        $requete->closeCursor();
        header("Location: formulaire.php");
    } else {
        echo "Données manquantes / Impossible de modifier le livre.";
    }
?>
<!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>Page de modification FNAC</title>
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
            <a href=formulaire.php>Retour au formulaire</a>
        </body>
    </html>