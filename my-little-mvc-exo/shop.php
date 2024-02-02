<?php

require_once 'vendor/autoload.php';
session_start();

use App\Model\Product;
use App\Controller\ShopController;


$productModel = new Product;
$productController= new ShopController;

/* var_dump($_SESSION); */


// On détermine sur quelle page on se trouve
    if(isset($_GET['page']) && !empty($_GET['page'])){
        $currentPage = (int) strip_tags($_GET['page']);
    }else{
        $currentPage = 1;
    }

    $nbProducts = $productModel->countProducts();

// On détermine le nombre d'articles que je veux par page
    $parPage = 5;

// On calcule le nombre de pages total (ceil : arrondi au nombre supérieur)
    $pages = ceil($nbProducts/ $parPage); 

// On récupère la liste de produit paginée
    $paginatedList = $productController->index($currentPage, $parPage)            

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

<h1>Liste de tous les produits</h1>

<?php foreach($paginatedList as $product): ?>

<article>
<h2><a href="product.php?id_product=<?= $product['id']?>"><?= $product['name']?></a></h2>
<p><?= $product['description'] ?></p>
<p><?= $product['color'] ?></p>


</article>

<?php endforeach; ?>

<nav>
        
<!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
    <button <?= ($currentPage == 1) ? "style='display:none'" : "" ?>>
        <a href="shop.php?page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
    </button>

    <?php for($page = 1; $page <= $pages; $page++): ?>
        <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
        <button <?= ($currentPage == $page) ? "active" : "" ?>>
            <a href="shop.php?page=<?= $page ?>" class="page-link"><?= $page ?></a>
        </button>
    <?php endfor ?>

    <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
    <button <?= ($currentPage == $pages) ? "style='display:none'" : "" ?>>
        <a href="shop.php?page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
    </button>
   
</nav>
    
</body>
</html>

