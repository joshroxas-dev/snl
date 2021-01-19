<?php
$document = [
    'module' => 'printCustomerbalsummary'
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
     <h2>Customer Balance Summary</h2>
     <p align='center'>January - December 2020</p><br>
</div>

<table width='100%' style='font-size: 7pt; border-collapse: collapse;'>
    <thead>
        <tr>
            <td>Customer</td>
            <td>Total</td>
        </tr>
    </thead>
    <tbody>
    ";
    $total = 0;
    if ($main_result->num_rows > 0) {
        while ($row = $main_result->fetch_assoc()) {
            //$data = [];
            $query = "SELECT SUM(expense_item.amount) as totalamountexp
            FROM expense_item
            LEFT JOIN expense ON expense_item.expenseid = expense.expenseid
            WHERE expense.payeeid = '".$row['customerguid']."'";
            $result = $conn->query($query) or die($conn->error . __LINE__);  
            $exprow = $result->fetch_assoc();
            $total = $total + $exprow['totalamountexp'];
            // $row['totalamountexp'] = $exprow['totalamountexp'];    
            // $data[] = $exprow; 
    $html .= "
        <tr>
            <td>".$row['cfullname']."</td> 
            <td>".number_format($exprow['totalamountexp'], 2)."</td>
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
            <td style='text-align:left;'><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL</strong></td>
            <td>".number_format($total, 2)."</td>
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