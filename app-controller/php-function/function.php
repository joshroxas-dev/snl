<?php

include '../../config.php';

	session_start();	

	// require_once("connection.php");

	// function loggedIn(){

	// 	if(isset($_SESSION["user_id"])){
	// 		return true;
	// 	} else {
	// 		return false;
	// 	}

	// }


	// function getUser_value($field_name){

	// 	global $conn;
	// 	$user_id = $_SESSION["user_id"];

	// 	$sql = "SELECT $field_name FROM users WHERE id='$user_id'";
	// 	$result = $conn->query($sql);
	// 	$row = $result->fetch_assoc();

	// 	return $row[$field_name];
	// }


	// To generate random user id
	function generateId($length = 15) {
		$characters = '0123456789ABCDEFGHIJKLMNOP';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	// function generateId(){
	// 	if (function_exists('com_create_guid')){
	// 		return com_create_guid();
	// 	}else{
	// 		// mt_srand((double)microtime()*10000);
	// 		$charid = strtoupper(md5(uniqid(rand(), true)));
	// 		$hyphen = chr(45);// "-"
	// 		$uuid = chr(123)// "{"
	// 			.substr($charid, 0, 8).$hyphen
	// 			.substr($charid, 8, 4).$hyphen
	// 			.substr($charid,12, 4).$hyphen
	// 			.substr($charid,16, 4).$hyphen
	// 			.substr($charid,20,12)
	// 			.chr(125);// "}"
	// 		return $uuid;
	// 	}
	// }

	// $servername = "db5000198974.hosting-data.io";
	// $username = "dbu407864";
	// $password = "K2NmauSqb#az4#R";
	// $db_tablename = "dbs193977";

	// $connect = new PDO("mysql:host=$servername;dbname=$db_tablename", $username, $password);

	
	//PDO CONN
	$connect = new PDO("mysql:host=$db_host;dbname=$db_tablename", $db_username, $db_password);

	//MYSQLI CONN
	$conn  = new mysqli($db_host, $db_username, $db_password, $db_tablename);

	$form_data = json_decode(file_get_contents("php://input"));

	$genid = generateId();

	if(!isset($form_data->action)){
		echo "<script>window.location.href='../../index.php';</script>";
	}


	if($form_data->action == 'savePurchaseOrder'){
		$data = array(
			':status' => $form_data->status,
			':batchnumber' => $form_data->batchnumber,
			':purchasedate' => $form_data->purchasedate,
			':ordernumber' => $form_data->ordernumber,
			':productid' => $form_data->productid,
			':quantity' => $form_data->quantity,
			':unitpricedollars' => $form_data->unitpricedollars,
			':stockname' => $form_data->stockname,
			':stockcolor' => $form_data->stockcolor,
			':stocksize' => $form_data->stocksize,
			':exchangerate' => $form_data->exchangerate,
			':unitpricephp' => $form_data->unitpricephp,
			':totalpricephp' => $form_data->totalpricephp,
			':totalpricedollars' => $form_data->totalpricedollars,
			':freightintotal' => $form_data->freightintotal,
			':freightinperunit' => $form_data->freightinperunit,
			':taxtotalperproduct' => $form_data->taxtotalperproduct,
			':taxperunit' => $form_data->taxperunit,
			':costperunit' => $form_data->costperunit,
			':totalcostofgoods' => $form_data->totalcostofgoods,
			':srp' => $form_data->srp,
			':remarks' => $form_data->remarks,
			':creditcard' => $form_data->creditcard,
			':courierid' => $form_data->courierid,
			':trackingnumber' => $form_data->trackingnumber,
		);
		$query1 = "
		INSERT INTO purchaseorder
			(status, batchnumber, purchasedate, ordernumber, productid, quantity, unitpricedollars, stockname, stockcolor, stocksize, exchangerate, unitpricephp, totalpricephp, totalpricedollars, freightintotal, freightinperunit, taxtotalperproduct, taxperunit, costperunit, totalcostofgoods, srp, remarks, creditcard, courierid, trackingnumber) VALUES 
			(:status, :batchnumber, :purchasedate, :ordernumber, :productid, :quantity, :unitpricedollars, :stockname, :stockcolor, :stocksize, :exchangerate, :unitpricephp, :totalpricephp, :totalpricedollars, :freightintotal, :freightinperunit, :taxtotalperproduct, :taxperunit, :costperunit, :totalcostofgoods, :srp, :remarks, :creditcard, :courierid, :trackingnumber)
		";
		$statement = $connect->prepare($query1);

		if($statement->execute($data))
		{
			$message = 'success';
		}else{
			$message = 'error';
		}
		$output = array(
			'message'	=>	$message,
			'batchnumber' => $form_data->batchnumber,
			'ordernumber' => $form_data->ordernumber
		);
	}

	if($form_data->action == 'loadPOlist'){
		$query = "SELECT * FROM po_main where status = '".$form_data->status."' AND dlt = '0' ORDER BY id ASC";
		$result = $conn->query($query) or die($conn->error . __LINE__);
		$fetch_data = array();
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$fetch_data[] = $row;
			}
		}
		$output = $fetch_data;
	}

	if($form_data->action == 'validatestock'){
		$query = "SELECT * FROM po_stock where pom_id = '".$form_data->pom_id."'";
		$result = $conn->query($query) or die($conn->error . __LINE__);
		$count = 0;
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				if((is_null($row['stocksid']) OR $row['stocksid'] == '') OR (is_null($row['quantity']) OR $row['quantity'] == '')){
					$count++;
				}
			}
		}
		$output = $count;
	}

	if($form_data->action == 'resetquantitystock'){
		//select latest PO
		$query = "SELECT * FROM po_stock where id = '".$form_data->id."'";
		$result = $conn->query($query) or die($conn->error . __LINE__);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$resultq = [];

				$query1 = "UPDATE stocks SET availablestocks = (availablestocks + '".$row['quantity']."') WHERE stocksid = '".$row['stocksid']."'";
				$resultq['add'] = $conn->query($query1) or die($conn->error . __LINE__);

				$query3 = "SELECT * FROM stocks where stocksid = '".$row['stocksid']."' AND availablestocks >= '".$form_data->qty."'";
				$result3 = $conn->query($query3) or die($conn->error . __LINE__);
				if ($result3->num_rows > 0) {
					$query2 = "UPDATE stocks SET availablestocks = (availablestocks - '".$form_data->qty."') WHERE stocksid = '".$row['stocksid']."'";
					$resultq['subtract'] = $conn->query($query2) or die($conn->error . __LINE__);

					$outofstocks = false;
				}else{
					$query2 = "UPDATE po_stock SET quantity = '', oldquantity = '' WHERE id = '".$form_data->id."'";
					$resultq['subtract'] = $conn->query($query2) or die($conn->error . __LINE__);

					$outofstocks = true;
				}
			}
			$message = 'success';
		}else{
			$message = 'error';
		}

		$output = array(
			'outofstocks' => $outofstocks,
			'result' => $resultq,
			'message' => $message
		);
	}

	if($form_data->action == 'setRateR'){
		$query2 = "UPDATE po_stock SET rate = '".$form_data->rate."' WHERE id = '".$form_data->id."'";
		$result = $conn->query($query2) or die($conn->error . __LINE__);

		$output = array(
			'message' => $result
		);
	}

	if($form_data->action == 'delPOdraftf'){
		//select latest PO
		$query = "SELECT * FROM po_stock where pom_id = '".$form_data->pom_id."'";
		$result = $conn->query($query) or die($conn->error . __LINE__);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$query1 = "UPDATE stocks SET availablestocks = (availablestocks + '".$row['quantity']."') WHERE stocksid = '".$row['stocksid']."'";
				$result3 = $conn->query($query1) or die($conn->error . __LINE__);
				
			}
			$message = 'success';
		}else{
			$message = 'error';
		}

		$query2 = "UPDATE po_main SET dlt = '1' WHERE pom_id = '".$form_data->pom_id."'";
		$result2 = $conn->query($query2) or die($conn->error . __LINE__);

		$output = array(
			'id' => $form_data->pom_id,
			'count' => $result->num_rows,
			'message' => $message
		);
	}

	if($form_data->action == 'checkIfExist'){
		if($form_data->active == 'new'){
			$query = "SELECT * FROM po_main where $form_data->type = '".$form_data->text."' AND dlt = '0'";
		}else{
			$query = "SELECT * FROM po_main where $form_data->type = '".$form_data->text."' AND pom_id != '".$form_data->pom_id."' AND dlt = '0'";
		}
		
		$result = $conn->query($query) or die($conn->error . __LINE__);

		if ($result->num_rows > 0) {
			$exist = true;
		}else{
			$exist = false;
		}

		$output = [
			'type' => $form_data->type,
			'exist' => $exist
		];
	}

	if($form_data->action == 'dellstockrow'){

		$query = "SELECT * FROM po_stock where id = '".$form_data->id."'";
		$result = $conn->query($query) or die($conn->error . __LINE__);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$resultq = [];

				$query1 = "UPDATE stocks SET availablestocks = (availablestocks + '".$row['quantity']."') WHERE stocksid = '".$row['stocksid']."'";
				$resultq['add'] = $conn->query($query1) or die($conn->error . __LINE__);
			}
		}

		$query = "
		DELETE FROM po_stock WHERE id='".$form_data->id."'
		";
		$statement = $connect->prepare($query);
		
		if($statement->execute()){
			$message = 'success';
		}else{
            $message = 'error';
        }

		$output = array(
			'result' => $resultq,
			'message'	=>	$message
		);
	}

	if($form_data->action == 'updatequantitystock'){
		// $query2 = "UPDATE stocks SET availablestocks = (availablestocks - '".$form_data->qty."') WHERE stocksid = '".$form_data->sid."'";
		// $result = $conn->query($query2) or die($conn->error . __LINE__);

		// $output = array(
		// 	'result' => $result,
		// 	'message' => 'success'
		// );
		$query = "SELECT * FROM po_stock where id = '".$form_data->id."'";
		$result = $conn->query($query) or die($conn->error . __LINE__);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$resultq = [];

				$query1 = "UPDATE stocks SET availablestocks = (availablestocks - '".$row['quantity']."') WHERE stocksid = '".$row['stocksid']."'";
				$resultq['add'] = $conn->query($query1) or die($conn->error . __LINE__);
			}
			$message = 'success';
		}else{
			$message = 'error';
		}

		$output = array(
			'result' => $resultq,
			'message' => $message
		);
	}

	if($form_data->action == 'updateActivePO'){
		$data = array(
			':id'     		=>	$form_data->id,
			':batchnumber'     	=>	$form_data->batchnumber,
			':ordernumber'     	=>	$form_data->ordernumber,
			':exchangerate'     	=>	$form_data->exchangerate,
			':freightinperunit'     	=>	$form_data->freightinperunit,
			':trackingnumber'     	=>	$form_data->trackingnumber,
			':purchasedate'     	=>	$form_data->purchasedate,
			':creditcard'     	=>	$form_data->creditcard,
			':courierid'     	=>	$form_data->courierid,
			':remarks'     	=>	$form_data->remarks,
			':sys_vat'     	=>	$form_data->sys_vat,
			

		);
		$query = "
		UPDATE po_main 
			SET batchnumber = :batchnumber, ordernumber = :ordernumber, exchangerate = :exchangerate, freightinperunit = :freightinperunit, trackingnumber = :trackingnumber, purchasedate = :purchasedate, creditcard = :creditcard, courierid = :courierid, remarks = :remarks, sys_vat = :sys_vat WHERE id = :id";
		$statement = $connect->prepare($query);

		// $data2 = array(
		// 	':pom_id'     		=>	$form_data->pom_id,
		// 	':rate'    		=>	$form_data->exchangerate,
		// );
		// $query = "
		// UPDATE po_stock 
		// 	SET rate = :rate WHERE pom_id = :pom_id";
		// $statement2 = $connect->prepare($query);
		// $statement2->execute($data2);

		if($statement->execute($data))
		{
			$message = 'update po success';
		}else{
			$message = 'error';
		}
		$output = array(
			'message' => $message
		);

	}

	if($form_data->action == 'auditLogs'){
		$data = array(
			':users_id' => $_SESSION['user_id'],
			':event' => $form_data->event,
			':description' => $form_data->description,
			':module' => $form_data->module,
		);
		$query1 = "
		INSERT INTO audit_logs
			(users_id, event, description, module) VALUES 
			(:users_id, :event, :description, :module)
		";
		$statement = $connect->prepare($query1);

		if($statement->execute($data))
		{
			$message = 'success';
		}else{
			$message = 'error';
		}
		$output = array(
			'message'	=>	$message
		);
	}

	if($form_data->action == 'saveNewPO'){
		$data = array(
			':pom_id' => $genid,
			':batchnumber' => $form_data->batchnumber,
			':ordernumber' => $form_data->ordernumber,
			':exchangerate' => $form_data->exchangerate,
			':freightinperunit' => $form_data->freightinperunit,
			':trackingnumber' => $form_data->trackingnumber,
			':purchasedate' => $form_data->purchasedate,
			':creditcard' => $form_data->creditcard,
			':courierid' => $form_data->courierid,
			':remarks' => $form_data->remarks,
			':session_status' => '1',
			':session_id' => $_SESSION['user_id'],
			':sys_vat'     	=>	$form_data->sys_vat,
		);
		$query1 = "
		INSERT INTO po_main
			(pom_id, batchnumber, ordernumber, exchangerate, freightinperunit, trackingnumber, purchasedate, creditcard, courierid, remarks, session_status, session_id, sys_vat) VALUES 
			(:pom_id, :batchnumber, :ordernumber, :exchangerate, :freightinperunit, :trackingnumber, :purchasedate, :creditcard, :courierid, :remarks, :session_status, :session_id, :sys_vat)
		";
		$statement = $connect->prepare($query1);

		$id = generateId();

		$data2 = array(
			':pom_id' => $genid,
			':rate' => $form_data->exchangerate,
			':pos_id' => $id,
		);
		$query2 = "
		INSERT INTO po_stock
			(pos_id, pom_id, rate) VALUES 
			(:pos_id, :pom_id, :rate)
		";
		$statement2 = $connect->prepare($query2);

		$data3 = array(
			':pos_id' => $id
		);
		$query3 = "
		INSERT INTO stockslist
			(pos_id) VALUES (:pos_id)
		";
		$statement3 = $connect->prepare($query3);

		if($statement->execute($data) && $statement2->execute($data2) && $statement3->execute($data3))
		{
			$message = 'success';
		}else{
			$message = 'error';
		}
		$output = array(
			'message'	=>	$message
		);
	}

	if($form_data->action == 'addstockrow'){
		$id = generateId();

		$data2 = array(
			':pom_id' => $form_data->pom_id,
			':pos_id' => $id,
			':rate' => $form_data->rate,
		);
		$query2 = "
		INSERT INTO po_stock
			(pos_id, pom_id, rate) VALUES 
			(:pos_id, :pom_id, :rate)
		";
		$statement2 = $connect->prepare($query2);

		$data3 = array(
			':pos_id' => $id
		);
		$query3 = "
		INSERT INTO stockslist
			(pos_id) VALUES (:pos_id)
		";
		$statement3 = $connect->prepare($query3);

		if($statement2->execute($data2) && $statement3->execute($data3))
		{
			$message = 'success';
		}else{
			$message = 'error';
		}
		$output = array(
			'message'	=>	$message
		);
	}

	if($form_data->action == 'POfinalsave'){
		$data = array(
			':pom_id' => $form_data->pom_id,
			':session_status' => '0',
			':status' => $form_data->status,
			':sys_vat' => $form_data->sys_vat,
		);
		$query = "
		UPDATE po_main 
			SET session_status = :session_status, status = :status, sys_vat = :sys_vat
		WHERE pom_id = :pom_id";
		$statement = $connect->prepare($query);

		if($statement->execute($data))
		{
			$message = 'success';
		}else{
			$message = 'error';
		}
		$output = array(
			'message' => $message
		);
	}

	if($form_data->action == 'updatestocks'){
		$stocjj = array($form_data->data);
	
		$qvalidate = 0;
		foreach ($form_data->data as $key=>$value) {
			// $query = "SELECT * FROM stocks where ";
			// $statement = $connect->prepare($query);
			// if($statement->execute())
			// {

			// }
			$query = "SELECT * FROM stockslist where pos_id = '".$value->pos_id."'";
			$resultf = $conn->query($query) or die($conn->error . __LINE__);

			if ($resultf->num_rows > 0) {
				$rowsl = $resultf->fetch_assoc();

				$testlog = [];
				if($rowsl['purchased_qty'] == $rowsl['available_qty']){
					$queryslu = "UPDATE stockslist SET purchased_qty = '".$value->quantity."', available_qty = '".$value->quantity."', backup_qty = '".$value->quantity."', unitprice = '".$value->unitpricephp."' WHERE pos_id = '".$value->pos_id."'";
					$resultslu = $conn->query($queryslu) or die($conn->error . __LINE__);
					$uValid = true;
				}else if($rowsl['purchased_qty'] > $rowsl['available_qty']){
					if($value->quantity > $rowsl['purchased_qty']){
						$c_qty = $value->quantity - $rowsl['purchased_qty'];
						$queryslu = "UPDATE stockslist SET purchased_qty = '".$value->quantity."', available_qty = (available_qty + '".$c_qty."'), backup_qty = '".$value->quantity."', unitprice = '".$value->unitpricephp."' WHERE pos_id = '".$value->pos_id."'";
						$resultslu = $conn->query($queryslu) or die($conn->error . __LINE__);
						$uValid = true;	
					}
					if($value->quantity < $rowsl['purchased_qty']){
						// if($value->quantity < $rowsl['available_qty']){
							$c_qty = $rowsl['purchased_qty'] - $value->quantity;
							$diffval =  $rowsl['available_qty'] - $c_qty;
							$testlog[] = $diffval;
							if($diffval < 0){
								$qvalidate = $qvalidate + 1;
								$uValid = false;
							}else{
								$c_qty = $rowsl['purchased_qty'] - $value->quantity;
								$queryslu = "UPDATE stockslist SET purchased_qty = '".$value->quantity."', available_qty = (available_qty - '".$c_qty."'), backup_qty = '".$value->quantity."', unitprice = '".$value->unitpricephp."' WHERE pos_id = '".$value->pos_id."'";
								$resultslu = $conn->query($queryslu) or die($conn->error . __LINE__);
								$uValid = true;
							}
							// $calq = $rowsl['purchased_qty'] - $rowsl['available_qty'];
							// $calq2 = $rowsl['available_qty'] - $value->quantity;
							// $testlog[] = $calq;
							// $testlog[] = $calq2;
							// if($calq2 < $calq){
							// 	$c_qty = $rowsl['purchased_qty'] - $value->quantity;
							// 	$queryslu = "UPDATE stockslist SET purchased_qty = '".$value->quantity."', available_qty = (available_qty - '".$c_qty."'), backup_qty = '".$value->quantity."', unitprice = '".$value->unitpricephp."' WHERE pos_id = '".$value->pos_id."'";
							// 	$resultslu = $conn->query($queryslu) or die($conn->error . __LINE__);
							// 	$uValid = true;
							// }else{

							// 	$qvalidate = $qvalidate + 1;
							// 	$uValid = false;
							// }
						// }else{
						// 	$c_qty = $rowsl['purchased_qty'] - $value->quantity;
						// 	$queryslu = "UPDATE stockslist SET purchased_qty = '".$value->quantity."', available_qty = (available_qty - '".$c_qty."'), backup_qty = '".$value->quantity."', unitprice = '".$value->unitpricephp."' WHERE pos_id = '".$value->pos_id."'";
						// 	$resultslu = $conn->query($queryslu) or die($conn->error . __LINE__);
						// 	$uValid = true;
						// }
					}
				}
				// $query3 = "UPDATE stocks SET availablestocks = (availablestocks + '".$row['quantity']."') WHERE stocksid = '".$row['oldstocksid']."'";
				// $resultslu = $conn->query($queryslu) or die($conn->error . __LINE__);
				
			}else{
				$uValid = true;
			}
			
			if($uValid){
				// $resultslu = $conn->query($queryslu) or die($conn->error . __LINE__);

				$query1 = "UPDATE po_stock SET oldstocksid = stocksid, oldquantity = quantity WHERE id = '".$value->id."'";
				$result = $conn->query($query1) or die($conn->error . __LINE__);
	
				$data2 = array(
					':id'     		=>	$value->id,
					':quantity'    	=>	$value->quantity,
					':stocksid'    	=>	$value->stocksid,
					':stockguid'    =>	$value->stockguid,
					':unitpricephp' =>	$value->unitpricephp,
					':totalpricephp' =>	$value->totalpricephp,
				);
				$query = "
				UPDATE po_stock 
					SET quantity = :quantity, stocksid = :stocksid, stockguid = :stockguid, unitpricephp = :unitpricephp, totalpricephp = :totalpricephp WHERE id = :id";
				$statement = $connect->prepare($query);
				$statement->execute($data2);
			}
		}
		$output = array(
			'message'	=>	$form_data->data,
			'isValidate' => $qvalidate,
			'testlog' => $testlog,
		);
	}

	if($form_data->action == 'getStockPOt'){
		$pom_id = $form_data->pom_id;

		$query2 = "SELECT FORMAT(SUM(quantity * (rate * unitpricephp)), 2) as total, SUM(quantity * (rate * unitpricephp)) as ftotal FROM po_stock WHERE pom_id = '".$pom_id."'";
		$statement2 = $connect->prepare($query2);
		$statement2->execute();
		$row2 = $statement2->fetch(PDO::FETCH_ASSOC);

		$total2_query = "SELECT 
		FORMAT(SUM((((po_stock.unitpricephp * po_stock.rate) / '".$row2['ftotal']."') * po_main.sys_vat) * po_stock.quantity), 2) as tftaxtotalperproduct
		FROM po_stock 
		LEFT JOIN stocks ON po_stock.stocksid = stocks.stocksid
		LEFT JOIN po_main ON po_stock.pom_id = po_main.pom_id
		where po_stock.pom_id = '".$pom_id."'";
		$total2_result = $conn->query($total2_query) or die($conn->error . __LINE__);
		$tftotal = $total2_result->fetch_assoc();

		$query = "SELECT po_stock.*, po_main.sys_vat,
		FORMAT((((po_stock.unitpricephp * po_stock.rate) / '".$row2['ftotal']."') * po_main.sys_vat), 2) as ftaxperunit,
    	FORMAT(((((po_stock.unitpricephp * po_stock.rate) / '".$row2['ftotal']."') * po_main.sys_vat) * po_stock.quantity), 2) as ftaxtotalperproduct,
		FORMAT(po_stock.quantity * (po_stock.rate * po_stock.unitpricephp), 2) as totalamount, 
		po_stock.unitpricephp, stocks.availablestocks 
		FROM po_stock
		LEFT JOIN stocks ON po_stock.stocksid = stocks.stocksid
		LEFT JOIN po_main ON po_stock.pom_id = po_main.pom_id
		WHERE po_stock.pom_id = '".$pom_id."' ORDER BY po_stock.datecreated ASC";
		$statement = $connect->prepare($query);
		if($statement->execute())
        {
            $message = 'success';
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
        }else{
            $message = 'error';
		}

		$output = array(
			'message'	=>	$message,
			'total' => $row2['total'],
			'taxtotal' => $tftotal['tftaxtotalperproduct'],
			'data' => $data
		);
	}

	if($form_data->action == 'getProdlist'){

		$query = "SELECT * FROM stocks ORDER BY datecreated ASC";
		$statement = $connect->prepare($query);
		if($statement->execute())
        {
            $message = 'success';
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
        }else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message,
			'data' => $data
		);
	}

	
	if($form_data->action == 'getCreditcardlist'){

		$query = "SELECT * FROM creditcard ORDER BY datecreated ASC";
		$statement = $connect->prepare($query);
		if($statement->execute())
        {
            $message = 'success';
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
        }else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message,
			'data' => $data
		);
	}

	if($form_data->action == 'getCatlist'){

		$query = "SELECT * FROM category_exp ORDER BY datecreated ASC";
		$statement = $connect->prepare($query);
		if($statement->execute())
        {
            $message = 'success';
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
        }else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message,
			'data' => $data
		);
	}

	if($form_data->action == 'getVat'){

		$query = "SELECT FORMAT(sys_value, 2) as sys_value FROM system_setting where sys_name = 'VAT'";
		$statement = $connect->prepare($query);
		if($statement->execute())
        {
            $message = 'success';
            $row = $statement->fetch(PDO::FETCH_ASSOC);
           
        }else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message,
			'data' => $row
		);
	}

	if($form_data->action == 'saveVat'){
		$query = "UPDATE system_setting SET sys_value = '".$form_data->sys_vat."' WHERE sys_name = 'VAT'";
		$result = $conn->query($query) or die($conn->error . __LINE__);

		if ($result) {
			$message = 'success';
		}else{
			$message = 'error';
		}

		$output = array(
			'message'	=>	$message
		);
	}

	if($form_data->action == 'getCustomerlist'){

		$query = "SELECT * FROM customer ORDER BY datecreated ASC";
		$statement = $connect->prepare($query);
		if($statement->execute())
        {
            $message = 'success';
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
        }else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message,
			'data' => $data
		);
	}

	if($form_data->action == 'getModeofpaymentlist'){

		$query = "SELECT * FROM modeofpayment ORDER BY datecreated ASC";
		$statement = $connect->prepare($query);
		if($statement->execute())
        {
            $message = 'success';
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
        }else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message,
			'data' => $data
		);
	}
	if($form_data->action == 'getPlatformlist'){

		$query = "SELECT * FROM platform ORDER BY datecreated ASC";
		$statement = $connect->prepare($query);
		if($statement->execute())
        {
            $message = 'success';
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
        }else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message,
			'data' => $data
		);
	}

	if($form_data->action == 'getSizelist'){

		$query = "SELECT * FROM sizes ORDER BY datecreated ASC";
		$statement = $connect->prepare($query);
		if($statement->execute())
        {
            $message = 'success';
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
        }else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message,
			'data' => $data
		);
	}
	
	if($form_data->action == 'getCourierlist'){

		$query = "SELECT * FROM couriers ORDER BY datecreated ASC";
		$statement = $connect->prepare($query);
		if($statement->execute())
        {
            $message = 'success';
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
        }else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message,
			'data' => $data
		);
	}

	if($form_data->action == 'getcustomerorderinfo'){

		$query = "SELECT * FROM customerorder ORDER BY datecreated ASC";
		$statement = $connect->prepare($query);
		if($statement->execute())
        {
            $message = 'success';
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
        }else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message,
			'data' => $data
		);
	}

	if($form_data->action == 'getmodeofpaymentinfo'){

		$query = "SELECT * FROM modeofpayment ORDER BY datecreated ASC";
		$statement = $connect->prepare($query);
		if($statement->execute())
        {
            $message = 'success';
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
        }else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message,
			'data' => $data
		);
	}

	
	if($form_data->action == 'getplatforminfo'){

		$query = "SELECT * FROM platform ORDER BY datecreated ASC";
		$statement = $connect->prepare($query);
		if($statement->execute())
        {
            $message = 'success';
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
        }else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message,
			'data' => $data
		);
	}

	if($form_data->action == 'getsizeinfo'){

		$query = "SELECT * FROM sizes ORDER BY datecreated ASC";
		$statement = $connect->prepare($query);
		if($statement->execute())
        {
            $message = 'success';
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
        }else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message,
			'data' => $data
		);
	}

	if($form_data->action == 'getActivePO'){

		$id = $form_data->id == 'active' ? $_SESSION['user_id'] : $form_data->id;

		if($form_data->id == 'active'){
			$query = "SELECT * FROM po_main WHERE session_id = '".$id."' and session_status = '1'";
		}else{
			$query = "SELECT * FROM po_main WHERE id = '".$id."'";
		}
		
		$statement = $connect->prepare($query);
		if($statement->execute())
        {
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
        }
		
		if(@$data){
			$message = 'success';
		}else{
			$message = 'error';
		}

		$output = array(
			'message'	=>	$message,
			'data' => $data[0]
		);
	}

	if($form_data->action == 'orderNumber'){

		$query = "SELECT ordernumber FROM purchaseorder GROUP BY ordernumber ORDER BY datecreated DESC";
		$statement = $connect->prepare($query);
		if($statement->execute())
        {
            $message = 'success';
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
        }else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message,
			'data' => $data
		);
	}

	if($form_data->action == 'getProdInfo'){
		$id = $form_data->id;
		$pom_id = $form_data->pom_id;

		$query2 = "SELECT * FROM po_stock where id = '".$form_data->poid."'";
		$resultf = $conn->query($query2) or die($conn->error . __LINE__);

		if ($resultf->num_rows > 0) {
			$row = $resultf->fetch_assoc();

			$query3 = "UPDATE stocks SET availablestocks = (availablestocks + '".$row['quantity']."') WHERE stocksid = '".$row['oldstocksid']."'";
			$resultqq = $conn->query($query3) or die($conn->error . __LINE__);
			
		}
		$query = "SELECT * FROM po_stock where pom_id = '".$pom_id."' AND stocksid = '".$id."'";
		$result = $conn->query($query) or die($conn->error . __LINE__);

		if ($result->num_rows > 0) {
			$exist = true;
		}else{
			$exist = false;
		}

		$query4 = "
		SELECT stocks.stockname, stocks.guid, stocks.stockcolor, stocks.stocksize, stocks.availablestocks, stocks.sku, stocks.unitprice, category.categorydesc, brands.brandname FROM stocks
		LEFT JOIN category ON stocks.categoryid = category.categoryid
		LEFT JOIN brands ON stocks.brandid = brands.brandid
		WHERE stocks.stocksid='".$id."'
		;
		";
		$statement = $connect->prepare($query4);
		if($statement->execute())
        {
            $message = 'success';
            $data = $statement->fetch(PDO::FETCH_ASSOC);
        }else{
            $message = 'error';
        }

		$output = array(
			'exist' => $exist,
			'result' => [
				"oldqty" => $row['oldquantity'],
				"oldid" => $row['oldstocksid'],
			],
			'message'	=>	$message,
			'data' => $data
		);
	}

	if($form_data->action == 'getProdInfo2'){
		$id = $form_data->id;

		$query = "
		SELECT stocks.stockname, stocks.guid, stocks.stockcolor, stocks.stocksize, suppliers.suppliername, stocks.supplierid, stocks.availablestocks, stocks.sku, stocks.unitprice, stocks.reorderpoint, stocks.threshold, category.categorydesc, brands.brandname FROM stocks
		LEFT JOIN category ON stocks.categoryid = category.categoryid
		LEFT JOIN brands ON stocks.brandid = brands.brandid
		LEFT JOIN suppliers ON stocks.supplierid = suppliers.supplierid
		WHERE stocks.stocksid='".$id."'
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

		$checkqty = "SELECT SUM(stockslist.available_qty) as newalbqty FROM stockslist 
        LEFT JOIN po_stock ON stockslist.pos_id = po_stock.pos_id
        LEFT JOIN po_main ON po_stock.pom_id = po_main.pom_id
        WHERE po_main.status='placed' 
        AND po_stock.stockguid='".$data['guid']."'";
        $resultqty = $conn->query($checkqty) or die($conn->error . __LINE__);
		$rowqty = $resultqty->fetch_assoc();
		
		$data['newalbqty'] = $rowqty['newalbqty'] ? $rowqty['newalbqty'] : 0;
		
		$checksql = "SELECT * FROM snldata WHERE module='stocks' AND itemid='".$data['guid']."'";
		$resultimg = $conn->query($checksql) or die($conn->error . __LINE__);
		$rowimg = $resultimg->fetch_assoc();

		if($resultimg->num_rows > 0){
			$image = $rowimg['path'];
		}else{
			$image = null;
		}

		$output = array(
			'message'	=>	$message,
			'data' => $data,
			'imgurl' => $image
		);
	}

	if($form_data->action == 'getAccountbal'){
		$id = $form_data->id;

		$query = "
		SELECT * FROM accounts
		WHERE accountid='".$id."'
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


	if($form_data->action == 'getCategorylist'){

		$query = "SELECT * FROM category ORDER BY datecreated ASC";
		$statement = $connect->prepare($query);
		if($statement->execute())
        {
            $message = 'success';
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
        }else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message,
			'data' => $data
		);
	}


	if($form_data->action == 'getcategoryinfo'){
		$id = $form_data->id;

		$query = "
		SELECT * FROM category
		WHERE category='".$id."'
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


	if($form_data->action == 'getAccountTypeInfo'){
		$id = $form_data->id;
		$query = "
		SELECT * FROM account_type
		WHERE acctypeid='".$id."';
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

	if($form_data->action == 'getAccountTypelist'){

		$query = "SELECT * FROM account_type";
		$statement = $connect->prepare($query);
		if($statement->execute())
        {
            $message = 'success';
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
        }else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message,
			'data' => $data
		);
	}

	if($form_data->action == 'getAccountDetailslist'){

		$query = "SELECT * FROM account_detail";
		$statement = $connect->prepare($query);
		if($statement->execute())
        {
            $message = 'success';
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
        }else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message,
			'data' => $data
		);
	}

	if($form_data->action == 'getAccountDetailsInfo'){
		$id = $form_data->id;
		$query = "
		SELECT * FROM account_detail
		WHERE accdetailsid='".$id."';
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



	if($form_data->action == 'getcourierinfo'){
		$id = $form_data->id;

		$query = "
		SELECT * FROM couriers
		WHERE courierid='".$id."'
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


	if($form_data->action == 'getcustomerinfo'){
		$id = $form_data->id;

		$query = "
		SELECT * FROM customer
		WHERE customerid='".$id."'
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

	if($form_data->action == 'getBrandlist'){

		$query = "SELECT * FROM brands ORDER BY datecreated ASC";
		$statement = $connect->prepare($query);
		if($statement->execute())
        {
            $message = 'success';
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
        }else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message,
			'data' => $data
		);
	}


	if($form_data->action == 'getBrandInfo'){
		$id = $form_data->id;

		$query = "
		SELECT * FROM brands
		WHERE brandid ='".$id."'
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



	if($form_data->action == 'getSupplierlist'){

		$query = "SELECT * FROM suppliers ORDER BY datecreated ASC";
		$statement = $connect->prepare($query);
		if($statement->execute())
        {
			$message = 'success';
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
        }else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message,
			'data' => $data
		);
	}

	if($form_data->action == 'getSizelist'){

		$query = "SELECT * FROM sizes ORDER BY datecreated ASC";
		$statement = $connect->prepare($query);
		if($statement->execute())
        {
			$message = 'success';
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
        }else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message,
			'data' => $data
		);
	}

	if($form_data->action == 'getcategColor'){

		$query = "SELECT * FROM category_color WHERE categoryid = '".$form_data->categoryid."' ORDER BY datecreated ASC";
		$statement = $connect->prepare($query);
		if($statement->execute())
        {
			$message = 'success';
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
        }else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message,
			'data' => $data
		);
	}

	if($form_data->action == 'loadFormcolorList'){

		$query = "SELECT category_color.*, snldata.path
		FROM category_color 
		LEFT JOIN snldata on category_color.color_guid = snldata.itemid
		WHERE category_color.categoryid = '".$form_data->categoryid."' 
		ORDER BY category_color.datecreated ASC";
		$result = $conn->query($query) or die($conn->error . __LINE__);

		$fetch_data = [];
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$fetch_data[] = $row;
			}
		}

		if($result){
			$message = 'success';
		}else{
			$message = 'error';
		}

		$output = array(
			'message'	=>	$message,
			'data' => $fetch_data
		);
	}

	if($form_data->action == 'addcategorycolor'){

		$cguid = $genid;

		$query = "INSERT INTO category_color (color_guid,categoryid, color)VALUES('".$cguid."','".$form_data->categoryid."','".$form_data->desc."')";
		$result = $conn->query($query) or die($conn->error . __LINE__);

		$querydata = "UPDATE snldata SET itemid = '".$cguid."' WHERE itemid = 'temp'";
		$resultdata = $conn->query($querydata) or die($conn->error . __LINE__);

		if($result){
			$message = 'success';
		}else{
			$message = 'error';
		}

		$output = array(
			'message'	=>	$message,
			'data'	=>	$resultdata
		);
	}

	if($form_data->action == 'savecategorycolor'){

		$query = "UPDATE category_color SET color = '".$form_data->desc."' WHERE id = '".$form_data->colorid."'";
		$result = $conn->query($query) or die($conn->error . __LINE__);

		if($result){
			$message = 'success';
		}else{
			$message = 'error';
		}

		$output = array(
			'message'	=>	$message
		);
	}

	if($form_data->action == 'deletecategorycolor'){

		$query = "DELETE FROM category_color WHERE id = '".$form_data->id."'";
		$result = $conn->query($query) or die($conn->error . __LINE__);

		if($result){
			$message = 'success';
		}else{
			$message = 'error';
		}

		$output = array(
			'message'	=>	$message
		);
	}

	if($form_data->action == 'getSupplierInfo'){
		$id = $form_data->id;

		$query = "
		SELECT * FROM suppliers
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





	if($form_data->action == 'Adduser'){
		$validation = [];
		if($form_data->password != $form_data->password2){
			$validation['passmatch'] = true;
		}
		if(empty($validation != [])){
			$data = array(
				':user_id'     		=>	$genid,
				':username'     	=>	$form_data->username,
				':firstname'    	=>	$form_data->firstname,
				':lastname'			=>	$form_data->lastname,
				':password'     	=>	$form_data->password,
				':address'     		=>	$form_data->address,
				':contactnumber'    =>	$form_data->contactnumber,
				':email'     		=>	$form_data->email

			);
			$query = "
			INSERT INTO user 
				(user_id, username, firstname, lastname, password, address, contactnumber, email) VALUES 
				(:user_id, :username, :firstname, :lastname, md5(:password), :address, :contactnumber, :email)
			";
			$statement = $connect->prepare($query);

			// ROLE DATA
			$data2 = array(
				':user_id'     		=>	$genid,
				':customerorder'    	=>	$form_data->customerorder,
				':supplierorder'    	=>	$form_data->supplierorder,
				':stockmanagement'		=>	$form_data->stockmanagement,
				':addstock'     		=>	$form_data->addstock,
				':deletestock'     		=>	$form_data->deletestock,
				':productmanagement'	=>	$form_data->productmanagement,
				':addcategories'    	=>	$form_data->addcategories,
				':deletecategories'    	=>	$form_data->deletecategories,
				':addbrands'    		=>	$form_data->addbrands,
				':deletebrands'    		=>	$form_data->deletebrands,
				':addsuppliers'    		=>	$form_data->addsuppliers,
				':deletesuppliers'    	=>	$form_data->deletesuppliers,
				':addcouriers'    		=>	$form_data->addcategories,
				':deletecouriers'    	=>	$form_data->deletecouriers,
				':systemusers'    		=>	$form_data->systemusers,
				':report'    			=>	$form_data->report,
				':dashboard'    		=>	$form_data->dashboard,
				':categoriesmanagement' =>	$form_data->categoriesmanagement,
				':brandsmanagement'    	=>	$form_data->brandsmanagement,
				':suppliersmanagement'  =>	$form_data->suppliersmanagement,
				':couriersmanagement'   =>	$form_data->couriersmanagement,
				':auditlogs'    		=>	$form_data->auditlogs,
				':customermanagement'   =>	$form_data->customermanagement,
				':addcustomer'    		=>	$form_data->addcustomer,
				':deletecustomer'    	=>	$form_data->deletecustomer,
				':accessdrafts'    		=>	$form_data->accessdrafts,
				':settings'    			=>	$form_data->settings,
				':platform'    			=>	$form_data->platform,
				':size'    				=>	$form_data->size,
				':modeofpayment'    	=>	$form_data->modeofpayment,
				':editvatvalue'    		=>	$form_data->editvatvalue,
				':creditcard'    		=>	$form_data->creditcard,
				':expenses'    			=>	$form_data->expenses,
				':expensecategory'    	=>	$form_data->expensecategory,
				':sizes'    			=>	$form_data->sizes

			);

			// ROLE QUERY
			$query2 = "
			INSERT INTO roles 
				(user_id, customerorder, supplierorder, stockmanagement, addstock, deletestock, productmanagement, addcategories, deletecategories, addbrands, deletebrands, addsuppliers, deletesuppliers, addcouriers, deletecouriers, systemusers, report, dashboard, categoriesmanagement, brandsmanagement, suppliersmanagement, couriersmanagement, auditlogs, customermanagement, addcustomer, deletecustomer, accessdrafts, settings, platform, modeofpayment, editvatvalue, creditcard, expenses, expensecategory, sizes) VALUES 
				(:user_id, :customerorder, :supplierorder, :stockmanagement, :addstock, :deletestock, :productmanagement, :addcategories, :deletecategories, :addbrands, :deletebrands, :addsuppliers, :deletesuppliers, :addcouriers, :deletecouriers, :systemusers, :report, :dashboard, :categoriesmanagement, :brandsmanagement, :suppliersmanagement, :couriersmanagement, :auditlogs, :customermanagement, :addcustomer, :deletecustomer, :accessdrafts, :settings, :platform, :modeofpayment, :editvatvalue, :creditcard, :expenses, :expensecategory, :sizes)
			";
			$statement2 = $connect->prepare($query2);
			if($statement->execute($data) && $statement2->execute($data2))
			{
				$message = 'success';
			}else{
				$message = 'error';
			}
		}else{
			$message = 'password';
		}
		$output = array(
			'message' => $message,
			'validation' => $validation,
		);
	}

	if($form_data->action == 'updateuser'){
		$data = array(
			':user_id'     		=>	$form_data->user_id,
			':username'     	=>	$form_data->username,
			':firstname'    	=>	$form_data->firstname,
			':lastname'			=>	$form_data->lastname,
			':address'     		=>	$form_data->address,
			':contactnumber'    =>	$form_data->contactnumber,
			':email'     		=>	$form_data->email

		);
		$query = "
		UPDATE user 
			SET username = :username, firstname = :firstname, lastname = :lastname, address = :address, contactnumber = :contactnumber, email = :email
		WHERE user_id = :user_id";
		$statement = $connect->prepare($query);

		// ROLE DATA
		$data2 = array(
			':user_id'     			=>	$form_data->user_id,
			':customerorder'    	=>	$form_data->customerorder,
			':supplierorder'    	=>	$form_data->supplierorder,
			':stockmanagement'		=>	$form_data->stockmanagement,
			':addstock'     		=>	$form_data->addstock,
			':deletestock'     		=>	$form_data->deletestock,
			':productmanagement'	=>	$form_data->productmanagement,
			':addcategories'    	=>	$form_data->addcategories,
			':deletecategories'    	=>	$form_data->deletecategories,
			':addbrands'    		=>	$form_data->addbrands,
			':deletebrands'    		=>	$form_data->deletebrands,
			':addsuppliers'    		=>	$form_data->addsuppliers,
			':deletesuppliers'    	=>	$form_data->deletesuppliers,
			':addcouriers'    		=>	$form_data->addcategories,
			':deletecouriers'    	=>	$form_data->deletecouriers,
			':systemusers'    		=>	$form_data->systemusers,
			':report'    			=>	$form_data->report,
			':dashboard'    		=>	$form_data->dashboard,
			':categoriesmanagement' =>	$form_data->categoriesmanagement,
			':brandsmanagement'    	=>	$form_data->brandsmanagement,
			':suppliersmanagement'  =>	$form_data->suppliersmanagement,
			':couriersmanagement'   =>	$form_data->couriersmanagement,
			':auditlogs'    		=>	$form_data->auditlogs,
			':customermanagement'   =>	$form_data->customermanagement,
			':addcustomer'    		=>	$form_data->addcustomer,
			':deletecustomer'    	=>	$form_data->deletecustomer,
			':accessdrafts'    		=>	$form_data->accessdrafts,
			':settings'    			=>	$form_data->settings,
			':platform'    			=>	$form_data->platform,
			':size'    				=>	$form_data->size,
			':modeofpayment'    	=>	$form_data->modeofpayment,
			':editvatvalue'    		=>	$form_data->editvatvalue,
			':creditcard'    		=>	$form_data->creditcard,
			':expenses'    			=>	$form_data->expenses,
			':expensecategory'    	=>	$form_data->expensecategory,
			':sizes'    			=>	$form_data->sizes

		);

		// ROLE QUERY
		$query2 = "
		UPDATE roles 
			SET customerorder = :customerorder, supplierorder = :supplierorder, stockmanagement = :stockmanagement, addstock = :addstock, deletestock = :deletestock, productmanagement = :productmanagement, addcategories = :addcategories, deletecategories = :deletecategories, addbrands = :addbrands, deletebrands = :deletebrands, addsuppliers = :addsuppliers, deletesuppliers = :deletesuppliers, addcouriers = :addcouriers, deletecouriers = :deletecouriers, systemusers = :systemusers, report = :report, dashboard = :dashboard, categoriesmanagement = :categoriesmanagement, brandsmanagement = :brandsmanagement, suppliersmanagement = :suppliersmanagement, couriersmanagement = :couriersmanagement, auditlogs = :auditlogs, customermanagement = :customermanagement, addcustomer = :addcustomer, deletecustomer = :deletecustomer, accessdrafts = :accessdrafts, settings = :settings, platform = :platform, modeofpayment = :modeofpayment, editvatvalue = :editvatvalue, creditcard = :creditcard, expenses = :expenses, expensecategory = :expensecategory, sizes = :sizes
		WHERE user_id = :user_id";
		$statement2 = $connect->prepare($query2);
		if($statement->execute($data) && $statement2->execute($data2))
		{
			$message = 'success';
		}else{
			$message = 'error';
		}
		$output = array(
			'message' => $message
		);
	}

	if($form_data->action == 'login'){

		$username = $form_data->username;
		$password = md5($form_data->password);

		$query = "SELECT * FROM user WHERE username='".$username."' AND password='".$password."'";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$count = $statement->rowCount();

		if($count > 0){
			session_start();
			foreach($result as $row){
				$_SESSION['user_id'] = $row['user_id'];
			}

			$message = 'success';
		}else{
			$message = 'error';
		}

		$output = array(
			'message'	=>	$message
		);
	}

	// Fetch user list 
	if($form_data->action == 'fetchlist'){

		$query = "SELECT user_id, username, firstname, lastname, address, contactnumber, email FROM user ORDER BY datecreated ASC";
		$statement = $connect->prepare($query);
		if($statement->execute())
        {
            $message = 'success';
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
        }else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message,
			'data' => $data
		);
	}

	// Edit user
	if($form_data->action == 'edituser'){

		$id = $form_data->id;

		$query = "SELECT *, md5(user.password) FROM user, roles WHERE user.user_id = roles.user_id AND user.user_id = '".$id."' ORDER BY user.datecreated ASC";
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
	

	if($form_data->action == 'editcreditcard'){

		$id = $form_data->id;

		$query = "SELECT * FROM creditcard WHERE creditcardid = '".$id."'";
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
	if($form_data->action == 'editcategexp'){

		$id = $form_data->id;

		$query = "SELECT * FROM category_exp WHERE categexpid = '".$id."'";
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


	if($form_data->action == 'editplatform'){

		$id = $form_data->id;

		$query = "SELECT * FROM platform WHERE platformid = '".$id."'";
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

	if($form_data->action == 'editsize'){

		$id = $form_data->id;

		$query = "SELECT * FROM sizes WHERE sizeid = '".$id."'";
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

	if($form_data->action == 'editvat'){

		$sys_name = $form_data->sys_name;

		$query = "SELECT * FROM system_setting WHERE sys_name = '".$sys_name."'";
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

	if($form_data->action == 'updateVat'){
		$data = array(
			':sys_name'     	=>	$form_data->sys_name,
			':sys_value'     	=>	$form_data->sys_value,
		);
		$query = "
		UPDATE system_setting 
		SET sys_value = :sys_value
		WHERE sys_name = :sys_name";
		$statement = $connect->prepare($query);

		if($statement->execute($data))
		{
			$message = 'success';
		}else{
			$message = 'error';
		}
		$output = array(
			'message' => $message
		);
	}

	if($form_data->action == 'updatePlatform'){
		$data = array(
			':platformid'     	=>	$form_data->platformid,
			':platform'     	=>	$form_data->platform,
		);
		$query = "
		UPDATE platform 
			SET platform = :platform
		WHERE platformid = :platformid";
		$statement = $connect->prepare($query);

		if($statement->execute($data))
		{
			$message = 'success';
		}else{
			$message = 'error';
		}
		$output = array(
			'message' => $message
		);
	}

	if($form_data->action == 'updateSize'){
		$data = array(
			':sizeid'     	=>	$form_data->sizeid,
			':size'     	=>	$form_data->size,
		);
		$query = "
		UPDATE sizes 
			SET size = :size
		WHERE sizeid = :sizeid";
		$statement = $connect->prepare($query);

		if($statement->execute($data))
		{
			$message = 'success';
		}else{
			$message = 'error';
		}
		$output = array(
			'message' => $message
		);
	}

	if($form_data->action == 'updateCategexpense'){
		$data = array(
			':categexpid'     	=>	$form_data->categexpid,
			':categexptype'     =>	$form_data->categexptype,
			':detailtype'     	=>	$form_data->detailtype,
			':categexpname'     =>	$form_data->categexpname,
			':categexdesc'     	=>	$form_data->categexdesc,
		);
		$query = "
		UPDATE category_exp 
		SET 
		categexptype = :categexptype, 
		detailtype   = :detailtype, 
		categexpname = :categexpname, 
		categexdesc  = :categexdesc
		WHERE categexpid = :categexpid";
		$statement = $connect->prepare($query);

		if($statement->execute($data))
		{
			$message = 'success';
		}else{
			$message = 'error';
		}
		$output = array(
			'message' => $message
		);
	}



	if($form_data->action == 'updateCreditcard'){
		$data = array(
			':creditcardid'     =>	$form_data->creditcardid,
			':creditcard'     	=>	$form_data->creditcard,
		);
		$query = "
		UPDATE creditcard 
			SET creditcard = :creditcard
		WHERE creditcardid = :creditcardid";
		$statement = $connect->prepare($query);

		if($statement->execute($data))
		{
			$message = 'success';
		}else{
			$message = 'error';
		}
		$output = array(
			'message' => $message
		);
	}

	


	if($form_data->action == 'editmodeofpayment'){

		$id = $form_data->id;

		$query = "SELECT * FROM modeofpayment WHERE mopid = '".$id."'";
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

	if($form_data->action == 'updateModeofpayment'){
		$data = array(
			':mopid'     		=>	$form_data->mopid,
			':modeofpayment'     	=>	$form_data->modeofpayment,
		);
		$query = "
		UPDATE modeofpayment 
			SET modeofpayment = :modeofpayment
		WHERE mopid = :mopid";
		$statement = $connect->prepare($query);

		if($statement->execute($data))
		{
			$message = 'success';
		}else{
			$message = 'error';
		}
		$output = array(
			'message' => $message
		);
	}

	if($form_data->action == 'editcategory'){

		$id = $form_data->id;

		$query = "SELECT * FROM category WHERE categoryid = '".$id."'";
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

	if($form_data->action == 'updateCategory'){
		$data = array(
			':categoryid'     		=>	$form_data->categoryid,
			':categorydesc'     	=>	$form_data->categorydesc,
		);
		$query = "
		UPDATE category 
			SET categorydesc = :categorydesc
		WHERE categoryid = :categoryid";
		$statement = $connect->prepare($query);

		if($statement->execute($data))
		{
			$message = 'success';
		}else{
			$message = 'error';
		}
		$output = array(
			'message' => $message
		);
	}

	if($form_data->action == 'updateCustomerorder'){
		$data = array(
			':customerorderid'  =>	$form_data->customerorderid,
			':ordernumber'     	=>	$form_data->ordernumber,                                          
			':platformid'     	=>	$form_data->platformid,
			':mopid'     	    =>	$form_data->mopid,
			':courierid'     	=>	$form_data->courierid,
			':productid'     	=>	$form_data->productid,
			':supplierid'     	=>	$form_data->supplierid,
			':quantity'     	=>	$form_data->quantity,
			':shippingfee'     	=>	$form_data->shippingfee,
			':shippingdate'     	=>	$form_data->shippingdate,
			':purchasedate'     	=>	$form_data->purchasedate,
			':totalamountdollar'    =>	$form_data->totalamountdollar,
			':totalamountpesos'     =>	$form_data->totalamountpesos,
			':exchangerate'     	=>	$form_data->exchangerate,
			':remarks'     	=>	$form_data->remarks,
			':dateupdated'     	=>	$form_data->dateupdated
		);
		$query = "
		UPDATE customerorder 
			SET 
			ordernumber = :ordernumber,
			platformid = :platformid,
			mopid = :mopid,
			courierid = :courierid,
			productid = :productid,
			supplierid = :supplierid,
			quantity = :quantity,
			shippingfee = :shippingfee,
			shippingdate = :shippingdate,
			purchasedate = :purchasedate,
			totalamountdollar = :totalamountdollar,
			totalamountpesos = :totalamountpesos,
			exchangerate = :exchangerate,
			remarks = :remarks,
			dateupdated = :dateupdated
			WHERE customerorderid = :customerorderid";
		$statement = $connect->prepare($query);

		if($statement->execute($data))
		{
			$message = 'success';
		}else{
			$message = 'error';
		}
		$output = array(
			'message' => $message
		);
	}


	if($form_data->action == 'editbrand'){

		$id = $form_data->id;

		$query = "SELECT * FROM brands WHERE brandid = '".$id."'";
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

	if($form_data->action == 'editaccount'){

		$id = $form_data->id;

		$query = "SELECT * FROM accounts WHERE accountid = '".$id."'";
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

	if($form_data->action == 'updateBrand'){
		$data = array(
			':brandid'     		=>	$form_data->brandid,
			':brandname'     	=>	$form_data->brandname,
			':branddesc'     	=>	$form_data->branddesc,
			':brandadd'     	=>	$form_data->brandadd,
			':brandcontactperson'     	=>	$form_data->brandcontactperson,
			':brandphonenum'     	=>	$form_data->brandphonenum,
			':brandemail'     	=>	$form_data->brandemail,
			':brandwebsite'     	=>	$form_data->brandwebsite,
		);
		$query = "
		UPDATE brands 
			SET brandname = :brandname, branddesc = :branddesc, brandadd = :brandadd, brandcontactperson = :brandcontactperson, brandphonenum = :brandphonenum, brandemail = :brandemail, brandwebsite = :brandwebsite
		WHERE brandid = :brandid";
		$statement = $connect->prepare($query);

		if($statement->execute($data))
		{
			$message = 'success';
		}else{
			$message = 'error';
		}
		$output = array(
			'message' => $message
		);
	}

	if($form_data->action == 'updateAccount'){
		$data = array(
			':accountid'     	=>	$form_data->accountid,
			':accountname'     	=>	$form_data->accountname,
			':acctypeid'     	=>	$form_data->acctypeid,
			':accdetailsid'     	=>	$form_data->accdetailsid,
			':currency'     	=>	$form_data->currency,
			':accbalance'     	=>	$form_data->accbalance,
			':balancedate'     	=>	$form_data->balancedate
		);
		$query = "
			UPDATE accounts 
			SET accountname = :accountname, 
			acctypeid = :acctypeid, 
			accdetailsid = :accdetailsid, 
			currency = :currency, 
			accbalance = :accbalance, 
			balancedate = :balancedate
			WHERE accountid = :accountid";
		$statement = $connect->prepare($query);
		if($statement->execute($data))
		{
			$message = 'success';
		}else{
			$message = 'error';
		}
		$output = array(
			'message' => $message
		);
	}


	if($form_data->action == 'editsupplier'){

		$id = $form_data->id;

		$query = "SELECT * FROM suppliers WHERE supplierid = '".$id."'";
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

	if($form_data->action == 'updateSupplier'){
		$data = array(
			':supplierid'     		=>	$form_data->supplierid,
			':suppliername'     	=>	$form_data->suppliername,
			':supplieraddress'     	=>	$form_data->supplieraddress,
			':scontactperson'     	=>	$form_data->scontactperson,
			':sphonenumber'     	=>	$form_data->sphonenumber,
			':semail'     	=>	$form_data->semail,
			':swebsite'     	=>	$form_data->swebsite,
		);
		$query = "
		UPDATE suppliers 
			SET suppliername = :suppliername, supplieraddress = :supplieraddress, scontactperson = :scontactperson, sphonenumber = :sphonenumber, semail = :semail, swebsite = :swebsite
		WHERE supplierid = :supplierid";
		$statement = $connect->prepare($query);

		if($statement->execute($data))
		{
			$message = 'success';
		}else{
			$message = 'error';
		}
		$output = array(
			'message' => $message
		);
	}


	if($form_data->action == 'updateSupplier'){
		$data = array(
			':supplierid'     		=>	$form_data->supplierid,
			':suppliername'     	=>	$form_data->suppliername,
			':supplieraddress'     	=>	$form_data->supplieraddress,
			':scontactperson'     	=>	$form_data->scontactperson,
			':sphonenumber'     	=>	$form_data->sphonenumber,
			':semail'     	=>	$form_data->semail,
			':swebsite'     	=>	$form_data->swebsite,
		);
		$query = "
		UPDATE suppliers 
		SET suppliername = :suppliername, supplieraddress = :supplieraddress, scontactperson = :scontactperson, sphonenumber = :sphonenumber, semail = :semail, swebsite = :swebsite
		WHERE supplierid = :supplierid";
		$statement = $connect->prepare($query);

		if($statement->execute($data))
		{
			$message = 'success';
		}else{
			$message = 'error';
		}
		$output = array(
			'message' => $message
		);
	}


	//stocks
	if($form_data->action == 'editstock'){

		$id = $form_data->id;

		$query = "SELECT * FROM stocks WHERE stocksid = '".$id."'";
		$statement = $connect->prepare($query);
		if($statement->execute())
		{
			$message = 'success';
			while($row = $statement->fetch(PDO::FETCH_ASSOC))
			{
				$checksql = "SELECT * FROM snldata WHERE module='stocks' AND itemid='".$row['guid']."'";
				$resultimg = $conn->query($checksql) or die($conn->error . __LINE__);
				$rowimg = $resultimg->fetch_assoc();

				if($resultimg->num_rows > 0){
					$row['imageurl'] = $rowimg['path'];
				}else{
					$row['imageurl'] = null;
				}
				$data[] = $row;
			}
		}else{
			$message = 'error';
		}
		$output = array(
			'message'	=>	$message,
			'data' => [
				"main" => $data[0],
			]
		);
	}

	if($form_data->action == 'updateStock'){
		$data = array(
			':stocksid'     	=>	$form_data->stocksid,
			':stockname'     	=>	$form_data->stockname,
			':categoryid'     	=>	$form_data->categoryid,
			':brandid'     		=>	$form_data->brandid,
			':supplierid'     	=>	$form_data->supplierid,
			':stockcolor'     	=>	$form_data->stockcolor,
			':sku'  		   	=>	$form_data->sku,
			':stocksize'     	=>	$form_data->stocksize,
			':availablestocks'     	=>	$form_data->availablestocks,
			':costperunit'     	=>	$form_data->costperunit,
			':unitprice'     	=>	$form_data->unitprice,
			':reorderpoint'     =>	$form_data->reorderpoint,
			':threshold'     	=>	$form_data->threshold
		);
		$query = "
		UPDATE stocks 
		SET stockname = :stockname, categoryid = :categoryid, brandid = :brandid, supplierid = :supplierid, stockcolor = :stockcolor,   sku = :sku, stocksize = :stocksize, availablestocks = :availablestocks, costperunit = :costperunit, unitprice = :unitprice, reorderpoint = :reorderpoint, threshold = :threshold
		WHERE stocksid = :stocksid";
		$statement = $connect->prepare($query);

		if($statement->execute($data))
		{
			$message = 'success';
		}else{
			$message = 'error';
		}
		$output = array(
			'message' => $message
		);
	}




	if($form_data->action == 'editcourier'){

		$id = $form_data->id;

		$query = "SELECT * FROM couriers WHERE courierid = '".$id."'";
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

	if($form_data->action == 'updateCourier'){
		$data = array(
			':courierid'     		=>	$form_data->courierid,
			':couriername'     	=>	$form_data->couriername,
			':courierbranch'     	=>	$form_data->courierbranch,
			':courierphonenum'     	=>	$form_data->courierphonenum,
			':courieremail'     	=>	$form_data->courieremail,
			':courierwebsite'     	=>	$form_data->courierwebsite,
		);
		$query = "
		UPDATE couriers 
			SET couriername = :couriername, courierbranch = :courierbranch, courierphonenum = :courierphonenum, courieremail = :courieremail, courierwebsite = :courierwebsite
		WHERE courierid = :courierid";
		$statement = $connect->prepare($query);

		if($statement->execute($data))
		{
			$message = 'success';
		}else{
			$message = 'error';
		}
		$output = array(
			'message' => $message
		);
	}

	if($form_data->action == 'editcustomer'){

		$id = $form_data->id;

		$query = "SELECT * FROM customer WHERE customerid = '".$id."'";
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
	if($form_data->action == 'updateCustomer'){
		$data = array(
			':customerid'     		=>	$form_data->customerid,
			':customerfirstname'     	=>	$form_data->customerfirstname,
			':customerlastname'     	=>	$form_data->customerlastname,
			':customerbname'     	=>	$form_data->customerbname,
			':cbillingaddress'     	=>	$form_data->cbillingaddress,
			':cshippingaddress'     	=>	$form_data->cshippingaddress,
			':cphonenumber'     	=>	$form_data->cphonenumber,
			':cemailaddress'     	=>	$form_data->cemailaddress,
		);
		$query = "
		UPDATE customer 
			SET customerfirstname = :customerfirstname, customerlastname = :customerlastname, customerbname = :customerbname, cbillingaddress = :cbillingaddress, cshippingaddress = :cshippingaddress, cphonenumber = :cphonenumber, cemailaddress = :cemailaddress
		WHERE customerid = :customerid";
		$statement = $connect->prepare($query);

		if($statement->execute($data))
		{
			$message = 'success';
		}else{
			$message = 'error';
		}
		$output = array(
			'message' => $message
		);
	}


	if($form_data->action == 'viewData'){

		$id = $form_data->id;

		$query = "SELECT * FROM user, roles WHERE user.user_id = roles.user_id AND user.user_id = '".$id."' ORDER BY user.datecreated ASC";
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

	if($form_data->action == 'deleteuser'){

		$id = $form_data->id;

		$query = "
		DELETE FROM user WHERE user_id='".$form_data->id."'
		";
		$statement = $connect->prepare($query);
		$query2 = "
		DELETE FROM roles WHERE user_id='".$form_data->id."'
		";
		$statement2 = $connect->prepare($query2);
		if($statement->execute() || $statement2->execute()){
			$message = 'success';
		}else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message
		);
	}


/* -----------------------------------------------------------------------------------  */
/* -----------------------------------------------------------------------------------  */
/* --------------------------------------- KHENARD CODE ------------------------------  */
/* -----------------------------------------------------------------------------------  */
/* -----------------------------------------------------------------------------------  */


if($form_data->action == 'viewbrandData'){

	$id = $form_data->id;

	$query = "SELECT * FROM brands WHERE brands.brandid = '".$id."' ORDER BY brands.datecreated ASC";
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

if($form_data->action == 'viewaccountData'){

	$id = $form_data->id;

	$query = "SELECT 
	accounts.accountname,
	account_type.accounttype,
	account_detail.accdetails,
	accounts.currency, 
	accounts.accbalance, 
	accounts.balancedate
	FROM accounts
	LEFT JOIN account_type ON accounts.acctypeid = account_type.acctypeid
	LEFT JOIN account_detail ON accounts.accdetailsid = account_detail.accdetailsid
	WHERE accounts.accountid = '".$id."'";
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


if($form_data->action == 'viewcourierData'){

	$id = $form_data->id;

	$query = "SELECT * FROM couriers WHERE courierid = '".$id."' ORDER BY datecreated ASC";
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



	if($form_data->action == 'viewData'){

		$id = $form_data->id;

		$query = "SELECT * FROM user, roles WHERE user.user_id = roles.user_id AND user.user_id = '".$id."' ORDER BY user.datecreated ASC";
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


if($form_data->action == 'viewsupplierData'){

	$id = $form_data->id;

	$query = "SELECT * FROM suppliers WHERE suppliers.supplierid = '".$id."' ORDER BY suppliers.datecreated ASC";
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


if($form_data->action == 'viewstocksData'){

	$id = $form_data->id;

	$query = "SELECT * FROM stocks WHERE stocksid = '".$id."' ORDER BY datecreated ASC";
	$statement = $connect->prepare($query);
	if($statement->execute())
	{
		$message = 'success';
		$data = $statement->fetch(PDO::FETCH_ASSOC);
	}else{
		$message = 'error';
	}

	$checksql = "SELECT * FROM snldata WHERE module='stocks' AND itemid='".$form_data->guid."'";
	$resultimg = $conn->query($checksql) or die($conn->error . __LINE__);
	$rowimg = $resultimg->fetch_assoc();

	if($resultimg->num_rows > 0){
		$image = $rowimg['path'];
	}else{
		$image = null;
	}

	$output = array(
		'message'	=>	$message,
		'data' => $data,
		'img' => $image
	);
}


if($form_data->action == 'viewcustomerData'){

	$id = $form_data->id;

	$query = "SELECT * FROM customer WHERE customerid = '".$id."' ORDER BY datecreated ASC";
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



if($form_data->action == 'viewcourierData'){

	$id = $form_data->id;

	$query = "SELECT * FROM couriers WHERE courierid = '".$id."' ORDER BY datecreated ASC";
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


	//add category
	if($form_data->action == 'addCategory'){
		$data = array(
			':categorydesc'	=>	$form_data->categorydesc

		);
		$query = "
		INSERT INTO category
			(categorydesc) VALUES 
			(:categorydesc)
		";
		$statement = $connect->prepare($query);

		if($statement->execute($data))
		{
			$message = 'success';
		}else{
			$message = 'error';
		}
		$output = array(
			'message'	=>	$message
		);
	}
	
//add platform
if($form_data->action == 'addPlatform'){
	$data = array(
		':platform'	=>	$form_data->platform

	);
	$query = "
	INSERT INTO platform
		(platform) VALUES 
		(:platform)
	";
	$statement = $connect->prepare($query);

	if($statement->execute($data))
	{
		$message = 'success';
	}else{
		$message = 'error';
	}
	$output = array(
		'message'	=>	$message
	);
}

//add size
if($form_data->action == 'addSize'){
	$data = array(
		':size'	=>	$form_data->size

	);
	$query = "
	INSERT INTO sizes
		(size) VALUES 
		(:size)
	";
	$statement = $connect->prepare($query);

	if($statement->execute($data))
	{
		$message = 'success';
	}else{
		$message = 'error';
	}
	$output = array(
		'message'	=>	$message
	);
}

//add category exp
if($form_data->action == 'addCategoryexpense'){
	$data = array(
		':categexptype'	=>	$form_data->categexptype,
		':detailtype'	=>	$form_data->detailtype,
		':categexpname'	=>	$form_data->categexpname,
		':categexdesc'	=>	$form_data->categexdesc

	);
	$query = "
	INSERT INTO category_exp
		(categexptype, detailtype, categexpname, categexdesc) VALUES 
		(:categexptype, :detailtype, :categexpname, :categexdesc)
	";
	$statement = $connect->prepare($query);

	if($statement->execute($data))
	{
		$message = 'success';
	}else{
		$message = 'error';
	}
	$output = array(
		'message'	=>	$message
	);
}


//add credit card
if($form_data->action == 'addCreditcard'){
	$data = array(
		':creditcard'	=>	$form_data->creditcard

	);
	$query = "
	INSERT INTO creditcard
		(creditcard) VALUES 
		(:creditcard)
	";
	$statement = $connect->prepare($query);

	if($statement->execute($data))
	{
		$message = 'success';
	}else{
		$message = 'error';
	}
	$output = array(
		'message'	=>	$message
	);
}


//add mode of payment
if($form_data->action == 'addModeofpayment'){
	$data = array(
		':modeofpayment'	=>	$form_data->modeofpayment

	);
	$query = "
	INSERT INTO modeofpayment
		(modeofpayment) VALUES 
		(:modeofpayment)
	";
	$statement = $connect->prepare($query);

	if($statement->execute($data))
	{
		$message = 'success';
	}else{
		$message = 'error';
	}
	$output = array(
		'message'	=>	$message
	);
}


//add brand
if($form_data->action == 'addCustomer'){
	$data = array(
		':customerguid' => $genid,
		':customerfirstname'	=>	$form_data->customerfirstname,
		':customerlastname'	=>	$form_data->customerlastname,
		':customerbname'	=>	$form_data->customerbname,
		':cbillingaddress'	=>	$form_data->cbillingaddress,
		':cshippingaddress'	=>	$form_data->cshippingaddress,
		':cphonenumber'	=>	$form_data->cphonenumber,
		':cemailaddress'	=>	$form_data->cemailaddress

	);
	
	$query = "
	INSERT INTO customer
		(customerguid, customerfirstname, customerlastname, customerbname,  cbillingaddress, cshippingaddress, cphonenumber, cemailaddress) VALUES 
		(:customerguid, :customerfirstname, :customerlastname, :customerbname, :cbillingaddress, :cshippingaddress, :cphonenumber, :cemailaddress)
	";
	$statement = $connect->prepare($query);

	if($statement->execute($data))
	{
		$message = 'success';
	}else{
		$message = 'error';
	}
	$output = array(
		'message'	=>	$message
	);
}

//add accpunts
if($form_data->action == 'addAccount'){
	$data = array(
		':accountname'	=>	$form_data->accountname,
		':acctypeid'	=>	$form_data->acctypeid,
		':accdetailsid'	=>	$form_data->accdetailsid,
		':currency'	=>	$form_data->currency,
		':accbalance'	=>	$form_data->accbalance,
		':balancedate'	=>	$form_data->balancedate
	);
	
	$query = "
	INSERT INTO accounts
		(accountname, acctypeid, accdetailsid, currency, accbalance, balancedate) VALUES 
		(:accountname, :acctypeid, :accdetailsid, :currency, :accbalance, :balancedate)
	";
	$statement = $connect->prepare($query);

	if($statement->execute($data))
	{
		$message = 'success';
	}else{
		$message = 'error';
	}
	$output = array(
		'message'	=>	$message
		
	);
}


if($form_data->action == 'deleteaccount'){
	$id = $form_data->id;
	$query = "
	DELETE FROM accounts WHERE accountid='".$form_data->id."'
	";
	$statement = $connect->prepare($query);
	if($statement->execute()){
		$message = 'success';
	}else{
		$message = 'error';
	}

	$output = array(
		'message'	=>	$message
	);
}





	//add brand
	if($form_data->action == 'addBrand'){
		$data = array(
			':brandname'	=>	$form_data->brandname,
			':branddesc'	=>	$form_data->branddesc,
			':brandadd'	=>	$form_data->brandadd,
			':brandcontactperson'	=>	$form_data->brandcontactperson,
			':brandphonenum'	=>	$form_data->brandphonenum,
			':brandemail'	=>	$form_data->brandemail,
			':brandwebsite'	=>	$form_data->brandwebsite

		);
		
		$query = "
		INSERT INTO brands
			(brandname, branddesc, brandadd, brandcontactperson, brandphonenum, brandemail, brandwebsite) VALUES 
			(:brandname, :branddesc, :brandadd, :brandcontactperson, :brandphonenum, :brandemail, :brandwebsite)
		";
		$statement = $connect->prepare($query);

		if($statement->execute($data))
		{
			$message = 'success';
		}else{
			$message = 'error';
		}
		$output = array(
			'message'	=>	$message
			
		);
	}

	if($form_data->action == 'deletebrand'){

		$id = $form_data->id;

		$query = "
		DELETE FROM brands WHERE brandid='".$form_data->id."'
		";
		$statement = $connect->prepare($query);
		if($statement->execute()){
			$message = 'success';
		}else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message
		);
	}

	if($form_data->action == 'deletecustomer'){

		$id = $form_data->id;

		$query = "
		DELETE FROM customer WHERE customerid='".$form_data->id."'
		";
		$statement = $connect->prepare($query);
		if($statement->execute()){
			$message = 'success';
		}else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message
		);
	}
	if($form_data->action == 'deletestock'){

		$id = $form_data->id;

		$query = "
		DELETE FROM stocks WHERE stocksid='".$form_data->id."'
		";
		$statement = $connect->prepare($query);
		if($statement->execute()){
			$message = 'success';
		}else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message
		);
	}
	//add courier
	if($form_data->action == 'addCourier'){
		$data = array(
			':couriername'	=>	$form_data->couriername,
			':courierbranch'	=>	$form_data->courierbranch,
			':courierphonenum'	=>	$form_data->courierphonenum,
			':courieremail'	=>	$form_data->courieremail,
			':courierwebsite'	=>	$form_data->courierwebsite,
		);
		$query1 = "
		INSERT INTO couriers
			(couriername, courierbranch, courierphonenum, courieremail, courierwebsite) VALUES 
			(:couriername, :courierbranch, :courierphonenum, :courieremail, :courierwebsite)
		";
		$statement = $connect->prepare($query1);

		if($statement->execute($data))
		{
			$message = 'success';
		}else{
			$message = 'error';
		}
		$output = array(
			'message'	=>	$message
		);
	}

	if($form_data->action == 'addStock'){  
		$ropdate = date('mm-dd-yyyy', strtotime($form_data->reorderpoint));
		$data = array(
			':guid'			=>	$form_data->guid,
			':stockname'	=>	$form_data->stockname,
			':categoryid'	=>	$form_data->categoryid,
			':brandid'		=>	$form_data->brandid,
			':supplierid'	=>	$form_data->supplierid,
			':stockcolor'	=>	$form_data->stockcolor,
			':stocksize'	=>	$form_data->stocksize,
			':sku'			=>	$form_data->sku,
			':costperunit'	=>	$form_data->costperunit,
			':reorderpoint'	=>	$form_data->reorderpoint,
			':threshold'	=>	$form_data->threshold
		);
		$query1 = "
		INSERT INTO stocks
			(guid, stockname, categoryid, brandid, supplierid, stockcolor, stocksize, sku, costperunit, reorderpoint, threshold) VALUES 
			(:guid, :stockname, :categoryid, :brandid, :supplierid, :stockcolor, :stocksize, :sku, :costperunit, :reorderpoint, :threshold)
		";
		$statement = $connect->prepare($query1);

		if($statement->execute($data))
		{
			$message = 'success';
		}else{
			$message = 'error';
		}
		$output = array(
			'message'	=>	$message
		);
	}

	//add supplier
	if($form_data->action == 'addSupplier'){
		$data = array(
			':supplierguid' => $genid,
			':suppliername'	=>	$form_data->suppliername,
			':supplieraddress'	=>	$form_data->supplieraddress,
			':scontactperson'	=>	$form_data->scontactperson,
			':sphonenumber'	=>	$form_data->sphonenumber,
			':semail'	=>	$form_data->semail,
			':swebsite'	=>	$form_data->swebsite,
		);
		$query1 = "
		INSERT INTO suppliers
			(supplierguid, suppliername, supplieraddress, scontactperson, sphonenumber, semail, swebsite) VALUES 
			(:supplierguid, :suppliername, :supplieraddress, :scontactperson, :sphonenumber, :semail, :swebsite)
		";
		$statement = $connect->prepare($query1);

		if($statement->execute($data))
		{
			$message = 'success';
		}else{
			$message = 'error';
		}
		$output = array(
			'message'	=>	$message
		);
	}




	//add customer
	if($form_data->action == 'customerAdd'){
		$data = array(
			':customerfirstname'	=>	$form_data->customerfirstname,
			':customerlastname'	=>	$form_data->customerfirstname,
			':cshippingaddress'	=>	$form_data->cshippingaddress,
			':cphonenumber'	=>	$form_data->cphonenumber,
			':cemailaddress'	=>	$form_data->cemailaddress,
		);
		$query1 = "
		INSERT INTO customer
			(customerfirstname, customerlastname, cshippingaddress, cphonenumber, cemailaddress) VALUES 
			(:customerfirstname, :customerlastname, :cshippingaddress, :cphonenumber, :cemailaddress)
		";
		$statement = $connect->prepare($query1);

		if($statement->execute($data))
		{
			$message = 'success';
		}else{
			$message = 'error';
		}
		$output = array(
			'message'	=>	$message
		);
	}
	
	if($form_data->action == 'deletecustomerorder'){

		$customerorderid = $form_data->customerorderid;

		$query3 = "SELECT * FROM customerorder where customerorderid = '".$form_data->customerorderid."'";
		$result = $conn->query($query3) or die($conn->error . __LINE__);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();

			$scount = 0;
			for($i = 1; $i<=$row['quantity']; $i++) {
				$query = "SELECT stockslist.* FROM stockslist 
				LEFT JOIN po_stock ON stockslist.pos_id = po_stock.pos_id
				LEFT JOIN po_main ON po_stock.pom_id = po_main.pom_id
				WHERE stockslist.available_qty < stockslist.purchased_qty AND po_stock.stocksid = '".$row['productid']."'
				ORDER BY po_main.purchasedate DESC LIMIT 1";
				$resultsl = $conn->query($query) or die($conn->error . __LINE__);

				if ($resultsl->num_rows > 0) {
					$rowsl = $resultsl->fetch_assoc();
					$queryfifo = "SELECT * FROM co_fifo where pos_id = '".$rowsl['pos_id']."'";
					$resultfifo = $conn->query($queryfifo) or die($conn->error . __LINE__);
					$rowfifo = $resultfifo->fetch_assoc();

					if ($resultfifo->num_rows > 0) {
						$queryufifo = "UPDATE co_fifo SET quantity = (quantity - 1) WHERE guid = '".$rowfifo['guid']."'";
						$resultufifo = $conn->query($queryufifo) or die($conn->error . __LINE__);
					}

					$queryusl = "UPDATE stockslist SET available_qty = (available_qty + 1) WHERE pos_id = '".$rowsl['pos_id']."'";
					$resultusl = $conn->query($queryusl) or die($conn->error . __LINE__);
				}

				$scount++;
			}
		}

		$query = "
		DELETE FROM customerorder WHERE customerorderid='".$form_data->customerorderid."'
		";
		$statement = $connect->prepare($query);
		if($statement->execute()){
			$message = 'success';
		}else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message,
			'updateqty' => $scount
		);
	}
	// Fetch courier list 
	if($form_data->action == 'fetchcourierlist'){

		$query = "SELECT courierid, couriername, courierbranch, courierphonenum, courieremail, courierwebsite FROM couriers ORDER BY datecreated ASC";
		$statement = $connect->prepare($query);
		if($statement->execute())
        {
            $message = 'success';
            while($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
        }else{
            $message = 'error';
        }

		$output = array(
			'message'	=>	$message,
			'data' => $data
		);
	}

// Fetch customer order list 
if($form_data->action == 'fetchcustomerorderlist'){

	$query = "SELECT * FROM customerorder WHERE customerorderid = '".$form_data->customerorderid."'";
	$statement = $connect->prepare($query);
	if($statement->execute())
	{
		$message = 'success';
		while($row = $statement->fetch(PDO::FETCH_ASSOC))
		{
			$data[] = $row;
		}
	}else{
		$message = 'error';
	}


	$output = array(
		'message'	=>	$message,
		'data' => [
			"main" => $data[0],
			// "stock" => $data1[0]
		]
	);
}



// Fetch category list 
if($form_data->action == 'fetchcategorylist'){

	$query = "SELECT categoryid, categorydesc FROM category ORDER BY datecreated ASC";
	$statement = $connect->prepare($query);
	if($statement->execute())
	{
		$message = 'success';
		while($row = $statement->fetch(PDO::FETCH_ASSOC))
		{
			$data[] = $row;
		}
	}else{
		$message = 'error';
	}

	$output = array(
		'message'	=>	$message,
		'data' => $data
	);
}

if($form_data->action == 'deletecategory'){

	$id = $form_data->id;

	$query = "
	DELETE FROM category WHERE categoryid='".$form_data->id."'
	";
	$statement = $connect->prepare($query);
	if($statement->execute()){
		$message = 'success';
	}else{
		$message = 'error';
	}

	$output = array(
		'message'	=>	$message
	);
}


if($form_data->action == 'deleteplatform'){

	$id = $form_data->id;

	$query = "
	DELETE FROM platform WHERE platformid='".$form_data->id."'
	";
	$statement = $connect->prepare($query);
	if($statement->execute()){
		$message = 'success';
	}else{
		$message = 'error';
	}

	$output = array(
		'message'	=>	$message
	);
}


if($form_data->action == 'deletesize'){

	$id = $form_data->id;

	$query = "
	DELETE FROM sizes WHERE sizeid='".$form_data->id."'
	";
	$statement = $connect->prepare($query);
	if($statement->execute()){
		$message = 'success';
	}else{
		$message = 'error';
	}

	$output = array(
		'message'	=>	$message
	);
}

if($form_data->action == 'deletecategexp'){

	$id = $form_data->id;

	$query = "
	DELETE FROM category_exp WHERE categexpid='".$form_data->id."'
	";
	$statement = $connect->prepare($query);
	if($statement->execute()){
		$message = 'success';
	}else{
		$message = 'error';
	}

	$output = array(
		'message'	=>	$message
	);
}

if($form_data->action == 'deletecreditcard'){

	$id = $form_data->id;

	$query = "
	DELETE FROM creditcard WHERE creditcardid='".$form_data->id."'
	";
	$statement = $connect->prepare($query);
	if($statement->execute()){
		$message = 'success';
	}else{
		$message = 'error';
	}

	$output = array(
		'message'	=>	$message
	);
}


if($form_data->action == 'deletemodeofpayment'){

	$id = $form_data->id;

	$query = "
	DELETE FROM modeofpayment WHERE mopid='".$form_data->id."'
	";
	$statement = $connect->prepare($query);
	if($statement->execute()){
		$message = 'success';
	}else{
		$message = 'error';
	}

	$output = array(
		'message'	=>	$message
	);
}

if($form_data->action == 'deletecourier'){

	$id = $form_data->id;

	$query = "
	DELETE FROM couriers WHERE courierid='".$form_data->id."'
	";
	$statement = $connect->prepare($query);
	if($statement->execute()){
		$message = 'success';
	}else{
		$message = 'error';
	}

	$output = array(
		'message'	=>	$message
	);
}

// Fetch Brand list 
if($form_data->action == 'fetchbrandlist'){

	$query = "SELECT * FROM brands ORDER BY datecreated ASC";
	$statement = $connect->prepare($query);
	if($statement->execute())
	{
		$message = 'success';
		while($row = $statement->fetch(PDO::FETCH_ASSOC))
		{
			$data[] = $row;
		}
	}else{
		$message = 'error';
	}

	$output = array(
		'message'	=>	$message,
		'data' => $data
	);
}




// Fetch suppliers list 
if($form_data->action == 'fetchsupplierlist'){

	$query = "SELECT * FROM suppliers ORDER BY datecreated ASC";
	$statement = $connect->prepare($query);
	if($statement->execute())
	{
		$message = 'success';
		while($row = $statement->fetch(PDO::FETCH_ASSOC))
		{
			$data[] = $row;
		}
	}else{
		$message = 'error';
	}

	$output = array(
		'message'	=>	$message,
		'data' => $data
	);
}


if($form_data->action == 'deletesupplier'){

	$id = $form_data->id;

	$query = "
	DELETE FROM suppliers WHERE supplierid='".$form_data->id."'
	";
	$statement = $connect->prepare($query);
	if($statement->execute()){
		$message = 'success';
	}else{
		$message = 'error';
	}

	$output = array(
		'message'	=>	$message
	);
}


// Fetch customer list 
if($form_data->action == 'fetchcustomerlist'){

	$query = "SELECT * FROM customer ORDER BY datecreated ASC";
	$statement = $connect->prepare($query);
	if($statement->execute())
	{
		$message = 'success';
		while($row = $statement->fetch(PDO::FETCH_ASSOC))
		{
			$data[] = $row;
		}
	}else{
		$message = 'error';
	}

	$output = array(
		'message'	=>	$message,
		'data' => $data
	);
}





if($form_data->action == 'saveCustomerOrder'){
	$coguid = generateId();

	if($form_data->customerorderid != ''){
		$query = "SELECT * FROM customerorder where customerorderid = '".$form_data->customerorderid."'";
		$result = $conn->query($query) or die($conn->error . __LINE__);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();

			if($row['quantity'] != $form_data->quantity){
				if($form_data->quantity > $row['quantity']){
					$cquantityfifo = $form_data->quantity - $row['quantity'];
					$scount = 0;
					for($i = 1; $i<=$cquantityfifo; $i++) {
						$query = "SELECT stockslist.* FROM stockslist 
						LEFT JOIN po_stock ON stockslist.pos_id = po_stock.pos_id
						LEFT JOIN po_main ON po_stock.pom_id = po_main.pom_id
						WHERE stockslist.available_qty != '0' AND po_stock.stocksid = '".$form_data->productid."'
						ORDER BY po_main.purchasedate ASC LIMIT 1";
						$result = $conn->query($query) or die($conn->error . __LINE__);

						if ($result->num_rows > 0) {
							$row = $result->fetch_assoc();
							$queryfifo = "SELECT * FROM co_fifo where pos_id = '".$row['pos_id']."'";
							$resultfifo = $conn->query($queryfifo) or die($conn->error . __LINE__);
							$rowfifo = $resultfifo->fetch_assoc();

							if ($resultfifo->num_rows > 0) {
								$queryufifo = "UPDATE co_fifo SET quantity = (quantity + 1) WHERE guid = '".$rowfifo['guid']."'";
								$resultufifo = $conn->query($queryufifo) or die($conn->error . __LINE__);
							}else{
								$fifoguid = generateId();
								$querycfifo = "INSERT INTO co_fifo (guid, customerorderguid, pos_id, quantity)VALUES('".$fifoguid."', '".$coguid."', '".$row['pos_id']."', '1')";
								$resultcfifo = $conn->query($querycfifo) or die($conn->error . __LINE__);
							}

							$queryusl = "UPDATE stockslist SET available_qty = (available_qty - 1) WHERE pos_id = '".$row['pos_id']."'";
							$resultusl = $conn->query($queryusl) or die($conn->error . __LINE__);
						}

						$scount++;
					}
				}else{
					$cquantityfifo = $row['quantity'] - $form_data->quantity;
					$scount = 0;
					for($i = 1; $i<=$cquantityfifo; $i++) {
						$query = "SELECT stockslist.* FROM stockslist 
						LEFT JOIN po_stock ON stockslist.pos_id = po_stock.pos_id
						LEFT JOIN po_main ON po_stock.pom_id = po_main.pom_id
						WHERE stockslist.available_qty < stockslist.purchased_qty AND po_stock.stocksid = '".$form_data->productid."'
						ORDER BY po_main.purchasedate DESC LIMIT 1";
						$result = $conn->query($query) or die($conn->error . __LINE__);

						if ($result->num_rows > 0) {
							$row = $result->fetch_assoc();
							$queryfifo = "SELECT * FROM co_fifo where pos_id = '".$row['pos_id']."'";
							$resultfifo = $conn->query($queryfifo) or die($conn->error . __LINE__);
							$rowfifo = $resultfifo->fetch_assoc();

							if ($resultfifo->num_rows > 0) {
								$queryufifo = "UPDATE co_fifo SET quantity = (quantity - 1) WHERE guid = '".$rowfifo['guid']."'";
								$resultufifo = $conn->query($queryufifo) or die($conn->error . __LINE__);
							}

							$queryusl = "UPDATE stockslist SET available_qty = (available_qty + 1) WHERE pos_id = '".$row['pos_id']."'";
							$resultusl = $conn->query($queryusl) or die($conn->error . __LINE__);
						}

						$scount++;
					}
				}
			}
		}

		$data = array(
			':customerid' => $form_data->customerid,
			':ordernumber' => $form_data->ordernumber,
			':productid' => $form_data->productid,
			':supplierid' => $form_data->supplierid,
			':mopid' => $form_data->mopid,
			':courierid' => $form_data->courierid,
			':platformid' => $form_data->platformid,
			':quantity' => $form_data->quantity,
			':filter' => $form_data->filter,
			':classification' => $form_data->classification,
			':shippingfee' => $form_data->shippingfee,
			':shippingdate' => $form_data->shippingdate,
			':purchasedate' => $form_data->purchasedate,
			':totalamountdollar' => $form_data->totalamountdollar,
			':totalamountpesos' => $form_data->totalamountpesos,
			':exchangerate' => $form_data->exchangerate,
			':remarks' => $form_data->remarks,
		);

		$query1 = "
		UPDATE customerorder 
			SET customerid = :customerid, 
			ordernumber = :ordernumber, 
			productid = :productid, 
			supplierid = :supplierid, 
			platformid = :platformid, 
			mopid = :mopid, 
			courierid = :courierid, 
			quantity = :quantity, 
			filter = :filter, 
			classification = :classification, 
			shippingfee = :shippingfee, 
			shippingdate = :shippingdate, 
			purchasedate = :purchasedate, 
			totalamountdollar = :totalamountdollar, 
			totalamountpesos = :totalamountpesos,
			exchangerate = :exchangerate, 
			remarks = :remarks 
			WHERE customerorderid = '".$form_data->customerorderid."'";

		// $query2 = "UPDATE stocks SET availablestocks = (availablestocks - '".$form_data->quantity."') WHERE stocksid = '".$form_data->productid."'";
		// $resultm['update2'] = $conn->query($query2) or die($conn->error . __LINE__);

		// $resultq = $resultm;
	}else{
		$data = array(
			':guid' => $coguid,
			':customerid' => $form_data->customerid,
			':ordernumber' => $form_data->ordernumber,
			':productid' => $form_data->productid,
			':supplierid' => $form_data->supplierid,
			':mopid' => $form_data->mopid,
			':courierid' => $form_data->courierid,
			':platformid' => $form_data->platformid,
			':quantity' => $form_data->quantity,
			':filter' => $form_data->filter,
			':classification' => $form_data->classification,
			':shippingfee' => $form_data->shippingfee,
			':shippingdate' => $form_data->shippingdate,
			':purchasedate' => $form_data->purchasedate,
			':totalamountdollar' => $form_data->totalamountdollar,
			':totalamountpesos' => $form_data->totalamountpesos,
			':exchangerate' => $form_data->exchangerate,
			':remarks' => $form_data->remarks,
		);

		$query1 = "
		INSERT INTO customerorder
			(guid, customerid, ordernumber, productid, supplierid, mopid, courierid, platformid, quantity, shippingfee, shippingdate, purchasedate, totalamountdollar, totalamountpesos, exchangerate, remarks, filter, classification) VALUES 
			(:guid, :customerid, :ordernumber, :productid, :supplierid, :mopid, :courierid, :platformid, :quantity, :shippingfee, :shippingdate, :purchasedate, :totalamountdollar, :totalamountpesos, :exchangerate, :remarks, :filter, :classification)
		";

		$scount = 0;
		for($i = 1; $i<=$form_data->quantity; $i++) {
			$query = "SELECT stockslist.* FROM stockslist 
			LEFT JOIN po_stock ON stockslist.pos_id = po_stock.pos_id
			WHERE stockslist.available_qty != '0' AND po_stock.stocksid = '".$form_data->productid."'
			ORDER BY stockslist.datecreated ASC LIMIT 1";
			$result = $conn->query($query) or die($conn->error . __LINE__);

			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				$queryfifo = "SELECT * FROM co_fifo where pos_id = '".$row['pos_id']."'";
				$resultfifo = $conn->query($queryfifo) or die($conn->error . __LINE__);
				$rowfifo = $resultfifo->fetch_assoc();

				if ($resultfifo->num_rows > 0) {
					$queryufifo = "UPDATE co_fifo SET quantity = (quantity + 1) WHERE guid = '".$rowfifo['guid']."'";
					$resultufifo = $conn->query($queryufifo) or die($conn->error . __LINE__);
				}else{
					$fifoguid = generateId();
					$querycfifo = "INSERT INTO co_fifo (guid, customerorderguid, pos_id, quantity)VALUES('".$fifoguid."', '".$coguid."', '".$row['pos_id']."', '1')";
					$resultcfifo = $conn->query($querycfifo) or die($conn->error . __LINE__);
				}

				$queryusl = "UPDATE stockslist SET available_qty = (available_qty - 1) WHERE pos_id = '".$row['pos_id']."'";
				$resultusl = $conn->query($queryusl) or die($conn->error . __LINE__);
			}

			$scount++;
		}

		// $query2 = "UPDATE stocks SET availablestocks = (availablestocks - '".$form_data->quantity."') WHERE stocksid = '".$form_data->productid."'";
		// $resultq = $conn->query($query2) or die($conn->error . __LINE__);
	}
	
	$statement = $connect->prepare($query1);

	if($statement->execute($data))
	{
		$message = 'success';
	}else{
		$message = 'error';
	}
	$output = array(
		'message'	=>	$message,
		'scount'   =>  $scount,
	);
}



// EXPENSE FUNCTIONS
if($form_data->action == 'paymentActList'){

	$query = "SELECT * FROM accounts ORDER BY datecreated ASC";
	$statement = $connect->prepare($query);
	if($statement->execute())
	{
		$message = 'success';
		while($row = $statement->fetch(PDO::FETCH_ASSOC))
		{
			$data[] = $row;
		}
	}else{
		$message = 'error';
	}

	$output = array(
		'message'	=>	$message,
		'data' => $data
	);
}

if($form_data->action == 'paymentMethod'){
	$query = "SELECT * FROM modeofpayment ORDER BY datecreated ASC";
	$statement = $connect->prepare($query);
	if($statement->execute())
	{
		$message = 'success';
		while($row = $statement->fetch(PDO::FETCH_ASSOC))
		{
			$data[] = $row;
		}
	}else{
		$message = 'error';
	}

	$output = array(
		'message'	=>	$message,
		'data' => $data
	);
}


if($form_data->action == 'payeeList'){

	$message = [];

	$query = "SELECT supplierguid as id, suppliername as name, 'supplier' as type FROM suppliers ORDER BY datecreated ASC";
	$statement = $connect->prepare($query);
	
	$supplier = [];
	if($statement->execute())
	{
		$message['supplier'] = 'success';
		$v_supplier = 'success';
		while($row = $statement->fetch(PDO::FETCH_ASSOC))
		{
			$supplier[] = $row;
			// $supplier[]['id'] = $row['supplierid'];
			// $supplier[]['name'] = $row['suppliername'];
			// $supplier['type'] = 'supplier';
		}
	}else{
		$message['supplier'] = 'error';
		$v_supplier = 'error';
	}

	$query2 = "SELECT  customerguid as id, CONCAT(customerfirstname,' ',customerlastname) as name, 'customer' as type  FROM customer ORDER BY datecreated ASC";
	$statement2 = $connect->prepare($query2);

	$customer = [];
	if($statement2->execute())
	{
		$message['customer'] = 'success';
		$v_customer = 'success';
		while($row2 = $statement2->fetch(PDO::FETCH_ASSOC))
		{
			$customer[] = $row2;
			// $customer[]['id'] = $row2['customerid'];
			// $customer[]['name'] = $row2['customerfirstname'].' '.$row2['customerlastname'];
			// $customer[]['type'] = 'customer';
		}
	}else{
		$message['customer'] = 'error';
		$v_customer = 'error';
	}

	if($v_supplier == 'success' && $v_customer == 'success'){
		$validate = 'success';
	}else{
		$validate = 'error';
	}

	$datalist = array_merge_recursive($supplier, $customer);

	$output = array(
		'message'	=>	$validate,
		'val' => $message,
		'datalist' => [$supplier, $customer],
		'data' => $datalist
	);
}

if($form_data->action == 'expenseCheck'){

	$query = "SELECT * FROM expense WHERE session = '0'";
	$result = $conn->query($query) or die($conn->error . __LINE__);
	
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$expenseid = $row['expenseid'];

		$result = 'existing';
	}else{
		$result = [];

		$query = "INSERT INTO expense (expenseid) VALUES ('".$genid."')";
		$result['Main'] = $conn->query($query) or die($conn->error . __LINE__);

		$query2 = "INSERT INTO expense_category (expenseid) VALUES ('".$genid."')";
		$result['category'] = $conn->query($query2) or die($conn->error . __LINE__);

		$query3 = "INSERT INTO expense_item (expenseid) VALUES ('".$genid."')";
		$result['items'] = $conn->query($query3) or die($conn->error . __LINE__);

		$expenseid = $genid;
	}

	$output = array(
		'expenseid' => $expenseid,
		'result' => $result
	);
}

if($form_data->action == 'loadActiveExpense'){

	$query = "SELECT * FROM expense WHERE expenseid = '".$form_data->expenseid."'";
	$statement = $connect->prepare($query);

	$main = [];
	if($statement->execute())
	{
		$expenseval = 'success';
		while($row = $statement->fetch(PDO::FETCH_ASSOC))
		{
			$main[] = $row;
		}
	}else{
		$expenseval = 'error';
	}

	$query2 = "SELECT *, FORMAT(amount ,2) as amount FROM expense_category WHERE expenseid = '".$form_data->expenseid."'";
	$statement2 = $connect->prepare($query2);

	$category = [];
	if($statement2->execute())
	{
		$categoryval = 'success';
		while($row = $statement2->fetch(PDO::FETCH_ASSOC))
		{
			$category[] = $row;
		}
	}else{
		$categoryval = 'error';
	}

	$query3 = "SELECT expense_item.*, FORMAT(expense_item.amount ,2) as amountse, stocks.availablestocks FROM expense_item 
	LEFT JOIN stocks ON expense_item.stocksid = stocks.stocksid
	WHERE expense_item.expenseid = '".$form_data->expenseid."'";
	$statement3 = $connect->prepare($query3);

	$item = [];
	if($statement3->execute())
	{
		$itemval = 'success';
		while($row = $statement3->fetch(PDO::FETCH_ASSOC))
		{
			$item[] = $row;
		}
	}else{
		$itemval = 'error';
	}

	$querytotal = "SELECT FORMAT(SUM(amount), 2) as totalamount FROM expense_category WHERE expenseid = '".$form_data->expenseid."'";
	$resulttotal = $conn->query($querytotal) or die($conn->error . __LINE__);
	
	if ($resulttotal->num_rows > 0) {
		$row = $resulttotal->fetch_assoc();
		$totalamount = $row['totalamount'];
	}else{
		$totalamount = '0.00';
	}

	$itemtotal = "SELECT FORMAT(SUM(amount), 2) as itemtotalamount FROM expense_item WHERE expenseid = '".$form_data->expenseid."'";
	$resultitemtotal = $conn->query($itemtotal) or die($conn->error . __LINE__);
	
	if ($resultitemtotal->num_rows > 0) {
		$row = $resultitemtotal->fetch_assoc();
		$totalitemamount = $row['itemtotalamount'];
	}else{
		$totalitemamount = '0.00';
	}

	$output = array(
		'message'	=>	[
			'main' => $expenseval,
			'category' => $categoryval,
			'item' => $itemval
		],
		'data'	=>	[
			'main' => $main['0'],
			'category' => $category,
			'item' => $item,
			'totalamount' => $totalamount,
			'totalitemamount' => $totalitemamount,
		],
	);
}

if($form_data->action == 'expenseSavemain'){
	
	$data = $form_data->data;

	$querytotal = "SELECT SUM(amount) as totalamount FROM expense_category WHERE expenseid = '".$data->expenseid."'";
	$totcategamount = $conn->query($querytotal) or die($conn->error . __LINE__);
	$row = $totcategamount->fetch_assoc();
	$totalamount = $row['totalamount'];

	$query = "UPDATE expense SET payeeid = '".$data->payeeid."', paymentaccount = '".$data->paymentaccount."', accountbal = '".$data->accountbal."', amount = '".$totalamount."', paymentdate = '".$data->paymentdate."', paymentmethod = '".$data->paymentmethod."', referenceno = '".$data->referenceno."', remarks = '".$data->remarks."' WHERE expenseid = '".$data->expenseid."'";
	$result = $conn->query($query) or die($conn->error . __LINE__);
	
	// $query1 = "UPDATE accounts SET accbalance = '".$data->accbalance."' WHERE accountid = '".$data->accountid."'";
	// $result1 = $conn->query($query1) or die($conn->error . __LINE__);

	$output = array(
		'message'	=> 'success',
		'data'	=>	$data
	);
}

if($form_data->action == 'expenseAddrow'){
	if($form_data->mod == 'expense_category'){
		$query2 = "INSERT INTO ".$form_data->mod." (expenseid) VALUES ('".$form_data->expenseid."')";
	}else{
		$query2 = "INSERT INTO ".$form_data->mod." (expenseid, rate) VALUES ('".$form_data->expenseid."', '".$form_data->rate."')";
	}
	
	$result = $conn->query($query2) or die($conn->error . __LINE__);

	$output = array(
		'message'	=> $result
	);
}

if($form_data->action == 'expenseRemoverow'){
	if($form_data->mod == 'expense_category'){
		$query2 = "DELETE FROM ".$form_data->mod." WHERE id = '".$form_data->id."'";
		$result = $conn->query($query2) or die($conn->error . __LINE__);
	}else{
		$query = "SELECT * FROM expense_item where id = '".$form_data->id."'";
		$result = $conn->query($query) or die($conn->error . __LINE__);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$resultq = [];

				$query1 = "UPDATE stocks SET availablestocks = (availablestocks + '".$row['quantity']."') WHERE stocksid = '".$row['stocksid']."'";
				$resultq['add'] = $conn->query($query1) or die($conn->error . __LINE__);
			}
		}
		$query2 = "DELETE FROM ".$form_data->mod." WHERE id = '".$form_data->id."'";
		$result = $conn->query($query2) or die($conn->error . __LINE__);
	}
	

	$output = array(
		'message'	=> $result
	);
}

if($form_data->action == 'ExpenseUpdatecategory'){
	$stocjj = array($form_data->data);

	foreach ($form_data->data as $key=>$value) {

		// $query1 = "UPDATE expense_category SET oldstocksid = stocksid, oldquantity = quantity WHERE id = '".$value->id."'";
		// $result = $conn->query($query1) or die($conn->error . __LINE__);

		$data2 = array(
			':id'     		 =>	$value->id,
			':categoryid'    =>	$value->categoryid,
			':description'   =>	$value->description,
			':amount'		 =>	$value->amount
		);
		$query = "
		UPDATE expense_category 
			SET categoryid = :categoryid, description = :description, amount = :amount WHERE id = :id";
		$statement = $connect->prepare($query);
		$statement->execute($data2);
	}
	$output = array(
		'message'	=>	$form_data->data
	);
}

if($form_data->action == 'loadexpenseslist'){
	$query = "SELECT expense.*, modeofpayment.modeofpayment FROM expense 
	LEFT JOIN modeofpayment ON expense.paymentmethod = modeofpayment.mopid
	where expense.status = '1' AND dlt = '0'
	ORDER BY expense.datecreated ASC";
	$result = $conn->query($query) or die($conn->error . __LINE__);
	$fetch_data = [];
	// $row = $result->fetch_assoc();
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
		// foreach($row as $key => $value){
		// 	$fetch_data[] = $value;
		// }
	}
	$output = $fetch_data;
}

if($form_data->action == 'ExpenseGetProdInfo'){
	$id = $form_data->id;
	$expenseid = $form_data->expenseid;

	$query2 = "SELECT * FROM expense_item where id = '".$form_data->poid."'";
	$resultf = $conn->query($query2) or die($conn->error . __LINE__);

	if ($resultf->num_rows > 0) {
		$row = $resultf->fetch_assoc();

		$query3 = "UPDATE stocks SET availablestocks = (availablestocks + '".$row['quantity']."') WHERE stocksid = '".$row['oldstocksid']."'";
		$resultqq = $conn->query($query3) or die($conn->error . __LINE__);
		
	}
	$query = "SELECT * FROM expense_item where expenseid = '".$expenseid."' AND stocksid = '".$id."'";
	$result = $conn->query($query) or die($conn->error . __LINE__);

	if ($result->num_rows > 0) {
		$exist = true;
	}else{
		$exist = false;
	}

	$query4 = "
	SELECT stocks.stockname, stocks.stockcolor, stocks.stocksize, stocks.availablestocks, stocks.sku, stocks.unitprice, category.categorydesc, brands.brandname FROM stocks
	LEFT JOIN category ON stocks.categoryid = category.categoryid
	LEFT JOIN brands ON stocks.brandid = brands.brandid
	WHERE stocks.stocksid='".$id."'
	;
	";
	$statement = $connect->prepare($query4);
	if($statement->execute())
	{
		$message = 'success';
		$data = $statement->fetch(PDO::FETCH_ASSOC);
	}else{
		$message = 'error';
	}

	$output = array(
		'exist' => $exist,
		'result' => [
			"oldqty" => $row['oldquantity'],
			"oldid" => $row['oldstocksid'],
		],
		'message'	=>	$message,
		'data' => $data
	);
}

if($form_data->action == 'expenseupdatestocks'){
	$stocjj = array($form_data->data);

	foreach ($form_data->data as $key=>$value) {
		// $query = "SELECT * FROM stocks where ";
		// $statement = $connect->prepare($query);
		// if($statement->execute())
		// {

		// }
		$query1 = "UPDATE expense_item SET oldstocksid = stocksid, oldquantity = quantity WHERE id = '".$value->id."'";
		$result = $conn->query($query1) or die($conn->error . __LINE__);

		$data2 = array(
			':id'     		=>	$value->id,
			':quantity'    	=>	$value->quantity,
			':stocksid'    	=>	$value->stocksid,
			':amount' 		=>	$value->amount,
			':unitpricephp' =>	$value->unitpricephp,
			':description' 	=>	$value->description,
			':rate' 		=>	$value->rate,
		);
		$query = "
		UPDATE expense_item 
			SET quantity = :quantity, stocksid = :stocksid, amount = :amount, unitpricephp = :unitpricephp, description = :description, rate = :rate WHERE id = :id";
		$statement = $connect->prepare($query);
		$statement->execute($data2);
	}
	$output = array(
		'message'	=>	$form_data->data
	);
}

if($form_data->action == 'expensevalidatestock'){
	$query = "SELECT * FROM expense_item where expenseid = '".$form_data->expenseid."'";
	$result = $conn->query($query) or die($conn->error . __LINE__);
	$count = 0;
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			if((is_null($row['stocksid']) OR $row['stocksid'] == '') OR (is_null($row['quantity']) OR $row['quantity'] == '')){
				$count++;
			}
		}
	}
	$output = $count;
}

if($form_data->action == 'expenseresetquantitystock'){
	//select latest PO
	$query = "SELECT * FROM expense_item where id = '".$form_data->id."'";
	$result = $conn->query($query) or die($conn->error . __LINE__);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$resultq = [];

			$query1 = "UPDATE stocks SET availablestocks = (availablestocks + '".$row['quantity']."') WHERE stocksid = '".$row['stocksid']."'";
			$resultq['add'] = $conn->query($query1) or die($conn->error . __LINE__);

			$query3 = "SELECT * FROM stocks where stocksid = '".$row['stocksid']."' AND availablestocks >= '".$form_data->qty."'";
			$result3 = $conn->query($query3) or die($conn->error . __LINE__);
			if ($result3->num_rows > 0) {
				$query2 = "UPDATE stocks SET availablestocks = (availablestocks - '".$form_data->qty."') WHERE stocksid = '".$row['stocksid']."'";
				$resultq['subtract'] = $conn->query($query2) or die($conn->error . __LINE__);

				$outofstocks = false;
			}else{
				$query2 = "UPDATE expense_item SET quantity = '', oldquantity = '' WHERE id = '".$form_data->id."'";
				$resultq['subtract'] = $conn->query($query2) or die($conn->error . __LINE__);

				$outofstocks = true;
			}
		}
		$message = 'success';
	}else{
		$message = 'error';
	}

	$output = array(
		'outofstocks' => $outofstocks,
		'result' => $resultq,
		'message' => $message
	);
}

if($form_data->action == 'saveExpense'){
	$query3 = "UPDATE expense SET session = '1', status = '1' WHERE expenseid = '".$form_data->id."'";
	$result1 = $conn->query($query3) or die($conn->error . __LINE__);
	
	$query = "SELECT * FROM expense_category where expenseid = '".$form_data->id."'";
	$result = $conn->query($query) or die($conn->error . __LINE__);
	$tmp_result = [];
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$query4 = "UPDATE accounts SET accbalance = accbalance - '".$row['amount']."' WHERE accountid = '".$form_data->accountid."'";
			$tmp_result[] = $conn->query($query4) or die($conn->error . __LINE__);
		}
	}
	if($result1){
		$message = 'success';
	}else{
		$message = 'error';
	}
	$output = array(
		'message' => $message,
		'tmp_result' => $tmp_result
	);
}

if($form_data->action == 'deleteexpense'){
	//select latest PO
	$query = "SELECT * FROM expense_item where expenseid = '".$form_data->id."'";
	$result = $conn->query($query) or die($conn->error . __LINE__);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$query1 = "UPDATE stocks SET availablestocks = (availablestocks + '".$row['quantity']."') WHERE stocksid = '".$row['stocksid']."'";
			$result3 = $conn->query($query1) or die($conn->error . __LINE__);
			
		}
		$message = 'success';
	}else{
		$message = 'error';
	}

	$query2 = "UPDATE expense SET dlt = '1' WHERE expenseid = '".$form_data->id."'";
	$result2 = $conn->query($query2) or die($conn->error . __LINE__);

	$output = array(
		'id' => $form_data->id,
		'count' => $result->num_rows,
		'message' => $message
	);
}

if($form_data->action == 'deleteStocksimage'){
	unlink('../../'.$form_data->imageurl);

	$delsql = "DELETE FROM snldata WHERE module = 'stocks' AND itemid='".$form_data->id."'";
	$resultdel = $conn->query($delsql) or die($conn->error . __LINE__);

	$output = array(
		'message' => $resultdel
	);
}

if($form_data->action == 'getinfop'){
	$query4 = "
		SELECT stocks.stockname, stocks.stockcolor, stocks.stocksize, stocks.availablestocks, stocks.sku, stocks.unitprice, category.categorydesc, brands.brandname FROM stocks
		LEFT JOIN category ON stocks.categoryid = category.categoryid
		LEFT JOIN brands ON stocks.brandid = brands.brandid
		WHERE stocks.stocksid='".$form_data->id."'
		;
	";

	$checksql = "SELECT * FROM snldata WHERE module='stocks' AND itemid='".$form_data->guid."'";
	$resultimg = $conn->query($checksql) or die($conn->error . __LINE__);
	$rowimg = $resultimg->fetch_assoc();

	if($resultimg->num_rows > 0){
		$image = $rowimg['path'];
	}else{
		$image = null;
	}

	$statement = $connect->prepare($query4);
	if($statement->execute())
	{
		$message = 'success';
		$data = $statement->fetch(PDO::FETCH_ASSOC);
	}else{
		$message = 'error';
	}

	$output = array(
		'message'	=>	$message,
		'data' => $data,
		'imgurl' => $image
	);
}

if($form_data->action == 'getinfostocks'){
	$checkqty = "SELECT stockslist.available_qty, stockslist.purchased_qty, FORMAT(stockslist.unitprice, 2) as unitprice, po_main.purchasedate FROM stockslist 
	LEFT JOIN po_stock ON stockslist.pos_id = po_stock.pos_id
	LEFT JOIN po_main ON po_stock.pom_id = po_main.pom_id
	WHERE po_main.status='placed' 
	AND po_stock.stockguid='".$form_data->guid."' ORDER BY po_main.purchasedate ASC";
	$resultqty = $conn->query($checkqty) or die($conn->error . __LINE__);
	// $rowqty = $resultqty->fetch_assoc();

	$fetch_data = [];
	if ($resultqty->num_rows > 0) {
		while ($row = $resultqty->fetch_assoc()) {
			$fetch_data[] = $row;
		}
	}

	if($resultqty){
		$message = 'success';
	}else{
		$message = 'error';
	}

	$output = array(
		'message'	=>	$message,
		'data' => $fetch_data
	);
}

if($form_data->action == 'getMultiFile'){
	$checksql = "SELECT * FROM snldata WHERE module='".$form_data->module."' AND itemid='".$form_data->id."'";
	$resultimg = $conn->query($checksql) or die($conn->error . __LINE__);

	$fetch_data = [];
	if ($resultimg->num_rows > 0) {
		while ($row = $resultimg->fetch_assoc()) {
			$fetch_data[] = $row;
		}
	}
	$output = $fetch_data;
}

if($form_data->action == 'deleteFile'){

	if($form_data->path != null){
		$delsql = "DELETE FROM snldata WHERE id='".$form_data->id."'";
		$resultdel = $conn->query($delsql) or die($conn->error . __LINE__);
	
		if(@unlink('../../'.$form_data->path)){
			$unlink = 'success';
		}else{
			$unlink = 'error';
		}
	}else{

		$query = "SELECT * FROM snldata WHERE itemid='".$form_data->id."'";
		$result = $conn->query($query) or die($conn->error . __LINE__);  
		$file = $result->fetch_assoc();
		
		if(@unlink('../../data/'.$file['folder'].'/'.$file['filename'])){
			$unlink = 'success';
		}else{
			$unlink = 'error';
		}

		$delsql = "DELETE FROM snldata WHERE itemid='".$form_data->id."'";
		$resultdel = $conn->query($delsql) or die($conn->error . __LINE__);
	}

	$output = array(
		'message' => $resultdel,
		'unlink' => $unlink
	);
}

if($form_data->action == 'saveChangePass'){
	$newpass = md5($form_data->password);
	$query1 = "UPDATE user SET password ='".$newpass."' WHERE user_id = '".$form_data->id."'";
	$result = $conn->query($query1) or die($conn->error . __LINE__);

	$output = array(
		'result' => $result
	);
}

if($form_data->action == 'getIncome'){
	$data = [];
	$main_query = "SELECT SUM(po_stock.totalpricephp) as totalamountpo, po_main.purchasedate
    FROM po_stock
    LEFT JOIN po_main ON po_stock.pom_id = po_main.pom_id
    WHERE po_main.purchasedate BETWEEN '".$form_data->datefrom."' AND '".$form_data->dateto."' AND po_main.status = 'placed'";
	$po_result = $conn->query($main_query) or die($conn->error . __LINE__);  
	$po = $po_result->fetch_assoc();

	$query = "SELECT SUM(totalamountpesos) as totalamountco
    FROM customerorder WHERE purchasedate BETWEEN '".$form_data->datefrom."' AND '".$form_data->dateto."'";
    $result = $conn->query($query) or die($conn->error . __LINE__);  
    $co = $result->fetch_assoc();

    $expquery = "SELECT SUM(expense_item.amount) as totalamountexp
	FROM expense_item
	LEFT JOIN expense ON expense_item.expenseid = expense.expenseid
	WHERE expense.status = '1' AND expense.paymentdate BETWEEN '".$form_data->datefrom."' AND '".$form_data->dateto."'";
    $exresult = $conn->query($expquery) or die($conn->error . __LINE__);  
    $exp = $exresult->fetch_assoc();

	$data[] = array(
		'name' => 'Purchase Order',
		'y' => intval($po['totalamountpo'] ? $po['totalamountpo'] : '0.00')
	);

	$data[] = array(
		'name' => 'Customer Order',
		'y' => intval($co['totalamountco'] ? $co['totalamountco'] : '0.00')
	);

	$data[] = array(
		'name' => 'Expense',
		'y' => intval($exp['totalamountexp'] ? $exp['totalamountexp'] : '0.00')
	);

	$output = array(
		'data' => $data,
		'total' => (($po['totalamountpo'] + $co['totalamountco']) - $exp['totalamountexp'])
	);
}

if($form_data->action == 'dashboardCheck'){

	$query = "SELECT * FROM dashboard";
	$result = $conn->query($query) or die($conn->error . __LINE__);
	
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$dashboardid = $row['dashboardid'];

		$result = 'existing';
	}else{
		$query = "INSERT INTO dashboard (dashboardid, myincomedatefrom, myincomedateto, myexpensefrom, myexpenseto) VALUES ('".$genid."', '', '', '', '')";
		$result = $conn->query($query) or die($conn->error . __LINE__);


		$dashboardid = $genid;
	}

	$output = array(
		'dashboardid' => $dashboardid,
		'result' => $result
	);
}

if($form_data->action == 'getchartexpense'){
	$query2 = "SELECT SUM(expense_category.amount) as totalexpense
	FROM category_exp
	LEFT JOIN expense_category ON category_exp.categexpid = expense_category.categoryid
	LEFT JOIN expense ON expense_category.expenseid = expense.expenseid
	WHERE expense.status = '1' AND expense.paymentdate BETWEEN '".$form_data->datefrom."' AND '".$form_data->dateto."'";
	$result2 = $conn->query($query2) or die($conn->error . __LINE__);
	$row3 = $result2->fetch_assoc();

	$query = "SELECT categexpid, categexpname FROM category_exp";
	$result = $conn->query($query) or die($conn->error . __LINE__);
	if ($result->num_rows > 0) {
		$data = [];
		while ($row = $result->fetch_assoc()) {
			$query1 = "SELECT SUM(expense_category.amount) as totalexpense
			FROM expense_category
			LEFT JOIN expense ON expense_category.expenseid = expense.expenseid
			WHERE expense.status = '1' AND expense_category.categoryid = '".$row['categexpid']."' AND (expense.paymentdate BETWEEN '".$form_data->datefrom."' AND '".$form_data->dateto."')";
			$result3 = $conn->query($query1) or die($conn->error . __LINE__);
			$row2 = $result3->fetch_assoc();

			$row['name'] = $row['categexpname'];
			$row['y'] = intval($row2['totalexpense'] ? $row2['totalexpense'] : '0.00');
			$data[] = $row;
		}
		$message = 'success';
	}else{
		$message = 'error';
	}

	$output = array(
		'data' => $data,
		'total' => $row3['totalexpense'],
		'result' => $message
	);
}

if($form_data->action == 'loadDashboard'){

	$query = "SELECT * FROM dashboard WHERE dashboardid='".$form_data->dashboardid."'";
	$result = $conn->query($query) or die($conn->error . __LINE__);
	$row = $result->fetch_assoc();

	$output = array(
		'data' => $row,
		'result' => $result
	);
}

if($form_data->action == 'saveDashboard'){
	$query1 = "UPDATE dashboard SET myincomedatefrom ='".$form_data->myincomedatefrom."', myincomedateto ='".$form_data->myincomedateto."', myexpensefrom ='".$form_data->myexpensefrom."',  myexpenseto ='".$form_data->myexpenseto."',  incomecomparison ='".$form_data->incomecomparison."' WHERE dashboardid = '".$form_data->id."'";
	$result = $conn->query($query1) or die($conn->error . __LINE__);

	$query = "SELECT * FROM dashboard WHERE dashboardid='".$form_data->id."'";
	$result2 = $conn->query($query) or die($conn->error . __LINE__);
	$row = $result2->fetch_assoc();

	$output = array(
		'data' => $row,
		'result' => $result
	);
}


if($form_data->action == 'loadDataMonthly'){
	$yearsql = "SELECT YEAR(purchasedate) as purchasedate FROM customerorder UNION SELECT YEAR(purchasedate) as purchasedate FROM po_main ORDER BY purchasedate ASC";
	$yearresult = $conn->query($yearsql) or die($conn->error . __LINE__);

	$month = ['01','02','03','04','05','06','07','08','09','10','11','12'];

	if ($yearresult->num_rows > 0) {
		$data = [];
		while ($row = $yearresult->fetch_assoc()) {
			$monthd = [];
			foreach ($month as $key => $value){
				$main_query = "SELECT SUM(po_stock.totalpricephp) as totalamountpo, po_main.purchasedate
				FROM po_stock
				LEFT JOIN po_main ON po_stock.pom_id = po_main.pom_id
				WHERE MONTH(po_main.purchasedate) = '".$value."' AND YEAR(po_main.purchasedate) = '".$row['purchasedate']."' AND po_main.status = 'placed'";
				$po_result = $conn->query($main_query) or die($conn->error . __LINE__);  
				$po = $po_result->fetch_assoc();

				$query = "SELECT SUM(totalamountpesos) as totalamountco
				FROM customerorder WHERE MONTH(purchasedate) = '".$value."' AND YEAR(purchasedate) = '".$row['purchasedate']."'";
				$result = $conn->query($query) or die($conn->error . __LINE__);  
				$co = $result->fetch_assoc();

				$monthd[] = intval($po['totalamountpo'] ? $po['totalamountpo'] : '0.00') + intval($co['totalamountco'] ? $co['totalamountco'] : '0.00');
			}

			$data[] = array(
				'name' => $row['purchasedate'],
				'data' => $monthd
			);

		}
	}

	$output = array(
		'data' => $data
	);
}


if($form_data->action == 'loadDataQuarterly'){
	$yearsql = "SELECT YEAR(purchasedate) as purchasedate FROM customerorder UNION SELECT YEAR(purchasedate) as purchasedate FROM po_main ORDER BY purchasedate ASC";
	$yearresult = $conn->query($yearsql) or die($conn->error . __LINE__);

	$month = array(
		[
			'name'  => 'Quarter 1',
			'start' => '1',
			'end'	=> '4'
		],
		[
			'name'  => 'Quarter 2',
			'start' => '5',
			'end'	=> '8'
		],
		[
			'name'  => 'Quarter 3',
			'start' => '9',
			'end'	=> '12'
		]
	);

	if ($yearresult->num_rows > 0) {
		$data = [];
		while ($row = $yearresult->fetch_assoc()) {
			$monthd = [];
			foreach ($month as $key => $value){
				$main_query = "SELECT SUM(po_stock.totalpricephp) as totalamountpo, po_main.purchasedate
				FROM po_stock
				LEFT JOIN po_main ON po_stock.pom_id = po_main.pom_id
				WHERE MONTH(po_main.purchasedate) BETWEEN '".$value['start']."' AND '".$value['end']."' AND YEAR(po_main.purchasedate) = '".$row['purchasedate']."' AND po_main.status = 'placed'";
				$po_result = $conn->query($main_query) or die($conn->error . __LINE__);  
				$po = $po_result->fetch_assoc();

				$query = "SELECT SUM(totalamountpesos) as totalamountco
				FROM customerorder WHERE MONTH(purchasedate) BETWEEN '".$value['start']."' AND '".$value['end']."' AND YEAR(purchasedate) = '".$row['purchasedate']."'";
				$result = $conn->query($query) or die($conn->error . __LINE__);  
				$co = $result->fetch_assoc();

				$monthd[] = intval($po['totalamountpo'] ? $po['totalamountpo'] : '0.00') + intval($co['totalamountco'] ? $co['totalamountco'] : '0.00');
			}

			$data[] = array(
				'name' => $row['purchasedate'],
				'data' => $monthd
			);

		}
	}

	$output = array(
		'data' => $data
	);
}

if($form_data->action == 'loadDataAnnually'){
	$yearsql = "SELECT YEAR(purchasedate) as purchasedate FROM customerorder UNION SELECT YEAR(purchasedate) as purchasedate FROM po_main ORDER BY purchasedate ASC";
	$yearresult = $conn->query($yearsql) or die($conn->error . __LINE__);

	if ($yearresult->num_rows > 0) {
		$data = [];
		$year = [];
		while ($row = $yearresult->fetch_assoc()) {
			$main_query = "SELECT SUM(po_stock.totalpricephp) as totalamountpo, po_main.purchasedate
			FROM po_stock
			LEFT JOIN po_main ON po_stock.pom_id = po_main.pom_id
			WHERE YEAR(po_main.purchasedate) = '".$row['purchasedate']."' AND po_main.status = 'placed'";
			$po_result = $conn->query($main_query) or die($conn->error . __LINE__);  
			$po = $po_result->fetch_assoc();

			$query = "SELECT SUM(totalamountpesos) as totalamountco
			FROM customerorder WHERE YEAR(purchasedate) = '".$row['purchasedate']."'";
			$result = $conn->query($query) or die($conn->error . __LINE__);  
			$co = $result->fetch_assoc();

			// $monthd[] = intval($po['totalamountpo'] ? $po['totalamountpo'] : '0.00') + intval($co['totalamountco'] ? $co['totalamountco'] : '0.00');

			// $data[] = intval($po['totalamountpo'] ? $po['totalamountpo'] : '0.00') + intval($co['totalamountco'] ? $co['totalamountco'] : '0.00');

			$year[] = $row['purchasedate'];

			$data[] = array(
				'name' => $row['purchasedate'],
				'data' => array(intval($po['totalamountpo'] ? $po['totalamountpo'] : '0.00') + intval($co['totalamountco'] ? $co['totalamountco'] : '0.00'))
			);
		}
	}

	$output = array(
		'data' => $data,
		'year' => $year,
	);
}

echo json_encode($output);
?>