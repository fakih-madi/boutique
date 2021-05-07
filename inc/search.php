<?php
require_once('../inc/fonction.inc.php');
if (isset($_POST["search"])) {
	$str = $_POST["search"];
	$sth = executeRequete('SELECT * FROM categorie INNER JOIN produit ON categorie.id_categorie = produit.id_categorie WHERE categorie LIKE "%'.$str.'%"');
 	$trouver = $sth->fetch_assoc();
		if ($trouver){?>
		<p>Résultat</p>
		<a href="categorie.php?categorie=<?php echo $trouver['id_categorie']?>"><?php echo $trouver['categorie']; ?></a>		
		<?php }
		else{
			echo "Aucun résultat";
		}
}

?>
<form method="post">
	<input type="search" name="search" placeholder="Recherche..." />
	<input type="submit" value="Valider" />
</form>
