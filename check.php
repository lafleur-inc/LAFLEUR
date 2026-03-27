<?php
/**
 * Ce fichier gère la vérification de la connexion de l'utilisateur. Il vérifie si la variable de session 'connexion' est définie et si sa valeur est égale à 1, ce qui signifie que l'utilisateur est connecté. Si l'utilisateur n'est pas connecté, il est redirigé vers la page de connexion (login.php). Si l'utilisateur est connecté, un message de bienvenue affichant le nom d'utilisateur est affiché.
* @var $_SESSION['connexion'] int
* @var $_SESSION['login'] string
*/
if (isset($_SESSION['connexion']) && $_SESSION['connexion'] == 1) {
} else {
    header('Location: login.php');
}
echo "Bienvenue " . $_SESSION['login'] . " !";
?>