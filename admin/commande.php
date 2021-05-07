<?php
require_once("../inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//--- VERIFICATION ADMIN ---//
if(!internauteEstConnecteEtEstAdmin())
{
    header("location:../connexion.php");
    exit();
}

/*("SELECT details_commande.id_details_commande, details_commande.id_produit, details_commande.quantite, details_commande.prix, details_commande.nom, details_commande.prenom, details_commande.adresse, details_commande.code_postal, details_commande.telephone FROM details_commande INNER JOIN commande ON details_commande.id_commande = commande.id_commande ORDER BY date ASC");
("SELECT * FROM details_commande INNER JOIN details_commande.id_commande ON commande.id_commande ORDER BY date ASC");*/
$resultat = executeRequete(
    "SELECT * 
    FROM details_commande
    INNER JOIN produit
    ON details_commande.id_produit = produit.id_produit 
    WHERE id_commande = $_GET[id_commande]");


//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("../inc/haut.inc.php");?>
<div class="new">
<div>
<table class="gestion_commande">
<tr>
<td>nom</td>
<td>prenom</td>
<td>adresse</td>
<td>telephone</td>
<td>code_postal</td>
<td>id_details_commande</td>
<td>id_commande</td>
<td>Titre produit</td>
<td>quantite</td>
<td>Total</td>
</tr>
<?php
while ($c = $resultat->fetch_assoc())
{?>
<tr>
<td><?php echo $c['nom']?></td>
<td><?php echo $c['prenom']?></td>
<td><?php echo $c['adresse']?></td>
<td><?php echo $c['telephone']?></td>
<td><?php echo $c['code_postal']?></td>
<td><?php echo $c['id_details_commande']?></td>
<td><?php echo $c['id_commande']?></td>
<td><?php echo $c['titre']?></td>
<td><?php echo $c['quantite']?></td>
<td><?php echo $c['prix']?>€</td>
</tr>
<?php } ?>
</table>
</div>
</div>
<?php require_once("../inc/bas.inc.php"); ?>