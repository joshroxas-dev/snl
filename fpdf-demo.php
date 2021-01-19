<?php

require('assets/fpdf/writehtml.php');

$pdf=new PDF();
$pdf->AddPage("Landscape", "A4");
$pdf->SetFont('Arial','',9);

$logo = "assets/images/logo-black-icon.png";
$pdf->Cell(20, 4, "", 0, 1, 'C', $pdf->Image($logo,93,3,0,0));
$pdf->Ln(12);
$pdf->Cell(190, 5, 'Sneaks and Laces', 0, 1, 'C');
$pdf->Cell(190, 5, 'Room 302-303 Rudel Building V, Diego Silang Street', 0, 1, 'C');
$pdf->Cell(190, 5, 'Session Road, Baguio City 2600', 0, 10, 'C');
$pdf->Ln(5);



$html='
<table border="" width="100%">
    <tr>
        <td width="150" height="35"><b>Invoice Number</b></td>
        <td width="100" height="35">: 000001</td>
        <td width="150" height="35"><b>Invoice Date</b></td>
        <td width="100" height="35">: 12/14/2019 - 11:00 AM</td>
    </tr>
    <tr></tr>
    <tr>
        <td width="200" height="35"><b>Customer Information</b></td>
    </tr>
    <tr><hr></tr>
    <tr>
        <td width="160" height="35"><b>Customer Name</b></td>
        <td width="250" height="35">: Khenard Figuracion</td>
    </tr>
    <tr>
        <td width="160" height="35"><b>Classification</b></td>
        <td width="300" height="35">: Wholesale</td>
    </tr>
    <tr>
        <td width="160" height="35"><b>Billing Address</b></td>
        <td width="300" height="35">: #258 Maria Cristina Street, Poblacion Zone 2 Villasis, Pangasinan</td>
    </tr>
    <tr>
        <td width="160" height="35"><b>Shipping Address</b></td>
        <td width="300" height="35">: Urdaneta City, Pangasinan</td>
    </tr>
    <tr>
        <td width="160" height="35"><b>Mobile Number</b></td>
        <td width="250" height="35">: +639473877134</td>
    </tr>
    <tr>
        <td width="160" height="35"><b>E-mail Address</b></td>
        <td width="300" height="35">: khenard.figuracion@gmail.com</td>
    </tr>
    <tr><br></tr>
    <tr>
        <td width="160" height="35"><b>Order Number</b></td>
        <td width="250" height="35">: 000234</td>
        <td width="100" height="35"><b>Order Platform</b></td>
        <td width="300" height="35">: Lazada Shop</td>
    </tr>
    <tr>
        <td width="160" height="35"><b>Mode of Payment</b></td>
        <td width="250" height="35">: Cash on Delivery</td>
        <td width="100" height="35"><b>Courier</b></td>
        <td width="300" height="35">: LBC</td>
    </tr>
    <tr></tr>
    <tr>
        <td width="200" height="35"><b>Sales Details</b></td>
    </tr>
    <tr><hr></tr>
    <tr>
        <td width="25" height="35"><b>#</b></td>
        <td width="100" height="35"><b>Product Brand</b></td>
        <td width="50" height="35"><b>Size</b></td>
        <td width="50" height="35"><b>SRP</b></td>
        <td width="50" height="35"><b>Discount</b></td>
        <td width="100" height="35"><b>Shipping Fee</b></td>
       <td width="50" height="35"><b>Quantity</b></td>
        <td width="50" height="35"><b>Total Amount</b></td>
    </tr>
    <tr><hr></tr>
    <tr>
        <td width="25" height="35">01</td>
        <td width="100" height="35">Dildo</td>
        <td width="50" height="35">Large</td>
        <td width="50" height="35">125.50</td>
        <td width="50" height="35">0.50</td>
        <td width="100" height="35">1.50</td>
        <td width="50" height="35">12</td>
        <td width="50" height="35">1506</td>
    </tr>
    <tr>
        <td width="25" height="35">02</td>
        <td width="100" height="35">Sex Toy</td>
        <td width="50" height="35">Large</td>
        <td width="50" height="35">125.50</td>
        <td width="50" height="35">0.50</td>
        <td width="100" height="35">1.50</td>
        <td width="50" height="35">12</td>
        <td width="50" height="35">1506</td>
    </tr> 

</table>
';

$pdf->WriteHTML($html);
$pdf->Output();

?>