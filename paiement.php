<?php
require_once("inc/init.inc.php");

if( isset($_POST['totalprix']) && !empty($_POST['totalprix']) ){
    require_once('vendor/autoload.php');
    $prix = (float)$_POST['totalprix'];

    // on instancie stripe

    \Stripe\Stripe::setApiKey('sk_test_VDhfYZHtFSFopN7ayyb9nZG300DC32ZS9S');

    $intent = \Stripe\PaymentIntent::create([
        'amount' => $prix*100,
        'currency' =>'eur'

    ]);
}else{
    header('Location:panier.php'); 
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement Eros Sport</title>
</head>
<body>
    
    <form method="post">
        <div id="erros"></div> <!-- message erreur de paiement -->
        <input type="text" id="cardholder-name" placeholder="Titulaire de la carte">
        <div id="card-elements"></div><!-- formulaire de saise des infos carte -->
        <div id="card-errors" role="alert"></div><!-- erreur de la carte-->
        <button id="card-button" type="button" data-secret="<?= $intent['client_secret'] ?>" name="paiement">Procéder au paiement</button>
    </form>

    
    <script src="https://js.stripe.com/v3/"></script>
    <script src="inc/js/scripts.js"></script>
</body>
</html>