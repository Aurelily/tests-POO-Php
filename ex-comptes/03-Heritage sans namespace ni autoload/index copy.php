<?php

require_once 'classes/Compte.php';

// Tant qu'on a pas d'autoload, on doit require toutes les classes utilisées
require_once 'classes/CompteCourant.php';
require_once 'classes/CompteEpargne.php';

// On instancie le compte

$compte1 = new CompteCourant("Aurélie", 500, 200);

$compte1->retirer(200);

var_dump($compte1);

$compteEpargne = new CompteEpargne("Sebastien", 200, 10);
$compteEpargne->verserInterets();

var_dump($compteEpargne);

?>


