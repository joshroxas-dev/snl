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


	if($form_data->action == 'getSupplierInfo'){
		$id = $form_data->id;
		$query = "SELECT * FROM suppliers
		WHERE supplierid ='".$id."'
		;
		";
		$statement = $connect->prepare($query);
		if($statement->execute())
        {
            $message = 'success';
            $data = $statement->fetch(PDO::FETCH_ASSOC);
        }else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message,
			'data' => $data
		);
	}

	if($form_data->action == 'getProductInfo'){
		$id = $form_data->id;
		$query = "SELECT * FROM stocks
		WHERE stocksid ='".$id."'
		;
		";
		$statement = $connect->prepare($query);
		if($statement->execute())
        {
            $message = 'success';
            $data = $statement->fetch(PDO::FETCH_ASSOC);
        }else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message,
			'data' => $data
		);
	}


	// if($form_data->action == 'getStockInfo'){
	// 	$id = $form_data->id;
	// 	$query = "SELECT * FROM stocks
	// 	WHERE stocksid ='".$id."'
	// 	;
	// 	";
	// 	$statement = $connect->prepare($query);
	// 	if($statement->execute())
    //     {
    //         $message = 'success';
    //         $data = $statement->fetch(PDO::FETCH_ASSOC);
    //     }else{
    //         $message = 'error';
    //     }

	// 	$output = array(
	// 		'message'	=>	$message,
	// 		'data' => $data
	// 	);
	// }

	if($form_data->action == 'loadsupplierlist'){
		if($form_data->supplierid == 'ALL'){
			$query = "SELECT customerorder.purchasedate, customerorder.customerorderid, stocks.stockname, suppliers.supplierid, suppliers.suppliername, customerorder.remarks, customerorder.quantity, customerorder.exchangerate, customerorder.totalamountpesos
		FROM customerorder
		LEFT JOIN stocks ON customerorder.productid = stocks.stocksid
		LEFT JOIN suppliers ON stocks.supplierid = suppliers.supplierid
		ORDER BY customerorder.customerorderid";
		}else{
			$query = "SELECT customerorder.purchasedate, customerorder.customerorderid, stocks.stockname, suppliers.supplierid, suppliers.suppliername, customerorder.remarks, customerorder.quantity, customerorder.exchangerate, customerorder.totalamountpesos
		FROM customerorder
		LEFT JOIN stocks ON customerorder.productid = stocks.stocksid
		LEFT JOIN suppliers ON stocks.supplierid = suppliers.supplierid
		WHERE suppliers.supplierid = '".$form_data->supplierid."'
		ORDER BY customerorder.customerorderid";
		}
		
		$result = $conn->query($query) or die($conn->error . __LINE__);
		$fetch_data = array();
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$fetch_data[] = $row;
			}
		}
		$output = $fetch_data;
	}


	if($form_data->action == 'loadproductlist'){
		if($form_data->stocksid == 'ALL'){
			$query = "SELECT customerorder.purchasedate, customerorder.customerorderid, stocks.stockname, suppliers.supplierid, suppliers.suppliername, customerorder.remarks, customerorder.quantity, customerorder.exchangerate, customerorder.totalamountpesos
		FROM customerorder
		LEFT JOIN stocks ON customerorder.productid = stocks.stocksid
		LEFT JOIN suppliers ON stocks.supplierid = suppliers.supplierid
		ORDER BY customerorder.customerorderid";
		}else{
			$query = "SELECT customerorder.purchasedate, customerorder.customerorderid, stocks.stockname, suppliers.supplierid, suppliers.suppliername, customerorder.remarks, customerorder.quantity, customerorder.exchangerate, customerorder.totalamountpesos
		FROM customerorder
		LEFT JOIN stocks ON customerorder.productid = stocks.stocksid
		LEFT JOIN suppliers ON stocks.supplierid = suppliers.supplierid
		WHERE stocks.stocksid = '".$form_data->stocksid."'
		ORDER BY customerorder.customerorderid";
		}
		
		$result = $conn->query($query) or die($conn->error . __LINE__);
		$fetch_data = array();
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$fetch_data[] = $row;
			}
		}
		$output = $fetch_data;
	}



	if($form_data->action == 'getpurchsuppdet'){
		$query = "SELECT * FROM customerorder ORDER BY datecreated DESC";
		$result = $conn->query($query) or die($conn->error . __LINE__);
		$fetch_data = array();
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$fetch_data[] = $row;
			}
		}
		$output = $fetch_data;
	}

	if($form_data->action == 'getcustomerbalsum'){
		$main_query = "SELECT CONCAT(customer.customerfirstname,' ', customer.customerlastname) as cfullname, customer.customerguid
		FROM customer
		LEFT JOIN expense ON customer.customerguid = expense.payeeid
		WHERE expense.status = '1'";
		$main_result = $conn->query($main_query) or die($conn->error . __LINE__);  
	   $data = [];
		while ($row = $main_result->fetch_assoc()) {
		    $query = "SELECT SUM(expense_item.amount) as totalamountexp
			FROM expense_item
		    LEFT JOIN expense ON expense_item.expenseid = expense.expenseid
		    WHERE expense.payeeid = '".$row['customerguid']."'";
		     $result = $conn->query($query) or die($conn->error . __LINE__);  
			 
		     $exprow = $result->fetch_assoc(); 
		     $row['totalamountexp'] = $exprow['totalamountexp'];    
		     $data[] = $row; 
		}
	
		$output = $data;
	}


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
		if ($result->num_rows > 0) {
			while ($row = $result -> fetch_assoc()) {
				$fetch_data[] = $row;
			}
		}
		$output = $fetch_data;
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
		customerorder.totalamountpesos
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
		$output = $fetch_data;
	}
	

	if($form_data->action == 'loadprofitlossbymonth'){
		$main_query = "SELECT FORMAT(SUM(totalpricephp), 2) as totalamountpo
		FROM po_stock";
		$main_result = $conn->query($main_query) or die($conn->error . __LINE__);
		$main = $main_result->fetch_assoc();
		$fetch_data[] = $main;

		// $main_result = $conn->query($main_query) or die($conn->error . __LINE__);
		// $fetch_data = array();
		// if ($main_result->num_rows > 0) {
		// 	while ($main = $main_result->fetch_assoc()) {
		// 		$fetch_data[] = $main;
		// 	}
		// }
		$output = $fetch_data;
	}

	echo json_encode($output);
	?>