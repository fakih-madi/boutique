<?php
require_once("inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//

//--- AFFICHAGE DES PRODUITS ---//
$contenu .= '<div class="new-product">';

    $donnees = executeRequete("SELECT id_produit,reference,titre,photo,prix FROM produit ORDER BY id_produit DESC LIMIT 4 ");  
    while($produit = $donnees->fetch_assoc())
    {
        $contenu .= '<div class="new-p">';
        $contenu .= "<a href=\"fiche_produit.php?id_produit=$produit[id_produit]\"><img src=\"$produit[photo]\" =\"330\" height=\"300\"></a>";
        $contenu .= "<h2 class='nomproduit'>$produit[titre]</h2>";
        $contenu .= "<p>$produit[prix] €</p>";
        $contenu .= '<a href="fiche_produit.php?id_produit=' . $produit['id_produit'] . '">Voir la fiche</a>';
        $contenu .= '</div>';
    }
$contenu .= '</div>';
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("inc/haut.inc.php");?>
<div class="new">
<?php echo $contenu;?>
</div>
<?php require_once("inc/bas.inc.php"); ?>