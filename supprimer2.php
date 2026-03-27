<?php
include 'connexion.php';
include 'check.php';
$sql = 'SELECT * FROM books WHERE isbn = :isbn';
$requete = $connection->prepare($sql);
$requete->bindParam(':isbn', $_REQUEST['livre'], PDO::PARAM_STR);
?>
<!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>Page d'accueil FNAC</title>
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
            <h1>FNAC :</h1>
            <legend >Informations du livre : </legend>
                <form action="supprimer3.php" method="get">
                    <?php
                    $requete->execute();
                    while ($ligne = $requete->fetch()) {
                        echo '<b>Titre = ' . $ligne ['title'] . '</b><br>Auteur = ' . $ligne ['author'] .
                        ' <br>ISBN = ' . $ligne ['isbn'] . '<br> Prix = ' . $ligne ['price'] . '€<br><br>';
                    }
                    $sql = 'SELECT orderid FROM order_items WHERE isbn = :isbn';
                    $requete = $connection->prepare($sql);
                    $requete->bindParam(':isbn', $_REQUEST['livre'], PDO::PARAM_STR);
                    $requete->execute();
                    while ($ligne = $requete->fetch()) {
                        echo '<input type="hidden" name="orderid" value="' . $ligne['orderid'] . '">';
                    }
                    ?>
                    <input type="hidden" name="livre" value="<?= $_REQUEST['livre'] ?>">
                    <input type="submit" value="Supprimer le livre" class="submit">
            </legend>
        </body>
    </html>