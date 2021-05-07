<?php
require_once("../inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if (isset($_GET['id_suivi']) AND !empty($_GET['id_suivi'])) {
    $requete = executeRequete("SELECT * FROM commande INNER JOIN etat_commande ON commande.id_etat = etat_commande.id_etat WHERE id_commande = '$_GET[id_suivi]'");
    $suivi = $requete->fetch_assoc();
    $resultat = "état de votre commande : $suivi[etat]";
}
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("../inc/haut.inc.php");?>
<form action="">
    <label for="id_suivi">Entrez votre numéro de suivi</label>
    <input type="text" name="id_suivi">
    <input type="submit" value="suivre votre commande" name="suivi_commande">
</form>
<h2><?php if(isset($_GET['id_suivi'])){echo $resultat;} ?></h2>
<?php require_once("../inc/bas.inc.php"); ?>