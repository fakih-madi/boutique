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
$resultat = executeRequete("SELECT * FROM commande INNER JOIN etat_commande ON commande.id_etat = etat_commande.id_etat ORDER BY id_commande ASC");
if(isset($_POST['change'])){
    $requete = executeRequete("UPDATE commande SET id_etat = $_POST[changementEtat] WHERE id_commande = $_POST[id_commande]");
    if($requete){
        header('location:gestion_commande.php');
    }
}

//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("../inc/haut.inc.php");?>
<div class="new">
    <table class="gestion_commande">
        <tr>
            <td>id_commande</td>
            <td>montant</td>
            <td>date</td>
            <td>etat</td>
            <td>modifier l'état</td>
        </tr>
        <?php while ($c = $resultat->fetch_assoc()) {?>
        <tr>
                <td><?= $c['id_commande']?></td>
                <td><?=$c['montant']?>€</td>
                <td><?=$c['date_enregistrement']?></td>
                <td><?=$c['etat']?></td>
                <td>
                    <form method="POST">
                        <select name="changementEtat">
                        <?php 
                        $etat = executeRequete("SELECT * FROM etat_commande ORDER BY id_etat");
                        while($e = $etat->fetch_assoc()){?>
                        <option value="<?php echo $e['id_etat']; ?>"><?php echo $e['etat'];?></option>
                        <?php }?>
                        </select>
                        <input type="text" name="id_commande" readonly hidden value="<?= $c['id_commande']?>">
                        <input type="submit" name="change" value="Valider changement" >
                    </form>
                </td>
                <td><a href="commande.php?id_commande=<?php echo $c['id_commande']?>">Voir la commande</a></td>
        </tr>
    
        <?php }?>
    </table>
</div>
<?php require_once("../inc/bas.inc.php"); ?>