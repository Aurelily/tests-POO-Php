<?php

// NOTE :  On ne fait PAS de SQL dans les Controllers ! On se sert des Models

namespace App\Controllers;

use App\Models\AnnoncesModel;

class AnnoncesController extends Controller
{
    /**
     * Page qui affichera la liste de toutes les annonces de la BDD
     *
     * @return void
     */
    public function index()
    {
        // On instancie le model correspondant à la table annonces de la bdd
        $annoncesModel = new AnnoncesModel;

        // On va chercher toutes les annonces qui ont la colonne 'actif" à 1
        $annonces = $annoncesModel->findBy(['actif'=> 1]);

        // On génère la vue index.php de annonces
        $this->render('annonces/index', ['annonces'=> $annonces]);
    }

    /**
     *ette methode affiche une annonce avec son id
     *
     * @param integer $id de l'annonce
     * @return void
     */
    public function lire(int $id)
    {
        // On instancie le model
        $annonceModel = new AnnoncesModel;

        // On va chercher 1 annonce avec son id
        $annonce = $annonceModel->findById($id);

        // On envoi à la Vue lire.php
        $this->render('annonces/lire', ['annonce'=> $annonce]);
     
    }
}