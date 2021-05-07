<?php
require_once("../inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
$sliderImage = executeRequete("SELECT * FROM produit ORDER BY id_produit DESC LIMIT 6");
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("../inc/haut.inc.php");?>
<section class="sec_slider">
  <div class="slider">
    <input type="radio" id="btn-1" name="toggle" checked>
    <input type="radio" id="btn-2" name="toggle">
    <input type="radio" id="btn-3" name="toggle">
    <div class="slider-controls">
        <label for="btn-1"></label>
        <label for="btn-2"></label>
        <label for="btn-3"></label>
    </div>                    
    <div class="slider-inner">
        <div class="slider-slides">
        <?php 
              while ($i = $sliderImage->fetch_assoc()) {?>
                <a href="fiche_produit.php?id_produit=<?php echo $i['id_produit']?>"><img src="<?php echo $i['photo'] ?>"> </a> 
              <?php }
              ?>
        </div>                        
    </div>
  </div>
</section>
<?php require_once("../inc/bas.inc.php"); ?>