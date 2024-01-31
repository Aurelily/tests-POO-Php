<?php
namespace App\Banque;

/**
 * Compte avec taux d'intérêt
 */
class CompteEpargne extends Compte
{
    /**
     * Taux d'intérêt du compte
     *
     * @var integer
     */
    private int $taux_interets;

    /**
     * Constructeur du compte Epargne
     *
     * @param string $nom Nom titulaire
     * @param float $montant Montant du solde à l'ouverture
     * @param integer $taux Toux d'intérêt
     */
    public function __construct(string $nom, float $montant, int $taux)
    {
        // On transfère les informations necessaires au constructeur de compte depuis la classe parente
        parent::__construct($nom, $montant);
        
        // Celui là est mis dans le constructeur local de la classe
        $this->taux_interets = $taux;
        
    }

    /**
     * Get taux d'intérêt du compte
     *
     * @return  integer
     */ 
    public function getTauxInterets():int
    {
        return $this->taux_interets;
    }

    /**
     * Set taux d'intérêt du compte
     *
     * @param  integer  $taux_interets  Taux d'intérêt du compte
     *
     * @return  self
     */ 
    public function setTauxInterets(int $taux_interets):self
    {
        if($taux_interets >= 0){
            $this->taux_interets = $taux_interets;
        }
        
        return $this;
    }

    public function verserInterets()
    {
        $this->solde = $this->solde + ($this->solde * $this->taux_interets / 100);
    }
}