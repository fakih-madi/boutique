<!Doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Eros Sport</title>
        <link rel="stylesheet" href="<?php echo RACINE_SITE; ?>inc/css/style.css">
        <link rel="stylesheet" href="<?php echo RACINE_SITE; ?>inc/css/header.css">
        <link rel="stylesheet" href="<?php echo RACINE_SITE; ?>inc/css/body.css">
        <link rel="stylesheet" href="<?php echo RACINE_SITE; ?>inc/css/footer.css">
    </head>
    <body>    
        <header>
            <div class="hd">
                <div>
                    <a href="<?php echo RACINE_SITE; ?>index.php" title="Eros sport"><img src=" <?php echo RACINE_SITE; ?>inc/img/logo.png" class="logo"></a>
                </div>
                <nav>
                <?php
                    if(internauteEstConnecteEtEstAdmin())
                    {
                        echo '<ul class="menuderoulant"><li><a href="#">Administration</a>';
                        echo'<ul class="sousmenu">';
                        echo '<li><a href="' . RACINE_SITE . 'admin/gestion_membre.php">Gestion des membres</a></li>';
                        echo '<li><a href="' . RACINE_SITE . 'admin/gestion_commande.php">Gestion des commandes</a></li>';
                        echo '<li><a href="' . RACINE_SITE . 'admin/gestion_boutique.php">Gestion de la boutique</a></li>';
                        echo '</ul>';
                        echo '</li></ul>';
                    }
                    if(internauteEstConnecte())
                    {
                        echo '<a href="' . RACINE_SITE . 'new.php">Nouveautés</a>';
                        echo '<a href="' . RACINE_SITE . 'categorie.php">Catégorie</a>';
                        echo '<a href="' . RACINE_SITE . 'profil.php">Voir votre profil</a>';
                        echo '<a href="' . RACINE_SITE . 'connexion.php?action=deconnexion">Se déconnecter</a>';
                    }
                    else
                    {
                        echo '<a href="' . RACINE_SITE . 'new.php">Nouveautés</a>';
                        echo '<a href="' . RACINE_SITE . 'categorie.php">Catégorie</a>';
                    }
                    ?>
                </nav>
                <div class="r-menu">
                    <a href="<?php echo RACINE_SITE; ?>panier.php"><img src="<?php echo RACINE_SITE; ?>inc/img/panier.svg" class="logopanier">Panier</a>
                <?php if(!internauteEstConnecte()){?>
                    <div class="r-connexion">
                        <a href="<?php echo RACINE_SITE; ?>inscription.php">Inscription</a>
                        <a href="<?php echo RACINE_SITE; ?>connexion.php">Connexion</a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </header>
        <section>