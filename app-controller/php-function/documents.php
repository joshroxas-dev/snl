<?php 
$req = include '../config.php';
// $req = include '../session.php'; 
if(!$req){
    header("Location: ../../index.php");
}
// // require_once __DIR__ . '../vendor/autoload.php';
require_once '../vendor/autoload.php';
// if(!loggedIn()){
//     header("Location: ../login.php");
// }

$conn  = new mysqli($db_host, $db_username, $db_password, $db_tablename);


if($document['module'] == 'purchaseOrder'){
    $id = $document['id'];

    $main_query = "SELECT couriers.couriername, DATE_FORMAT(po_main.purchasedate, '%m/%d/%Y') as pdate, po_main.ordernumber, po_main.exchangerate, po_main.remarks, po_main.freightinperunit, po_main.creditcard, po_main.trackingnumber, po_main.sys_vat, FORMAT(po_main.sys_vat, 2) as fsys_vat FROM po_main 
    LEFT JOIN couriers ON po_main.courierid = couriers.courierid
    where pom_id = '".$id."'";
    $main_result = $conn->query($main_query) or die($conn->error . __LINE__);
    $main = $main_result->fetch_assoc();

    $total_query = "SELECT 
    FORMAT((SUM((po_stock.unitpricephp * po_stock.rate) * po_stock.quantity)), 2) as ftotalpricephpfinal,
    SUM(po_stock.quantity) as totalquantity,
    FORMAT(SUM(po_stock.unitpricephp * po_stock.quantity), 2) as ftotalpricedollarfinal,
    FORMAT(SUM(po_main.freightinperunit * po_stock.quantity), 2) as ffreightintotalfinal,
    SUM((po_stock.unitpricephp * po_stock.rate) * po_stock.quantity) as totalpricephpfinal
    FROM po_stock 
    LEFT JOIN stocks ON po_stock.stocksid = stocks.stocksid
    LEFT JOIN po_main ON po_stock.pom_id = po_main.pom_id
    where po_stock.pom_id = '".$id."'";
    $total_result = $conn->query($total_query) or die($conn->error . __LINE__);
    $ftotal = $total_result->fetch_assoc();

    $total2_query = "SELECT 
    FORMAT(SUM((((po_stock.unitpricephp * po_stock.rate) / '".$ftotal['totalpricephpfinal']."') * po_main.sys_vat) * po_stock.quantity), 2) as tftaxtotalperproduct,
    FORMAT(SUM(((((po_stock.unitpricephp * po_stock.rate) / '".$ftotal['totalpricephpfinal']."') * po_main.sys_vat) + po_main.freightinperunit) *  po_stock.quantity), 2) as tftotalcostofgoods
    FROM po_stock 
    LEFT JOIN stocks ON po_stock.stocksid = stocks.stocksid
    LEFT JOIN po_main ON po_stock.pom_id = po_main.pom_id
    where po_stock.pom_id = '".$id."'";
    $total2_result = $conn->query($total2_query) or die($conn->error . __LINE__);
    $tftotal = $total2_result->fetch_assoc();

    $stocks_query = "SELECT po_stock.*, stocks.stockname, stocks.stocksize, po_main.sys_vat, po_main.freightinperunit,
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
    where po_stock.pom_id = '".$id."'  and po_stock.stocksid is not NULL";
    $stocks_result = $conn->query($stocks_query) or die($conn->error . __LINE__);
}

//customer order
if($document['module'] == 'customerOrder'){
    $id = $document['id'];
  
    $customerorderquery = mysqli_query($conn,"SELECT * FROM customerorder WHERE customerorderid = '".$id."'");
    $coitem = mysqli_fetch_array($customerorderquery);

    $customerquery = mysqli_query($conn,"SELECT * FROM customer WHERE customerid = '".$coitem['customerid']."'");
    $citem = mysqli_fetch_array($customerquery);

    $stocksquery = mysqli_query($conn,"SELECT * FROM stocks WHERE stocksid = '".$coitem['productid']."'");
    $stockitem = mysqli_fetch_array($stocksquery);

    $platformquery = mysqli_query($conn,"SELECT * FROM platform WHERE platformid = '".$coitem['platformid']."'");
    $platformitem = mysqli_fetch_array($platformquery);

    $modeofpaymentquery = mysqli_query($conn,"SELECT * FROM modeofpayment WHERE mopid = '".$coitem['mopid']."'");
    $modeofpaymentitem = mysqli_fetch_array($modeofpaymentquery);

    $categoryquery = mysqli_query($conn,"SELECT * FROM category WHERE categoryid = '".$stockitem['categoryid']."'");
    $categitem = mysqli_fetch_array($categoryquery);

    $courierquery = mysqli_query($conn,"SELECT * FROM couriers WHERE courierid = '".$coitem['courierid']."'");
    $courieritem = mysqli_fetch_array($courierquery);

    $brandquery = mysqli_query($conn,"SELECT * FROM brands WHERE brandid = '".$stockitem['brandid']."'");
    $branditem = mysqli_fetch_array($brandquery);

}

//expenses 
if($document['module'] == 'expense'){
    $id = $document['id'];

    $main_query = "SELECT expense.*, expense_item.*, stocks.*, suppliers.*, customer.*, accounts.*, 
    FORMAT(SUM(expense_item.amount), 2) as totalamount
    FROM expense 
    LEFT JOIN expense_item ON expense.expenseid = expense_item.expenseid
    LEFT JOIN stocks ON expense_item.stocksid = stocks.stocksid
    LEFT JOIN customer ON expense.payeeid = customer.customerguid
    LEFT JOIN suppliers ON expense.payeeid = suppliers.supplierguid
    LEFT JOIN accounts ON expense.paymentaccount = accounts.accountid
    where expense_item.expenseid = '".$id."'";
    $main_result = $conn->query($main_query) or die($conn->error . __LINE__);
    $main = $main_result->fetch_assoc();

    $query = "SELECT expense.*, expense_item.*, FORMAT(expense_item.amount, 2) as amount, stocks.*, suppliers.*, customer.*
    FROM expense 
    LEFT JOIN expense_item ON expense.expenseid = expense_item.expenseid
    LEFT JOIN stocks ON expense_item.stocksid = stocks.stocksid
    LEFT JOIN customer ON expense.payeeid = customer.customerguid
    LEFT JOIN suppliers ON expense.payeeid = suppliers.supplierguid
    where expense_item.expenseid = '".$id."'";
    $queryresult = $conn->query($query) or die($conn->error . __LINE__);
    
    $querycus = "SELECT CONCAT(customerfirstname, ' ' ,customerlastname) as payeename FROM customer where customerguid = '".$main['payeeid']."'";
    $resultcus = $conn->query($querycus) or die($conn->error . __LINE__);
    if($resultcus->num_rows > 0){
        $rowcus = $resultcus->fetch_assoc();
        $payeename = $rowcus['payeename'];
    }else{
        $querysup = "SELECT suppliername as payeename FROM suppliers where supplierguid = '".$main['payeeid']."'";
        $resultsup = $conn->query($querysup) or die($conn->error . __LINE__);
        if($resultsup->num_rows > 0){
            $rowsup = $resultsup->fetch_assoc();
            $payeename = $rowsup['payeename'];
        }else{
            $payeename = '';
        }
    }


}




/*  ---------------------------------- REPORTS  ---------------------------------- */ 

if($document['module'] == 'printPurchaseSupplierDetail'){

    $main_query = "SELECT customerorder.purchasedate, customerorder.customerorderid, stocks.stockname, suppliers.suppliername, customerorder.remarks, customerorder.quantity, customerorder.exchangerate, customerorder.totalamountpesos,
    (customerorder.totalamountpesos * customerorder.quantity) as famountpesos
    FROM customerorder
    LEFT JOIN stocks ON customerorder.productid = stocks.stocksid
    LEFT JOIN suppliers ON stocks.supplierid = suppliers.supplierid
    ORDER BY customerorder.customerorderid";
    $main_result = $conn->query($main_query) or die($conn->error . __LINE__);  

}


if($document['module'] == 'printJournal'){

    $main_query = "SELECT expense.*, category_exp.categexptype, expense_category.amount, expense_item.amount
    FROM expense 
    LEFT JOIN expense_item ON expense.expenseid = expense_item.expenseid
    LEFT JOIN expense_category ON expense.expenseid = expense_category.expenseid
    LEFT JOIN category_exp ON expense_category.categoryid = category_exp.categexpid
    where expense.status = '1' AND dlt = '0'
    ORDER BY expense.datecreated ASC";
    $main_result = $conn->query($main_query) or die($conn->error . __LINE__);  

}



if($document['module'] == 'printCustomerbalsummary'){

    $main_query = "SELECT CONCAT(customer.customerfirstname,' ', customer.customerlastname) as cfullname, customer.customerguid
    FROM customer
    LEFT JOIN expense ON customer.customerguid = expense.payeeid
    WHERE expense.status = '1'";
    $main_result = $conn->query($main_query) or die($conn->error . __LINE__);  
   // $data = [];
    // while ($row = $main_result->fetch_assoc()) {
    //     // $query = "SELECT SUM(expense_item.amount) as totalamountexp
	// 	// FROM expense_item
    //     // LEFT JOIN expense ON expense_item.expenseid = expense.expenseid
    //     // WHERE expense.payeeid = '".$row['customerguid']."'";
    //     //  $result = $conn->query($query) or die($conn->error . __LINE__);  
         
    //     //  $exprow = $result->fetch_assoc();
    //     //  $row['totalamountexp'] = $exprow['totalamountexp'];    
    //     //  $data[] = $exprow; 
    // }

    // $query = "SELECT CONCAT(customer.customerfirstname,' ', customer.customerlastname) as cfullname
    // FROM customer
    // LEFT JOIN expense ON customer.customerguid = expense.payeeid	
    // LEFT JOIN expense_item ON expense.expenseid = expense_item.expenseid";
    // $result = $conn->query($query) or die($conn->error . __LINE__);  

}


if($document['module'] == 'printProfitandlossamount'){

    $main_query = "SELECT FORMAT(SUM(po_stock.totalpricephp), 2) as totalamountpo, po_main.purchasedate
    FROM po_stock
    LEFT JOIN po_main ON po_stock.pom_id = po_main.pom_id
    WHERE po_main.status = 'placed'";
    $main_result = $conn->query($main_query) or die($conn->error . __LINE__);  
    //$main = $main_result->fetch_assoc();

    $query = "SELECT FORMAT(SUM(totalamountpesos), 2) as totalamountco
    FROM customerorder";
    $result = $conn->query($query) or die($conn->error . __LINE__);  
    //$co = $result->fetch_assoc();

    $expquery = "SELECT FORMAT(SUM(amount), 2) as totalamountexp
    FROM expense_item
    WHERE status = '1'";
    $exresult = $conn->query($expquery) or die($conn->error . __LINE__);  
    //$exp = $exresult->fetch_assoc();


}

if($document['module'] == 'purchasebyproduct'){
    $query = "SELECT 
    customerorder.purchasedate, 
    customerorder.customerorderid, 
    customerorder.productid, 
    customer.customerfirstname, 
    customer.customerlastname, 
    stocks.stockname, 
    stocks.unitprice,
    suppliers.suppliername, 
    customerorder.remarks, 
    customerorder.quantity, 
    customerorder.exchangerate, 
    FORMAT(customerorder.totalamountpesos, 2) as totalamountpesos,
    FORMAT(customerorder.totalamountpesos * customerorder.quantity, 2) as ftotal
    FROM customerorder
    LEFT JOIN stocks ON customerorder.productid = stocks.stocksid
    LEFT JOIN customer ON customerorder.customerid = customer.customerid
    LEFT JOIN suppliers ON stocks.supplierid = suppliers.supplierid
    ORDER BY customerorder.customerorderid";
    $main_result = $conn->query($query) or die($conn->error . __LINE__);  

    $query2 = "SELECT 
    FORMAT(SUM(customerorder.totalamountpesos * customerorder.quantity), 2) as fftotal
    FROM customerorder";
    $result = $conn->query($query2) or die($conn->error . __LINE__);
    $final = $result->fetch_assoc();
}

if($document['module'] == 'transaccount'){
    $query = "SELECT expense_category.*, category_exp.categexpname, expense.paymentdate
    FROM expense_category
    LEFT JOIN category_exp ON expense_category.categoryid = category_exp.categexpid
    LEFT JOIN expense ON expense_category.expenseid = expense.expenseid
    WHERE expense_category.categoryid = '".$document['id']."'";
    $result = $conn->query($query) or die($conn->error . __LINE__);
}

if($document['module'] == 'printbillpaymentlist'){
    $query = "SELECT expense_category.*, category_exp.*, expense.paymentdate, expense.payeeid
    FROM expense_category
    LEFT JOIN category_exp ON expense_category.categoryid = category_exp.categexpid
    LEFT JOIN expense ON expense_category.expenseid = expense.expenseid
    WHERE expense.paymentmethod = '".$document['id']."'";
    $result = $conn->query($query) or die($conn->error . __LINE__);
}

if($document['module'] == 'printopeninvoice'){
    $query = "SELECT expense.*, category_exp.categexptype, expense_category.amount,  expense_category.id, expense_item.amount, expense.payeeid
    FROM expense 
    LEFT JOIN expense_item ON expense.expenseid = expense_item.expenseid
    LEFT JOIN expense_category ON expense.expenseid = expense_category.expenseid
    LEFT JOIN category_exp ON expense_category.categoryid = category_exp.categexpid
    where expense.status = '1' AND dlt = '0'
    ORDER BY expense.datecreated ASC";
    $result = $conn->query($query) or die($conn->error . __LINE__);
}


if($document['module'] == 'printchequedetails'){
    $query = "SELECT expense_category.*, category_exp.*, expense.paymentdate, expense.payeeid, expense.remarks
    FROM expense_category
    LEFT JOIN category_exp ON expense_category.categoryid = category_exp.categexpid
    LEFT JOIN expense ON expense_category.expenseid = expense.expenseid
    WHERE expense.paymentaccount = '".$document['id']."'";
    $result = $conn->query($query) or die($conn->error . __LINE__);
}

if($document['module'] == 'profitandlossbymonth'){
    $aveSql ="SELECT * FROM stocks";
    $aveSql_result = $conn->query($aveSql) or die($conn->error . __LINE__);  

    $totalunitprice = 0;
    while($row = $aveSql_result->fetch_assoc()){
        $totalunitprice = $totalunitprice + $row['unitprice'];
    }

    $average = ($totalunitprice / $aveSql_result->num_rows);
    
    $month = ['01','02','03','04','05','06','07','08','09','10','11','12'];

    $dataPO = [];
    $dataCO = [];
    $totalPOCO = [];
    $revenue = [];
    $totalCOG = [];
    $dataExp = [];
    $totalExp = 0;
    foreach ($month as $key => $value){
        $main_query = "SELECT SUM(po_stock.totalpricephp) as totalamountpo, SUM(po_stock.quantity) as totalquantitypo, po_main.purchasedate
        FROM po_stock
        LEFT JOIN po_main ON po_stock.pom_id = po_main.pom_id
        WHERE MONTH(po_main.purchasedate) = '".$value."' AND YEAR(po_main.purchasedate) = '".$document['year']."' AND po_main.status = 'placed'";
        $po_result = $conn->query($main_query) or die($conn->error . __LINE__);  
        $po = $po_result->fetch_assoc();
            
        $query = "SELECT SUM(totalamountpesos) as totalamountco, SUM(quantity) as totalquantityco
        FROM customerorder WHERE MONTH(purchasedate) = '".$value."' AND YEAR(purchasedate) = '".$document['year']."'";
        $result = $conn->query($query) or die($conn->error . __LINE__);  
        $co = $result->fetch_assoc();

        $query1 = "SELECT SUM(expense_category.amount) as totalexpense
        FROM expense_category
        LEFT JOIN expense ON expense_category.expenseid = expense.expenseid
        WHERE expense.status = '1' AND MONTH(expense.paymentdate) = '".$value."' AND YEAR(expense.paymentdate) = '".$document['year']."'";
        $result3 = $conn->query($query1) or die($conn->error . __LINE__);
        $row2 = $result3->fetch_assoc();
        
        $dataExp[] = intval($row2['totalexpense'] ? $row2['totalexpense'] : '0.00');

        $dataPO[] = intval($po['totalamountpo'] ? $po['totalamountpo'] : '0.00');
        $dataCO[] = intval($co['totalamountco'] ? $co['totalamountco'] : '0.00');

        $totalPOCO1 = intval($co['totalamountco'] ? $co['totalamountco'] : '0.00') + intval($po['totalamountpo'] ? $po['totalamountpo'] : '0.00');
        $totalPOCO[] = $totalPOCO1;
        $revenue1 = ((intval($co['totalquantityco'] ? $co['totalquantityco'] : '0') + intval($po['totalquantitypo'] ? $po['totalquantitypo'] : '0')) * $average);
        $revenue[] = $revenue1;

        $totalCOG[] = $totalPOCO1 - $revenue1;

        $totalExp = $totalExp + intval($row2['totalexpense'] ? $row2['totalexpense'] : '0.00');
    }
}

if($document['module'] == 'printprofitlosstotal'){
    $query = "SELECT SUM(totalamountpesos) as customerordertotal FROM customerorder";
    $result = $conn->query($query) or die($conn->error . __LINE__);
    $row = $result->fetch_assoc();
    $totalCO = $row['customerordertotal'];

    $query1 = "SELECT SUM(totalpricephp) as purchaseordertotal FROM po_stock";
    $result1 = $conn->query($query1) or die($conn->error . __LINE__);
    $row1 = $result1->fetch_assoc();
    $totalPO = $row1['purchaseordertotal'];

    $query2 = "SELECT SUM(shippingfee) as shippingfeetotal FROM customerorder";
		$result2 = $conn->query($query2) or die($conn->error . __LINE__);
		$row2 = $result2->fetch_assoc();
		$shippingfeetotal = $row2['shippingfeetotal'];

    $query3 = "SELECT SUM(amount) as expenseamount FROM expense_item";
    $result3 = $conn->query($query3) or die($conn->error . __LINE__);
    $row3 = $result3->fetch_assoc();
    $expenseamount= $row3['expenseamount'];
  
    $query4 = "SELECT SUM(totalamountpesos) as cotcog FROM customerorder";
    $result4 = $conn->query($query4) or die($conn->error . __LINE__);
    $row4 = $result4->fetch_assoc();
    $coTCOG = $row4['cotcog'];
    

    $query5 = "SELECT SUM(totalpricephp) as potcog FROM po_stock";
    $result5 = $conn->query($query5) or die($conn->error . __LINE__);
    $row5 = $result5->fetch_assoc();
    $poTCOG = $row5['potcog'];
    
    $totalcostofgoods = $coTCOG + $poTCOG;


    $query6 = "SELECT SUM(unitprice) as unitprice FROM stocks";
    $result6 = $conn->query($query6) or die($conn->error . __LINE__);
    $row6 = $result6->fetch_assoc();
    $sumunitprice = $row6['unitprice'];

    
    $query7 = "SELECT COUNT(*) as stockcount FROM stocks";
    $result7 = $conn->query($query7) or die($conn->error . __LINE__);
    $row7 = $result7->fetch_assoc();
    $stockcount = $row7['stockcount'];

    $averageprice = $sumunitprice / $stockcount;
    
        
    $query8 = "SELECT SUM(quantity) as customerorderquan FROM customerorder";
    $result8 = $conn->query($query8) or die($conn->error . __LINE__);
    $row8 = $result8->fetch_assoc();
    $customerorderquan = $row8['customerorderquan'];

    $query9 = "SELECT SUM(quantity) as purchaseorderquan FROM po_stock";
    $result9 = $conn->query($query9) or die($conn->error . __LINE__);
    $row9 = $result9->fetch_assoc();
    $purchaseorderquan = $row9['purchaseorderquan'];
    
    $sumquanPOCO = $customerorderquan + $purchaseorderquan;

    $revenue = $sumquanPOCO * $averageprice;

    $grossprofit = $totalcostofgoods - $revenue;

    $netearning = $totalCO + $totalPO - $totalcostofgoods;
}



?>