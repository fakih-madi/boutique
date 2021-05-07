<?php
require_once("../inc/init.inc.php");

if(isset($_POST['submit_livraison'])){
    if(isset($_POST['nom']) AND !empty($_POST['nom'])){
        $nom = htmlspecialchars($_POST['nom']);
        if(isset($_POST['prenom']) AND !empty($_POST['prenom'])){
            $prenom = htmlspecialchars($_POST['prenom']);
            if(isset($_POST['delivery']) AND !empty($_POST['delivery'])){
                $adresse = htmlspecialchars($_POST['delivery']);
                if(isset($_POST['code']) AND !empty($_POST['code'])){
                    $codePostal = htmlspecialchars($_POST['code']);
                        if(isset($_POST['phone']) AND !empty($_POST['phone'])){
                            $numéroDeTel = htmlspecialchars($_POST['phone']);
                            $_SESSION['livraison'] = array();
                            $_SESSION['livraison']['nom'] = $nom;
                            $_SESSION['livraison']['prenom'] = $prenom;
                            $_SESSION['livraison']['adresse'] = $adresse;
                            $_SESSION['livraison']['code_postal'] = $codePostal;
                            $_SESSION['livraison']['telephone'] = $numéroDeTel;
                            header('location: success_order.php');
                        }
                }
            }
        }
    }
}


?>
<?php include("../inc/haut.inc.php"); ?>

<h2>Paiement validée</h2>
<h2>Il manque une étape</h2>

<form action="infos_livraison.php" class="form_livraison" method="POST">
    <label for="nom">Nom</label><br>
    <input type="text" placeholder="Nom" name="nom"><br>
    <label for="prenom">Prenom</label><br>
    <input type="text" placeholder="Prenom" name="prenom"><br>
    <label for="delivery">Adresse de livraison</label><br>
    <input type="text" placeholder="Adresse de livraison" name="delivery"><br>
    <label for="code">Code postal</label><br>
    <input type="text" placeholder="Code postal" name="code"><br>
    <label for="phone">Numéro de téléphone</label><br>
    <input type="text" placeholder="numéro de téléphone" name="phone"><br>
    <input type="submit" name="submit_livraison">
</form>
<?php
for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++) 
{?>
<div class="infos-panier">
<p><img src="<?php echo $_SESSION['panier']['photo'][$i] ?>" class="img-panier"></p>
<p><?php echo $_SESSION['panier']['titre'][$i] ?></p>
<p>ID Produit: <?php echo $_SESSION['panier']['id_produit'][$i]?></p>
<p>Prix: <?php echo $_SESSION['panier']['prix'][$i]?>€</p>
<p>Quantité(s): <?php echo $_SESSION['panier']['quantite'][$i] ?></p>
</div>
            
        
<?php }
?>

<?php include("../inc/bas.inc.php"); ?>