<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Barryvdh\DomPDF\Facade\Pdf;
use Log;

class PdfController extends Controller
{ 
    public function index() 
    {
        Log::debug("pdfcontroller index");
        $pdf = Pdf::loadView('pdf.test', array());
        return $pdf->download('invoice.pdf');
    }
}