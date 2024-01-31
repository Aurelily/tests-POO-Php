<?php

use App\Autoloader;
use App\Client\Compte as CompteClient; // On appele la classe Compte du namespace Client et on lui attribu un ALIAS avec as
use App\Banque\{CompteCourant, CompteEpargne};
;

require_once 'classes/Autoloader.php';
Autoloader::register();

//Je crée un compte client
$client = new CompteClient('Aurélie', 'PREAUD', 'Marseille');

// On instancie le compte

$compte1 = new CompteCourant($client, 500, 200);

/* $compte1->retirer(200);

var_dump($compte1);

$compteEpargne = new CompteEpargne($client, 200, 10);
$compteEpargne->verserInterets(); */

var_dump($compte1);



var_dump($client);

?>
