<?php

namespace App\Banque;

// Extension Php DockBlocker pour faire les blocks de documentation en tapant /** */

/**
 * Objet compte bancaire
 */

abstract class Compte
// NOTE :  Rendre cette classe abstraite permet de ne plus l'instancier en faisant new Compte(). Elle sera hérité dans d'autres classes.
// Cette classe sera la partie commune de toutes les sortes de comptes.
{

    // LES PROPRIETES
    // -----------------------------

    /**
     * Titulaire du compte
     *
     * @var string
     */
    private string $titulaire;
    /**
     * Solde du compte
     *
     * @var float
     */
    protected float $solde; // En mettant la propriété en protected, je la rend accessible aussi par les classes enfants (heritage)


    // LE CONSTRUCTEUR
    // -----------------------------

    /**
     * Constructeur du compte bancaire
     *
     * @param string $nom Nom du titulaire
     * @param float $montant Montant du solde
     */
    public function __construct(string $nom, float $montant = 100 )
    {
        // On attribue le nom à la propriété titulaire de l'instance créée
        $this->titulaire = $nom;
         // On attribue le montant à la propriété solde de l'instance créée
         $this->solde = $montant;
        
    }

    // LES ACCESSEURS
    // -----------------------------
    /**
     * Retourne la valeur de titulaire du compte
     *
     * @return string
     */
    public function getTitulaire() : string
    {
        return $this->titulaire;
    }

    /**
     * Modifie le nom du titulaire et retourne l'objet Compte
     *
     * @param string $nom Nom du titulaire
     * @return Compte Compte bancaire
     */
    public function setTitulaire(string $nom) : self
    {
        // On verifie qu'on ai bien un titulaire
        if($nom != ""){
            $this->titulaire = $nom;
            return $this;
        }
       
    }

    /**
     * Retourne le solde du compte
     *
     * @return float Solde du compte
     */
    public function getSolde() : float
    {
        return $this->solde;
    }

    /**
     * Modifie le montant du solde du compte
     *
     * @param float $montant Montant du solde
     * @return Compte Compte bancaire
     */
    public function setSolde(float $montant) : self
    {
        if($montant >= 0){
            $this->solde = $montant;
        }
        return $this;
    }


    // LES METHODES
    // -----------------------------

    /**
     * Déposer de l'argent sur le compte
     *
     * @param float $montant Montant déposé
     * @return void
     */
    public function deposer(float $montant)
    {
        // On vérifie si le montant est positif
        if($montant > 0){
            $this->solde += $montant;
        }else{
            echo "Montant invalide !";
        }
    }

    /**
     * Retire un montant du solde du compte
     *
     * @param float $montant Montant à retirer
     * @return void
     */
    public function retirer(float $montant)
    {
        // On vérifie que le montant est  positif et que le solde est suffisant
        if($montant > 0 && $this->solde >= $montant){
            $this->solde -= $montant;
        }else{
            echo "Montant invalide ou solde insuffisant !";
        }
    }

    /**
     * Retourne une chaine caractère affichant le solde
     *
     * @return string
     */
    public function voirSolde()
    {
        return "Le solde du compte est de $this->solde €";
    }


    
}
