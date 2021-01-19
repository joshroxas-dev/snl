<?php
$document = [
    'module' => 'customerOrder',
    'id'     => $_GET['coid']
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
     <h2>CUSTOMER ORDER REPORT</h2>
    
</div><br>
<table width='100%'>
    <tr>
        <td width='18%'><strong>Order Number</strong></td>
        <td width='32%'><strong>: ".$coitem['ordernumber']."</strong></td>
        <td width='18%'><strong>Invoice Date</strong></td>
        <td width='32%'><strong>: ".$coitem['purchasedate']."</strong></td>
    </tr>
    <tr>
        <td width='18%'><strong>Order Platform</strong></td>
        <td width='32%'><strong>: ".$platformitem['platform']."</strong></td>
        <td width='18%'><strong>Mode of Payment</strong></td>
        <td width='32%'><strong>: ".$modeofpaymentitem['modeofpayment']."</strong></td>
    </tr>  
    <tr>
        <td width='18%'><strong>Courier</strong></td>
        <td width='32%'><strong>: ".$courieritem['couriername']."</strong></td>
        <td width='18%'><strong>Classification</strong></td>
        <td width='32%'><strong>: ".$coitem['classification']."</strong></td>
    </tr>
    <tr>
        <td width='18%'><strong>Shipping Fee</strong></td>
        <td width='32%'><strong>: ".$coitem['shippingfee']."</strong></td>
    </tr>
</table>
<table width='50%'>
    <tr>
        <td><br></td>
    </tr>
    <tr>
        <td><h3><strong>Customer Information</strong></h3></td>
    </tr>
    <tr>
        <td width='15%'><strong>Customer Name</strong></td>
        <td width='35%'><strong>: ".$citem['customerfirstname']." ".$citem['customerlastname']."</strong></td>
    </tr>
    <tr>
        <td width='15%'><strong>Busness Name</strong></td>
        <td width='35%'><strong>: ".$citem['customerbname']."</strong></td>
    </tr>
    <tr>
        <td width='15%'><strong>Billing Address</strong></td>
        <td width='35%'><strong>: ".$citem['cbillingaddress']."</strong></td>
    </tr>
    <tr>
        <td width='15%'><strong>Shipping Address</strong></td>
        <td width='35%'><strong>: ".$citem['cshippingaddress']."</strong></td>
    </tr>
    <tr>
        <td width='15%'><strong>Mobile Number</strong></td>
        <td width='35%'><strong>: ".$citem['cphonenumber']."</strong></td>
    </tr>
    <tr>
        <td width='15%'><strong>E-mail Address</strong></td>
        <td width='35%'><strong>: ".$citem['cemailaddress']."</strong></td>
    </tr>
    <tr>
        <td><br></td>
    </tr>
    <tr>
        <td><h3><strong>Sales Information</strong></h3></td>
    </tr>
</table>
<table width='100%' style='font-size: 7pt; border-collapse: collapse;'>
    <thead>
        <tr>
            <td>#</td> 
            <td colspan='2'>Product Name</td>
            <td>Brand</td>
            <td>Size</td>
            <td>Cost of Goods</td>
            <td>Quantity</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>".$stockitem['stocksid']."</td> 
            <td colspan='2'>".$stockitem['stockname']."</td>
            <td>".$branditem['brandname']."</td>
            <td>".$stockitem['stocksize']."</td>
            <td>".$stockitem['unitprice']."</td>
            <td>".$coitem['quantity']."</td>
        </tr>
        <tr>
            <td><strong>TOTAL :</strong></td>
            <td colspan='6' align='left'>".$coitem['totalamountpesos']."</td>
        </tr>
    </tbody>
</table>

<div align='center'>".$socialmedia."</div>";

$html .= "
</body>
</html>
";


$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'orientation' => 'P',
    'format' => 'Legal'
]);

$mpdf->SetTitle('CUSTOMER ORDER REPORT');

$mpdf->SetHTMLHeaderByName('myHTMLHeader1');


$mpdf->WriteHTML($html);
$mpdf->Output();