<?php
namespace App;

//NOTE : la fonction spl_autoload_register fournie par Php : permet une détection auto des instanciations de classes
//Si la classe instancié n'est pas encore connu, une méthode de callback sera appelée

class Autoloader

//NOTE : Les methodes statics sont accessibles sans avoir besoin d'instancier la classe.
//On l'appelera comme ça : Autoloader::register
{
    static function register() // Nous permet d'enregistrer notre Autoloader
    {
        spl_autoload_register([
            __CLASS__, // Méthode magique indiquand la Classe où on se trouve
            'autoload' // Méthode à lancer définie ci dessous
        ]);
    }

    static function autoload($class)
    {
        //On récupère dans $class la totalité du namespace de la classe concernée (ex.: App\Client\Compte)

        //Etape1 : On retire App\ . On utilisera la constante magique __NAMESPACE__ qui retourne le namespace dans lequel on se trouve (ici App)
        //Note : j'ai mis \\ au lieu de \ car sinon c'est juste pris comme un échappement de l'apostrophe
        $class = str_replace(__NAMESPACE__ . '\\', '', $class);

        //Etape 2 : On remplace les \ par des / pour ecrire le chemin d'accès à nos fichiers
        $class = str_replace('\\', '/', $class);

        //Etape 3 : On écris le chemin vers le fichier
        //Note : __DIR__ est une constante magique pour recup le chemin du fichier où on se trouve
        $fichier =  __DIR__ . '/' . $class . '.php';

        //Etape 4 : On charge le fichier (Après avoir vérifié que le fichier existe bien)
        if(file_exists($fichier)){
            require_once $fichier;
        }
    }

}