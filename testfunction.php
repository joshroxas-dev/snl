<?php

include 'config.php';

$connect = new PDO("mysql:host=$db_host;dbname=$db_tablename", $db_username, $db_password);
$form_data = json_decode(file_get_contents("php://input"));

$testlang = 'active';

	if($testlang == 'active'){

		// $query = "SELECT username, firstname, lastname, address, contactnumber, email FROM user ORDER BY datecreated ASC";
		// $statement = $connect->prepare($query);
		// if($statement->execute())
        // {
        //     $message = 'success';
        //     while($row = $statement->fetch(PDO::FETCH_ASSOC))
        //     {
        //         $data[] = $row;
        //     }
        // }else{
        //     $message = 'error';
        // }

		// $output = array(
		// 	'message'	=>	$message,
		// 	'data' => $data[0]
        // );
        
        $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'purchaseorder' AND DATA_TYPE = 'varchar'";
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

    echo json_encode($output);

?>