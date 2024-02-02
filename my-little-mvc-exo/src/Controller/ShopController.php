<?php

namespace App\Controller;

use App\Model\Product;


class ShopController extends Product
{

    public function index($currentPage, $parPage)
    {

        $productsPaginated = $this->findPaginated($currentPage, $parPage);   
        
       /*  var_dump($productsPaginated); */

        return $productsPaginated;
    }
}