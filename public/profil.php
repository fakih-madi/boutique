<?php
require_once("../inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if(!internauteEstConnecte()) header("location:connexion.php");
// debug($_SESSION);
$id_membre = (int)$_SESSION['membre']['id_membre'];
$mesCommandes = executeRequete("SELECT * FROM commande INNER JOIN etat_commande ON commande.id_etat = etat_commande.id_etat WHERE id_membre = $id_membre");

//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("../inc/haut.inc.php");?>
<p class="centre">Bonjour <strong><?php echo $_SESSION['membre']['pseudo']?></strong></p>
<div class="cadre">
    <h2> Voici vos informations </h2>
    <p> votre email est: <?php echo $_SESSION['membre']['email']?></p>
    <p>votre ville est: <?php echo $_SESSION['membre']['ville']?></p>
    <p>votre cp est: <?php echo $_SESSION['membre']['code_postal']?></p>
    <p>votre adresse est: <?php echo $_SESSION['membre']['adresse']?></p>
</div>
<br><br><br>
<div>
    <h2 class="last_order">Mes dernières commandes</h2>
    <?php if($mesCommandes->num_rows == 0)
    {?>
    <h2 class="last_order">Pas de commande passez sur le site faites votre première commande</h2>
    <a href="new.php" class="voir_new">Voir les nouveautés</a>
    <?php }
    else{
    ?>
    <div>
    <table class="gestion_commande">
    <tr>
        <td>id_commande</td>
        <td>montant</td>
        <td>date</td>
        <td>etat</td>
    </tr>
    <?php
    while ($c = $mesCommandes->fetch_assoc()) {
    ?>
    <tr>
        <td><?= $c['id_commande']?></td>
        <td><?=$c['montant']?>€</td>
        <td><?=$c['date_enregistrement']?></td>
        <td><?=$c['etat']?></td>
        <td><a href="historique_commande.php?id_commande=<?php echo $c['id_commande']?>">Voir la commande</a></td>
    </tr>
    <?php }
    ?>
    </table>
    <?php } ?>
</div>
<?php require_once("../inc/bas.inc.php");
?>