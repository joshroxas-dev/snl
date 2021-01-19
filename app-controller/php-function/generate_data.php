<?php
include '../../config.php';
session_start();
//PDO CONN
$connect = new PDO("mysql:host=$db_host;dbname=$db_tablename", $db_username, $db_password);
//MYSQLI CONN
$conn  = new mysqli($db_host, $db_username, $db_password, $db_tablename);

if(isset($_GET['export'])) {
if($_GET['export'] == 'true'){

//customer order
if($_GET['page'] == 'customerorder.php'){
$query = "SELECT 
customerorder.customerorderid,
customer.customerbname,
customerorder.ordernumber,
platform.platform,
modeofpayment.modeofpayment,
couriers.couriername,
stocks.stockname,
suppliers.suppliername,
customerorder.quantity,
customerorder.shippingfee,
customerorder.shippingdate,
customerorder.purchasedate,
customerorder.totalamountdollar,
customerorder.totalamountpesos,
customerorder.exchangerate,
customerorder.remarks,
customerorder.filter,
customerorder.classification,
customerorder.datecreated,
customerorder.dateupdated
FROM (((((customerorder 
LEFT JOIN customer on customerorder.customerid = customer.customerid)
LEFT JOIN platform on customerorder.platformid = platform.platformid)
LEFT JOIN modeofpayment on customerorder.mopid = modeofpayment.mopid)
LEFT JOIN couriers on customerorder.courierid = couriers.courierid)
LEFT JOIN stocks on customerorder.productid = stocks.stocksid)
LEFT JOIN suppliers on customerorder.supplierid = suppliers.supplierid
";
$result = $conn->query($query) or die($conn->error . __LINE__);

$delimiter = ",";
$filename = "SNL-Customer-Order" . date("Ymd") . ".csv";
$f = fopen('php://memory', 'w');
$fields = array(
    "COID", 
    "Customer",
    "Order Number", 
    "Platform", 
    "Mode of Payment", 
    "Courier", 
    "Product",
    "Supplier",
    "Quantity",
    "Shipping Fee",
    "Shipping Date",
    "Purchase Date",
    "Total AMT Dollars",
    "Total AMT Pesos",
    "Exchange Rate",
    "Remarks",
    "Filter",
    "Classification",
    "Date Created",
    "Date Updated"
);
fputcsv($f, $fields, $delimiter);
$fetch_data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $lineData = array(
            $row['customerorderid'], 
            $row['customerbname'],
            $row['ordernumber'], 
            $row['platform'],
            $row['modeofpayment'], 
            $row['couriername'],
            $row['stockname'], 
            $row['suppliername'],
            $row['quantity'], 
            $row['shippingfee'],
            $row['shippingdate'], 
            $row['purchasedate'],
            $row['totalamountdollar'], 
            $row['totalamountpesos'],
            $row['exchangerate'], 
            $row['remarks'],
            $row['filter'],
            $row['classification'], 
            $row['datecreated'],
            $row['dateupdated']
        );
        fputcsv($f, $lineData, $delimiter);
    }
}
fseek($f, 0);
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="'.$filename.'"');
fpassthru($f);
}

//purchase order
if($_GET['page'] == 'purchase-order.php'){
    $total_query = "SELECT 
    FORMAT((SUM((po_stock.unitpricephp * po_stock.rate) * po_stock.quantity)), 2) as ftotalpricephpfinal,
    SUM(po_stock.quantity) as totalquantity,
    FORMAT(SUM(po_stock.unitpricephp * po_stock.quantity), 2) as ftotalpricedollarfinal,
    FORMAT(SUM(po_main.freightinperunit * po_stock.quantity), 2) as ffreightintotalfinal,
    SUM((po_stock.unitpricephp * po_stock.rate) * po_stock.quantity) as totalpricephpfinal
    FROM po_stock 
    LEFT JOIN stocks ON po_stock.stocksid = stocks.stocksid
    LEFT JOIN po_main ON po_stock.pom_id = po_main.pom_id";
    $total_result = $conn->query($total_query) or die($conn->error . __LINE__);
    $ftotal = $total_result->fetch_assoc();

    $main_query = "SELECT po_stock.*, stocks.stockname, stocks.stocksize, po_main.sys_vat, po_main.purchasedate, po_main.batchnumber, po_main.ordernumber, po_main.freightinperunit, po_main.exchangerate,
    FORMAT((po_stock.unitpricephp * po_stock.rate), 2) as funitpricephp, 
    FORMAT((po_stock.unitpricephp * po_stock.quantity), 2) as ftotalpricedollar, 
    FORMAT(((po_stock.unitpricephp * po_stock.rate) * po_stock.quantity), 2) as ftotalpricephp, 
    FORMAT((po_main.freightinperunit * po_stock.quantity), 2) as ffreightintotal,
    FORMAT((((po_stock.unitpricephp * po_stock.rate) / '".$ftotal['totalpricephpfinal']."') * po_main.sys_vat), 2) as ftaxperunit,
    FORMAT(((((po_stock.unitpricephp * po_stock.rate) / '".$ftotal['totalpricephpfinal']."') * po_main.sys_vat) * po_stock.quantity), 2) as ftaxtotalperproduct,
    FORMAT(((((po_stock.unitpricephp * po_stock.rate) / '".$ftotal['totalpricephpfinal']."') * po_main.sys_vat) + (po_stock.unitpricephp * po_stock.rate) + po_main.freightinperunit), 2) as fcostperunit,
    FORMAT(((((po_stock.unitpricephp * po_stock.rate) / '".$ftotal['totalpricephpfinal']."') * po_main.sys_vat) + po_main.freightinperunit), 2) as fcostperunit2,
    FORMAT((((((po_stock.unitpricephp * po_stock.rate) / '".$ftotal['totalpricephpfinal']."') * po_main.sys_vat) + po_main.freightinperunit) *  po_stock.quantity), 2) as ftotalcostofgoods
    FROM po_stock 
    LEFT JOIN stocks ON po_stock.stocksid = stocks.stocksid
    LEFT JOIN po_main ON po_stock.pom_id = po_main.pom_id
    where (((po_stock.pom_id is not NULL) and (po_stock.stocksid is not NULL)) AND po_main.status = 'placed')";
    $main_result = $conn->query($main_query) or die($conn->error . __LINE__);
    $main = $main_result->fetch_assoc();

    $delimiter = ",";
    $filename = "SNL-Purchase-Order" . date("Ymd") . ".csv";
    $f = fopen('php://memory', 'w');
    $fields = array(
        "Purchase ID", 
        "Batch Number", 
        "Order Number", 
        "POM ID", 
        "Product Purchased", 
        "Product Size",
        "Quantity", 
        "Unit Price($)", 
        "Exchange Rate", 
        "Unit Price(PhP)", 
        "Total Price($)", 
        "Total Price(PhP)",
        "F-in(U)",
        "F-in(T)",
        "Tax(U)",
        "Tax(T)",
        "Cost per Unit",
        "Total Cost of Goods", 
        "VAT on Importation",
        "Purchase Date"

    );
    fputcsv($f, $fields, $delimiter);
    $fetch_data = array();
    //if ($stocks_result->num_rows > 0) {
        while ($row = $main_result->fetch_assoc()) {
            $lineData = array(
                $row['id'], 
                $row['batchnumber'], 
                $row['ordernumber'], 
                $row['pom_id'], 
                $row['stockname'], 
                $row['stocksize'],
                $row['quantity'], 
                $row['unitpricephp'], 
                $row['exchangerate'],
                $row['funitpricephp'],
                $row['ftotalpricedollar'],
                $row['ftotalpricephp'], 
                $row['freightinperunit'],
                $row['ffreightintotal'], 
                $row['ftaxperunit'],
                $row['ftaxtotalperproduct'],
                $row['fcostperunit2'],
                $row['ftotalcostofgoods'],
                $row['sys_vat'],
                $row['purchasedate']
            );
            fputcsv($f, $lineData, $delimiter);
        }
    //}
    fseek($f, 0);
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="'.$filename.'"');
    fpassthru($f);
}



}
}

?>