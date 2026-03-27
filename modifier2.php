<?php
    include 'connexion.php';
    include 'check.php';
    if (isset($_REQUEST['typeRecherche'])) {
        $Titre = $_REQUEST['typeRecherche'];
        $sql = "SELECT title, author, isbn, price FROM books WHERE title = '$Titre'";
        $table = $connection->query($sql);
        $ligne = $table->fetch();
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
            <h1>FNAC : modification du livre <?= htmlspecialchars($ligne['title']) ?></h1>
        <legend >Modification à apporter :</legend> <br>
            <form action="modifier3.php" method="get">
                <label for="termeRecherche">Titre :</label>
                    <input type="text" name="Titre" value="<?php echo htmlspecialchars($ligne['title']); ?>"> <br> <br>
                <label for="termeRecherche">Auteur :</label>
                    <input type="text" name="Auteur"value="<?php echo htmlspecialchars($ligne['author'])?>"> <br> <br>
                <label for="termeRecherche">Prix :</label>
                    <input type="text" name="Prix" value="<?php echo htmlspecialchars($ligne['price'])?>"> <br> <br>
                <label for="termeRecherche">ISBN :</label>
                    <input type="text" name="ISBN" disabled="disabled" value="<?php echo htmlspecialchars($ligne['isbn'])?>"> <br> <br>

                <input type="submit" value="Modifier le livre">
                <input type="hidden" name="AncienTitre" value="<?= htmlspecialchars($ligne['title']) ?>">
            </form>
        </legend>
    </body>
</html>
