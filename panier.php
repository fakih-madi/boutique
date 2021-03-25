<?php
require_once("inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//--- AJOUT PANIER ---//
if(isset($_POST['ajout_panier'])) 
{   // debug($_POST);
    $resultat = executeRequete("SELECT * FROM produit WHERE id_produit='$_POST[id_produit]'");
    $produit = $resultat->fetch_assoc();
    ajouterProduitDansPanier($produit['titre'],$_POST['id_produit'],$_POST['quantite'],$produit['prix'],$produit['photo']);
    header('Location:panier.php'); 
    exit();
    
}
//--- VIDER PANIER ---//
if(isset($_GET['action']) && $_GET['action'] == "vider")
{
    unset($_SESSION['panier']);
}
//--- PAIEMENT ---//
if(isset($_POST['payer']))
{
    for($i=0 ;$i < count($_SESSION['panier']['id_produit']) ; $i++) 
    {
        $resultat = executeRequete("SELECT * FROM produit WHERE id_produit=" . $_SESSION['panier']['id_produit'][$i]);
        $produit = $resultat->fetch_assoc();
        if($produit['stock'] < $_SESSION['panier']['quantite'][$i])
        {
            $contenu .= '<hr><div class="erreur">Stock Restant: ' . $produit['stock'] . '</div>';
            $contenu .= '<div class="erreur">Quantité demandée: ' . $_SESSION['panier']['quantite'][$i] . '</div>';
            if($produit['stock'] > 0)
            {
                $contenu .= '<div class="erreur">la quantité de l\'produit ' . $_SESSION['panier']['id_produit'][$i] . ' à été réduite car notre stock était insuffisant, veuillez vérifier vos achats.</div>';
                $_SESSION['panier']['quantite'][$i] = $produit['stock'];
            }
            else
            {
                $contenu .= '<div class="erreur">l\'produit ' . $_SESSION['panier']['id_produit'][$i] . ' à été retiré de votre panier car nous sommes en rupture de stock, veuillez vérifier vos achats.</div>';
                retirerProduitDuPanier($_SESSION['panier']['id_produit'][$i]);
                $i--;
            }
            $erreur = true;
        }
    }
    /*if(!isset($erreur))
    {
        executeRequete("INSERT INTO commande (id_membre, montant, date_enregistrement) VALUES (" . $_SESSION['membre']['id_membre'] . "," . montantTotal() . ", NOW())");
        $id_commande = $mysqli->insert_id;
        for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
        {
            executeRequete("INSERT INTO details_commande (id_commande, id_produit, quantite, prix) VALUES ($id_commande, " . $_SESSION['panier']['id_produit'][$i] . "," . $_SESSION['panier']['quantite'][$i] . "," . $_SESSION['panier']['prix'][$i] . ")");
        }
        unset($_SESSION['panier']);
        //mail($_SESSION['membre']['email'], "confirmation de la commande", "Merci votre n° de suivi est le $id_commande", "From:vendeur@dp_site.com");
        $contenu .= "<div class='validation'>Merci pour votre commande. votre n° de suivi est le $id_commande</div>";
    }*/
}
 
//--------------------------------- AFFICHAGE HTML ---------------------------------//
include("inc/haut.inc.php");
echo $contenu;
echo '<h2 class="titre-panier">Panier</h2>';
echo '<div class="panier">';
if(empty($_SESSION['panier']['id_produit'])) // panier vide
{
    echo "<tr><td colspan='5'>Votre panier est vide</td></tr>";
}
else
{
    for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++) 
    {
        echo '<div class="infos-panier">';
        
            echo '<p><img src="' . $_SESSION['panier']['photo'][$i] . '" class="img-panier"></p>';
            echo '<p>' . $_SESSION['panier']['titre'][$i] . '</p>';
            echo '<p>ID Produit: ' . $_SESSION['panier']['id_produit'][$i] . '</p>';
            echo '<p>Prix: ' . $_SESSION['panier']['prix'][$i] . '€</p>';
            echo '<p>Quantité(s): ' . $_SESSION['panier']['quantite'][$i] .'</p>';
        echo '</div>';
               
         
    }
    echo "</div>"; 
    echo '<div class="paiement-panier">';
        echo '<form method="post" action="paiement.php" class="paiement-data">';
        echo '<p><input type="text" name="totalprix" value="'. montantTotal() .'€" readonly>'; 
        echo '<p><input type="submit" name="payer" value="Paiement"></p>';
        echo '</form>';
        echo "<button><a href='?action=vider'>Vider mon panier</a></button>";
        echo "<p>Réglement par CHÈQUE uniquement à l'adresse suivante : Madi Fakih 03 rue de abram 13015 Marseille</p>";
    echo '</div>';
        
          
    
    
}


// echo "<hr>session panier:<br>"; debug($_SESSION);
include("inc/bas.inc.php");
?>