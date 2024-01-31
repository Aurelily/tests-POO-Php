<?php

namespace App\Model;

use App\Model\Abstract\AbstractProduct;

class Product extends AbstractProduct{

    public function findPaginated($currentPage){

        $pdo = new \PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');


        // On détermine le nombre total d'articles
        $sql = 'SELECT COUNT(*) AS nb_articles FROM product;';
        $query = $pdo->prepare($sql);
        $query->execute();

        // On récupère le nombre d'articles
        $resultCount = $query->fetch();
        $nbArticles = (int) $resultCount['nb_articles'];

        // On détermine le nombre d'articles par page
        $parPage = 5;

        // On calcule le nombre de pages total (ceil : arrondi au nombre supérieur)
        $pages = ceil($nbArticles / $parPage);

        // Calcul du 1er article de la page
        $premier = ($currentPage * $parPage) - $parPage;

        // On fait la requete avec la pagination
        $statement = $pdo->prepare(
            'SELECT * FROM product
            LEFT JOIN electronic ON product.id = electronic.product_id
            LEFT JOIN clothing ON product.id = clothing.product_id
            DESC LIMIT :premier, :parpage');
        
        $statement->bindValue(':premier', $premier, \PDO::PARAM_INT);
        $statement->bindValue(':parpage', $parPage, \PDO::PARAM_INT);

        $statement->execute();
        $results = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $products = [];

        foreach ($results as $result) {
            $products[] = new static(
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

        return $products;

    }
}