<?php
    include 'connexion.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page d'accueil La Fleur</title>
    <link rel="stylesheet" href="style.css">
</head>

<header class="header">
    <div class="header-content">
        <a href="index.php" class="logo">La<span class="logo-pink">Fleur</span></a>
        <h1>Bienvenue Chez la <span class="logo-pink">Fleur</span></h1>
    
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

<body>
    <div class="search-section">
        <h2>Recherche dans notre catalogue de fleurs</h2>

        <form class="search-form" action="recherche.php" method="GET">
            <input type="text" name="q" placeholder="Rechercher une fleur...">
            <button type="submit">Rechercher</button>
        </form>
    </div>

    <nav>
        <div class="main_pages">
            <a href="#">Rosier</a>
            <a href="#">Plantes à massif</a>
            <a href="#">Bulbes</a>
        </div>
    </nav>



</body>
<footer class="footer">
        <p>&copy; 2026 LaFleur - Votre fleuriste de confiance</p>
    </footer>
</html>