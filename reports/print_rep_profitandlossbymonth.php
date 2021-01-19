<?php

require('fpdf/writehtml.php');
require('../config.php');

$pdf=new PDF();
$pdf->AddPage("F", "A4");
$pdf->SetFont('Arial','B',12);

$logo = "../assets/images/logo-black-icon.png";
$pdf->Cell(20, 4, "", 0, 1, 'C', $pdf->Image($logo,135,5,0,0));
$pdf->Ln(12);
$pdf->Cell(272, 10, 'Sneaks and Laces', 0, 1, 'C');
$pdf->SetFont('Arial','',9);
$pdf->Cell(272, 2, 'PROFIT AND LOSS BY MONTH', 0, 1, 'C');
$pdf->Cell(272, 6, 'As of October 18, 2019', 0, 10, 'C');
$pdf->Ln(5);




$pdf->SetFont('Arial','',9);





$start_x=$pdf->GetX(); //initial x (start of column position)
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();

$cell_width = 40;  //define cell width
$cell_width2 = 21;  //define cell width
$cell_width3 = 21;  //define cell width
$cell_width4 = 21;  //define cell width
$cell_width5 = 21;  //define cell width
$cell_width6 = 21;  //define cell width
$cell_width7 = 21;  //define cell width
$cell_width8 = 21;  //define cell width
$cell_width9 = 21;  //define cell width
$cell_width10 = 21;  //define cell width
$cell_width11 = 21;  //define cell width
$cell_width12 = 35;  //define cell width
$cell_height=5;    //define cell height

$pdf->Ln();
$current_x=$start_x;                       //set x to start_x (beginning of line)
$current_y+=$cell_height;                  //increase y by cell_height to print on next line
$pdf->SetXY($current_x, $current_y);



$pdf->MultiCell($cell_width,$cell_height,'',0 ,1); 
$current_x+=$cell_width;                           
$pdf->SetXY($current_x, $current_y);               

$pdf->MultiCell($cell_width2,$cell_height,'JAN 2019',0 ,1); 
$current_x+=$cell_width2;                           
$pdf->SetXY($current_x, $current_y);               

$pdf->MultiCell($cell_width3,$cell_height,'FEB 2019',0 ,1);
$current_x+=$cell_width3;
$pdf->SetXY($current_x, $current_y);  

$pdf->MultiCell($cell_width4,$cell_height,'MAR 2019',0 ,1); 
$current_x+=$cell_width4;                           
$pdf->SetXY($current_x, $current_y);               

$pdf->MultiCell($cell_width5,$cell_height,'APR 2019',0 ,1); 
$current_x+=$cell_width5;                           
$pdf->SetXY($current_x, $current_y); 

$pdf->MultiCell($cell_width6,$cell_height,'MAY 2019',0 ,1); 
$current_x+=$cell_width6;                           
$pdf->SetXY($current_x, $current_y);

$pdf->MultiCell($cell_width7,$cell_height,'JUN 2019',0 ,1); 
$current_x+=$cell_width7;                           
$pdf->SetXY($current_x, $current_y);

$pdf->MultiCell($cell_width8,$cell_height,'JUL 2019',0 ,1); 
$current_x+=$cell_width8;                           
$pdf->SetXY($current_x, $current_y);

$pdf->MultiCell($cell_width9,$cell_height,'AUG 2019',0 ,1); 
$current_x+=$cell_width9;                           
$pdf->SetXY($current_x, $current_y);

$pdf->MultiCell($cell_width10,$cell_height,'SEP 2019',0 ,1); 
$current_x+=$cell_width10;                           
$pdf->SetXY($current_x, $current_y);

$pdf->MultiCell($cell_width11,$cell_height,'OCT 2019',0 ,1); 
$current_x+=$cell_width11;                           
$pdf->SetXY($current_x, $current_y);

$pdf->MultiCell($cell_width12,$cell_height,'TOTAL',0 ,1); 
$current_x+=$cell_width12;         


////////////////////////////////////// SPACE /////////////////////////////////////////////////
$pdf->Ln();
$current_x=$start_x;                       //set x to start_x (beginning of line)
$current_y+=$cell_height;                  //increase y by cell_height to print on next line
$pdf->SetXY($current_x, $current_y);                 //increase y by cell_height to print on next line
////////////////////////////////////// SPACE ////////////////////////////////////////////////


$pdf->MultiCell($cell_width,$cell_height,'Sales of Product Income',0 ,1); 
$current_x+=$cell_width;                           
$pdf->SetXY($current_x, $current_y);               

$pdf->MultiCell($cell_width2,$cell_height,'-2,057.00',0 ,1); 
$current_x+=$cell_width2;                           
$pdf->SetXY($current_x, $current_y);               

$pdf->MultiCell($cell_width3,$cell_height,'-1,269.00',0 ,1);
$current_x+=$cell_width3;
$pdf->SetXY($current_x, $current_y);  

$pdf->MultiCell($cell_width4,$cell_height,'-2,161.49',0 ,1); 
$current_x+=$cell_width4;                           
$pdf->SetXY($current_x, $current_y);               

$pdf->MultiCell($cell_width5,$cell_height,'-1,775.00',0 ,1); 
$current_x+=$cell_width5;                           
$pdf->SetXY($current_x, $current_y); 

$pdf->MultiCell($cell_width6,$cell_height,'-2,884.00',0 ,1); 
$current_x+=$cell_width6;                           
$pdf->SetXY($current_x, $current_y);

$pdf->MultiCell($cell_width7,$cell_height,'-100.00',0 ,1); 
$current_x+=$cell_width7;                           
$pdf->SetXY($current_x, $current_y);

$pdf->MultiCell($cell_width8,$cell_height,'-395.00',0 ,1); 
$current_x+=$cell_width8;                           
$pdf->SetXY($current_x, $current_y);

$pdf->MultiCell($cell_width9,$cell_height,'-250.00',0 ,1); 
$current_x+=$cell_width9;                           
$pdf->SetXY($current_x, $current_y);

$pdf->MultiCell($cell_width10,$cell_height,'-880.70',0 ,1); 
$current_x+=$cell_width10;                           
$pdf->SetXY($current_x, $current_y);

$pdf->MultiCell($cell_width11,$cell_height,'-2,087.55',0 ,1); 
$current_x+=$cell_width11;                           
$pdf->SetXY($current_x, $current_y);

$pdf->MultiCell($cell_width12,$cell_height,'PHP -13,859.74',0 ,1); 
$current_x+=$cell_width12;         


////////////////////////////////////// SPACE /////////////////////////////////////////////////
$pdf->Ln();
$current_x=$start_x;                       //set x to start_x (beginning of line)
$current_y+=$cell_height;                  //increase y by cell_height to print on next line
$pdf->SetXY($current_x, $current_y);                 //increase y by cell_height to print on next line
////////////////////////////////////// SPACE ////////////////////////////////////////////////


$pdf->Output();

?>