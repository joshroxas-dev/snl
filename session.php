<?php
session_start();	
include "config.php";
function loggedIn(){

    if(isset($_SESSION["user_id"])){

        return true;

    } else {

        return false;

    }

}

function Role($role){

    include "config.php";

    $conn = mysqli_connect($db_host, $db_username, $db_password, $db_tablename); 
    
    $user_id = $_SESSION["user_id"];

    $sql = "SELECT $role FROM roles WHERE user_id='$user_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if($row[$role] === 'true'){
        return true;
    }else{
        return false;
    }
}

include 'query.php';

?>