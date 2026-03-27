<?php
    include_once 'connexion.php';
    include_once 'check.php';
    /**

* Ce fichier gère l'affichage du formulaire d'ajout de livre. Il affiche un formulaire avec des champs pour le titre, l'auteur, l'ISBN et le prix du livre à ajouter. Lorsque l'utilisateur soumet le formulaire, les données sont envoyées à ajouter2.php pour être traitées et ajoutées à la base de données.

*/
?>
<!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>Page d'accueil FNAC</title>
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
            <h1>FNAC : Ajout de livre</h1>
            <legend >Livre à ajouter :</legend> <br>
                <form action="ajouter2.php" method="post">
                    <label for="termeRecherche">Titre :</label>
                        <input type="text" name="Titre" required> <br> <br>
                    <label for="termeRecherche">Auteur :</label>
                        <input type="text" name="Auteur" required> <br> <br>
                    <label for="termeRecherche">ISBN :</label>
                        <input type="text" name="ISBN" required> <br> <br>
                    <label for="termeRecherche">Prix :</label>
                        <input type="text" name="Prix" required> <br> <br>
                    <input type="submit" value="Ajouter le livre">
            </legend>
        </body>
    </html>