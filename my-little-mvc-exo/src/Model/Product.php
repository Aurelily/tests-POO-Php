<?php

namespace App\Model;

use App\Model\Abstract\AbstractProduct;

class Product extends AbstractProduct{

    public function findPaginated($page){

        $result = AbstractProduct::findAll();

    }
}