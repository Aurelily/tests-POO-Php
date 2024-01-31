<?php
namespace App\classes;

// Cet INTERFACE va définir les méthodes qui seront FORCEMMENT utilisées par TOUS mes loader de PDF.

interface PdfDownloader
{

    // CONSTRUCTEUR
    // Toutes les methodes magiques sont autorisées dans une interface mais toujours en mode signature seulement :
    /* public function __construct(); */

    // METHODES :
    // Dans une interface on ne défini pas la logique des fonctions, seulement les Signatures (comme pour les classes abstraites)
    // Dans une interface on ne peut également que définir des methodes en PUBLIC (pas de private ou protected)

    public function downloadPdf() : string;

    // On peut y utiliser cependant des CONSTANTES

    public const SIZE = 0;

    // L'interface ne peut pas contenir de propriétés (contrairement aux classes abstraites)

}