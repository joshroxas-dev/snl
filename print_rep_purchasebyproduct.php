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
$pdf->Cell(272, 2, 'Room 302-303 Rudel Building V, Diego Silang Street', 0, 1, 'C');
$pdf->Cell(272, 6, 'Session Road, Baguio City 2600', 0, 10, 'C');
$pdf->Ln(5);




$pdf->SetFont('Arial','',10);





$start_x=$pdf->GetX(); //initial x (start of column position)
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();

$cell_width = 20;  //define cell width
$cell_height=5;    //define cell height

$pdf->Ln();
$current_x=$start_x;                       //set x to start_x (beginning of line)
$current_y+=$cell_height;                  //increase y by cell_height to print on next line
$pdf->SetXY($current_x, $current_y);



$pdf->MultiCell($cell_width,$cell_height,'DATE',0 ,1); 
$current_x+=$cell_width;                           
$pdf->SetXY($current_x, $current_y);               

$pdf->MultiCell(45,$cell_height,'TRANSACTION TYPE',0 ,1); 
$current_x+=45;                           
$pdf->SetXY($current_x, $current_y);               

$pdf->MultiCell(30,$cell_height,'SUPPLIER',0 ,1);
$current_x+=30;
$pdf->SetXY($current_x, $current_y);  

$pdf->MultiCell(80,$cell_height,'MEMO/DESCRIPTION',0 ,1); 
$current_x+=80;                           
$pdf->SetXY($current_x, $current_y);               

$pdf->MultiCell($cell_width,$cell_height,'QTY',0 ,1); 
$current_x+=$cell_width;                           
$pdf->SetXY($current_x, $current_y); 

$pdf->MultiCell($cell_width,$cell_height,'RATE',0 ,1); 
$current_x+=$cell_width;                           
$pdf->SetXY($current_x, $current_y);

$pdf->MultiCell(30,$cell_height,'AMOUNT',0 ,1); 
$current_x+=30;                           
$pdf->SetXY($current_x, $current_y);

$pdf->MultiCell(30,$cell_height,'BALANCE',0 ,1);
$current_x+=30;


////////////////////////////////////// SPACE /////////////////////////////////////////////////
$pdf->Ln();
$current_x=$start_x;                       //set x to start_x (beginning of line)
$current_y+=$cell_height;                  //increase y by cell_height to print on next line
$pdf->SetXY($current_x, $current_y);                 //increase y by cell_height to print on next line
////////////////////////////////////// SPACE ////////////////////////////////////////////////

$pdf->MultiCell($cell_width,$cell_height,'Angelus',0 ,1); 
$current_x+=$cell_width;                           
$pdf->SetXY($current_x, $current_y);    
$pdf->MultiCell(45,$cell_height,'  ',0 ,1); 
$current_x+=45;                           
$pdf->SetXY($current_x, $current_y);    
$pdf->MultiCell(30,$cell_height,'  ',0 ,1);
$current_x+=30;
$pdf->SetXY($current_x, $current_y);  
$pdf->MultiCell(80,$cell_height,' ',0 ,1); 
$current_x+=80;                           
$pdf->SetXY($current_x, $current_y);      
$pdf->MultiCell($cell_width,$cell_height,'  ',0 ,1); 
$current_x+=$cell_width;                           
$pdf->SetXY($current_x, $current_y); 
$pdf->MultiCell($cell_width,$cell_height,'  ',0 ,1); 
$current_x+=$cell_width;                           
$pdf->SetXY($current_x, $current_y);
$pdf->MultiCell(30,$cell_height,'  ',0 ,1); 
$current_x+=30;                           
$pdf->SetXY($current_x, $current_y);
$pdf->MultiCell(30,$cell_height,'  ',0 ,1);
$current_x+=30;




////////////////////////////////////// SPACE /////////////////////////////////////////////////
$pdf->Ln();
$current_x=$start_x;                       //set x to start_x (beginning of line)
$current_y+=$cell_height;                  //increase y by cell_height to print on next line
$pdf->SetXY($current_x, $current_y);                 //increase y by cell_height to print on next line
////////////////////////////////////// SPACE ////////////////////////////////////////////////

$pdf->MultiCell(40, $cell_height,'Clean & Condition',0 ,1); 
$current_x+=40;                           
$pdf->SetXY($current_x, $current_y);    
$pdf->MultiCell(45,$cell_height,'  ',0 ,1); 
$current_x+=45;                           
$pdf->SetXY($current_x, $current_y);    
$pdf->MultiCell(30,$cell_height,'  ',0 ,1);
$current_x+=30;
$pdf->SetXY($current_x, $current_y);  
$pdf->MultiCell(80,$cell_height,' ',0 ,1); 
$current_x+=80;                           
$pdf->SetXY($current_x, $current_y);      
$pdf->MultiCell($cell_width,$cell_height,'  ',0 ,1); 
$current_x+=$cell_width;                           
$pdf->SetXY($current_x, $current_y); 
$pdf->MultiCell($cell_width,$cell_height,'  ',0 ,1); 
$current_x+=$cell_width;                           
$pdf->SetXY($current_x, $current_y);
$pdf->MultiCell(30,$cell_height,'  ',0 ,1); 
$current_x+=30;                           
$pdf->SetXY($current_x, $current_y);
$pdf->MultiCell(30,$cell_height,'  ',0 ,1);
$current_x+=30;

////////////////////////////////////// SPACE /////////////////////////////////////////////////
$pdf->Ln();
$current_x=$start_x;                       //set x to start_x (beginning of line)
$current_y+=$cell_height;                  //increase y by cell_height to print on next line
$pdf->SetXY($current_x, $current_y);                 //increase y by cell_height to print on next line
////////////////////////////////////// SPACE ////////////////////////////////////////////////

$pdf->MultiCell(40,$cell_height,'Brush Cleaner',0 ,1); 
$current_x+=40;                           
$pdf->SetXY($current_x, $current_y);    
$pdf->MultiCell(45,$cell_height,'  ',0 ,1); 
$current_x+=45;                           
$pdf->SetXY($current_x, $current_y);    
$pdf->MultiCell(30,$cell_height,'  ',0 ,1);
$current_x+=30;
$pdf->SetXY($current_x, $current_y);  
$pdf->MultiCell(80,$cell_height,' ',0 ,1); 
$current_x+=80;                           
$pdf->SetXY($current_x, $current_y);      
$pdf->MultiCell($cell_width,$cell_height,'  ',0 ,1); 
$current_x+=$cell_width;                           
$pdf->SetXY($current_x, $current_y); 
$pdf->MultiCell($cell_width,$cell_height,'  ',0 ,1); 
$current_x+=$cell_width;                           
$pdf->SetXY($current_x, $current_y);
$pdf->MultiCell(30,$cell_height,'  ',0 ,1); 
$current_x+=30;                           
$pdf->SetXY($current_x, $current_y);
$pdf->MultiCell(30,$cell_height,'  ',0 ,1);
$current_x+=30;

$pdf->WriteHTML('<hr>');

////////////////////////////////////// SPACE /////////////////////////////////////////////////
$pdf->Ln();
$current_x=$start_x;                       //set x to start_x (beginning of line)
$current_y+=$cell_height;                  //increase y by cell_height to print on next line
$pdf->SetXY($current_x, $current_y);                 //increase y by cell_height to print on next line
////////////////////////////////////// SPACE ////////////////////////////////////////////////


$pdf->MultiCell($cell_width,$cell_height,'10/01/2019',0 ,1); 
$current_x+=$cell_width;                           
$pdf->SetXY($current_x, $current_y);               

$pdf->MultiCell(45,$cell_height,'Inventory Starting Value',0 ,1); 
$current_x+=45;                           
$pdf->SetXY($current_x, $current_y);               

$pdf->MultiCell(30,$cell_height,'START',0 ,1);
$current_x+=30;
$pdf->SetXY($current_x, $current_y);  

$pdf->MultiCell(80,$cell_height,'Brush Cleaner - Opening inventory and value',0 ,1); 
$current_x+=80;                           
$pdf->SetXY($current_x, $current_y);               

$pdf->MultiCell($cell_width,$cell_height,'1.00',0 ,1); 
$current_x+=$cell_width;                           
$pdf->SetXY($current_x, $current_y); 

$pdf->MultiCell($cell_width,$cell_height,'RATE',0 ,1); 
$current_x+=$cell_width;                           
$pdf->SetXY($current_x, $current_y);

$pdf->MultiCell(30,$cell_height,'0.00',0 ,1); 
$current_x+=30;                           
$pdf->SetXY($current_x, $current_y);

$pdf->MultiCell(30,$cell_height,'0.00',0 ,1);
$current_x+=30;



////////////////////////////////////// SPACE /////////////////////////////////////////////////
$pdf->Ln();
$current_x=$start_x;                       //set x to start_x (beginning of line)
$current_y+=$cell_height;                  //increase y by cell_height to print on next line
$pdf->SetXY($current_x, $current_y);                 //increase y by cell_height to print on next line
////////////////////////////////////// SPACE ////////////////////////////////////////////////


$pdf->MultiCell($cell_width,$cell_height,'Total for Brush Cleaner',0 ,1); 
$current_x+=$cell_width;                           
$pdf->SetXY($current_x, $current_y);               

$pdf->MultiCell(45,$cell_height,' ',0 ,1); 
$current_x+=45;                           
$pdf->SetXY($current_x, $current_y);               

$pdf->MultiCell(30,$cell_height,' ',0 ,1);
$current_x+=30;
$pdf->SetXY($current_x, $current_y);  

$pdf->MultiCell(80,$cell_height,' ',0 ,1); 
$current_x+=80;                           
$pdf->SetXY($current_x, $current_y);               

$pdf->MultiCell($cell_width,$cell_height,'1.00',0 ,1); 
$current_x+=$cell_width;                           
$pdf->SetXY($current_x, $current_y); 

$pdf->MultiCell($cell_width,$cell_height,' ',0 ,1); 
$current_x+=$cell_width;                           
$pdf->SetXY($current_x, $current_y);

$pdf->MultiCell(30,$cell_height,'PHP0.00',0 ,1); 
$current_x+=30;                           
$pdf->SetXY($current_x, $current_y);

$pdf->MultiCell(30,$cell_height,'0.00',0 ,1);
$current_x+=30;




$pdf->Output();

?>