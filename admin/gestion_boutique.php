<?php
require_once("../inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//--- VERIFICATION ADMIN ---//
if(!internauteEstConnecteEtEstAdmin())
{
    header("location:../connexion.php");
    exit();
}
 
//--- SUPPRESSION PRODUIT ---//
if(isset($_GET['action']) && $_GET['action'] == "suppression")
{   // $contenu .= $_GET['id_produit']
    $resultat = executeRequete("SELECT * FROM produit WHERE id_produit=$_GET[id_produit]");
    $produit_a_supprimer = $resultat->fetch_assoc();
    $chemin_photo_a_supprimer = $_SERVER['DOCUMENT_ROOT'] . $produit_a_supprimer['photo'];
    if(!empty($produit_a_supprimer['photo']) && file_exists($chemin_photo_a_supprimer)) unlink($chemin_photo_a_supprimer);
    $contenu .= '<div class="validation">Suppression du produit : ' . $_GET['id_produit'] . '</div>';
    executeRequete("DELETE FROM produit WHERE id_produit=$_GET[id_produit]");
    $_GET['action'] = 'affichage';
}
//--- ENREGISTREMENT PRODUIT ---//
if(isset($_POST['submitAddSize']) AND !empty($_POST['addSize'])){
    executeRequete("INSERT INTO taille (taille) values ('$_POST[addSize]')");
    header('gestion_boutique.php?action=ajout');
}
if(isset($_POST['submitCategorie']) AND !empty($_POST['addCategorie'])){
    executeRequete("INSERT INTO categorie (categorie) values ('$_POST[addCategorie]')");
    header('gestion_boutique.php?action=ajout');
}
if(isset($_POST['submtiSousCategorie']) AND !empty($_POST['addSousCategorie'])){
    executeRequete("INSERT INTO sous_categorie (nom) values ('$_POST[addSousCategorie]')");
    header('gestion_boutique.php?action=ajout');
}

if(!empty($_POST['submit_produit']))
{   // debug($_POST);
    $photo_bdd = ""; 
    if(isset($_GET['action']) && $_GET['action'] == 'modification')
    {
        $photo_bdd = $_POST['photo_actuelle'];
    }
    if(!empty($_FILES['photo']['name']))
    {   // debug($_FILES);
        $nom_photo = $_POST['reference'] . '_' .$_FILES['photo']['name'];
        $photo_bdd = RACINE_SITE . "photo/$nom_photo";
        $photo_dossier = $_SERVER['DOCUMENT_ROOT'] . RACINE_SITE . "/photo/$nom_photo"; 
        copy($_FILES['photo']['tmp_name'],$photo_dossier);
    }
    foreach($_POST as $indice => $valeur)
    {
        $_POST[$indice] = htmlEntities(addSlashes($valeur));
    }
    if ($_GET['action'] == 'modification') {
        executeRequete("UPDATE produit SET reference = '$_POST[reference]', id_categorie = '$_POST[categorie]', titre = '$_POST[titre]', description = '$_POST[description]', id_taille = '$_POST[taille]', public = '$_POST[public]',  photo = '$photo_bdd', prix = '$_POST[prix]', id_sous_categorie = '$_POST[sous_categorie]' WHERE id_produit = '$_POST[id_produit]'");
        
    $contenu .= '<div class="validation">Le produit a été ajouté</div>';
    $_GET['action'] = 'affichage';
    }elseif($_GET['action'] == 'ajout'){
        executeRequete("REPLACE INTO produit (reference, id_categorie, titre, description, public, photo, prix, id_sous_categorie) values ('$_POST[reference]', '$_POST[categorie]', '$_POST[titre]', '$_POST[description]', '$_POST[couleur]', '$_POST[taille]', '$_POST[public]',  '$photo_bdd',  '$_POST[prix]',  '$_POST[stock]', '$_POST[sous_categorie]')");
        header('location:gestion_boutique.php?action=affichage');
    }
    
}
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("../inc/haut.inc.php");?>
<a href="?action=affichage">Affichage des produits</a><br>
<a href="?action=ajout">Ajout d'un produit</a><br>
<a href="?action=categorie">Gerer les categorie</a><br><br><hr><br>
<?php 
//Gestion categorie et sous categorie

?>

<?php 
//--- AFFICHAGE PRODUITS ---//
if(isset($_GET['action']) && $_GET['action'] == "affichage")
{
    $resultat = executeRequete("SELECT * 
    FROM produit 
    INNER JOIN categorie 
        ON produit.id_categorie = categorie.id_categorie 
    INNER JOIN sous_categorie 
        ON produit.id_sous_categorie = sous_categorie.id_sous_categorie
    ");
    ?>
    <h2> Affichage des produits </h2>
    <p>Nombre de produit(s) dans la boutique : <?php echo $resultat->num_rows ?></p>
    <table border="1" cellpadding="5">
        
        <?php
        while ($ligne = $resultat->fetch_assoc())
        {?>   
        <tr> 
            <th>photo</th>
            <th>id_produit</th>
            <th>categorie</th>
            <th>sous_categorie</th>
            <th>titre</th>
            <th>prix</th>
            <th>description</th>
            <th>Modification</th>
            <th>Supression</th>
        </tr>
        <tr>
            <td><img src="<?php echo $ligne['photo'] ?>" ="70" height="70"></td>
            <td><?php echo $ligne['id_produit'] ?></td>
            <td><?php echo $ligne['categorie'] ?></td>
            <td><?php echo $ligne['nom'] ?></td>
            <td><?php echo $ligne['titre'] ?></td>
            <td><?php echo $ligne['prix']?>€</td>
            <td><?php echo $ligne['description'] ?></td>
            <td><a href="?action=modification&id_produit=<?php echo $ligne['id_produit']?>"><img src="../inc/img/edit.png"></a></td>
            <td><a href="?action=suppression&id_produit=<?php echo $ligne['id_produit']?>"><img src="../inc/img/delete.png"></a></td>
        </tr>
    <?php } ?>
    </table><br><hr><br>
<?php }

// Formulaire produit
if(isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action'] == 'modification'))
{
    if(isset($_GET['id_produit']))
    {
        $resultat = executeRequete("SELECT * 
        FROM produit
        INNER JOIN categorie 
        ON produit.id_categorie = categorie.id_categorie
        INNER JOIN sous_categorie
        ON produit.id_sous_categorie = sous_categorie.id_sous_categorie 
        WHERE id_produit=$_GET[id_produit]");
        $produit_actuel = $resultat->fetch_assoc();
    }?>
    <h1> Formulaire Produits </h1>
    <form method="post" enctype="multipart/form-data" action=""><br><br>

        <?php if(isset($produit_actuel['id_categorie'])){?><i>Categorie actuelle : <?php echo $produit_actuel['categorie']?></i><br><?php }?>
        <label for="categorie">Selectionner categorie</label><br>
        <select name="categorie" required>
            <?php // boucle while 
                $AfficheCategorie = executeRequete(
                    "SELECT * 
                    FROM categorie 
                    ORDER BY id_categorie");
                while ($a = $AfficheCategorie->fetch_assoc()) {?>
                    <option value="<?php $a['id_categorie']?>"><?php echo $a['categorie'];
                    ?></option>
            <?php    }
            ?>
        </select>
        <label for="addCategorie">Ajouter une nouvelle categorie</label>
        <input type="text" name="addCategorie">
        <input type="submit" value="ajouter categorie" name="submitCategorie"><br><br>
        
        <?php if(isset($produit_actuel['id_sous_categorie'])){?><i>Sous Categorie actuelle : <?php echo $produit_actuel['nom']?></i><br><?php }?>
        <label for="sous_categorie">Selectionner une sous categorie</label><br>
        <select name="sous_categorie" required>
            <?php // boucle while 
                $AfficheSousCategorie = executeRequete("SELECT * FROM sous_categorie ORDER BY id_sous_categorie");
                while ($a = $AfficheSousCategorie->fetch_assoc()) {?>
                    <option value="<?php if(isset($produit_actuel['id__sous_categorie'])){echo $produit_actuel['id_sous_categorie'];}else{echo $a['id_sous_categorie'];} ?>"><?php if(isset($produit_actuel['id__sous_categorie'])){echo $produit_actuel['nom'];}else{echo $a['nom'];} ?></option>
            <?php    }
            ?>
        </select>
        <label for="addSousCategorie">Ajouter une nouvelle sous categorie</label>
        <input type="text" name="addSousCategorie">
        <input type="submit" value="ajouter categorie" name="submitSousCategorie"><br><br>
        

        <input type="hidden" id="id_produit" name="id_produit" value="<?php if(isset($produit_actuel['id_produit'])) echo $produit_actuel['id_produit'] ?>">
             
        <label for="reference">reference</label><br>
        <input type="text" id="reference" name="reference" placeholder="la référence de produit" value=" <?php if(isset($produit_actuel['reference'])) echo $produit_actuel['reference']?>"><br><br>
 
        <label for="titre">titre</label><br>
        <input type="text" id="titre" name="titre" placeholder="le titre du produit" value="<?php if(isset($produit_actuel['titre'])) echo $produit_actuel['titre']?>" > <br><br>
 
        <label for="description">description</label><br>
        <textarea name="description" id="description" placeholder="la description du produit"><?php if(isset($produit_actuel['description'])) echo $produit_actuel['description']?></textarea><br><br>
 
        <label for="photo">photo</label><br>
        <input type="file" id="photo" name="photo"><br><br>
        <?php if(isset($produit_actuel))
        {?>
            <i>Vous pouvez uplaoder une nouvelle photo si vous souhaitez la changer</i><br>
            <img src="<?php echo $produit_actuel['photo']?>"  ="90" height="90"><br>
            <input type="hidden" name="photo_actuelle" value="<?php $produit_actuel['photo']?>"><br>
        <?php }?>
         
        <label for="prix">prix</label><br>
        <input type="text" id="prix" name="prix" placeholder="le prix du produit"  value="<?php if(isset($produit_actuel['prix'])) echo $produit_actuel['prix']?>"><br><br>
         
        <label for="stock">stock</label><br>
        <input type="text" id="stock" name="stock" placeholder="le stock du produit"  value="<?php if(isset($produit_actuel['stock'])) echo $produit_actuel['stock'] ?>"><br><br>
         
        <input type="submit" value="<?php echo ucfirst($_GET['action'])?> du produit" name="submit_produit">
    </form>
<?php }

require_once("../inc/bas.inc.php")?>