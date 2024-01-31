<?php

namespace App\Core;

use App\Controllers\MainController;

/**
 * Routeur principal
 */
class Main
{
    public function start()
    {
        echo "Application démarrée !";


        //http://mes-annonces.test/controller/method/parameters
        //http://mes-annonces.test/annonces/details/toto/
        //http://mes-annonces.test/index.php?p=annonces/details/toto/ (c'est ça en réalité qu'on va ressayer de reecrire avec notre routeur)
        // Pour la réécriture d'URL on va utiliser un fichier htaccess

        // On retire le dernier slash de l'url pour éviter le duplicate content /details/toto/ et /details/toto
        $uri = $_SERVER['REQUEST_URI'];

        // On vérifie que $uri n'est pas vide et se termine par un slash, si oui, on l'enlèvera
        if(!empty($uri) && $uri != "/" && $uri[-1] === "/" && str_ends_with($uri, 'public/') == false){

            $uri = substr($uri, 0, -1);

            // On envoi un code de redirection permanente vers cette nouvelle uri pour éviter le duplicate content
            http_response_code(301);

            // On redirige vers l'url sans "/" à la fin
            header('location: '.$uri);
        }

        // On gère ensuite les paramètres
        // p=controller/methode/parametres
        // On sépare dans un tableau les différents paramètres
        $params = [];
        if(isset($_GET['p'])){
            $params = explode('/', $_GET['p']);
            /* var_dump($params); */
        }
        

        if($params[0] != ''){
            // On verifie qu'on a au moins 1 paramètre
            // On recupere le nom du controller à instancier dans le tableau $params
            // En une fois : On mets une majuscule en 1ère lettre, on ajoute le namespace complet avant et on ajoute "Controller" après.
            $controller = '\\App\\Controllers\\'.ucfirst(array_shift($params)).'Controller';

            // On instancie le controller
            $controller = new $controller();

            /* var_dump($controller); */
            
            // Je recupère le 2ème paramètre d'URL pour la methode. Si il n'y en a pas j'utilise la methode index() qui me renvoi vers la page d'accueil
            $action = (isset($params[0])) ? array_shift($params) : 'index';

            // Je verifie si la methode recupérée existe dans un controller
            if(method_exists($controller, $action)){
                // Si il reste des parametre derrière, on les passe à la methode sous forme de tableau 
                /* (isset($params[0])) ? $controller->$action($params) : $controller->$action(); */
                //A LA PLACE : La methode call_user_func_array ci dessous est plus adaptée car permet de récupérer tous les paramètres les uns après les autres et pas en tableau.
                (isset($params[0])) ? call_user_func_array([$controller, $action], $params) : $controller->$action();

            }else{
                http_response_code(404);
                echo "<p>La page recherchée n'existe pas</p>";
            }
        }else{
            // On a pas de parametres, on instancie le controller par defaut MainController.php
            $controller = new MainController;
            // On appele la methode index()
            $controller->index();

        }



        /* var_dump($_GET); */
        echo('l\'URI de la page est : '.$uri);

    }
}