<?php
$document = [
    'module' => 'expense',
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
     <h2>EXPENSE VOUCHER</h2>
</div><br>
<table width='100%'>
    <tr>
        <td width='18%'><strong>Expense ID</strong></td>
        <td width='32%'><strong>: ".$main['expenseid']."<strong></td>
    </tr>
    <tr>
        <td width='18%'><strong>Reference Number</strong></td>
        <td width='32%'><strong>: ".$main['referenceno']."<strong></td>
    </tr>
    <tr>
        <td width='18%'><strong>Payment To</strong></td>
        <td width='32%'><strong>: ".$payeename."<strong></td>
        <td width='18%'><strong>Date</strong></td>
        <td width='32%'><strong>: ".$main['paymentdate']."<strong></td>
    </tr>
    <tr>
    <td width='18%'><strong>Account: </strong></td>
    <td width='32%'><strong>: ".$main['accountname']."<strong></td>
</tr>
</table>
<table width='100%' style='margin-top:10px;font-size: 9pt; border-collapse: collapse;'>
    <thead>
        <tr>
            <td colspan='2'>Account/Item</td>
            <td>Description</td>
            <td>Amount</td>
        </tr>
    </thead>
    <tbody>";
    if ($queryresult->num_rows > 0) {
        while ($row = $queryresult->fetch_assoc()) {
    $html .="
        <tr>
            <td colspan='2'>".$row['stockname']." </td>
            <td>".$row['description']."</td>
            <td>".$row['amount']."</td>
        </tr>";
        }
    }
        $html .= "<tr><td colspan='4'><br></td></tr>
        <tr>
            <td align='right' colspan='3'><b>TOTAL:</b></td>
            <td>PHP ".$main['totalamount']."</td>
        </tr>
    </tbody>
</table>
<div width='40%' style='margin-top: 10px;'>
    <span>
        <p><b>Memo:</b>".$main['remarks']."</p>
    </span>
</div>  
<span align='right'><br>
    <p><b>SIGNATURE:</b></p>
</span>

<div align='left' style='position: absolute; bottom: 60px;'>
<img src='../assets/images/fb.png' width='15px' height='15px'>&nbsp;".$slfb." &nbsp;
<img src='../assets/images/ig.png' width='15px' height='15px'>&nbsp;".$slig." &nbsp;
<img src='../assets/images/web.jpeg' width='15px' height='15px'>&nbsp;".$slemail." &nbsp;
</div>";

$html .= "
</body>
</html>
";


$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'orientation' => 'P',
    'format' => 'Legal'
]);

$mpdf->SetTitle('EXPENSES VOUCHER');

$mpdf->SetHTMLHeaderByName('myHTMLHeader1');


$mpdf->WriteHTML($html);
$mpdf->Output();