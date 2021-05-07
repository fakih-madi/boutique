<?php
require_once("../inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//--- AFFICHAGE DES CATEGORIES ---//
$categories_des_produits = executeRequete("SELECT * FROM categorie");
$contenu .= '<div class="boutique-gauche">';
$contenu .= "<ul>";
while($cat = $categories_des_produits->fetch_assoc())
{
    $contenu .= "<li><a href='?categorie=" . $cat['id_categorie'] . "'>" . $cat['categorie'] . "</a></li>";
    
}
$contenu .= "</ul>";
$contenu .= "</div>";

//--- AFFICHAGE DES PRODUITS ---//
$contenu .= '<div class="boutique-droite">';
if(isset($_GET['categorie']))
{
    $contenu .= '<div class="sous-categorie">';
    $sous_categorie = executeRequete(
        "SELECT * 
        FROM sous_categorie
    ");
    $contenu .="<i>filtrer par sport</i><br>";
    while ($a = $sous_categorie->fetch_assoc()) {
        
        $contenu .= "<a class='link_sous_categorie' href='?categorie=" . $_GET['categorie'] . "&sous_categorie=". $a['id_sous_categorie'] ."'>" . $a['nom'] . "</a><br>";
    }
    $contenu .= '</div>';
    if (isset($_GET['sous_categorie'])) {
        $donnees = executeRequete("SELECT id_produit,reference,titre,photo,prix FROM produit WHERE id_categorie='$_GET[categorie]' AND id_sous_categorie='$_GET[sous_categorie]'");  
        while($produit = $donnees->fetch_assoc())
        {
            $contenu .= '<div class="boutique-produit">';
            $contenu .= "<a href=\"fiche_produit.php?id_produit=$produit[id_produit]\"><img src=\"$produit[photo]\" =\"330\" height=\"300\"></a>";
            $contenu .= "<h2 class='nomproduit'>$produit[titre]</h2>";
            $contenu .= "<p>$produit[prix] €</p>";
            $contenu .= '<a href="fiche_produit.php?id_produit=' . $produit['id_produit'] . '">Voir la fiche</a>';
            $contenu .= '</div>';
        }
    }else {
        $donnees = executeRequete("SELECT id_produit,reference,titre,photo,prix FROM produit WHERE id_categorie='$_GET[categorie]'");  
        while($produit = $donnees->fetch_assoc())
        {
            $contenu .= '<div class="boutique-produit">';
            $contenu .= "<a href=\"fiche_produit.php?id_produit=$produit[id_produit]\"><img src=\"$produit[photo]\" =\"330\" height=\"300\"></a>";
            $contenu .= "<h2 class='nomproduit'>$produit[titre]</h2>";
            $contenu .= "<p>$produit[prix] €</p>";
            $contenu .= '<a href="fiche_produit.php?id_produit=' . $produit['id_produit'] . '">Voir la fiche</a>';
            $contenu .= '</div>';
        }
    }
    
}
$contenu .= '</div>';
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("../inc/haut.inc.php");?>
<div class="cat">
<?php echo $contenu;?>
</div>
<?php require_once("../inc/bas.inc.php"); ?>