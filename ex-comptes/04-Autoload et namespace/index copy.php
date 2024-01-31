<?php

use App\Autoloader;
use App\Client\Compte as CompteClient; // On appele la classe Compte du namespace Client et on lui attribu un ALIAS avec as
use App\Banque\{CompteCourant, CompteEpargne};
;

require_once 'classes/Autoloader.php';
Autoloader::register();

// On instancie le compte

$compte1 = new CompteCourant("Aurélie", 500, 200);

$compte1->retirer(200);

var_dump($compte1);

$compteEpargne = new CompteEpargne("Sebastien", 200, 10);
$compteEpargne->verserInterets();

var_dump($compteEpargne);

$client = new CompteClient();

var_dump($client);

?>


