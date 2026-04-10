<?php
    require_once 'connexion.php';

    $mode = 'categories';
    $results = [];
    $recherche = ''; 

    if (isset($_GET['search'])) {
        $mode = 'produits';
        $recherche = trim($_GET['search']);

        if (empty($recherche)) {
            $sql = "SELECT * FROM produit";
            $stmt = $connection->query($sql);
        } else {
            $sql = "SELECT * FROM produit WHERE designation LIKE :recherche";
            $stmt = $connection->prepare($sql);
            $stmt->execute(['recherche' => '%' . $recherche . '%']);
        }
        
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page d'accueil La Fleur</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="header">
    <div class="header-content">
        <a href="accueilLaFleur.php" class="logo">La<span class="logo-pink">Fleur</span></a>
        <h1>Bienvenue Chez la <span class="logo-pink">Fleur</span></h1>

        <div class="right-header">
            <?php if (isset($_SESSION['connexion']) && $_SESSION['connexion'] === 1): ?>
                <div style="display: flex; flex-direction: column; align-items: flex-end; gap: 5px;">
                        <span style="font-weight: bold; color: #333;">
                            <?php echo htmlspecialchars($_SESSION['login']); ?>
                        </span>
                    <span style="font-size: 0.85rem; color: #ec4899; font-weight: 600;">
                            <?php echo $_SESSION['role'] === 'admin' ? 'Administrateur' : 'Utilisateur'; ?>
                        </span>
                </div>
                <a href="login.php">
                    <img src="https://static.vecteezy.com/ti/vecteur-libre/p1/26626361-compte-icone-vecteur-symbole-conception-illustration-vectoriel.jpg"
                         alt="silhouette de connexion"
                         width="75"
                         height="75"
                    />
                </a>
            <?php else: ?>
                <a href="login.php">connexion</a>
                <a href="login.php">
                    <img src="https://static.vecteezy.com/ti/vecteur-libre/p1/26626361-compte-icone-vecteur-symbole-conception-illustration-vectoriel.jpg"
                         alt="silhouette de connexion"
                         width="75"
                         height="75"
                    />
                </a>
            <?php endif; ?>
        </div>
    </div>
</header>

    <section class="produits" style="padding-bottom: 0;">
        <h2>Rechercher un produit</h2>
        <form action="accueilLaFleur.php" method="GET" class="search-form">
            <input type="text" name="search" placeholder="Que cherches-tu ?" value="<?php echo htmlspecialchars($recherche); ?>">
            <button type="submit">Chercher</button>
        </form>
    </section>

    <?php if ($mode === 'categories'): ?>
        
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

    <?php else: ?>

        <section class="produits" style="padding-top: 0;">
            <div class="results-container">
                
                <a href="accueilLaFleur.php" style="display: inline-block; margin-bottom: 20px; color: #6b7280; text-decoration: none; font-weight: bold;">← Retour aux catégories</a>

                <?php 
                    $nb_results = count($results);
                    $s = ($nb_results > 1) ? 's' : ''; 
                ?>

                <?php if (!empty($recherche)): ?>
                    <h3><?php echo $nb_results; ?> résultat<?php echo $s; ?> pour "<?php echo htmlspecialchars($recherche); ?>" :</h3>
                <?php else: ?>
                    <h3>Tous nos produits (<?php echo $nb_results; ?> article<?php echo $s; ?>) :</h3>
                <?php endif; ?>

                <?php if ($nb_results > 0): ?>
                    <?php foreach ($results as $row): ?>
                        <div class="result-item" style="display: flex; gap: 15px; align-items: center;">
                            <img src="image/<?php echo htmlspecialchars($row['photo']); ?>" alt="<?php echo htmlspecialchars($row['designation']); ?>" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                            
                            <div>
                                <strong>
                                    <a href="produit.php?id=<?php echo htmlspecialchars($row['reference']); ?>" style="color: #333; text-decoration: none; font-size: 1.2rem;">
                                        <?php echo htmlspecialchars($row['designation']); ?>
                                    </a>
                                </strong>
                                <p style="color: #ec4899; font-weight: bold; margin: 5px 0;"><?php echo htmlspecialchars($row['prix']); ?> €</p>
                                <a href="produit.php?id=<?php echo htmlspecialchars($row['reference']); ?>" style="color: #6b7280; font-size: 0.9rem; text-decoration: underline;">Voir le produit</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="no-result">Désolé, aucun résultat trouvé pour cette recherche.</p>
                <?php endif; ?>
                
            </div>
        </section>

    <?php endif; ?>

    <footer class="footer">
        <p>&copy; 2026 LaFleur - Votre fleuriste de confiance</p>
    </footer>
</body>
</html>