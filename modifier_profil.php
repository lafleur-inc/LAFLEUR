<?php
require_once 'connexion.php'; // Utilise l'objet $connection que nous avons configuré

// Sécurité : Vérifier si l'utilisateur est connecté (User Story 5/6)
if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: accueilLaFleur.php');
    exit();
}

// Récupération des infos actuelles pour préremplir le formulaire
$id = $_SESSION['id_utilisateur'];
$stmt = $connection->prepare("SELECT nom, prenom, email FROM utilisateur WHERE id = :id");
$stmt->execute(['id' => $id]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Lafleur - Mon Profil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Modifier mes informations personnelles</h1>

<form action="traitement_modifier_profil.php" method="POST">
    <div class="form-group">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required>
    </div>

    <div class="form-group">
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($user['prenom']) ?>" required>
    </div>

    <div class="form-group">
        <label for="email">Adresse de courriel (Login) :</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
    </div>

    <div class="form-group">
        <label for="mdp">Nouveau mot de passe (laisser vide pour ne pas changer) :</label>
        <input type="password" id="mdp" name="mdp">
    </div>

    <button type="submit">Enregistrer les modifications</button>
</form>
</body>
</html>