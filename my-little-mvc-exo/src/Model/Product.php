<?php

namespace App\Model;

use App\Model\Abstract\AbstractProduct;

class Product extends AbstractProduct{

// Fonction qui compte le nombre de produits dans la BDD
// ---------------------------------------------------------

    public function countProducts():int{

        $pdo = new \PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');  

// On détermine le nombre total d'articles
        $sql = 'SELECT COUNT(*) AS nb_products FROM product;';
        $query = $pdo->prepare($sql);
        $query->execute();
        $resultCount = $query->fetch();
        $nbProducts = (int) $resultCount['nb_products'];

        return $nbProducts;
    }

// Fonction qui va chercher les produits et mets en place la pagination
// ---------------------------------------------------------

    public function findPaginated($currentPage, $parPage){

        $pdo = new \PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');  

/* // On détermine le nombre d'articles que je veux par page
        $parPage = 5; */

// Calcul le numéro du 1er article de la page
        $premier = ($currentPage * $parPage) - $parPage;

// On fait la requete qui recupère les produits avec la limit de pagination
// NOTE : J'aurais pu mettre ça :  'SELECT p.*, e.*, c.* si je n'avais pas appelé l'id principal de toutes les tables avec le même nom "id"
        $statement = $pdo->prepare(
            'SELECT p.*, e.brand, e.waranty_fee, c.type, c.size,c.color
            FROM product as p
            LEFT JOIN electronic as e ON p.id = e.product_id
            LEFT JOIN clothing as c ON p.id = c.product_id
            LIMIT :premier, :parpage');
  
                
        $statement->bindValue(':premier', $premier, \PDO::PARAM_INT);
        $statement->bindValue(':parpage', $parPage, \PDO::PARAM_INT);

        $statement->execute();
        $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
        
        return $results;

    }
}