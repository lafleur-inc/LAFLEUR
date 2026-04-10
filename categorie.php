<?php
$category_id = $_GET['id'] ?? '';

$categories = [
    'bulbes' => [
        'name' => 'Bulbes',
        'description' => 'Bulbes de fleurs à planter pour un jardin coloré',
        'image' => 'https://images.unsplash.com/photo-1773322524707-77c64c75247b?w=800',
        'products' => [
            ['name' => 'Bulbes de Tulipes', 'price' => 12.99, 'desc' => 'Lot de 10 bulbes de tulipes multicolores'],
            ['name' => 'Bulbes de Narcisses', 'price' => 10.99, 'desc' => 'Lot de 10 bulbes de narcisses jaunes'],
            ['name' => 'Bulbes de Jacinthes', 'price' => 14.99, 'desc' => 'Lot de 8 bulbes de jacinthes parfumées'],
            ['name' => 'Bulbes de Crocus', 'price' => 8.99, 'desc' => 'Lot de 15 bulbes de crocus'],
        ]
    ],
    'plante-massif' => [
        'name' => 'Plante à massif',
        'description' => 'Plantes pour créer de magnifiques massifs dans votre jardin',
        'image' => 'https://images.unsplash.com/photo-1715716958289-8d87eb9753f8?w=800',
        'products' => [
            ['name' => 'Géraniums', 'price' => 5.99, 'desc' => 'Géraniums rouges en pot'],
            ['name' => 'Pétunias', 'price' => 4.99, 'desc' => 'Pétunias multicolores'],
            ['name' => 'Bégonias', 'price' => 6.99, 'desc' => 'Bégonias à fleurs doubles'],
            ['name' => 'Pensées', 'price' => 3.99, 'desc' => 'Pensées variées'],
        ]
    ],
    'rosier' => [
        'name' => 'Rosier',
        'description' => 'Rosiers de qualité pour embellir votre espace extérieur',
        'image' => 'https://images.unsplash.com/photo-1687226690518-d6470e541c1e?w=800',
        'products' => [
            ['name' => 'Rosier Buisson Rouge', 'price' => 24.99, 'desc' => 'Rosier buisson à grandes fleurs rouges'],
            ['name' => 'Rosier Grimpant Blanc', 'price' => 29.99, 'desc' => 'Rosier grimpant remontant blanc'],
            ['name' => 'Rosier Couvre-sol Rose', 'price' => 19.99, 'desc' => 'Rosier couvre-sol florifère'],
            ['name' => 'Rosier Anglais', 'price' => 34.99, 'desc' => 'Rosier anglais parfumé'],
        ]
    ]
];

$category = $categories[$category_id] ?? null;
if (!$category) { header('Location: accueilLaFleur.php'); exit; }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaFleur - <?php echo $category['name']; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
    <div class="header-content">
        <a href="accueilLaFleur.php" class="logo">La<span class="logo-pink">Fleur</span></a>
        
        <!-- Bloc du bouton de connexion -->
        <div>
            <?php if (isset($_SESSION['connexion']) && $_SESSION['connexion'] == 1): ?>
                <!-- Si l'utilisateur est connecté -->
                <span style="margin-right: 15px; color: #6b7280; font-weight: bold;">
                    Bonjour, <?php echo htmlspecialchars($_SESSION['login']); ?>
                </span>
                <a href="logout.php" style="padding: 8px 15px; background-color: #6b7280; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; transition: 0.3s;">
                    Déconnexion
                </a>
            <?php else: ?>
                <!-- Si l'utilisateur n'est PAS connecté -->
                <a href="login.php" style="padding: 8px 15px; background-color: #ec4899; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; transition: 0.3s;">
                    Se connecter / S'inscrire
                </a>
            <?php endif; ?>
        </div>
    </div>
</header>

    <div class="container">
        <a href="accueilLaFleur.php" class="back">← Retour aux catégories</a>
        
        <div class="hero">
            <img src="<?php echo $category['image']; ?>" alt="<?php echo $category['name']; ?>">
            <div class="hero-overlay">
                <h1><?php echo $category['name']; ?></h1>
                <p><?php echo $category['description']; ?></p>
            </div>
        </div>

        <div class="products">
            <h2>Nos Produits</h2>
            <p style="color: #6b7280;"><?php echo count($category['products']); ?> produits disponibles</p>
            
            <div class="grid">
                <?php foreach ($category['products'] as $product): ?>
                    <div class="card">
                        <img src="<?php echo $category['image']; ?>" alt="<?php echo $product['name']; ?>">
                        <div class="card-body">
                            <h3><?php echo $product['name']; ?></h3>
                            <p><?php echo $product['desc']; ?></p>
                            <span class="price"><?php echo number_format($product['price'], 2); ?> €</span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2026 LaFleur - Votre fleuriste de confiance</p>
    </footer>
</body>
</html>