<?php
require_once 'vendor/autoload.php';

/* use App\Model\Electronic;
use App\Model\Clothing; */


// Démarrer la session si elle n'est pas déjà démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}else{
    session_destroy();
}

/* var_dump($_SESSION); */

if($_SESSION){
    $userConnected = $_SESSION['user'];
}



/* $clothing = new Clothing();
$clothing->setSize('S');
$clothing->setColor("Rouge");
$clothing->setName('Débardeur Rouge');
$clothing->setType('Top');
$clothing->setMaterialFee(5);
$clothing->setPrice(25);
$clothing->setDescription('Débardeur rouge en coton');
$clothing->setQuantity(50);
$clothing->setPhotos(['https://www.google.com']);
$clothing->setCategoryId(9);
$clothing->setCreatedAt(new DateTime());
$clothing->setUpdatedAt(new DateTime());
$clothing->create(); */

/* $electronic = new Electronic();
$electronic->setBrand('Darty');
$electronic->setWarantyFee(15);
$electronic->setName('cafetière NESPRESSO');
$electronic->setPrice(80);
$electronic->setDescription('What else !');
$electronic->setQuantity(10);
$electronic->setPhotos(['https://www.google.com']);
$electronic->setCategoryId(8);
$electronic->setCreatedAt(new DateTime());
$electronic->setUpdatedAt(new DateTime());
$electronic->create(); */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
<header>
    <?php include_once ('includeNav.php'); ?>
</header>
<main><h1>Page d'accueil du site</h1></main>
<?php if($_SESSION): ?>
    <h2>Bienvenue <?= $userConnected->getFullname() ?> !</h2>
<?php else: ?>
    <h2>Bienvenue !</h2>
<?php endif ?>
    
</body>
</html>

