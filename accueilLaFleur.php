<?php
    include 'connexion.php';

    $results = [];
    $recherche = ''; // On prépare la variable pour la recherche

    // 1. Si une recherche est lancée et n'est pas vide
    if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
        $recherche = trim($_GET['search']);
        $sql = "SELECT * FROM produit WHERE designation LIKE :recherche";
        $stmt = $connection->prepare($sql);
        $stmt->execute(['recherche' => '%' . $recherche . '%']);
    } else {
        // 2. Sinon (page d'accueil par défaut ou recherche vide), on prend TOUS les produits
        $sql = "SELECT * FROM produit";
        $stmt = $connection->query($sql);
    }
    
    // On récupère les résultats dans tous les cas
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // On compte combien il y a de lignes trouvées
    $nb_results = count($results);
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

    <section class="produits">
        <h2>Rechercher un produit</h2>

        <form action="" method="GET" class="search-form">
            <input type="text" name="search" placeholder="Que cherches-tu ?" value="<?php echo htmlspecialchars($recherche); ?>">
            <button type="submit">Chercher</button>
        </form>

        <div class="results-container">
            <?php 
                // Petite astuce pour mettre un "s" seulement si on a plus d'un résultat
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

    <footer class="footer">
        <p>&copy; 2026 LaFleur - Votre fleuriste de confiance</p>
    </footer>
</body>
</html>