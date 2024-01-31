<?php

namespace App\Controller;

use App\Model\Product;

class ShopController extends Product{

    public function index($page){

         // On détermine sur quelle page on se trouve
         if(isset($_GET['page']) && !empty($_GET['page'])){
            $currentPage = (int) strip_tags($_GET['page']);
        }else{
            $currentPage = 1;
        }

        // Fait appel à la methode findPaginate($page) se trouvant dans Product
        $productModel = new Product();

        
    }
}