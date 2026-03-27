<?php
    include 'connexion.php';
    include 'check.php';
    /**
* On selectionne les titres de tous les livres de la base de données pour les afficher dans une liste déroulante. L'utilisateur pourra ensuite choisir un livre à modifier en sélectionnant son titre dans la liste déroulante et en cliquant sur le bouton "Modifier".
*/
    $sql = 'SELECT title FROM books';
    $table = $connection->query($sql);
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
            <legend >Quel livre souhaitez vous modifier ?</legend>
                <form action="modifier2.php" method="get">
                    <select class="deroulant" id="typeRecherche" name="typeRecherche" required><br>
                        <?php
                            while ($ligne = $table->fetch()) {
                                echo '<option value="' . htmlspecialchars($ligne['title']) . '">' . htmlspecialchars($ligne['title']) . '</option>';
                            }
                        ?>
                    </select> <br><br>
                        <input type="submit" value="Modifier">
            </legend>
        </body>
    </html>