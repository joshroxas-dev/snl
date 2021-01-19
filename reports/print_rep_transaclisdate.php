<?php

require('fpdf/writehtml.php');
require('../config.php');

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_tablename); 

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$query = mysqli_query($conn,"SELECT 
		customerorder.purchasedate, 
		customerorder.customerorderid, 
		customerorder.productid, 
		customer.customerfirstname, 
		customer.customerlastname, 
		stocks.stockname, 
		suppliers.suppliername, 
		customerorder.remarks, 
		customerorder.quantity, 
		customerorder.exchangerate, 
		customerorder.totalamountpesos
		FROM customerorder
		LEFT JOIN stocks ON customerorder.productid = stocks.stocksid
		LEFT JOIN customer ON customerorder.customerid = customer.customerid
		LEFT JOIN suppliers ON stocks.supplierid = suppliers.supplierid
		ORDER BY customerorder.customerorderid
");


$pdf = new FPDF();
$pdf->AddPage("F", "A4");

$pdf->SetFont('Arial','',9);
//define standard font size
$fontSize=12;

$logo = "../assets/images/logo-black-icon.png";
$pdf->Cell(20, 4, "", 0, 1, 'C', $pdf->Image($logo,135,5,0,0));
$pdf->Ln(12);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(272, 10, 'Sneaks and Laces', 0, 1, 'C');
$pdf->SetFont('Arial','',9);
$pdf->Cell(272, 2, 'TRANSACTION LIST BY DATE', 0, 1, 'C');
$pdf->Cell(272, 6, '1-18 October, 2019', 0, 10, 'C');
$pdf->Ln(5);

$pdf->Cell(20,6,'DATE',0,0);
$pdf->Cell(40,6,'TRANSACTION TYPE',0,0);
$pdf->Cell(10,6,'NO.',0,0);
$pdf->Cell(20,6,'POSTING',0,0);
$pdf->Cell(30,6,'NAME',0,0);
$pdf->Cell(50,6,'MEMO/DESCRIPTION',0,0);
$pdf->Cell(40,6,'ACCOUNT',0,0);
$pdf->Cell(40,6,'SPLIT',0,0);
$pdf->Cell(30,6,'AMOUNT',0,0);

$pdf->Ln(10);

while($item = mysqli_fetch_array($query)){
    $orgDate = $item['purchasedate'];
    $newDate = date("F d, Y", strtotime($orgDate)); 
    $customername = $item['customerfirstname'] . " " . $item['customerlastname'];

//data which possibly contains long text

$data2 = (array) null;

$data2=array(
	array(
        "".$orgDate."",
        "INVOICE",
		"".$item['productid']."",
		"Yes",
        "".$customername."",
        "".$item['remarks']."",
        "Accounts Receivable (A/R)",
        "Sales of Product Income",
        "".$item['totalamountpesos'].""
	)
);



//multicell method
foreach($data2 as $item){
	$cellWidth=40;//wrapped cell width
	$cellHeight=5;//normal one-line cell height
	
	//check whether the text is overflowing
	if($pdf->GetStringWidth($item[5]) < $cellWidth){
		//if not, then do nothing
		$line=1;
	}else{
		//if it is, then calculate the height needed for wrapped cell
		//by splitting the text to fit the cell width
		//then count how many lines are needed for the text to fit the cell
		
		$textLength=strlen($item[5]);	//total text length
		$errMargin=10;		//cell width error margin, just in case
		$startChar=0;		//character start position for each line
		$maxChar=0;			//maximum character in a line, to be incremented later
		$textArray=array();	//to hold the strings for each line
		$tmpString="";		//to hold the string for a line (temporary)
		
		while($startChar < $textLength){ //loop until end of text
			//loop until maximum character reached
			while( 
			$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
			($startChar+$maxChar) < $textLength ) {
				$maxChar++;
				$tmpString=substr($item[5],$startChar,$maxChar);
			}
			//move startChar to next line
			$startChar=$startChar+$maxChar;
			//then add it into the array so we know how many line are needed
			array_push($textArray,$tmpString);
			//reset maxChar and tmpString
			$maxChar=0;
			$tmpString='';
			
		}
		//get number of line
		$line=count($textArray);
	}
	$pdf->Line(10,54,285,54);
	//write the cells
	$pdf->Cell(20,($line * $cellHeight),$item[0],0,0); //adapt height to number of lines
	$pdf->Cell(38,($line * $cellHeight),$item[1],0,0); //adapt height to number of lines
	$pdf->Cell(10,($line * $cellHeight),$item[2],0,0); //adapt height to number of lines
    $pdf->Cell(20,($line * $cellHeight),$item[3],0,0); //adapt height to number of lines
	$pdf->Cell(35,($line * $cellHeight),$item[4],0,0); //adapt height to number of lines
	//use MultiCell instead of Cell
	//but first, because MultiCell is always treated as line ending, we need to 
	//manually set the xy position for the next cell to be next to it.
	//remember the x and y position before writing the multicell
	$xPos=$pdf->GetX();
	$yPos=$pdf->GetY();
	$pdf->MultiCell($cellWidth,$cellHeight,$item[5],0);
	
	//return the position for next cell next to the multicell
	//and offset the x with multicell width
	$pdf->SetXY($xPos + $cellWidth , $yPos);
	
	$pdf->Cell(45,($line * $cellHeight),$item[6],0,0); //adapt height to number of lines
    $pdf->Cell(40,($line * $cellHeight),$item[7],0,0); //adapt height to number of lines
    $pdf->Cell(25,($line * $cellHeight),$item[8],0,1); //adapt height to number of lines
	
}

}




$pdf->Output();
?>
