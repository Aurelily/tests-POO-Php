<?php

use App\Autoloader;
use App\Models\AnnoncesModel;
use App\Models\UsersModel;

require_once 'Autoloader.php';
Autoloader::register();

$model = new UsersModel;

// Methode 2 : on récupère par exemple un  tableau qui viendrait d'une requete POST et on va HYDRATER notre annonce via une methode que l'on va créer dans le model originel.
// La methode d'hydratation est créee dans le Model et va vérifier qu'il y a bien un setter pour chaque proprété du tableau de données
$donnees = [
    'email' => 'aurelie@gmail.com',
    'password' => 'azerty',
];

$user = $model->hydrate($donnees);  // On fait un OBJET du tableau $donnees (via un POST par exemple)
$model->create($user);

// Methode 1 : Set chaque données une par une :
/* $annonce = $model
->setTitre("Nouvelle annonce")
->setDescription("Nouvelle description")
->setActif(1); */

/* $model->deleteById(3);  */

/* var_dump($model->findAll()); */

/* $annonces = $model->findById(2); */
/* var_dump($annonce); */