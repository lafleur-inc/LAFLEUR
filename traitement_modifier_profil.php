<?php
require_once 'connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_SESSION['id_utilisateur'];
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $mdp = $_POST['mdp'];

    try {
        // Préparation de la requête de base
        $sql = "UPDATE utilisateur SET nom = :nom, prenom = :prenom, email = :email";
        $params = [
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'id' => $id
        ];

        // Si un nouveau mot de passe est saisi, on l'ajoute à la requête
        if (!empty($mdp)) {
            $sql .= ", password = :mdp";
            $params['mdp'] = password_hash($mdp, PASSWORD_BCRYPT);
        }

        $sql .= " WHERE id = :id";

        $stmt = $connection->prepare($sql);
        $stmt->execute($params);

        // Mise à jour de la session
        $_SESSION['nom'] = $nom;
        $_SESSION['prenom'] = $prenom;
        $_SESSION['email'] = $email;

        // Analyse de présence (Exigence 19) : Log de la modification
        // Ici, on pourrait insérer une ligne dans une table 'logs_activite'

        header('Location: modifier_profil.php?success=1');
        exit();

    } catch (PDOException $e) {
        error_log($e->getMessage());
        die("Erreur lors de la mise à jour des données.");
    }
}