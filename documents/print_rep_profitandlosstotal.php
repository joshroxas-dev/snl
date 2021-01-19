<?php
$document = [
    'module' => 'printprofitlosstotal'
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
     <h2>Profit and Loss % of Total Income </h2>
    
</div><br>
<table width='100%' style='font-size: 7pt; border-collapse: collapse;'>
<thead>
   <th></th>
   <th>TOTAL</th>
</thead>
<thead>
    <th></th>
    <th>1 January - <?php echo date('F j, Y'); ?></th>
</thead>
    <tbody>";

        $html .= "  
        <tr>
        <td>INCOME</td>
        <td></td>
        </tr>
        <tr>
        <td>Sales of Customer Order</td>
        <td>".$totalCO."</td>
        </tr>
        <tr>
        <td>Sales of Purchase Order</td>
        <td>".$totalPO."</td>
        </tr>
        <tr>
        <td>Shipping Income</td>
        <td>".$shippingfeetotal."</td>
        </tr>
        <tr>
        <td>Total Income (PO and CO)</td>
        <td>".$$totalcostofgoods."</td>
        </tr>
        <tr>
        <td>GROSS PROFIT</td>
        <td>".$grossprofit."</td>
        </tr>";
        
    $html .= "
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

$mpdf->SetTitle('Profit and Loss % of Total Income ');

$mpdf->SetHTMLHeaderByName('myHTMLHeader1');


$mpdf->WriteHTML($html);
$mpdf->Output();