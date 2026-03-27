<?php
include_once 'connexion.php';
include_once 'check.php';
if (isset($_REQUEST['livre'])) {
    $ISBN = $_REQUEST['livre'];
    $sql = "Select orderid FROM order_items WHERE isbn = :isbn";
    $requete = $connection->prepare($sql);
    $requete->bindParam(':isbn', $_REQUEST['livre'], PDO::PARAM_STR);
    $requete->execute();
    while ($ligne = $requete->fetch()) {
        $sql = "DELETE FROM order_items WHERE orderid = :orderid";
        $requete2 = $connection->prepare($sql);
        $requete2->bindParam(':orderid', $ligne['orderid'], PDO::PARAM_STR);
        $requete2->execute();
    }
    $sql = "DELETE FROM orders WHERE orderid = :orderid";
    $requete = $connection->prepare($sql);
    $requete->bindParam(':orderid', $_REQUEST['orderid'], PDO::PARAM_STR);
    $requete->execute();
    $sql = "DELETE FROM book_reviews WHERE isbn = :isbn";
    $requete = $connection->prepare($sql);
    $requete->bindParam(':isbn', $ISBN, PDO::PARAM_STR);
    $requete->execute();
    $sql = "DELETE FROM books WHERE isbn = :isbn";
    $requete = $connection->prepare($sql);
    $requete->bindParam(':isbn', $ISBN, PDO::PARAM_STR);
    $requete->execute();
    $requete->closeCursor();
    header("Location: formulaire.php");
} else {
    echo "Suppression impossible";
}
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
            <legend >Livre supprimé !</legend>
        </body>
    </html>