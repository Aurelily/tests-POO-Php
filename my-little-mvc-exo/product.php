<?php
session_start();

use App\Model\Clothing;
use App\Model\Electronic;

require_once 'vendor/autoload.php';

if(isset($_GET['id_product'])){

    $idProduct = $_GET['id_product'];
    $clothingModel = new Clothing;
    $electronicModel = new Electronic;
    $finalProduct = null;

    $clothingCheck = $clothingModel->findOneById($idProduct);
    $electronicCheck = $electronicModel->findOneById($idProduct);

    if($_GET['id_product']){
        if($clothingCheck){
            $finalProduct = $clothingCheck;
            /* var_dump($clothingCheck); */
        }else if ($electronicCheck){
            $finalProduct = $electronicCheck;
            /* var_dump($electronicCheck); */
        }
    }

}

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
        <h2><?= $finalProduct->getPrice() ?> €</h2>
    <?php else: ?>
        <h1>Le produit n'existe pas !</h1>
    <?php endif ?>
    <a href="shop.php"><button>Retour à la boutique</button></a>
</body>
</html>