<?php
include 'connexion.php';

/**
* @var string $login C'est le nom d'utilisateur saisi par l'utilisateur dans le formulaire de connexion
* @var string $mdp C'est le mot de passe saisi par l'utilisateur dans le formulaire de connexion
*/
$login = $_REQUEST['login'];
$mdp = $_REQUEST['mdp'];

/**
* @var string $sql C'est la requete SQL qui sélectionne les informations de l'utilisateur correspondant au nom d'utilisateur saisi
* @var PDOStatement $requete C'est la requete préparée qui va être exécutée pour récupérer les informations de l'utilisateur correspondant au nom d'utilisateur saisi
* @var array $user C'est un tableau associatif qui contient les informations de l'utilisateur récupérées à partir de la base de données. Si l'utilisateur existe, le tableau contiendra les informations de l'utilisateur, sinon il sera vide
*/

$sql = 'SELECT * FROM member WHERE username = :login';
$requete = $connection->prepare($sql);
$requete->execute([':login' => $login]);
$user = $requete->fetch(PDO::FETCH_ASSOC);

/**
* Si l'utilisateur existe, la fonction password_verify() est utilisée pour vérifier si le mot de passe saisi correspond au mot de passe stocké dans la base de données. Si les mots de passe correspondent, les variables de session sont définies pour indiquer que l'utilisateur est connecté et pour stocker le nom d'utilisateur. Si les mots de passe ne correspondent pas ou si l'utilisateur n'existe pas, la variable de session 'connexion' est définie sur 0 pour indiquer que l'utilisateur n'est pas connecté
*/
if ($user) {
    if (password_verify($mdp, $user['password'])) {
        $_SESSION['login'] = $login;
        $_SESSION['connexion'] = 1;
    } else {
        $_SESSION['connexion'] = 0;
    }
} else {
    $_SESSION['connexion'] = 0;
}

header('Location: formulaire.php');
exit();
?>
