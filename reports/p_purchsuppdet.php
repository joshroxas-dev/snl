<?php

require('fpdf/writehtml.php');
require('../config.php');

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_tablename); 

$query = mysqli_query($conn,"SELECT customerorder.purchasedate, customerorder.customerorderid, stocks.stockname, suppliers.suppliername, customerorder.remarks, customerorder.quantity, customerorder.exchangerate, customerorder.totalamountpesos
FROM customerorder
LEFT JOIN stocks ON customerorder.productid = stocks.stocksid
LEFT JOIN suppliers ON stocks.supplierid = suppliers.supplierid
ORDER BY customerorder.customerorderid
");


$pdf=new PDF();
$pdf->AddPage("F", "A4");
$pdf->SetFont('Arial','B',12);
$pdf->Cell(280, 5, 'Sneaks and Laces', 0, 1, 'C');
$pdf->SetFont('Arial','',9);
$pdf->Ln(3);
$pdf->Cell(280, 2, 'PURCHASES BY SUPPLIER DETAILS', 0, 1, 'C');
$pdf->SetFont('Arial','',8);
$pdf->Ln(3);
$pdf->Cell(280, 2, 'January - December 2020', 0, 1, 'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',8);

$html1 = '';
$html='<table>
    <tr><hr></tr>
    <tr>
    <td width="120" height="35"><b>DATE</b></td>
    <td width="120" height="35"><b>TRANS TYPE</b></td>
    <td width="70" height="35"><b>NO.</b></td>
    <td width="70" height="35"><b>PRODUCT</b></td>
    <td width="70" height="35"><b>SUPPLIER</b></td>
    <td width="250" height="35"><b>REMARKS</b></td>
   <td width="70" height="35"><b>QTY</b></td>
   <td width="100" height="35"><b>RATE</b></td>
   <td width="70" height="35"><b>AMT</b></td>
    </tr>
    <tr><hr></tr>';

    while($item = mysqli_fetch_array($query)){
        
        $orgDate = $item['purchasedate'];
        $newDate = date("F d, Y", strtotime($orgDate)); 

$html1 .= '
    <tr>
    <td width="120" height="35">'.$newDate.'</td>
    <td width="120" height="35">CUSTOMER ORDER</td>
    <td width="70" height="35">'.$item['customerorderid'].'</td>
    <td width="70" height="35">'.$item['stockname'].'</td>
    <td width="70" height="35">'.$item['suppliername'].'</td>
    <td width="250" height="35">'.$item['remarks'].'</td>
    <td width="70" height="35">'.$item['quantity'].'</td>
    <td width="100" height="35">'.$item['exchangerate'].'</td>
    <td width="70" height="35"><b>'.$item['totalamountpesos'].'</b></td>
    </tr>
    <tr></tr>';
}
$html2 = '</table>';

$pdf->WriteHTML($html);
$pdf->WriteHTML($html1);
$pdf->WriteHTML($html2);
$pdf->Output();

?>