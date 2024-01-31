<?php

// Je crée un SUPER SERVICE qui va gérer le download de PDF

namespace App\classes;



class PdfDownloaderService 
{
    public function downloadPdf(PdfDownloader $pdfDownloader)
    {
        return $pdfDownloader->downloadPdf();

    }
    
}
