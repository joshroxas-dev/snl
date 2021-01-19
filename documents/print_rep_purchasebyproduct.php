<?php
$document = [
    'module' => 'purchasebyproduct'
    //'id'     => $_GET['docid']
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
    table thead tr th{
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

    table.tbl tr td{
        border: 1px solid black;
    }

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
     <h2>Purchases by Product/Service Detail</h2>
     <p align='center'>January - December 2020</p><br>
</div>

<table width='100%' style='font-size: 7pt; border-collapse: collapse;'>
    <thead>
        <tr>
            <th>DATE</th>
            <th>TRANSACTION TYPE</th>
            <th>SUPPLIER</th>
            <th>REMARKS</th>
            <th>QTY</th>
            <th>RATE</th>
            <th>AMOUNT (₱)</th>
            <th>TOTAL</th>
        </tr>
    </thead>
    <tbody>
    ";
    if ($main_result->num_rows > 0) {
        while ($row = $main_result->fetch_assoc()) {
            
        $html .= "
        <tr>
            <td>".$row['purchasedate']."</td> 
            <td> CUSTOMER ORDER </td>
            <td>".$row['suppliername']."</td> 
            <td>".$row['remarks']."</td>
            <td>".$row['quantity']."</td> 
            <td>".$row['exchangerate']."</td>
            <td>".$row['totalamountpesos']."</td> 
            <td>".$row['ftotal']."</td>
        </tr>";
        }
    }else{
        $html .= "
        <tr>
            <td colspan='8' style='text-align: center;''>NO RECORDS!</td>
        </tr>";
    }
$html .= "
        <tr>
            <td colspan='7' style='text-align:left;'><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL</strong></td>
            <td>".$final['fftotal']."</td>
        </tr>
    </tbody>
</table>
<div align='center'>".$socialmedia."</div>
";

$html .= "
</body>
</html>
";


$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'orientation' => 'P',
    'format' => 'Legal'
]);

$mpdf->SetTitle('Customer Balance Summary Report');

$mpdf->SetHTMLHeaderByName('myHTMLHeader1');


$mpdf->WriteHTML($html);
$mpdf->Output();