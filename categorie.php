
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
if (!$category) { header('Location: index.php'); exit; }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaFleur - <?php echo $category['name']; ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f9fafb; }
        .header { background: white; box-shadow: 0 2px 5px rgba(0,0,0,0.1); padding: 1rem 2rem; }
        .header-content { max-width: 1200px; margin: 0 auto; }
        .logo { font-size: 1.8rem; font-weight: bold; text-decoration: none; color: #333; }
        .logo-pink { color: #ec4899; }
        .container { max-width: 1200px; margin: 0 auto; padding: 2rem; }
        .back { display: inline-block; color: #6b7280; text-decoration: none; margin-bottom: 2rem; }
        .back:hover { color: #ec4899; }
        .hero { position: relative; height: 300px; border-radius: 15px; overflow: hidden; margin-bottom: 2rem; }
        .hero img { width: 100%; height: 100%; object-fit: cover; }
        .hero-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.7), rgba(0,0,0,0.2)); display: flex; align-items: center; justify-content: center; flex-direction: column; color: white; }
        .hero-overlay h1 { font-size: 3rem; margin-bottom: 1rem; }
        .hero-overlay p { font-size: 1.2rem; }
        .products { margin-top: 2rem; }
        .products h2 { font-size: 2rem; margin-bottom: 1rem; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1.5rem; margin-top: 2rem; }
        .card { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .card img { width: 100%; height: 200px; object-fit: cover; }
        .card-body { padding: 1.5rem; }
        .card-body h3 { font-size: 1.2rem; margin-bottom: 0.5rem; }
        .card-body p { color: #6b7280; font-size: 0.9rem; margin-bottom: 1rem; }
        .price { font-size: 1.5rem; color: #ec4899; font-weight: bold; }
        .footer { background: #1f2937; color: #9ca3af; text-align: center; padding: 3rem; margin-top: 4rem; }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <a href="index.php" class="logo">La<span class="logo-pink">Fleur</span></a>
        </div>
    </header>

    <div class="container">
        <a href="index.php" class="back">← Retour aux catégories</a>
       
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

