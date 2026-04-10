<?php
session_start();

include_once("fonctionPanier.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml : lang="fr">
<head>

<link rel="stylesheet" href="style.css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Panier</title>

</head>

<body>
<form method= "post" action="panier.php">
<table width="400">
    <tr>
        <td colspan= "4">Votre panier</td>
    </tr>
    <tr>
        <td>Type</td>
        <td>Marque</td>
        <td>Modele</td>
        <td>Quantité</td>
        <td>Prix</td>
    </tr>

    <?php
    if (creationPanier()) {
        $nbArticles = count($_SESSION["panier"]["type"]);
        if ($nbArticles <= 0) {
            echo "<tr><td>Votre panier est vide </ td></tr>";
        } else {
            for ($i = 0; $i < $nbArticles; $i++) {
                echo "<tr>";
                echo "<td>".htmlspecialchars( $_SESSION["panier"]["type"][$i]) . "</td>";
                echo "<td><input type=\"text\" size=\"4\" name=\"q[]\" value=\"".htmlspecialchars($_SESSION['panier']['qte'][$i])."\"/></td>";
                echo "<td>" .htmlspecialchars($_SESSION["panier"]["prix"][$i]) . "</td>";
                echo "<td><a href=\"".htmlspecialchars("panier.php?action=suppression&l=".rawurlencode($_SESSION['panier']['type'][$i]))."\">XX</a></td>";
                echo "</tr>";
            }
            echo "<tr><td colspan=\"2\"> </td>";
            echo "<td colspan=\"2\">";
            echo "Total : ".MontantGlobal();
            echo "</td></tr>";

            echo"<tr><td colspan=\"4\">";
            echo "<input type=\"submit\" value=\"Rafraichir\"/>";
            echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/>";

            echo "</td></tr>";
        }
    }
    ?>
</table>
</form>
</body>
</html>

<?php
$erreur = false;

$action = (isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : null));
if ($action !== null) {
    if (!in_array($action, array('ajout', 'suppression', 'refresh'))) {
        $erreur = true;
        
        //récupération des variables (POST ou GET)
        $l = (isset($_POST['l']) ? $_POST['l'] : (isset($_GET['l']) ? $_GET['l'] : null));
        $q = (isset($_POST['q']) ? $_POST['q'] : (isset($_GET['q']) ? $_GET['q'] : null));
        $p = (isset($_POST['p']) ? $_POST['p'] : (isset($_GET['p']) ? $_GET['p'] : null));

        //Suppression des espaces verticaux
        $l = preg_replace('#\v#', '', $l);

        //On vérifie que $p est un float
        $p = floatval($p);

        //On traite $q , soit un entier soit un tableau d'entier
        if(is_array($q)){
            $QteArticle = array();
            $i = 0;
            foreach ($q as $contenu){
                $QteArticle[$i++] = intval($contenu);
            }
        } else {
            $q = intval($q);
        }
    }
}
if(!$erreur){
    switch($action){
        Case "ajout":
            ajouterArticle($l,$q,$p);
            break;

        Case "suppression":
            supprimerArticle($l);
            break;

        Case "refresh" :
            for ($i = 0; $i < count($QteArticle); $i++) {
                modifierQteArticle($_SESSION["panier"]["type"][$i], round($QteArticle[$i]));
            }
            break;

        Default:
            break;
    }
}