<?php
require_once 'connexion.php';

$produit = null;

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_produit = $_GET['id'];

    $sql = "SELECT * FROM produit WHERE reference = :id";
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
        <?php echo $produit ? htmlspecialchars($produit['designation']) . ' - LaFleur' : 'Produit introuvable - LaFleur'; ?>
    </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <div class="header-content">
            <a href="accueilLafleur.php" class="logo">La<span class="logo-pink">Fleur</span></a>      
            <div class="right-header">
                <a href="login.php">connexion</a>    
                <a href="login.php">
                    <img src="https://static.vecteezy.com/ti/vecteur-libre/p1/26626361-compte-icone-vecteur-symbole-conception-illustration-vectoriel.jpg" 
                        alt="silhouette de connexion"
                        width="75"
                        height="75"
                    />
                </a>
            </div>
        </div>
    </header>

    <section class="product-section">
        <?php if ($produit): ?>
            <div class="product-container">
                <img src="image/<?php echo htmlspecialchars($produit['photo'] ?? 'placeholder.jpg'); ?>" alt="<?php echo htmlspecialchars($produit['designation']); ?>" class="product-image">
                
                <div class="product-details">
                    <h1><?php echo htmlspecialchars($produit['designation']); ?></h1>
                    
                    <p class="product-price"><?php echo htmlspecialchars($produit['prix']); ?> €</p>
                    
                    <p class="product-description"><?php echo nl2br(htmlspecialchars($produit['description'] ?? 'Aucune description disponible.')); ?></p>
                    
                    <p style="margin-top: 10px; font-weight: bold; color: <?php echo ($produit['qte_stock'] > 0) ? '#28a745' : '#dc3545'; ?>;">
                        <?php echo ($produit['qte_stock'] > 0) ? 'En stock (' . htmlspecialchars($produit['qte_stock']) . ')' : 'Rupture de stock'; ?>
                    </p>

                    <?php if ($produit['qte_stock'] > 0): ?>
                        <a href="panier.php?action=ajouter&id=<?php echo htmlspecialchars($produit['reference']); ?>" class="btn-buy">Ajouter au panier</a>
                    <?php else: ?>
                        <button class="btn-buy" style="background-color: #ccc; cursor: not-allowed;" disabled>Indisponible</button>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="error-message">
                <h2>Produit introuvable.</h2>
                <p>Le produit que vous cherchez n'existe pas</p>
                <a href="accueilLaFleur.php">Retour à la page de recherche</a>
            </div>
        <?php endif; ?>
    </section class="product-section">

    <footer class="footer">
        <p>&copy; 2026 LaFleur - Votre fleuriste de confiance</p>
    </footer>
</body>
</html>
