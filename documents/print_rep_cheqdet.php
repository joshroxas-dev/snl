<?php
$document = [
    'module' => 'printchequedetails',
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
     <h2>Cheque Details</h2>
    
</div><br>
<table width='100%' style='font-size: 7pt; border-collapse: collapse;'>
    <thead>
        <tr>
            <th>DATE</th>
            <th>TRANSACTION TYPE</th>
            <th>NO.</th>
            <th>NAME</th>
            <th>MEMO/DESCRIPTION</th>
            <th>CLR</th>
            <th>AMOUNT</th>
        </tr>
    </thead>
    <tbody>";
    $total = 0; 
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $querycus = "SELECT CONCAT(customerfirstname, ' ' ,customerlastname) as payeename FROM customer where customerguid = '".$row['payeeid']."'";
			$resultcus = $conn->query($querycus) or die($conn->error . __LINE__);
			if($resultcus->num_rows > 0){
				$rowcus = $resultcus->fetch_assoc();
				$payeename = $rowcus['payeename'];
			}else{
				$querysup = "SELECT suppliername as payeename FROM suppliers where supplierguid = '".$row['payeeid']."'";
				$resultsup = $conn->query($querysup) or die($conn->error . __LINE__);
				if($resultsup->num_rows > 0){
					$rowsup = $resultsup->fetch_assoc();
					$payeename = $rowsup['payeename'];
				}else{
					$payeename = '';
				}
			}
			$row['payeename'] = $payeename;
            $total = $total + $row['amount'];
        $html .= "  
        <tr>
            <td>".$row['paymentdate']."</td>
            <td>EXPENSES</td>
            <td>".$row['id']."</td>
            <td>".$row['payeename']."</td>
            <td>".$row['remarks']."</td>
            <td>C</td>
            <td>".($row['amount'] ? (number_format($row['amount'], 2)) : '0.00')."</td>
        </tr>";
        }
    }else{
        $html .= " 
        <tr>
            <td colspan='5'>NO RECORDS FOUND!</td>
        </tr>";
    }
    $html .= "
    <tr>
        <td colspan='6' style='text-align:left;'><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL</strong></td>
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

$mpdf->SetTitle('CHEQUE DETAILS');

$mpdf->SetHTMLHeaderByName('myHTMLHeader1');


$mpdf->WriteHTML($html);
$mpdf->Output();