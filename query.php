<?php

if(loggedIn()){
    $sessionid = $_SESSION["user_id"];
    $conn = mysqli_connect($db_host, $db_username, $db_password, $db_tablename);
    $userinfo = mysqli_query($conn, "SELECT * FROM user where user_id = '".$sessionid."'");
    $row = mysqli_fetch_array($userinfo);

    $uuserid = $row['user_id'];
    $ufirstname = $row['firstname'];
    $ulastname = $row['lastname'];
    $uaddress = $row['address'];
    $ucontactnumber = $row['contactnumber'];
}
?>

