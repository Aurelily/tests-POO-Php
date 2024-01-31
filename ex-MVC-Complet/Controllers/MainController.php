<?php

namespace App\Controllers;

class MainController extends Controller
{
    public function index(){
        /* echo "<h1>Ceci est la page d'accueil</h1>"; */

        $this->render('main/index', [], 'home');
    }
}