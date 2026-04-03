<?php
session_start(); //Récupération de la session actuelle.
session_unset(); //Vide les variables de session
session_destroy(); //Destruction de la session côté serveur

header('location:login.php'); //Redirection vers la page de login
exit();
