<?php
require_once("inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if(isset($_GET['id_produit']))  { $resultat = executeRequete("SELECT * FROM produit WHERE id_produit = '$_GET[id_produit]'"); }
if($resultat->num_rows <= 0) { header("location:boutique.php"); exit(); }
 
$produit = $resultat->fetch_assoc();
$contenu .= "<img src='$produit[photo]' ='630' height='600'>";
$contenu .= '<div class="fiche-desc">';
$contenu .= "<h2>$produit[titre]</h2>";
$contenu .= "<p>$produit[description]</p>";
$contenu .= "<p>Categorie: $produit[categorie]</p>";
$contenu .= "<p>Couleur: $produit[couleur]</p>";
$contenu .= "<p>Taille: $produit[taille]</p>";
$contenu .= "<p>Prix : $produit[prix] €</p>";

 
if($produit['stock'] > 0)
{
    $contenu .= "Nombre de produit(s) disponible : $produit[stock]";
    $contenu .= '<form method="post" action="panier.php">';
        $contenu .= "<input type='hidden' name='id_produit' value='$produit[id_produit]'>";
        $contenu .= '<label for="quantite">Quantité : </label>';
        $contenu .= '<select id="quantite" name="quantite">';
            for($i = 1; $i <= $produit['stock'] && $i <= 5; $i++)
            {
                $contenu .= "<option>$i</option>";
            }
        $contenu .= '</select>';
        $contenu .= '<input type="submit" name="ajout_panier" value="ajout au panier">';
    $contenu .= '</form>';
}
else
{
    $contenu .= 'Rupture de stock !';
}
$contenu .= "<a href='categorie.php?categorie=" . $produit['categorie'] . "'>Retour vers la séléction de " . $produit['categorie'] . "</a>";

$contenu .= '</div>';
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("inc/haut.inc.php");?>
<div class="fiche">
<?php echo $contenu;?>
</div>
<?php require_once("inc/bas.inc.php"); ?>