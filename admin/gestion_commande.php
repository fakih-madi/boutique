<?php
require_once("../inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//--- VERIFICATION ADMIN ---//
if(!internauteEstConnecteEtEstAdmin())
{
    header("location:../connexion.php");
    exit();
}

("SELECT details_commande.id_produit, details_commande.quantite, details_commande.prix FROM details_commande INNER JOIN commande ON details_commande.id_commande = commande.id_commande ORDER BY date ASC");

//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("../inc/haut.inc.php");?>
<div class="new">
<?php echo $contenu;?>
</div>
<?php require_once("../inc/bas.inc.php"); ?>