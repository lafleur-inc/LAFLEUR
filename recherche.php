<?php
require_once 'connexion.php'; 

$results = [];

if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $recherche = trim($_GET['search']);

    $sql = "SELECT * FROM produit WHERE designation LIKE :recherche";
    $stmt = $connection->prepare($sql);
    $stmt->execute(['recherche' => '%' . $recherche . '%']);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche dans Lafleur</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <div class="header-content">
            <a href="accueilLafleur.php" class="logo">La<span class="logo-pink">Fleur</span></a>
        </div>
    </header>

    <section class="produits">
        <h2>Rechercher un produit</h2>

        <form action="" method="GET" class="search-form">
            <input type="text" name="search" placeholder="Que cherches-tu ?" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" required>
            <button type="submit">Chercher</button>
        </form>

        <div class="results-container">
            <?php if (isset($_GET['search'])): ?>
                <h3>Résultats pour "<?php echo htmlspecialchars($_GET['search']); ?>" :</h3>

                <?php if (count($results) > 0): ?>
                    <?php foreach ($results as $row): ?>
                        <div class="result-item">
                            <strong><?php echo htmlspecialchars($row['titre']); ?></strong>
                            <p><?php echo htmlspecialchars($row['description']); ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="no-result">Aucun résultat trouvé pour cette recherche.</p>
                <?php endif; ?>

            <?php endif; ?>
        </div>
    </section>

    <footer class="footer">
        <p>&copy; 2026 LaFleur - Votre fleuriste de confiance</p>
    </footer>
</body>
</html>