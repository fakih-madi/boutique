<?php
require_once("../inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//--- VERIFICATION ADMIN ---//
if(!internauteEstConnecteEtEstAdmin())
{
    header("location:../connexion.php");
    exit();
}
$requete = executeRequete("SELECT * FROM membre ORDER BY id_membre");
if(isset($_GET['supprime']) AND !empty($_GET['supprime']))
{
    $req = executeRequete("DELETE FROM membre WHERE id_membre = $_GET[id_membre]");
    if($req){
        header('location:gestion_membre.php');
    }
}

//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("../inc/haut.inc.php");?>
<div class="new">
    <h2 class="h2_gestion">Membre inscrit sur la boutique</h2>
    <table class="gestion_commande">
        <tr>
            <td>Nom</td>
            <td>Prenom</td>
            <td>Pseudo</td>
            <td>Email</td>
            <td>Id</td>
        </tr>
        
        <?php while ($r = $requete->fetch_assoc()) {?>
        <tr>
            <td><?php echo $r['nom']?></td>
            <td><?php echo $r['prenom']?></td>
            <td><?php echo $r['pseudo']?></td>
            <td><?php echo $r['email']?></td>
            <td><?php echo $r['id_membre']?></td>
            <td><a href="gestion_membre.php?supprime=yes&id_membre=<?php echo $r['id_membre']?>">Supprimer l'utilisateur</a></td>
        </tr>
        <?php }?>
        
    </table>
</div>
<?php require_once("../inc/bas.inc.php"); ?>