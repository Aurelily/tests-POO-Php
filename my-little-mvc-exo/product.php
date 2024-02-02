<?php

use App\Controller\ShopController;

require_once 'vendor/autoload.php';

$shopController = new ShopController;
$finalProduct = $shopController->showProduct($_GET['id_product']);

/* var_dump($_SESSION);

var_dump($finalProduct); */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produit</title>
</head>
<body>
    <header>
        <?php include_once ('includeNav.php'); ?>
    </header>
    
    <?php if($finalProduct): ?>
        <h1><?= $finalProduct->getName() ?></h1>
        <h2><?= $finalProduct->getDescription() ?></h2>
        <h2>Prix : <?= $finalProduct->getPrice() ?> €</h2>
       <hr> 
            <?php if($_SESSION['type'] == "clothing"): ?>
                <h2>Couleur : <?= $finalProduct->getColor() ?></h2>
                <h3>Taille : <?= $finalProduct->getSize() ?></h3>
                <h3>Type : <?= $finalProduct->getType() ?></h3>
                <h3>Frais matériel : <?= $finalProduct->getMaterialFee() ?></h3>
            <?php elseif($_SESSION['type'] ==    "electronic"): ?>
                <h2>Marque : <?= $finalProduct->getBrand() ?></h2>
                <h3>Frais de garantie : <?= $finalProduct->getWarantyFee() ?></h3>
            <?php endif ?>
        <h3>Produit ajouté le : <?= $finalProduct->getCreatedAt()->format('d-m-Y') ?></h3>
    <?php else: ?>
        <h1>Le produit n'existe pas !</h1>
    <?php endif ?>
    <a href="shop.php"><button>Retour à la boutique</button></a>
</body>
</html>