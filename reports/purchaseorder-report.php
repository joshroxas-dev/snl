<?php

require('fpdf/writehtml.php');
require('../config.php');


$conn = mysqli_connect($db_host, $db_username, $db_password, $db_tablename); 

// $customerorderquery = mysqli_query($conn,"SELECT * FROM customerorder WHERE customerorderid = '".$_GET['coid']."'");
// $coitem = mysqli_fetch_array($customerorderquery);

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
$pdf->SetFont('Arial','B',12);
$pdf->Cell(272, 10, 'PURCHASE ORDER REPORT', 0, 1, 'C');

$html='
<table border="" width="100%">
    <tr>
        <td width="100" height="35"><b>Batch Number</b></td>
        <td width="200" height="35">: 0002343</td>
        <td width="100" height="35"><b>Purchase Date</b></td>
        <td width="200" height="35">: 01/15/2020</td>
        <td width="100" height="35"><b>Order Number</b></td>
        <td width="100" height="35">: 545234 </td>
    </tr>
    <tr>
    <td width="142" height="35"><b>Exchange Rate</b></td>
    <td width="250" height="35">: 43.10 </td>
</tr>
<tr>
    <td width="160" height="35"><b>Freight-in (per unit)</b></td>
    <td width="300" height="35">: 12.50 </td>
</tr>
<tr>
    <td width="160" height="35"><b>Credit Card</b></td>
    <td width="300" height="35">: BDO Banco De Oro</td>
</tr>
<tr>
    <td width="160" height="35"><b>Tracking # (AWB)</b></td>
    <td width="300" height="35">: 00239452</td>
</tr>
<tr>
    <td width="160" height="35"><b>Courier</b></td>
    <td width="250" height="35">: LBC</td>
</tr>
    </table>';


$html2='<table>
    <tr>
        <td width="200" height="35"><b>Products Purchased</b></td>
    </tr>
    <tr><hr></tr> 
    <tr>
        <td width="5" height="35"><b>#</b></td>
        <td width="50" height="35"><b>Product</b></td>
        <td width="50" height="35"><b>Brand</b></td>
        <td width="25" height="35"><b>Size</b></td>
        <td width="25" height="35"><b>QTY</b></td>
        <td width="25" height="35"><b>Unit($)</b></td>
        <td width="50" height="35"><b>Unit (P)</b></td>
       <td width="50" height="35"><b>Total ($)</b></td>
       <td width="50" height="35"><b>Total (P)</b></td>
       <td width="25" height="35"><b>F-IN (T)</b></td>
        <td width="50" height="35"><b>TAXT/Product</b></td>
        <td width="50" height="35"><b>TAXT/Unit</b></td>
        <td width="50" height="35"><b>Cost/unit</b></td>
        <td width="50" height="35"><b>Total COG</b></td>
    </tr>
    <tr><hr></tr>
    <tr>
    <td width="25" height="35">01</td>
    <td width="100" height="35">Product 1</td>
    <td width="70" height="35">Rit Dye</td>
    <td width="25" height="35">XS</td>
    <td width="60" height="35">23</td>
    <td width="50" height="35">32.00</td>
    <td width="50" height="35">50.00</td>
   <td width="50" height="35">12.50</td>
   <td width="50" height="35">150.30</td>
   <td width="50" height="35">90.50</td>
    <td width="50" height="35">12</td>
    <td width="50" height="35">12</td>
    <td width="50" height="35">12</td>
    <td width="50" height="35">220.30</td>
    </tr>
    <tr>
    <td width="25" height="35">01</td>
    <td width="100" height="35">Product 1</td>
    <td width="70" height="35">Rit Dye</td>
    <td width="25" height="35">XS</td>
    <td width="60" height="35">23</td>
    <td width="50" height="35">32.00</td>
    <td width="50" height="35">50.00</td>
   <td width="50" height="35">12.50</td>
   <td width="50" height="35">150.30</td>
   <td width="50" height="35">90.50</td>
    <td width="50" height="35">12</td>
    <td width="50" height="35">12</td>
    <td width="50" height="35">12</td>
    <td width="50" height="35">220.30</td>
    </tr>
</table>
';
$pdf->Ln(5);
$pdf->WriteHTML($html);
$pdf->Ln(5);
$pdf->WriteHTML($html2);
$pdf->Output();

?>