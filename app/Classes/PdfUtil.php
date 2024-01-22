<?php

namespace App\Classes;

use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;

class PdfUtil
{
	protected $fpdf;
 
    public function __construct()
    {
        // $this->fpdf = new Fpdf;
    }

    public function printBookingDetails($details){
        $this->fpdf = new Fpdf;

        $this->fpdf->AddPage("P");

        $this->fpdf->SetFont('Arial', 'B', 15);
        $this->fpdf->Cell(0,0,'Booking',0,1,'C');

        //HEADER ----------------
        $x=10;$y=20;
        $this->fpdf->Image($details['office']->logo, $x, $x+10, $y, $y+10);

        $x+=25;
        $this->fpdf->SetXY($x, $y); // Set position
        $this->fpdf->Cell(10, 10, $details['office']->name, 0, 1, 'L'); // 'C' indicates center alignment

        // Set font and size for the address
        $this->fpdf->SetFont('Arial', '', 12);

        $y+=6;
        $this->fpdf->SetXY($x, $y); // Set position at X=30, Y=10
        $this->fpdf->Cell(10, 10, $details['office']->address, 0, 1, 'L');
        
        $y+=6;
        $this->fpdf->SetXY($x, $y); // Set position at X=30, Y=10
        $this->fpdf->Cell(10, 10, 'Company Address Line 2', 0, 1, 'L');
        
        $y+=6;
        $this->fpdf->SetXY($x, $y); // Set position at X=30, Y=10
        $this->fpdf->Cell(10, 10, 'City, State, ZIP', 0, 1, 'L');
        
        $y+=12;
        $this->fpdf->Line(10, $y, 200, $y);
        //-----------------------------------

        //BODY---------------------
        // Set fill color (in this case, light gray)
        // $fpdf->SetFillColor(211, 211, 211); // RGB values for light gray

        // Draw a filled rectangle to create a shaded area
        // $fpdf->Rect(10, 55, 100, 100, 'F'); // X=20, Y=30, Width=150, Height=50
        $this->fpdf->SetFont('Arial', 'B', 15);

        $x=10;$y=58;
        $this->fpdf->SetXY($x, $y); // Set position 
        $this->fpdf->Cell(0,0,'Booking Details',0,1,'L');

        $this->fpdf->SetFont('Arial', '', 12);
        $this->fpdf->SetXY($x, $y+6); // Set position 
        $this->fpdf->Cell(5, 8, 'Pick up (Date & Time): '.$details['booking']->pickup_date_time, 0, 1, 'L');
        $this->fpdf->Cell(5, 8, 'Number of days: '.$details['booking']->tarrif_detail, 0, 1, 'L');
        $this->fpdf->Cell(5, 8, 'Car Type: '.$details['booking']->car_type, 0, 1, 'L');
        $this->fpdf->Cell(5, 8, 'Pick up location: '.$details['booking']->pickup_location, 0, 1, 'L');
        $this->fpdf->Cell(5, 8, 'Per day KM allocation: '.$details['booking']->km_allocation, 0, 1, 'L');
        $this->fpdf->Cell(5, 8, 'Payment Mode: '.$details['booking']->payment_mode, 0, 1, 'L');

        $x=110;$y=55;
        $this->fpdf->SetXY($x, $y); // Set position 
        // $fpdf->Cell(5, 8, 'Pick up (Date & Time): '.$booking->pickup_date_time, 0, 1, 'L');
    }

    public function printBookingInvoice($details){

    }

    public function add_test_content() 
    {
    	$this->fpdf->SetFont('Arial', 'B', 15);
        $this->fpdf->AddPage("P");
        $this->fpdf->Text(10, 10, "Hello World!");       
    }

    public function getFpdf() {
        return $this->fpdf;
    }

    public function output(){
        $this->fpdf->Output();
        exit;
    }
}
