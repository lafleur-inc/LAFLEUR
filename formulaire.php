<?php
/**
* Ce fichier gère l'affichage de la page d'accueil de la FNAC en fonction de l'état de connexion de l'utilisateur. Si l'utilisateur est connecté, il affiche un message de bienvenue et les options disponibles pour rechercher, modifier, ajouter ou supprimer des livres. Si l'utilisateur n'est pas connecté, il redirige vers la page de connexion.
*/
include 'connexion.php';
if ($_SESSION['connexion'] == 1) {
    echo "Bienvenue " . $_SESSION['login'] . " !";
    echo '<a href="deconnexion.php">  Deconnexion</a>';
} else {
    header('Location: pagefnac.php');
}
?>
<!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>Page d'accueil FNAC</title>
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
            <h1>FNAC</h1>
            <legend >Que souhaitez vous faire ? </legend> <br>
                <form action="" method="post">
                        <input type="radio" name="choix" value="0" checked> Rechercher une fleur<br>
                        <?php
                        if ($_SESSION['connexion'] == 1) {
                                echo '<input type="radio" name="choix" value="1" checked> Modifier une fleur dans le 
                                catalogue<br>';
                                echo '<input type="radio" name="choix" value="2"> Ajouter une fleur<br>';
                                echo '<input type="radio" name="choix" value="3"> Supprimer une fleur<br>';
                        }
                        ?>
                    <br>
                    <input type="submit" value="Valider">
                </form>
            </legend>
            <?php
            if (isset($_POST['choix'])) {
                $choix = $_POST['choix'];
                switch ($choix) {
                    case 0:
                        header('Location: pagefnac.php');
                        break;
                    case 1:
                        header('Location: modifier.php');
                        break;
                    case 2:
                        header('Location: ajouter.php');
                        break;
                    case 3:
                        header('Location: supprimer.php');
                        break;
                }
            }
            ?>
        </body>
    </html>