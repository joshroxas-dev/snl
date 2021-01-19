<?php

require('assets/fpdf/writehtml.php');


include "config.php";
$conn = mysqli_connect($db_host, $db_username, $db_password, $db_tablename); 

$customerorderquery = mysqli_query($conn,"SELECT * FROM customerorder WHERE customerorderid = '".$_GET['coid']."'");
$coitem = mysqli_fetch_array($customerorderquery);

$customerquery = mysqli_query($conn,"SELECT * FROM customer WHERE customerid = '".$coitem['customerid']."'");
$citem = mysqli_fetch_array($customerquery);

$stocksquery = mysqli_query($conn,"SELECT * FROM stocks WHERE stocksid = '".$coitem['productid']."'");
$stockitem = mysqli_fetch_array($stocksquery);

$categoryquery = mysqli_query($conn,"SELECT * FROM category WHERE categoryid = '".$stockitem['categoryid']."'");
$categitem = mysqli_fetch_array($categoryquery);

$courierquery = mysqli_query($conn,"SELECT * FROM couriers WHERE courierid = '".$coitem['courierid']."'");
$courieritem = mysqli_fetch_array($courierquery);

$brandquery = mysqli_query($conn,"SELECT * FROM brands WHERE brandid = '".$stockitem['brandid']."'");
$branditem = mysqli_fetch_array($brandquery);

$pdf=new PDF();
$pdf->AddPage("F", "A4");
$pdf->SetFont('Arial','B',12);


$logo = "assets/images/logo-black-icon.png";
$pdf->Cell(20, 4, "", 0, 1, 'C', $pdf->Image($logo,135,5,0,0));
$pdf->Ln(12);
$pdf->Cell(272, 10, 'Sneaks and Laces', 0, 1, 'C');
$pdf->SetFont('Arial','',9);
$pdf->Cell(272, 2, 'Room 302-303 Rudel Building V, Diego Silang Street', 0, 1, 'C');
$pdf->Cell(272, 6, 'Session Road, Baguio City 2600', 0, 10, 'C');
$pdf->Ln(5);

$html='
<table border="" width="100%">
    <tr>
        <td width="100" height="35"><b>Order Number</b></td>
        <td width="200" height="35">:'.$coitem['ordernumber'].'</td>
        <td width="100" height="35"><b>Invoice Date</b></td>
        <td width="100" height="35">: '.$coitem['purchasedate'].'</td>
    </tr>
    <tr></tr>
    <tr>
        <td width="200" height="35"><b>Customer Information</b></td>
    </tr>
    </table>';


$html2='<table>
    <tr>
        <td width="160" height="35"><b>Customer Name</b></td>
        <td width="250" height="35">: '.$citem['customerfirstname'].' '.$citem['customerlastname'].'</td>
    </tr>
    <tr>
        <td width="160" height="35"><b>Classification</b></td>
        <td width="300" height="35">: '.$categitem['categorydesc'].'</td>
    </tr>
    <tr>
        <td width="160" height="35"><b>Billing Address</b></td>
        <td width="300" height="35">:'.$citem['cbillingaddress'].'</td>
    </tr>
    <tr>
        <td width="160" height="35"><b>Shipping Address</b></td>
        <td width="300" height="35">:'.$citem['cshippingaddress'].'</td>
    </tr>
    <tr>
        <td width="160" height="35"><b>Mobile Number</b></td>
        <td width="250" height="35">:'.$citem['cphonenumber'].'</td>
    </tr>
    <tr>
        <td width="160" height="35"><b>E-mail Address</b></td>
        <td width="300" height="35">: '.$citem['cemailaddress'].'</td>
    </tr>
    <tr><br></tr>
    <tr>
        <td width="160" height="35"><b>Order Number</b></td>
        <td width="250" height="35">: '.$coitem['ordernumber'].'</td>
        <td width="100" height="35"><b>Order Platform</b></td>
        <td width="300" height="35">: '.$coitem['orderplatform'].'</td>
    </tr>
    <tr>
        <td width="160" height="35"><b>Mode of Payment</b></td>
        <td width="250" height="35">: '.$coitem['modeofpayment'].'</td>
        <td width="100" height="35"><b>Courier</b></td>
        <td width="300" height="35">: '.$courieritem['couriername'].'</td>
    </tr>
    <tr></tr>
    <tr>
        <td width="200" height="35"><b>Sales Details</b></td>
    </tr>
    <tr><hr></tr>
    <tr>
        <td width="25" height="35"><b>#</b></td>
        <td width="280" height="35"><b>Product Brand</b></td>
        <td width="50" height="35"><b>Size</b></td>
        <td width="50" height="35"><b>SRP</b></td>
        <td width="100" height="35"><b>Shipping Fee</b></td>
       <td width="50" height="35"><b>Quantity</b></td>
        <td width="50" height="35"><b>Total Amount</b></td>
    </tr>
    <tr><hr></tr>
    <tr>
        <td width="25" height="35">'.$stockitem['stocksid'].'</td>
        <td width="280" height="35">'.$branditem['brandname'].'</td>
        <td width="50" height="35">'.$stockitem['stocksize'].'</td>
        <td width="50" height="35">'.$stockitem['unitprice'].'</td>
        <td width="100" height="35">'.$coitem['shippingfee'].'</td>
        <td width="50" height="35">'.$coitem['quantity'].'</td>
        <td width="50" height="35"><b>'.$coitem['totalamountpesos'].'</b></td>
    </tr>
</table>
';

$pdf->WriteHTML($html);
$pdf->WriteHTML('<hr>');
$pdf->WriteHTML($html2);
$pdf->Output();

?>