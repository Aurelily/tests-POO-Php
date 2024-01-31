<?php

// Extension Php DockBlocker pour faire les blocks de documentation en tapant /** */

/**
 * Objet compte bancaire
 */

class Compte
{
    /**
     * Titulaire du compte
     *
     * @var string
     */
    public $titulaire;
    /**
     * Solde du compte
     *
     * @var float
     */
    public $solde;

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

        // On attribue le montant à la propriété solde
        $this->solde = $montant;
        
    }

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
