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
$resultat = executeRequete("SELECT * FROM details_commande WHERE id_commande = $_GET[id_commande]");
$contenu .= '<div>';
$contenu .= '<table class="gestion_commande">';
$contenu .= '<tr>';
$contenu .= "<td>nom</td>";
$contenu .= "<td>prenom</td>";
$contenu .= "<td>adresse</td>";
$contenu .= "<td>telephone</td>";
$contenu .= "<td>code_postal</td>";
$contenu .= "<td>id_details_commande</td>";
$contenu .= "<td>id_commande</td>";
$contenu .= "<td>id_produit</td>";
$contenu .= "<td>quantite</td>";
$contenu .= "<td>prix</td>";
$contenu .= "</tr>";
while ($c = $resultat->fetch_assoc()) {
    $contenu .= '<tr>';
    $contenu .= "<td>$c[nom]</td>";
    $contenu .= "<td>$c[prenom]</td>";
    $contenu .= "<td>$c[adresse]</td>";
    $contenu .= "<td>$c[telephone]</td>";
    $contenu .= "<td>$c[code_postal]</td>";
    $contenu .= "<td>$c[id_details_commande]</td>";
    $contenu .= "<td>$c[id_commande]</td>";
    $contenu .= "<td>$c[id_produit]</td>";
    $contenu .= "<td>$c[quantite]</td>";
    $contenu .= "<td>$c[prix]</td>";
    $contenu .= "</tr>";
}
$contenu .= '</table>';
$contenu .= '</div>';
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("../inc/haut.inc.php");?>
<div class="new">
<?php echo $contenu;?>
</div>
<?php require_once("../inc/bas.inc.php"); ?>