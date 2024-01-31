<?php

namespace App\Controllers;


// Controller principal : methodes pour aller chercher la bonne vue

abstract class Controller
{

    public function render(string $fichier, array $donnees=[], string $template = 'default')
    {
        /* var_dump($donnees); */

        // On extrait le contenu de $donnees : extract() démonte le tableau de donnée en clé/valeurs.
        // Ca crée des variables clés qui ont pour valeur la valeur
        extract($donnees);

        // On démarre le buffer de sortie (Ca met tout ce qu'on reçoit comme données dans une variable tampon)
        ob_start();
        // A partir de ce point toute sortie (entre ob_start et ob_get_clean) est conservée en mémoire (ob = output buffer)
        
        /* var_dump(ROOT); */
        // On va ensuite transmettre cet extract à la View
        require_once ROOT.'/Views/'.$fichier.'.php';

        // On récup le buffer ci dessus (ici notre vue) et on le stock dans la variable
        $contenu = ob_get_clean();

        // Le template default.php utilisant la variable $contenu, le contenu html contenu dans $contenu apparaitra à l'endroit où on l'a mis
        require_once ROOT.'/Views/'.$template.'.php';
    }
}