<?php
include 'session.php'; 
require_once __DIR__ . '/vendor/autoload.php';
if(!loggedIn()){
    header("Location: login.php");
}
$html .= "
<html>
    <head>
    <style>
    @page {
        margin: 0.3in 2in 0.6in 2in;
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
    <img src='assets/images/logo-black-icon.png'><br>
    <h3>Sneaks and Laces</h3>
     <p>Room 302-303 Rudel Building V, Diego Silang Street</p>
     <p>Session Road, Baguio City 2600</p>
     <h2>STATEMENT OF CASH FLOWS</h2>
     <p>1 January - 18 Febuary, 2020</p>
    
</div><br>
<table width='100%' style='font-size: 7pt; border-collapse: collapse;'>
    <thead>
        <tr>
            <td></td>
            <td>TOTAL</td>
        </tr>
    </thead>
    <tbody>
        <!-- <tr>
            <td></td>
            <td></td>
        </tr> -->
        <tr>
            <td colspan='2'>NO RECORDS FOUND!</td>
        </tr>
        <tr>
            <td><strong>TOTAL EQUITY </strong></td>
            <td>123123</td>
            
        </tr>
    </tbody>
</table>

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