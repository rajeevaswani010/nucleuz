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
        // $parser = new \Smalot\PdfParser\Parser();

        $this->fpdf = new Fpdi();
        $this->fpdf->AddPage();        
        $this->fpdf->setSourceFile(public_path('public/pdfutil/booking_contract.pdf'));
        // import page 1
        $tplId = $this->fpdf->importPage(1);
        // use the imported page and place it at point 10,10 with a width of 100 mm
        $this->fpdf->useTemplate($tplId,5,0,200,300);

        //add details
        $this->fpdf->SetFont('helvetica', 'B', 14);

        //=--------set COMPANY HEADER ---------------//
        //set logo
        $x=95;$y=15;
        $this->fpdf->Image($details['office']->logo, $x,$y,20,20);

        $x=10;$y=13;
        $this->fpdf->SetXY($x, $y); // Set position
        $this->fpdf->Cell(10, 10, $details['office']->name, 0, 1, 'L'); // 'C' indicates center alignment

        // Set font and size for the address
        $this->fpdf->SetFont('Arial', '', 10);

        $x=10;$y=13+6*1;
        $this->fpdf->SetXY($x, $y); // Set position
        $this->fpdf->Cell(10, 10, $details['office']->address, 0, 1, 'L');
        
        $x=10;$y=13+6*2;
        $this->fpdf->SetXY($x, $y); // Set position at X=30, Y=10
        $this->fpdf->Cell(10, 10, 'Company Address Line 2', 0, 1, 'L');
        
        $x=10;$y=13+6*3;
        $this->fpdf->SetXY($x, $y); // Set position at X=30, Y=10
        $this->fpdf->Cell(10, 10, 'City, State, ZIP', 0, 1, 'L');
        
        //separation line between header and body
        $x=18;$y=40;
        $this->fpdf->SetXY($x, $y); // Set position at X=30, Y=10
        $this->fpdf->Line(10, $y, 200, $y);


        //change font color and size before fillig details.. 
        $this->fpdf->SetTextColor(0, 0, 255); // blue color (RGB)
        $this->fpdf->SetFont('Arial', '', 10);

        //=--------set CUSTOMER DETAILS ---------------//
        //set name
        $x=18;$y=68+7*0;
        $this->fpdf->SetXY($x, $y); // Set position 
        $this->fpdf->Cell(5, 8, $details['customer']->title." ".$details['customer']->first_name, 0, 1, 'L');

        //set passport details
        $x=18;$y=68+7*2;
        $this->fpdf->SetXY($x, $y); // Set position 
        $this->fpdf->Cell(5, 8, $details['customer']->passport_num, 0, 1, 'L');

        //set driving license details.. 
        $x=18;$y=68+7*3;
        $this->fpdf->SetXY($x, $y); // Set position 
        $this->fpdf->Cell(5, 8, $details['customer']->id_num, 0, 1, 'L');

        //set driving license details.. 
        $x=18;$y=68+7*4;
        $this->fpdf->SetXY($x, $y); // Set position 
        $this->fpdf->Cell(5, 8, $details['customer']->driving_license_num, 0, 1, 'L');
        
        //set driving license issued by. 
        $x=18;$y=68+7*5;
        $this->fpdf->SetXY($x, $y); // Set position 
        $this->fpdf->Cell(5, 8, $details['customer']->driving_lic_issuedby, 0, 1, 'L');

        //set driving license valid upto
        $x=18;$y=68+7*6;
        $this->fpdf->SetXY($x, $y); // Set position 
        $this->fpdf->Cell(5, 8, $details['customer']->driving_lic_valid_upto, 0, 1, 'L');

        //set nationality
        $x=18;$y=68+7*7;
        $this->fpdf->SetXY($x, $y); // Set position 
        $this->fpdf->Cell(5, 8, $details['customer']->nationality, 0, 1, 'L');

        //set mobile
        $x=18;$y=68+7*9;
        $this->fpdf->SetXY($x, $y); // Set position 
        $this->fpdf->Cell(5, 8, $details['customer']->mobile, 0, 1, 'L');     


        //=-----set VEHICLE DETAILS-----------------//
        if($details['vehicle']) {
            //vehicle reg_no
            $x=118;$y=68+7*0;
            $this->fpdf->SetXY($x, $y); // Set position 
            $this->fpdf->Cell(5, 8, $details['vehicle']->reg_no, 0, 1, 'L');

            //vehicle model
            $x=118;$y=68+7*1;
            $this->fpdf->SetXY($x, $y); // Set position 
            $this->fpdf->Cell(5, 8, $details['vehicle']->model, 0, 1, 'L');

            //vehicle returning date
            $x=113;$y=68+7*5;
            $this->fpdf->SetXY($x, $y); // Set position 
            $str = substr($details['vehicle']->dropoff_date, 0, strrpos($details['vehicle']->dropoff_date, ' '));
            $newDate = date("d    m    Y", strtotime($str));
            $this->fpdf->Cell(5, 8, $newDate, 0, 1, 'L');

            //vehicle leaving date
            $x=142;$y=68+7*5;
            $this->fpdf->SetXY($x, $y); // Set position 
            $str = substr($details['vehicle']->pickup_date_time, 0, strrpos($details['vehicle']->pickup_date_time, ' '));
            $newDate = date("d    m     Y", strtotime($str));
            $this->fpdf->Cell(5, 8, $newDate, 0, 1, 'L');
        } else {
            //vehicle reg_no
            $x=118;$y=68+7*0;
            $this->fpdf->SetXY($x, $y); // Set position 
            $this->fpdf->Cell(5, 8, "RESERVED", 0, 1, 'L');
            
        }

        //=-----TERMS AND CONDITIONS-----------------//
        $this->fpdf->AddPage();
        $tplId2 = $this->fpdf->importPage(2);
        $this->fpdf->useTemplate($tplId2,5,0,200,300);

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
