<?php
require_once 'connexion.php';

$produit = null;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_produit = $_GET['id'];

    $sql = "SELECT * FROM produits WHERE id = :id";
    $stmt = $connection->prepare($sql);
    $stmt->execute(['id' => $id_produit]);
    $produit = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $produit ? htmlspecialchars($produit['nom']) . ' - LaFleur' : 'Produit introuvable - LaFleur'; ?>
    </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <div class="header-content">
            <a href="index.php" class="logo">La<span class="logo-pink">Fleur</span></a>
        </div>
    </header>

    <main>
        <?php if ($produit): ?>
            <div class="product-container">
                <img src="<?php echo htmlspecialchars($produit['image_url'] ?? 'placeholder.jpg'); ?>" alt="<?php echo htmlspecialchars($produit['nom']); ?>" class="product-image">
                
                <div class="product-details">
                    <h1><?php echo htmlspecialchars($produit['nom']); ?></h1>
                    <p class="product-price"><?php echo htmlspecialchars($produit['prix']); ?> €</p>
                    <p class="product-description"><?php echo nl2br(htmlspecialchars($produit['description'])); ?></p>
                    
                    <a href="panier.php?action=ajouter&id=<?php echo $produit['id']; ?>" class="btn-buy">Ajouter au panier</a>
                </div>
            </div>
        <?php else: ?>
            <div class="error-message">
                <h2>Oups ! Produit introuvable.</h2>
                <p>Le produit que vous cherchez n'existe pas ou a été retiré.</p>
                <a href="recherche.php">Retour à l'accueil</a>
            </div>
        <?php endif; ?>
    </main>

    <footer class="footer">
        <p>&copy; 2026 LaFleur - Votre fleuriste de confiance</p>
    </footer>
</body>
</html>