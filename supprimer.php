<?php
    include 'connexion.php';
    include 'check.php';
    $sql = 'SELECT * FROM books';
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
            <legend >Quel livre souhaitez vous supprimer ?</legend>
                <form action="supprimer2.php" method="get">
                    <select class="deroulant" id="livre" name="livre"><br>
                        <?php
                        while ($ligne = $table->fetch()) {
                            echo '<option value="' . $ligne['isbn'] . '">' . $ligne['title'] . '</option>';
                        }
                        ?>
                    </select> <br><br>
                        <input type="submit" value="Voir les détails du livre" class="submit">
            </legend>
        </body>
    </html>