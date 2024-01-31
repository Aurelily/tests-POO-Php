<?php

require_once 'vendor/autoload.php';
session_start();

use App\Model\Clothing;
use App\Model\Electronic;


$clothingModel = new Clothing;
$electronicModel = new Electronic;


$clothings = $clothingModel->findAll();
$electronics = $electronicModel->findAll();


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste produits</title>
</head>
<body>

<header>
    <?php include_once ('includeNav.php'); ?>
</header>

<h1>Liste des produits de la boutique : Vêtements</h1>

<?php foreach($clothings as $clothing): ?>

    <article>
    <h2><a href="product.php?id_product=<?= $clothing->getId()?>"><?= $clothing->getName()?></a></h2>
    <p><?= $clothing->getDescription() ?></p>
    </article>

<?php endforeach; ?>
<hr>
<h1>Liste des produits de la boutique : Electronique</h1>

<?php foreach($electronics as $electronic): ?>

    <article>
    <h2><a href="product.php?id_product=<?= $electronic->getId()?>"><?= $electronic->getName()?></a></h2>
    <p><?= $electronic->getDescription() ?></p>
    </article>

<?php endforeach; ?>
    
</body>
</html>

