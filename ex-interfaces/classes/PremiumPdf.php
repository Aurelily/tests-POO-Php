<?php
namespace App\classes;

class PremiumPdf implements PdfDownloader


{


    public function downloadPdf(): string
    {
        return "PDF téléchargé (Premium)";
    }

}