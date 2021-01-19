<?php

include '../../config.php';

//PDO CONN
$connect = new PDO("mysql:host=$db_host;dbname=$db_tablename", $db_username, $db_password);

//MYSQLI CONN
$conn  = new mysqli($db_host, $db_username, $db_password, $db_tablename);

$form_data = json_decode(file_get_contents("php://input"));

    if(!isset($form_data->action)){
        echo "<script>window.location.href='../../index.php';</script>";
    }

	if($form_data->action == 'getpurchasebyproduct'){
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
		$result = $conn->query($query) or die($conn->error . __LINE__);
		$fetch_data = array();
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$fetch_data[] = $row;
			}
        }
        
        $query2 = "SELECT 
        FORMAT(SUM(customerorder.totalamountpesos * customerorder.quantity), 2) as fftotal
        FROM customerorder";
        $result = $conn->query($query2) or die($conn->error . __LINE__);
        $final = $result->fetch_assoc();

        // $fetch_data['totalamountko'] = $final['fftotal'];

        $output = array(
            "data"  => $fetch_data,
            "total" => $final['fftotal']
        );
    }
	
	/* ------------------- DIVISION -----------------------  */

	if($form_data->action == 'getcustomerbalsummary'){
		$query = "SELECT 
		CONCAT(customer.customerfirstname,' ', customer.customerlastname) as cfullname, 
		customer.customerguid
		FROM customer
		LEFT JOIN expense ON customer.customerguid = expense.payeeid
		WHERE expense.status = '1'";
		$result = $conn->query($query) or die($conn->error . __LINE__);
        $fetch_data = array();
        $total = 0;
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$query1 = "SELECT SUM(expense_item.amount) as totalamountexp
				FROM expense_item
				LEFT JOIN expense ON expense_item.expenseid = expense.expenseid
				WHERE expense.payeeid = '".$row['customerguid']."'";
				$result1 = $conn->query($query1) or die($conn ->error . __LINE__); 
				$exprow = $result1->fetch_assoc();
				$row['totalamountexp'] = $exprow['totalamountexp'];
                $fetch_data[] = $row;
                
                $total = $total + $exprow['totalamountexp'];
			}
		}
        // $output = $fetch_data;
        
        $output = array(
            "data"  => $fetch_data,
            "total" => $total ? $total : '0.00'
        );
	}
		
	/* ------------------- DIVISION -----------------------  */

	if($form_data->action == 'gettransaclistdate'){
		$query = "SELECT 
		customerorder.purchasedate, 
		customerorder.customerorderid, 
		customerorder.productid, 
		customer.customerfirstname, 
		customer.customerlastname, 
		customer.customerbname, 
		stocks.stockname, 
		suppliers.suppliername, 
		customerorder.remarks, 
		customerorder.quantity, 
		customerorder.exchangerate, 
		customerorder.totalamountpesos
		FROM customerorder
		LEFT JOIN stocks ON customerorder.productid = stocks.stocksid
		LEFT JOIN customer ON customerorder.customerid = customer.customerid
		LEFT JOIN suppliers ON stocks.supplierid = suppliers.supplierid
		ORDER BY customerorder.customerorderid";
		$result = $conn->query($query) or die($conn->error . __LINE__);
        $fetch_data = array();
        $total = 0;
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$orgDate = $row['purchasedate'];
				$newDate = date("F d, Y", strtotime($orgDate)); 
				$customername = $row['customerfirstname'] . " " . $row['customerlastname'];
                $fetch_data[] = $row;
                
                $total = $total + $row['totalamountpesos'];
			}
		}
		$output = array(
            "data"  => $fetch_data,
            "total" => $total ? $total : '0.00'
        );
	}


	/* ------------------- DIVISION -----------------------  */

	if($form_data->action == 'getpurchsuppdet'){
		$query = "SELECT customerorder.purchasedate, 
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
		customerorder.totalamountpesos,
        (customerorder.totalamountpesos * customerorder.quantity) as famountpesos
		FROM customerorder
		LEFT JOIN stocks ON customerorder.productid = stocks.stocksid
		LEFT JOIN customer ON customerorder.customerid = customer.customerid
		LEFT JOIN suppliers ON stocks.supplierid = suppliers.supplierid
		ORDER BY customerorder.customerorderid";
		$result = $conn->query($query) or die($conn->error . __LINE__);
        $fetch_data = array();
        $total = 0;
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
                $fetch_data[] = $row;
                
                $total = $total + $row['famountpesos'];
			}
		}
		$output = array(
            "data"  => $fetch_data,
            "total" => $total ? $total : '0.00'
        );
    }
    /* ------------------- DIVISION -----------------------  */

    if($form_data->action == 'transaccount'){
        $query = "SELECT expense_category.*, category_exp.categexpname, expense.paymentdate
		FROM expense_category
		LEFT JOIN category_exp ON expense_category.categoryid = category_exp.categexpid
        LEFT JOIN expense ON expense_category.expenseid = expense.expenseid
        WHERE expense_category.categoryid = '".$form_data->categexpid."'";
		$result = $conn->query($query) or die($conn->error . __LINE__);
        $fetch_data = array();
        $total = 0;
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
                $fetch_data[] = $row;
                
                $total = $total + intval($row['amount']);
			}
        }

        $output = array(
            "data"  => $fetch_data,
            "total" => $total ? $total : '0.00'
        );
    }

	/* ------------------- DIVISION -----------------------  */

	if($form_data->action == 'getjournal'){
		$query = "SELECT expense.*, category_exp.categexptype, expense_category.amount, expense_item.amount
		FROM expense 
		LEFT JOIN expense_item ON expense.expenseid = expense_item.expenseid
		LEFT JOIN expense_category ON expense.expenseid = expense_category.expenseid
		LEFT JOIN category_exp ON expense_category.categoryid = category_exp.categexpid
		where expense.status = '1' AND dlt = '0'
		ORDER BY expense.datecreated ASC";
		$result = $conn->query($query) or die($conn->error . __LINE__);
		$fetch_data = array();
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
				$fetch_data[] = $row;
			}
		}
		$output = $fetch_data;
	}

	  /* ------------------- DIVISION -----------------------  */

	  if($form_data->action == 'billpaymentlist'){
        $query = "SELECT expense_category.*, category_exp.*, expense.paymentdate, expense.payeeid
		FROM expense_category
		LEFT JOIN category_exp ON expense_category.categoryid = category_exp.categexpid
        LEFT JOIN expense ON expense_category.expenseid = expense.expenseid
        WHERE expense.paymentmethod = '".$form_data->mopid."' AND expense.status = '1'";
		$result = $conn->query($query) or die($conn->error . __LINE__);
        $fetch_data = array();
        $total = 0;
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
			$querycus = "SELECT suppliername as payeename FROM suppliers where supplierguid = '".$row['payeeid']."'";
			$resultcus = $conn->query($querycus) or die($conn->error . __LINE__);
			if($resultcus->num_rows > 0){
				$rowcus = $resultcus->fetch_assoc();
				$payeename = $rowcus['payeename'];
			}
				$row['payeename'] = $payeename;
                $fetch_data[] = $row;
                $total = $total + intval($row['amount']);
			}
        }

        $output = array(
            "data"  => $fetch_data,
            "total" => $total ? $total : '0.00'
        );
	}
	
	  /* ------------------- DIVISION -----------------------  */

	  if($form_data->action == 'creditcardlist'){
        $query = "SELECT expense_category.*, category_exp.*, expense.paymentdate, expense.payeeid, expense.remarks
		FROM expense_category
		LEFT JOIN category_exp ON expense_category.categoryid = category_exp.categexpid
        LEFT JOIN expense ON expense_category.expenseid = expense.expenseid
        WHERE expense.paymentaccount = '".$form_data->creditcardid."'";
		$result = $conn->query($query) or die($conn->error . __LINE__);
        $fetch_data = array();
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
                $fetch_data[] = $row;
                $total = $total + intval($row['amount']);
			}
        }

        $output = array(
            "data"  => $fetch_data,
            "total" => $total ? $total : '0.00'
        );
	}
	
	/* ------------------- DIVISION -----------------------  */

	if($form_data->action == 'getOpeninvoicelist'){
		$query = "SELECT expense.*, category_exp.categexptype, expense_category.amount,  expense_category.id, expense_item.amount, expense.payeeid
		FROM expense 
		LEFT JOIN expense_item ON expense.expenseid = expense_item.expenseid
		LEFT JOIN expense_category ON expense.expenseid = expense_category.expenseid
		LEFT JOIN category_exp ON expense_category.categoryid = category_exp.categexpid
		where expense.status = '1' AND dlt = '0'
		ORDER BY expense.datecreated ASC";
		$result = $conn->query($query) or die($conn->error . __LINE__);
		$fetch_data = array();
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
				$fetch_data[] = $row;
                // $total = $total + intval($row['amount']);
			}
		}
		$output = $fetch_data;
	}

	/* ------------------- DIVISION -----------------------  */

	if($form_data->action == 'getProfitlossincome'){
	
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

		$output = array(
			"data"  => $totalCO,
			"dataPo" =>$totalPO,
			"dataShipping" => $shippingfeetotal,
			"datatotalPOCO" => $totalCO +  $totalPO,
			"dataExp" => $expenseamount,
			"dataNetearning" => $netearning,
			"dataGrossprofit" => $grossprofit
        );
	}


    if($form_data->action == 'getYearplm'){
        $yearsql = "SELECT YEAR(purchasedate) as purchasedate FROM customerorder UNION SELECT YEAR(purchasedate) as purchasedate FROM po_main ORDER BY purchasedate DESC";
        $yearresult = $conn->query($yearsql) or die($conn->error . __LINE__);
        // $yr = $yearresult->fetch_assoc();

        $year = [];
        while ($yr = $yearresult->fetch_assoc()){
            $year[]['year'] = $yr['purchasedate'];
        }
    
        $output = array(
            // 'data' => $data,
            'data' => $year,
        );
    }

    if($form_data->action == 'profitandlossbymonth'){
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
            WHERE MONTH(po_main.purchasedate) = '".$value."' AND YEAR(po_main.purchasedate) = '".$form_data->year."' AND po_main.status = 'placed'";
            $po_result = $conn->query($main_query) or die($conn->error . __LINE__);  
            $po = $po_result->fetch_assoc();
                
            $query = "SELECT SUM(totalamountpesos) as totalamountco, SUM(quantity) as totalquantityco
            FROM customerorder WHERE MONTH(purchasedate) = '".$value."' AND YEAR(purchasedate) = '".$form_data->year."'";
            $result = $conn->query($query) or die($conn->error . __LINE__);  
            $co = $result->fetch_assoc();

            $query1 = "SELECT SUM(expense_category.amount) as totalexpense
			FROM expense_category
			LEFT JOIN expense ON expense_category.expenseid = expense.expenseid
			WHERE expense.status = '1' AND MONTH(expense.paymentdate) = '".$value."' AND YEAR(expense.paymentdate) = '".$form_data->year."'";
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

        $output = array(
            'dataPO' => $dataPO,
            'dataCO' => $dataCO,
            'dataExp' => $dataExp,
            'totalPOCO' => $totalPOCO,
            'revenue' => $revenue,
            'totalCOG' => $totalCOG,
            'average' => $average,
            'totalExp' => $totalExp,
        );
    }

 //---------------------------- end module close ----------------------------

echo json_encode($output);
?>