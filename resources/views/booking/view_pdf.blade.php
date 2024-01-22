@php
    require_once('../../../fpdf/fpdf.php');
    require_once('../../../fpdf/fpdi2/src/autoload.php');

    // initiate FPDI
    $pdf = new \setasign\Fpdi\Fpdi();
    // add a page
    $pdf->AddPage();
    // set the source file
    // $pdf->setSourceFile('./PdfDocument.pdf');
    // // import page 1
    // $tplIdx = $pdf->importPage(1);
    // // use the imported page and place it at position 10,10 with a width of 100 mm
    // $pdf->useTemplate($tplIdx, 8, 8, 200);

    // now write some text above the imported page
    $pdf->SetFont('Helvetica');
    $pdf->SetTextColor(255, 0, 0);

    $pdf->SetXY(25, 74);
    $pdf->Write(0, 'Rajeev Aswani');

    $pdf->SetXY(25, 80);
    $pdf->Write(0, 'ITSC Co. Ltd.');

    $pdf->SetXY(25, 87);
    $pdf->Write(0, 'P90720');

    $pdf->SetXY(25, 93);
    $pdf->Write(0, '105118074');

    $pdf->Output('I', 'generated.pdf');

@endphp
