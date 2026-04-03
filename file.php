
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
        <a href="index.php" class="logo">La<span class="logo-pink">Fleur</span></a>
        
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

    

    <footer class="footer">
        <p>&copy; 2026 LaFleur - Votre fleuriste de confiance</p>
    </footer>
</body>
</html>

