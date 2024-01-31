<?php

// Ce fichier sera LE fichier central du projet. Il servira à lancer le routeur
// On crée une constante contenant le dossier racine du projet

use App\Autoloader;
use App\Core\Main;

define ('ROOT', dirname(__DIR__));
/* echo ROOT; */

// On importe l'autoloader
require_once ROOT.'/Autoloader.php';
Autoloader::register();

// On instancie la classe Main qui sera notre ROUTEUR
$app = new Main();

// On démarre l'application avec la methode start() que l'on a mis dans le routeur
$app->start();