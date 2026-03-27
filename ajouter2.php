<?php
    include_once 'connexion.php';
    include_once 'check.php';
/**
 * Ce fichier gère le traitement du formulaire d'ajout de livre. Il vérifie que les données soumises sont valides (titre, auteur, ISBN et prix) et si c'est le cas, il prépare et exécute une requete SQL pour insérer le nouveau livre dans la base de données. Si les données sont incorrectes, un message d'erreur est affiché.
 *
* @var string $Titre C'est le titre du livre à ajouter
* @var string $Auteur C'est l'auteur du livre à ajouter
* @var string $ISBN C'est l'ISBN du livre à ajouter
* @var string $Prix C'est le prix du livre à ajouter
*/
if (
    isset($_REQUEST['Titre'], $_REQUEST['Auteur'], $_REQUEST['Prix'], $_REQUEST['ISBN']) &&
    is_string($_REQUEST['Titre']) &&
    is_string($_REQUEST['Auteur']) &&
    is_numeric($_REQUEST['Prix']) &&
    is_string($_REQUEST['ISBN'])
) {
    $Titre = $_POST['Titre'];
    $Auteur = $_POST['Auteur'];
    $ISBN = $_POST['ISBN'];
    $Prix = $_POST['Prix'];

/**
* @var string $sql C'est la requete SQL d'insertion
* @var PDOStatement $requete C'est la requete préparée qui va être exécutée pour insérer le livre dans la base de données
* @var string $Titre C'est le titre du livre à ajouter
* @var string $Auteur C'est l'auteur du livre à ajouter
* @var string $ISBN C'est l'ISBN du livre à ajouter
* @var string $Prix C'est le prix du livre à ajouter
*/
    $sql = "INSERT INTO books (title, author, isbn, price) VALUES (:title, :author, :isbn, :price)";
    $requete = $connection->prepare($sql);
    $requete->bindParam(':title', $Titre, PDO::PARAM_STR);
    $requete->bindParam(':author', $Auteur, PDO::PARAM_STR);
    $requete->bindParam(':isbn', $ISBN, PDO::PARAM_STR);
    $requete->bindParam(':price', $Prix, PDO::PARAM_STR);
    $requete->execute();
    echo "Livre ajouté avec succès : <br>";
    echo '<b>Titre = ' . $Titre . '</b><br>Auteur = ' . $Auteur
    . '<br>ISBN = ' . $ISBN . '<br> Prix = ' . $Prix . '€<br><br>';
    $requete->closeCursor();
} else {
        echo "Informations incorrectes";
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