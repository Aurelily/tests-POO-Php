<?php

namespace App\Controller;

use App\Model\Product;
use App\Model\Electronic;
use App\Model\Clothing;


class ShopController extends Product
{

    public function index($currentPage, $parPage)
    {

        $productsPaginated = $this->findPaginated($currentPage, $parPage);   
        
       /*  var_dump($productsPaginated); */

        return $productsPaginated;
    }


    public function showProduct($idProduct){

        // Démarrer la session si elle n'est pas déjà démarrée
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            $_SESSION['type'] = "";
        }else{
            session_destroy();
        }

        // Verifier que le user est connecté
        // Si oui récup des infos du produit en bdd avec findOneById()
        // Si non : renvoi vers connexion avec message erreur
        if($_SESSION['user']){

            $electronicModel = new Electronic;
            $clothingModel = new Clothing;
            
            if($_GET['id_product'] == $idProduct){

                $clothingCheck = $clothingModel->findOneById($idProduct);
                $electronicCheck = $electronicModel->findOneById($idProduct);
                $finalProduct = null;

                if($clothingCheck){
                    $finalProduct = $clothingCheck;
                    $_SESSION['type'] = "clothing";
                    /* var_dump($clothingCheck); */
                }else if ($electronicCheck){
                    $finalProduct = $electronicCheck;
                    $_SESSION['type'] = "electronic";
                    /* var_dump($electronicCheck); */
                }
            }

            return $finalProduct;

        }else{
            $_SESSION['message'] = "Veuillez vous connecter pour accéder aux produits";
            // Redirection vers profile.php
            header('Location: login.php');
            exit;
        }
        // retourner les infos à la vue
    }
}