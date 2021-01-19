<?php

$document = [
    'module' => 'purchaseOrder',
    'id'     => $_GET['docid']
];

include '../app-controller/php-function/documents.php'; 

$html .= "
<html>
    <head>
    <style>
    @page {
        margin: 0.3in 0.3in 0.6in 0.3in;
    }
    body {font-family: sans-serif;
        font-size: 8pt !important;
    }
    td{
        padding: 0.5px 1.5px 0.5px 1.5px;
    }
    table thead tr td{
        font-weight: bold;
        border: 1px solid black;
        text-align: center;
    }
    table tbody tr td{
        border: 1px solid black;
        text-align: center;
    }
    p{
        margin: 0px;
    }
    h2{
        margin-bottom: 0px !important;
    }
    .border-b{
        border-bottom: 1px solid black;
    }

    /* table.tbl tr td{
        border: 1px solid black;
    } */

    </style>
    </head>
<body>
<!--mpdf
<htmlpagefooter name='myfooter'>
<div style='font-size: 9pt; text-align: right; padding-top: 3mm; '>
Page {PAGENO} of {nb}
</div>
</htmlpagefooter>
<sethtmlpageheader name='myheader' value='on' show-this-page='1' />
<sethtmlpagefooter name='myfooter' value='on' />
mpdf-->";

$html .= "
<div style='text-align: center;'>
    <img src='../assets/images/logo-black-icon.png'><br>
    <h3>Sneaks and Laces</h3>
     <p>Room 302-303 Rudel Building V, Diego Silang Street</p>
     <p>Session Road, Baguio City 2600</p>
     <h2>PURCHASE ORDER REPORT</h2>
    
</div><br>
<table width='50%'>
    <tr>
        <td width='18%'><strong>Purchased Date</strong></td>
        <td width='32%'><strong>: ".$main['pdate']."</strong></td>
        <td width='18%'><strong>Order Number</strong></td>
        <td width='32%'><strong>: ".$main['ordernumber']."</strong></td>
    </tr>
    <tr>
        <td><strong>Exchange Rate</strong></td>
        <td><strong>: ".$main['exchangerate']."</strong></td>
        <td><strong>Remarks</strong></td>
        <td rowspan='5' style='vertical-align: text-top;'><strong>: ".$main['remarks']."</strong></td>
    </tr>
    <!-- <tr>
        <td><strong>Freight-In (per unit)</strong></td>
        <td colspan='2'><strong>: ".$main['freightinperunit']."</strong></td>
    </tr> -->
    <tr>
        <td><strong>Credit Card</strong></td>
        <td colspan='2'><strong>: ".$main['creditcard']."</strong></td>
    </tr>
    <tr>
        <td><strong>Tracking # (AWB)</strong></td>
        <td colspan='2'><strong>: ".$main['trackingnumber']."</strong></td>
    </tr>
    <tr>
        <td><strong>Courier</strong></td>
        <td colspan='2'><strong>: ".$main['couriername']."</strong></td>
    </tr>
    
</table>
<table width='100%' style='font-size: 7pt; border-collapse: collapse;'>
    <thead>
        <tr>
            <td width='13.2%'>Product Purchased</td>
            <td width='7.6%'>Product Size</td>
            <td width='7.6%'>Quantity</td>
            <td width='7.6%'>Unit Price($)</td>
            <td width='7.6%'>Unit Price(PhP)</td>
            <td width='7.6%'>Total Price($)</td>
            <td width='7.6%'>Total Price(PhP)</td>
            <td width='6.2%'>F-in(U)</td>
            <td width='6.2%'>F-in(T)</td>
            <td width='6.2%'>Tax(U)</td>
            <td width='6.2%'>Tax(T)</td>
            <td width='7.6%'>Cost per Unit</td>
            <td width='7.6%'>Total Cost of Goods</td>
        </tr>
    </thead>
    <tbody>";
    if ($stocks_result->num_rows > 0) {
    while ($row = $stocks_result->fetch_assoc()) {
    $html .="
        <tr>
            <td>".$row['stockname']."</td>
            <td>".$row['stocksize']."</td>
            <td>".$row['quantity']."</td>
            <td>".$row['unitpricephp']."</td>
            <td>".$row['funitpricephp']."</td>
            <td>".$row['ftotalpricedollar']."</td>
            <td>".$row['ftotalpricephp']."</td>
            <td>".$main['freightinperunit']."</td>
            <td>".$row['ffreightintotal']."</td>
            <td>".$row['ftaxperunit']."</td>
            <td>".$row['ftaxtotalperproduct']."</td>
            <td>".$row['fcostperunit2']."</td>
            <td>".$row['ftotalcostofgoods']."</td>
        </tr>";
    }}else{
    $html .="
        <tr>
            <td colspan='14'>NO RECORDS FOUND!</td>
        </tr>";
    }
    $html .="
        <tr>
            <td><strong>TOTAL :</strong></td>
            <td></td>
            <td><strong>".$ftotal['totalquantity']."</strong></td>
            <td></td>
            <td></td>
            <td><strong>".$ftotal['ftotalpricedollarfinal']."</strong></td>
            <td><strong>".$ftotal['ftotalpricephpfinal']."</strong></td>
            <td></td>
            <td><strong>".$ftotal['ffreightintotalfinal']."</strong></td>
            <td></td>
            <td><strong>".$tftotal['tftaxtotalperproduct']."</strong></td>
            <td></td>
            <td><strong>".$tftotal['tftotalcostofgoods']."</strong></td>
        </tr>
    </tbody>
</table>

<table width='25%' style='margin-top:15px;'>
    <tr>
        <td>VAT on Importation</td>
        <td class='border-b' style='text-align: right;'><strong>".$main['fsys_vat']."</strong></td>
    </tr>
    <!-- <tr>
        <td width='50%'>Freight-in via DHL</td>
        <td width='50%' style='text-align: right;'></td>
    </tr>
    <tr>
        <td>Fuel Surcharge</td>
        <td class='border-b' style='text-align: right;'></td>
    </tr>
    <tr>
        <td>Total Freight-in</td>
        <td style='text-align: right;'></td>
    </tr>
    <tr>
        <td>Divide by: Quantity Purchased</td>
        <td class='border-b' style='text-align: right;'></td>
    </tr>
    <tr>
        <td><strong>Allocation Per Unit</strong></td>
        <td style='text-align: right;'></td>
    </tr>
    <tr>
        <td colspan='2'>&nbsp;</td>
    </tr>
    <tr>
        <td>Purchase Price in Peso</td>
        <td style='text-align: right;'></td>
    </tr>
    <tr>
        <td>Divide by: PP in USD</td>
        <td class='border-b' style='text-align: right;'></td>
    </tr>
    <tr>
        <td><strong>Exchange Rate</strong></td>
        <td style='text-align: right;'></td>
    </tr>
    <tr>
        <td colspan='2'>&nbsp;</td>
    </tr>
    <tr>
        <td>Purchase Price in Peso</td>
        <td style='text-align: right;'></td>
    </tr>
    <tr>
        <td>Multiply by: Exchange Rate</td>
        <td class='border-b' style='text-align: right;'></td>
    </tr>
    <tr>
        <td><strong>Total Purchase Price in Peso</strong></td>
        <td style='text-align: right;'></td>
    </tr> -->
</table>
<div align='center'>".$socialmedia."</div>
";

$html .= "
</body>
</html>
";


$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'orientation' => 'L',
    'format' => 'Legal'
]);

$mpdf->SetTitle('PURCHASE ORDER REPORT');

$mpdf->SetHTMLHeaderByName('myHTMLHeader1');


$mpdf->WriteHTML($html);
$mpdf->Output();