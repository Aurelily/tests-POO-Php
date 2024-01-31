<?php
namespace App\Banque;

use App\Client\Compte as CompteClient;


/**
 * Compte bancaire qui hérite (étend) de la classe Compte
 */
class CompteCourant extends Compte
{

    private float $decouvert;

    /**
     * Constructeur du compte courant
     *
     * @param CompteClient $compte Compte du titulaire
     * @param float $montant Montant du solde
     * @param integer $decouvert Découvert autorisé
     */
    public function __construct(CompteClient $compte, float $montant, int $decouvert)
    {
        // On transfère les informations necessaires au constructeur de compte depuis la classe parente
        parent::__construct($compte, $montant);

        // Celui là est mis dans le constructeur local de la classe
        $this->decouvert = $decouvert;

    }



    /**
     * Get the value of decouvert
     */ 
    public function getDecouvert():int
    {
        return $this->decouvert;
    }

    /**
     * Set the value of decouvert
     *
     * @return  self
     */ 
    public function setDecouvert(int $montant):self
    {
        if($montant >= 0){
            $this->decouvert = $montant;
        }
        
        return $this;
    }

    public function retirer(float $montant)
    {
        // On vérifie si le découvert permet le retrait
        if($montant > 0 && $this->solde - $montant >= -$this->decouvert){
            $this->solde -= $montant;
        }else{
            echo "Solde insuffisant";
        }

    }
}