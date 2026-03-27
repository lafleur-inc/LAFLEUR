<?php
    include 'connexion.php';
?>
<!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>Page d'accueil La Fleur</title>
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
            <h1>Recherche dans notre catalogue de fleurs</h1>
            <legend >Choisissez un type de fleur</legend>
                <form action="recherche.php" method="post">
                    <select class="deroulant" id="typeRecherche" name="typeRecherche" required><br>
                        <option value="title">Titre</option>
                        <option value="author">Auteur</option>
                        <option value="isbn">ISBN</option>
                    </select> <br><br>
                    <label for="termeRecherche">Terme a rechercher :</label> <br>
                        <input type="text" name="termeRecherche">
                        <input type="submit" value="Rechercher">
            </legend>
        </body>
    </html>