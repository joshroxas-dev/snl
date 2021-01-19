<?php

include 'config.php';
	// session_start();	

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
	function generateId($length = 10) {
		$characters = '0123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	// $servername = "db5000198974.hosting-data.io";
	// $username = "dbu407864";
	// $password = "K2NmauSqb#az4#R";
	// $db_tablename = "dbs193977";

	// $connect = new PDO("mysql:host=$servername;dbname=$db_tablename", $username, $password);


	$connect = new PDO("mysql:host=$db_host;dbname=$db_tablename", $db_username, $db_password);

	$form_data = json_decode(file_get_contents("php://input"));

	$genid = generateId();



	if($form_data->action == 'Adduser'){
		$validation = [];
		if($form_data->password != $form_data->password2){
			$validation[]['passmatch'] = "Password dont match";
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

			);

			// ROLE QUERY
			$query2 = "
			INSERT INTO roles 
				(user_id, customerorder, supplierorder, stockmanagement, addstock, deletestock, productmanagement, addcategories, deletecategories, addbrands, deletebrands, addsuppliers, deletesuppliers, addcouriers, deletecouriers, systemusers, report, dashboard, categoriesmanagement, brandsmanagement, suppliersmanagement, couriersmanagement, auditlogs, customermanagement, addcustomer, deletecustomer) VALUES 
				(:user_id, :customerorder, :supplierorder, :stockmanagement, :addstock, :deletestock, :productmanagement, :addcategories, :deletecategories, :addbrands, :deletebrands, :addsuppliers, :deletesuppliers, :addcouriers, :deletecouriers, :systemusers, :report, :dashboard, :categoriesmanagement, :brandsmanagement, :suppliersmanagement, :couriersmanagement, :auditlogs, :customermanagement, :addcustomer, :deletecustomer)
			";
			$statement2 = $connect->prepare($query2);
			if($statement->execute($data) && $statement2->execute($data2))
			{
				$message = 'success';
			}else{
				$message = 'error';
			}
		}else{
			$message = 'error';
		}
		$output = array(
			'message' => $message,
			'validation' => $validation,
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


/* -----------------------------------------------------------------------------------  */
/* -----------------------------------------------------------------------------------  */
/* --------------------------------------- KHENARD CODE ------------------------------  */
/* -----------------------------------------------------------------------------------  */
/* -----------------------------------------------------------------------------------  */

	//add category
	if($form_data->action == 'categoryAdd'){
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


	//add supplier
	if($form_data->action == 'addSupplier'){
		$data = array(
			':suppliername'	=>	$form_data->suppliername,
			':supplieraddress'	=>	$form_data->supplieraddress,
			':scontactperson'	=>	$form_data->scontactperson,
			':sphonenumber'	=>	$form_data->sphonenumber,
			':semail'	=>	$form_data->semail,
			':swebsite'	=>	$form_data->swebsite,
		);
		$query1 = "
		INSERT INTO suppliers
			(suppliername, supplieraddress, scontactperson, sphonenumber, semail, swebsite) VALUES 
			(:suppliername, :supplieraddress, :scontactperson, :sphonenumber, :semail, :swebsite)
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



	echo json_encode($output);
	?>