<?php
require_once("../inc/init.inc.php");
//--- PAIEMENT ---//
if(isset($_SESSION['livraison']))
{
    if(!isset($erreur))
    {
        executeRequete("INSERT INTO commande (id_membre, montant, date_enregistrement) VALUES (" . $_SESSION['membre']['id_membre'] . "," . montantTotal() . ", NOW())");
        $id_commande = $mysqli->insert_id;
        for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
        {
            executeRequete("INSERT INTO details_commande (id_commande, id_produit, quantite, prix, nom, prenom, adresse, code_postal, telephone) VALUES ('$id_commande', '" . $_SESSION['panier']['id_produit'][$i] . "','" . $_SESSION['panier']['quantite'][$i] . "','" . $_SESSION['panier']['prix'][$i] . "','".$_SESSION['livraison']['nom']."','".$_SESSION['livraison']['prenom']."','".$_SESSION['livraison']['adresse']."','".$_SESSION['livraison']['code_postal']."','".$_SESSION['livraison']['telephone']."')");
        }
        unset($_SESSION['panier']);
        unset($_SESSION['livraison']);
        //mail($_SESSION['membre']['email'], "confirmation de la commande", "Merci votre n° de suivi est le $id_commande", "From:vendeur@dp_site.com");
        $contenu .= "<div class='validation'>Merci pour votre commande. votre n° de suivi est le $id_commande</div>";
    }
}

?>
<?php include("../inc/haut.inc.php"); ?>

<?php if(isset($contenu)){echo $contenu;}?>

<?php include("../inc/bas.inc.php"); ?>