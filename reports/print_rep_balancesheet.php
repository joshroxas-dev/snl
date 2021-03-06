<?php

require('fpdf/writehtml.php');
require('../config.php');

$pdf=new PDF();
$pdf->AddPage("P", "A4");
$pdf->SetFont('Arial','B',12);

$logo = "../assets/images/logo-black-icon.png";
$pdf->Cell(20, 4, "", 0, 1, 'C', $pdf->Image($logo,95,5,0,0));
$pdf->Ln(12);
$pdf->Cell(190, 10, 'Sneaks and Laces', 0, 1, 'C');
$pdf->SetFont('Arial','',9);
$pdf->Cell(190, 2, 'BALANCE SHEET', 0, 1, 'C');
$pdf->Cell(190, 6, '1 January - 18 October, 2019', 0, 10, 'C');
$pdf->Ln(5);




$pdf->SetFont('Arial','',9);





$start_x=$pdf->GetX(); //initial x (start of column position)
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();

$cell_width = 165;  //define cell width
$cell_width2 = 40;  //define cell width
$cell_width3 = 40;  //define cell width
$cell_height=6;    //define cell height

$pdf->Ln();
$current_x=$start_x;                       //set x to start_x (beginning of line)
$current_y+=$cell_height;                  //increase y by cell_height to print on next line
$pdf->SetXY($current_x, $current_y);


$pdf->WriteHTML('<hr>');
$pdf->MultiCell($cell_width,$cell_height,' ',0 ,1); 
$current_x+=$cell_width;                           
$pdf->SetXY($current_x, $current_y);               

$pdf->MultiCell($cell_width2,$cell_height,'TOTAL',0 ,1); 
$current_x+=$cell_width2;                    
$pdf->WriteHTML('<hr>');

////////////////////////////////////// SPACE /////////////////////////////////////////////////
$pdf->Ln();
$current_x=$start_x;                       //set x to start_x (beginning of line)
$current_y+=$cell_height;                  //increase y by cell_height to print on next line
$pdf->SetXY($current_x, $current_y);                 //increase y by cell_height to print on next line
////////////////////////////////////// SPACE ////////////////////////////////////////////////



$pdf->MultiCell($cell_width,$cell_height,'Accounts Receivable (A/R)',0 ,1); 
$current_x+=$cell_width;                           
$pdf->SetXY($current_x, $current_y);     

$pdf->MultiCell($cell_width2,$cell_height,'1,910,376.26',0 ,1); 
$current_x+=$cell_width2;       


////////////////////////////////////// SPACE /////////////////////////////////////////////////
$pdf->Ln();
$current_x=$start_x;                       //set x to start_x (beginning of line)
$current_y+=$cell_height;                  //increase y by cell_height to print on next line
$pdf->SetXY($current_x, $current_y);                 //increase y by cell_height to print on next line
////////////////////////////////////// SPACE ////////////////////////////////////////////////


$pdf->MultiCell($cell_width,$cell_height,'Total Accounts receivable',0 ,1); 
$current_x+=$cell_width;                           
$pdf->SetXY($current_x, $current_y);     

$pdf->MultiCell($cell_width2,$cell_height,'PHP1,910,376.26',0 ,1); 
$current_x+=$cell_width2;       


////////////////////////////////////// SPACE /////////////////////////////////////////////////
$pdf->Ln();
$current_x=$start_x;                       //set x to start_x (beginning of line)
$current_y+=$cell_height;                  //increase y by cell_height to print on next line
$pdf->SetXY($current_x, $current_y);                 //increase y by cell_height to print on next line
////////////////////////////////////// SPACE ////////////////////////////////////////////////



$pdf->Output();

?>