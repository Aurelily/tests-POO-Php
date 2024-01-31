<?php

// On ajoute un namespace à cette classe pour ne pas qu'elle soit confondu avec l'autre.
// On l'appelera via ce namespace
namespace App\Client;

class Compte
{

    private string $nom;
    private string $prenom; 
    private string $ville; 

    public function __construct(string $nom, string $prenom, string $ville)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->ville = $ville;
        
    }

// PHP 8 : Depuis on peut directement déclarer les propriétés dans les paramètres du construct (par contre on ne peut pas mettre de propriété hérité en mode static, donc à garder que pour les classes non hétitées)

    
}

