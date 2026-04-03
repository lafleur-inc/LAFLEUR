<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'connexion.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // ==========================================
    // TRAITEMENT DE L'INSCRIPTION
    // ==========================================
    if (isset($_POST['action']) && $_POST['action'] === 'inscription') {
        $nom = trim($_POST['nom']);
        $email = trim($_POST['email']);
        $mdp = $_POST['mdp'];

        $check = $connection->prepare("SELECT nom FROM utilisateur WHERE nom = :nom OR email = :email");
        $check->execute([':nom' => $nom, ':email' => $email]);
        
        if ($check->rowCount() > 0) {
            $message = "<div style='color:#721c24; background:#f8d7da; padding:15px; text-align:center;'>Ce nom d'utilisateur ou cet email est déjà utilisé.</div>";
        } else {
            $mdp_hashe = password_hash($mdp, PASSWORD_DEFAULT);
            $insert = $connection->prepare("INSERT INTO utilisateur (nom, email, mot_de_passe) VALUES (:nom, :email, :mot_de_passe)");
            
            if ($insert->execute([':nom' => $nom, ':email' => $email, ':mot_de_passe' => $mdp_hashe])) {
                $message = "<div style='color:#155724; background:#d4edda; padding:15px; text-align:center;'>Compte créé avec succès ! Vous pouvez maintenant vous connecter.</div>";
            } else {
                $message = "<div style='color:#721c24; background:#f8d7da; padding:15px; text-align:center;'>Erreur lors de la création du compte.</div>";
            }
        }
    }

    // ==========================================
    // TRAITEMENT DE LA CONNEXION
    // ==========================================
    if (isset($_POST['action']) && $_POST['action'] === 'connexion') {
        $login = $_POST['login']; 
        $mdp = $_POST['mdp'];     

        $sql = 'SELECT * FROM utilisateur WHERE nom = :login';
        $requete = $connection->prepare($sql);
        $requete->execute([':login' => $login]);
        $user = $requete->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($mdp, $user['mot_de_passe'])) {
                $_SESSION['login'] = $user['nom'];
                $_SESSION['connexion'] = 1;
                header('Location: accueilLaFleur.php');
                exit();
            } else {
                $_SESSION['connexion'] = 0;
                $message = "<div style='color:#721c24; background:#f8d7da; padding:15px; text-align:center;'>Mot de passe incorrect.</div>";
            }
        } else {
            $_SESSION['connexion'] = 0;
            $message = "<div style='color:#721c24; background:#f8d7da; padding:15px; text-align:center;'>Utilisateur introuvable.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion / Inscription</title>
    <!-- On charge votre fichier CSS ici -->
    <link rel="stylesheet" href="style.css"> 
</head>
<body>

    <!-- L'en-tête issu de votre CSS -->
    <div class="header">
        <div class="header-content">
            <a href="accueilLaFleur.php" class="logo">MaBoutique<span class="logo-pink">Fleurs</span></a>
        </div>
    </div>

    <!-- Le bloc Hero pour le titre -->
    <div class="hero">
        <h1>Espace Membre</h1>
        <p>Connectez-vous ou créez un compte pour gérer vos commandes.</p>
    </div>

    <!-- Affichage des messages (erreurs ou succès) -->
    <?php if (!empty($message)) echo $message; ?>

    <!-- Utilisation de vos classes grid et card pour aligner les formulaires -->
    <div class="produits">
        <div class="grid">
            
            <!-- FORMULAIRE DE CONNEXION (dans une 'card') -->
            <div class="card">
                <div class="card-body">
                    <h3 style="margin-bottom: 20px; border-bottom: 2px solid #fce7f3; padding-bottom: 10px;">Déjà membre ?</h3>
                    <form method="POST" action="">
                        <input type="hidden" name="action" value="connexion">
                        
                        <label style="display:block; margin-bottom:5px; color:#6b7280;">Nom d'utilisateur</label>
                        <input type="text" name="login" required>
                        
                        <label style="display:block; margin-bottom:5px; color:#6b7280;">Mot de passe</label>
                        <input type="password" name="mdp" required>
                        
                        <button type="submit" style="width: 100%; margin-top: 10px;">Se connecter</button>
                    </form>
                </div>
            </div>

            <!-- FORMULAIRE D'INSCRIPTION (dans une 'card') -->
            <div class="card">
                <div class="card-body">
                    <h3 style="margin-bottom: 20px; border-bottom: 2px solid #fce7f3; padding-bottom: 10px;">Nouveau client ?</h3>
                    <form method="POST" action="">
                        <input type="hidden" name="action" value="inscription">
                        
                        <label style="display:block; margin-bottom:5px; color:#6b7280;">Nom d'utilisateur</label>
                        <input type="text" name="nom" required>

                        <label style="display:block; margin-bottom:5px; color:#6b7280;">Email</label>
                        <input type="email" name="email" required>
                        
                        <label style="display:block; margin-bottom:5px; color:#6b7280;">Mot de passe</label>
                        <input type="password" name="mdp" required>
                        
                        <button type="submit" style="width: 100%; margin-top: 10px; background-color: #ec4899;">Créer mon compte</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- Le pied de page issu de votre CSS -->
    <div class="footer">
        <p>&copy; 2024 MaBoutiqueFleurs. Tous droits réservés.</p>
    </div>

</body>
</html>