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
$pdf->Cell(272, 2, 'COLLECTIONS REPORT', 0, 1, 'C');
$pdf->Cell(272, 6, 'As of October 18, 2019', 0, 10, 'C');
$pdf->Ln(5);




$pdf->SetFont('Arial','',10);





$start_x=$pdf->GetX(); //initial x (start of column position)
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();

$cell_width = 50;  //define cell width
$cell_width2 = 45;  //define cell width
$cell_width3 = 20;  //define cell width
$cell_width4 = 40;  //define cell width
$cell_width5 = 40;  //define cell width
$cell_width6 = 40;  //define cell width
$cell_width7 = 40;  //define cell width
$cell_width8 = 40;  //define cell width
$cell_height=5;    //define cell height

$pdf->Ln();
$current_x=$start_x;                       //set x to start_x (beginning of line)
$current_y+=$cell_height;                  //increase y by cell_height to print on next line
$pdf->SetXY($current_x, $current_y);



$pdf->MultiCell($cell_width,$cell_height,'DATE',0 ,1); 
$current_x+=$cell_width;                           
$pdf->SetXY($current_x, $current_y);               

$pdf->MultiCell($cell_width2,$cell_height,'TRANSACTION TYPE',0 ,1); 
$current_x+=$cell_width2;                           
$pdf->SetXY($current_x, $current_y);               

$pdf->MultiCell($cell_width3,$cell_height,'NO.',0 ,1);
$current_x+=$cell_width3;
$pdf->SetXY($current_x, $current_y);  

$pdf->MultiCell($cell_width4,$cell_height,'TERMS',0 ,1); 
$current_x+=$cell_width4;                           
$pdf->SetXY($current_x, $current_y);               

$pdf->MultiCell($cell_width5,$cell_height,'DUE DATE',0 ,1); 
$current_x+=$cell_width5;                           
$pdf->SetXY($current_x, $current_y); 

$pdf->MultiCell($cell_width6,$cell_height,'PAST DUE',0 ,1); 
$current_x+=$cell_width6;                           
$pdf->SetXY($current_x, $current_y);

$pdf->MultiCell($cell_width7,$cell_height,'OPEN BALANCE',0 ,1); 
$current_x+=$cell_width7;         


////////////////////////////////////// SPACE /////////////////////////////////////////////////
$pdf->Ln();
$current_x=$start_x;                       //set x to start_x (beginning of line)
$current_y+=$cell_height;                  //increase y by cell_height to print on next line
$pdf->SetXY($current_x, $current_y);                 //increase y by cell_height to print on next line
////////////////////////////////////// SPACE ////////////////////////////////////////////////


$pdf->MultiCell(50,$cell_height,'Aaron Andre Alberto',0 ,1); 
$current_x+=50;                           
$pdf->SetXY($current_x, $current_y);               

$pdf->MultiCell($cell_width2,$cell_height,' ',0 ,1); 
$current_x+=$cell_width2;                           
$pdf->SetXY($current_x, $current_y);               

$pdf->MultiCell($cell_width3,$cell_height,' ',0 ,1);
$current_x+=$cell_width3;
$pdf->SetXY($current_x, $current_y);  

$pdf->MultiCell($cell_width4,$cell_height,' ',0 ,1); 
$current_x+=$cell_width4;                           
$pdf->SetXY($current_x, $current_y);               

$pdf->MultiCell($cell_width5,$cell_height,' ',0 ,1); 
$current_x+=$cell_width5;                           
$pdf->SetXY($current_x, $current_y); 

$pdf->MultiCell($cell_width6,$cell_height,' ',0 ,1); 
$current_x+=$cell_width6;                           
$pdf->SetXY($current_x, $current_y);

$pdf->MultiCell($cell_width7,$cell_height,' ',0 ,1); 
$current_x+=$cell_width7;       


////////////////////////////////////// SPACE /////////////////////////////////////////////////
$pdf->Ln();
$current_x=$start_x;                       //set x to start_x (beginning of line)
$current_y+=$cell_height;                  //increase y by cell_height to print on next line
$pdf->SetXY($current_x, $current_y);                 //increase y by cell_height to print on next line
////////////////////////////////////// SPACE ////////////////////////////////////////////////


$pdf->MultiCell($cell_width,$cell_height,'10/01/2019',0 ,1); 
$current_x+=$cell_width;                           
$pdf->SetXY($current_x, $current_y);               

$pdf->MultiCell(45,$cell_height,'Invoice',0 ,1); 
$current_x+=45;                           
$pdf->SetXY($current_x, $current_y);               

$pdf->MultiCell(20,$cell_height,'2875',0 ,1);
$current_x+=20;
$pdf->SetXY($current_x, $current_y);  

$pdf->MultiCell($cell_width4,$cell_height,'Due on receipt',0 ,1); 
$current_x+=$cell_width4;                           
$pdf->SetXY($current_x, $current_y);               

$pdf->MultiCell($cell_width5,$cell_height,'Due on receipt',0 ,1); 
$current_x+=$cell_width5;                           
$pdf->SetXY($current_x, $current_y); 

$pdf->MultiCell($cell_width6,$cell_height,'550.00',0 ,1); 
$current_x+=$cell_width6;                           
$pdf->SetXY($current_x, $current_y);

$pdf->MultiCell($cell_width7,$cell_height,'550.00',0 ,1); 
$current_x+=$cell_width7;    



////////////////////////////////////// SPACE /////////////////////////////////////////////////
$pdf->Ln();
$current_x=$start_x;                       //set x to start_x (beginning of line)
$current_y+=$cell_height;                  //increase y by cell_height to print on next line
$pdf->SetXY($current_x, $current_y);                 //increase y by cell_height to print on next line
////////////////////////////////////// SPACE ////////////////////////////////////////////////


$pdf->MultiCell(90,$cell_height,'Total for Aaron Andre Alberto asd asd',0 ,1); 
$current_x+=90;                           
$pdf->SetXY($current_x, $current_y);               

$pdf->MultiCell($cell_width2,$cell_height,' ',0 ,1); 
$current_x+=$cell_width2;                           
$pdf->SetXY($current_x, $current_y);               

$pdf->MultiCell($cell_width3,$cell_height,' ',0 ,1);
$current_x+=$cell_width3;
$pdf->SetXY($current_x, $current_y);  

$pdf->MultiCell(0,$cell_height,' ',0 ,1); 
$current_x+=0;                           
$pdf->SetXY($current_x, $current_y);               

$pdf->MultiCell($cell_width5,$cell_height,' ',0 ,1); 
$current_x+=$cell_width5;                           
$pdf->SetXY($current_x, $current_y); 

$pdf->MultiCell($cell_width6,$cell_height,'PHP468.00',0 ,1); 
$current_x+=$cell_width6;                           
$pdf->SetXY($current_x, $current_y);

$pdf->MultiCell($cell_width7,$cell_height,'PHP468.00',0 ,1); 
$current_x+=$cell_width7; 

$pdf->Output();

?>