<?php

namespace App\Classes;

use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use App\Classes\PdfUtil;

class budget_PdfUtil extends PdfUtil
{

    public function printBookingDetails($details){
        $this->fpdf->AddPage("P");

        $this->fpdf->SetFont('Arial', 'B', 15);
        $this->fpdf->Cell(0,0,'Booking',0,1,'C');
    }

}
