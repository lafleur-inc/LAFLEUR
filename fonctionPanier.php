<?php
function creationPanier()
{
    if (!isset($_SESSION["panier"])) {
        $_SESSION["panier"] = array();
        $_SESSION["panier"]["type"] = array();
        $_SESSION["panier"]["marque"] = array();    
        $_SESSION["panier"]["modele"] = array();
        $_SESSION["panier"]["qte"] = array();
        $_SESSION["panier"]["prix"] = array();
        $_SESSION["panier"]["verrou"] = false;
    }
    return true;
}

function ajouterArticle($type, $marque, $modele, $qte, $prix){
    
    //on verifie l'existense du panier
    if (creationPanier()) {
        $position = array_search($type, $_SESSION["panier"]["type"]);
        if ($position !== false) {

            // si le produit existe déja on ajoute uniquement la quantité
            $_SESSION["panier"]["qte"][$position] += $qte;
        } else {
            array_push($_SESSION["panier"]["type"], $type);
            array_push($_SESSION["panier"]["marque"], $marque);
            array_push($_SESSION["panier"]["modele"], $modele);
            array_push($_SESSION["panier"]["qte"], $qte);
            array_push($_SESSION["panier"]["prix"], $prix);
        }
    }else
    echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}
 
function supprimerArticle($type){
    //si le panier existe 
    if (creationPanier()) {
        $tmp = array();
        $tmp["type"] = array(); 
        $tmp["marque"] = array();
        $tmp["modele"] = array();
        $tmp["qte"] = array();
        $tmp["prix"] = array();
        $tmp["verrou"] = $_SESSION["panier"]["verrou"];

        for ($i = 0; $i <count($_SESSION["panier"]["type"]); $i++) {
            if ($_SESSION["panier"]["type"][$i] !== $type) {
                array_push($tmp["type"], $_SESSION["panier"]["type"][$i]);
                array_push($tmp["marque"], $_SESSION["panier"]["marque"][$i]);
                array_push($tmp["modele"], $_SESSION["panier"]["modele"][$i]);
                array_push($tmp["qte"], $_SESSION["panier"]["qte"][$i]);
                array_push($tmp["prix"], $_SESSION["panier"]["prix"][$i]);
            }
        }
        //On remplace le panier session par notre panier temporaire à jour
        $_SESSION["panier"] = $tmp;
        //on efface le panier temporaire
        unset($tmp);
    }
    else
    echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}

function modifierQteArticle($type, $qte){
    //si le panier existe
    if (creationPanier()) {
        //si la quantité est positive on modifie sinon on supprime l'article
        if ($qte > 0) {
            $position = array_search($type, $_SESSION["panier"]["type"]);
            if ($position !== false) {
                $_SESSION["panier"]["qte"][$position] = $qte;
            }
        } else {
            supprimerArticle($type);
        }
    }
    else
    echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}

function montantTotal()
{
    $total = 0;
    for ($i = 0; $i < count($_SESSION["panier"]["type"]); $i++) {
        $total += $_SESSION["panier"]["qte"][$i] * $_SESSION["panier"]["prix"][$i];
    }
    return $total;
}

function supprimerPanier()
{
    unset($_SESSION["panier"]);
}
?>