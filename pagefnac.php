<?php
    include 'connexion.php';
?>
<!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>Page d'accueil FNAC</title>
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
            <h1>FNAC : recherche dans le catalogue</h1>
            <legend >Choisissez un type de recherche :</legend>
                <form action="recherche.php" method="post">
                    <select class="deroulant" id="typeRecherche" name="typeRecherche" required><br>
                        <option value="title">Titre</option>
                        <option value="author">Auteur</option>
                        <option value="isbn">ISBN</option>
                    </select> <br><br>
                    <label for="termeRecherche">Terme à rechercher :</label> <br>
                        <input type="text" name="termeRecherche">
                        <input type="submit" value="Rechercher">
            </legend>
        </body>
    </html>