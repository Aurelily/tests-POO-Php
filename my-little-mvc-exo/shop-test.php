<?php

require_once 'vendor/autoload.php';
session_start();

use App\Model\ConcreteProduct;

 // On détermine sur quelle page on se trouve
 if(isset($_GET['page']) && !empty($_GET['page'])){
    $currentPage = (int) strip_tags($_GET['page']);
}else{
    $currentPage = 1;
}

$pdo = new \PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');  

// On détermine le nombre total d'articles
    $sql = 'SELECT COUNT(*) AS nb_articles FROM product;';
    $query = $pdo->prepare($sql);
    $query->execute();
    $resultCount = $query->fetch();
    $nbArticles = (int) $resultCount['nb_articles'];

// On détermine le nombre d'articles que je veux par page
    $parPage = 5;

// On calcule le nombre de pages total (ceil : arrondi au nombre supérieur)
    $pages = ceil($nbArticles / $parPage);

// Calcul le numéro du 1er article de la page
$premier = ($currentPage * $parPage) - $parPage;

// On fait la requete qui recupère les produits avec la limit de pagination
$statement = $pdo->prepare(
    'SELECT * FROM product
    LEFT JOIN electronic ON product.id = electronic.product_id
    LEFT JOIN clothing ON product.id = clothing.product_id
    LIMIT :premier, :parpage');
        
$statement->bindValue(':premier', $premier, \PDO::PARAM_INT);
$statement->bindValue(':parpage', $parPage, \PDO::PARAM_INT);

$statement->execute();
$results = $statement->fetchAll(\PDO::FETCH_ASSOC);

$products = [];

foreach ($results as $result) {
    $products[] = new ConcreteProduct(
        $result['id'],
        $result['name'],
        json_decode($result['photos']),
        $result['price'],
        $result['description'],
        $result['quantity'],
        $result['category_id'],
        new \DateTime($result['created_at']),
        $result['updated_at'] ? (new \DateTime($result['updated_at'])) : null,
        $result['brand'],
        $result['waranty_fee'],
        $result['size'],
        $result['color'],
        $result['type'],
        );
    }
var_dump($results);
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

<?php foreach($products as $product): ?>

    <article>
    <h2><a href="product.php?id_product=<?= $product->getId()?>"><?= $product->getName()?></a></h2>
    <p><?= $product->getDescription() ?></p>
    
    </article>

<?php endforeach; ?>

    <nav>
        
            <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
            <button <?= ($currentPage == 1) ? "disabled" : "" ?>>
                <a href="shop-test.php?page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
            </button>

            <?php for($page = 1; $page <= $pages; $page++): ?>
                <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                <button <?= ($currentPage == $page) ? "active" : "" ?>>
                <a href="shop-test.php?page=<?= $page ?>" class="page-link"><?= $page ?></a>
                </button>
            <?php endfor ?>

            <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
            <button <?= ($currentPage == $pages) ? "disabled" : "" ?>>
            <a href="shop-test.php?page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
            </button>
       
    </nav>
</body>
</html>

