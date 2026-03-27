<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
    </head>
    <body>
        <?php
        include 'connexion.php';
        /**
         * Ce fichier gère l'affichage du formulaire de connexion. Il vérifie si la variable de session 'connexion' est définie, si ce n'est pas le cas, elle est initialisée à 0 pour indiquer que l'utilisateur n'est pas connecté. Ensuite, un formulaire de connexion est affiché avec des champs pour l'identifiant et le mot de passe. Lorsque l'utilisateur soumet le formulaire, les données sont envoyées à login2.php pour être traitées et vérifier les informations d'identification de l'utilisateur.
         *
* @var int $_SESSION['connexion'] C'est une variable de session qui indique si l'utilisateur est connecté ou non. Si la valeur est 1, cela signifie que l'utilisateur est connecté, sinon il n'est pas connecté.
*/
        if (!isset($_SESSION['connexion'])) {
            $_SESSION['connexion'] = 0;
        }
        ?>
        <H1>Identification : </H1>
        <form action="login2.php" method="GET" id="">
            <p>Identifiant : <input type="text" value="" name="login"></p>
            <p>Mot de passe  : <input type="password" value="" name="mdp"></p>
            <input type="submit" value="envoyer">
            <input type="reset" value="annuler">
        </form>
    </body>
</html>