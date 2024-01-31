<?php
namespace App\classes;

/* class BasicPdf implements PdfDownloader, HtmlDownloader */
class BasicPdf implements PdfDownloader

// Note : on peut aussi implémenter plusieurs interfaces comme ci dessus (contrairement à la classe abstraite qui avec l'heritage sera seul sur l'enfant), ou bien n'en mettre qu'une et faire un extends d'une ou plusieurs autres interfaces dans la première
{

    // Si on défini un constructeur dans l'interface implémenté il faut aussi en définir un ici
    // Idem si on met des paramètres dans PdfDownloader, il faut qu'il y en ai dans la methode ici aussi

    public function __construct()
    {
        echo "Ok";
    }

    public function downloadPdf(?int $size = null): string
    {
        return "PDF téléchargé (basic)";
    }

/*     public function downloadHtml(): string
    {
        return "HTML téléchargé (basic)!";
    }
 */
}