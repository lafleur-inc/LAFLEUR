<?php
session_start();
include 'connexion.php';
include_once("fonctionPanier.php");

// Traitement des actions
$erreur = false;
$message = '';

$action = (isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : null));

if ($action !== null) {
    if (in_array($action, array('ajout', 'ajouter', 'suppression', 'refresh', 'vider'))) {

        if ($action === 'vider') {
            supprimerPanier();
            $message = "<div class='message-success'>Panier vidé avec succès.</div>";
        } elseif ($action === 'ajouter' || $action === 'ajout') {
            // Récupération des données du produit depuis la BDD
            $id_produit = (isset($_GET['id']) ? $_GET['id'] : null);
            $quantite = (isset($_GET['quantite']) ? intval($_GET['quantite']) : 1);

            if ($id_produit) {
                $sql = "SELECT * FROM produit WHERE reference = :id";
                $stmt = $connection->prepare($sql);
                $stmt->execute(['id' => $id_produit]);
                $produit = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($produit) {
                    ajouterArticle(
                        $produit['designation'],
                        $produit['categorie'] ?? '',
                        $produit['reference'],
                        $quantite,
                        floatval($produit['prix'])
                    );
                    $message = "<div class='message-success'>Article ajouté au panier avec succès.</div>";
                } else {
                    $message = "<div class='message-error'>Produit introuvable.</div>";
                }
            }
        } elseif ($action === 'suppression') {
            $l = (isset($_GET['l']) ? $_GET['l'] : null);
            if ($l) {
                supprimerArticle($l);
                $message = "<div class='message-success'>Article supprimé.</div>";
            }
        } elseif ($action === 'refresh') {
            $q = (isset($_POST['q']) ? $_POST['q'] : array());
            if (is_array($q)) {
                for ($i = 0; $i < count($q); $i++) {
                    if (isset($_SESSION["panier"]["type"][$i])) {
                        modifierQteArticle($_SESSION["panier"]["type"][$i], intval($q[$i]));
                    }
                }
                $message = "<div class='message-success'>Panier mis à jour.</div>";
            }
        }
    }
}

creationPanier();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Panier - LaFleur</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <div class="header-content">
            <a href="accueilLaFleur.php" class="logo">La<span class="logo-pink">Fleur</span></a>
            <h1>Mon Panier</h1>

            <div class="right-header">
                <?php if (isset($_SESSION['connexion']) && $_SESSION['connexion'] === 1): ?>
                    <div class="user-info">
                        <span class="user-name">
                            <?php echo htmlspecialchars($_SESSION['login']); ?>
                        </span>
                        <span class="user-role">
                            <?php echo isset($_SESSION['role']) && $_SESSION['role'] === 'admin' ? 'Administrateur' : 'Utilisateur'; ?>
                        </span>
                    </div>
                <?php else: ?>
                    <a href="login.php">connexion</a>
                <?php endif; ?>
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

    <?php echo $message; ?>

    <div class="panier-container">
        <?php
        $nbArticles = count($_SESSION["panier"]["type"]);

        if ($nbArticles <= 0) {
            echo '<div class="panier-vide">';
            echo '<h3>Votre panier est vide</h3>';
            echo '<p>Découvrez nos magnifiques fleurs et compositions florales</p>';
            echo '<a href="accueilLaFleur.php" class="btn-action btn-continuer panier-vide-link">Continuer mes achats</a>';
            echo '</div>';
        } else {
            ?>
            <div class="panier-header">
                <div>
                    <h2>Votre Panier</h2>
                    <p class="nbr-articles"><?php echo $nbArticles; ?> article<?php echo $nbArticles > 1 ? 's' : ''; ?></p>
                </div>
                <a href="accueilLaFleur.php" class="btn-action btn-continuer">Continuer mes achats</a>
            </div>

            <form method="post" action="panier.php">
                <div class="panier-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Article</th>
                                <th>Prix unitaire</th>
                                <th style="text-align: center;">Quantité</th>
                                <th style="text-align: right;">Prix total</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $montantTotal = 0;
                            for ($i = 0; $i < $nbArticles; $i++) {
                                $type = htmlspecialchars($_SESSION["panier"]["type"][$i]);
                                $marque = isset($_SESSION["panier"]["marque"][$i]) ? htmlspecialchars($_SESSION["panier"]["marque"][$i]) : '';
                                $modele = isset($_SESSION["panier"]["modele"][$i]) ? htmlspecialchars($_SESSION["panier"]["modele"][$i]) : '';
                                $qte = intval($_SESSION['panier']['qte'][$i]);
                                $prix = floatval($_SESSION["panier"]["prix"][$i]);
                                $totalLigne = $qte * $prix;
                                $montantTotal += $totalLigne;

                                echo '<tr>';
                                echo '<td>';
                                echo '<div class="article-info">';
                                echo '<div>';
                                echo '<div class="article-nom">' . $type . '</div>';
                                if ($marque || $modele) {
                                    echo '<div class="article-details">';
                                    if ($marque) echo 'Marque: ' . $marque;
                                    if ($marque && $modele) echo ' - ';
                                    if ($modele) echo 'Modèle: ' . $modele;
                                    echo '</div>';
                                }
                                echo '</div>';
                                echo '</div>';
                                echo '</td>';

                                echo '<td class="prix-unitaire">' . number_format($prix, 2, ',', ' ') . ' €</td>';

                                echo '<td style="text-align: center;">';
                                echo '<input type="number" class="qte-input" name="q[]" value="' . $qte . '" min="1" max="999"/>';
                                echo '</td>';

                                echo '<td class="prix-total" style="text-align: right;">' . number_format($totalLigne, 2, ',', ' ') . ' €</td>';

                                echo '<td style="text-align: center;">';
                                echo '<a href="panier.php?action=suppression&l=' . rawurlencode($_SESSION['panier']['type'][$i]) . '">';
                                echo '<button type="button" class="btn-supprimer" onclick="return confirm(\'Voulez-vous vraiment supprimer cet article ?\')">Supprimer</button>';
                                echo '</a>';
                                echo '</td>';

                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="panier-resume">
                    <h3 class="resume-title">Récapitulatif</h3>

                    <div class="resume-ligne">
                        <span>Nombre d'articles:</span>
                        <span><strong><?php echo $nbArticles; ?></strong></span>
                    </div>

                    <div class="resume-ligne">
                        <span>Sous-total:</span>
                        <span><strong><?php echo number_format($montantTotal, 2, ',', ' '); ?> €</strong></span>
                    </div>

                    <div class="resume-ligne">
                        <span>Livraison:</span>
                        <span><strong>Gratuite</strong></span>
                    </div>

                    <div class="resume-ligne">
                        <span>Total:</span>
                        <span><?php echo number_format($montantTotal, 2, ',', ' '); ?> €</span>
                    </div>
                </div>

                <div class="panier-actions">
                    <button type="submit" name="action" value="refresh" class="btn-action btn-rafraichir">
                        Mettre à jour le panier
                    </button>

                    <a href="panier.php?action=vider" onclick="return confirm('Voulez-vous vraiment vider le panier ?')">
                        <button type="button" class="btn-action btn-vider">Vider le panier</button>
                    </a>

                    <button type="button" class="btn-action btn-commander" onclick="alert('Fonctionnalité de commande à venir !')">
                        Commander
                    </button>
                </div>
            </form>
            <?php
        }
        ?>
    </div>

    <footer class="footer">
        <p>&copy; 2026 LaFleur - Votre fleuriste de confiance</p>
    </footer>
</body>
</html>
