<?php

use App\Autoloader;
use App\classes\BasicPdf; 
use App\classes\PdfDownloaderService;
use App\classes\PremiumPdf;

require_once '../Autoloader.php';
Autoloader::register();

$basicPdf = new BasicPdf();
$premiumPdf = new PremiumPdf();
/*var_dump($basicPdf->downloadPdf()); */

$pdfDownloaderService = new PdfDownloaderService();
var_dump($pdfDownloaderService->downloadPdf($premiumPdf));