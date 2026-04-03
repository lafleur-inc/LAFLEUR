<?php
/**
* Ce fichier gère la déconnexion de l'utilisateur en détruisant la session en cours et en redirigeant vers la page de connexion
*/
    session_start();
    session_unset();
    session_destroy();
    header('location:login.php');
?>
    