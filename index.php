<?php
    include 'connexion.php';
    include 'check.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaFleur - Accueil</title>

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
                <a href="deconnexion.php" style="padding: 8px 15px; background-color: #6b7280; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; transition: 0.3s;">
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

    <section class="hero">
        <h1>Bienvenue chez <span class="logo-pink">LaFleur</span></h1>
        <p>Découvrez notre collection de plantes et fleurs pour votre jardin</p>
    </section>

    <section class="categories">
        <h2>Nos Catégories</h2>
        <div class="grid">
            <a href="categorie.php?id=bulbes" class="card">
                <img src="https://images.unsplash.com/photo-1773322524707-77c64c75247b?w=600" alt="Bulbes">
                <div class="card-body">
                    <h3>Bulbes</h3>
                    <p>Bulbes de fleurs à planter pour un jardin coloré</p>
                </div>
            </a>
            <a href="categorie.php?id=plante-massif" class="card">
                <img src="https://images.unsplash.com/photo-1715716958289-8d87eb9753f8?w=600" alt="Plante à massif">
                <div class="card-body">
                    <h3>Plante à massif</h3>
                    <p>Plantes pour créer de magnifiques massifs dans votre jardin</p>
                </div>
            </a>
            <a href="categorie.php?id=rosier" class="card">
                <img src="https://images.unsplash.com/photo-1687226690518-d6470e541c1e?w=600" alt="Rosier">
                <div class="card-body">
                    <h3>Rosier</h3>
                    <p>Rosiers de qualité pour embellir votre espace extérieur</p>
                </div>
            </a>
        </div>
    </section>

    <footer class="footer">
        <p>&copy; 2026 LaFleur - Votre fleuriste de confiance</p>
    </footer>
</body>
</html>