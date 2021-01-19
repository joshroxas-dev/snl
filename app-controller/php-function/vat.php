<?php

include '../../config.php';
$conn  = new mysqli($db_host, $db_username, $db_password, $db_tablename);

$query = "SELECT sys_value FROM system_setting WHERE sys_name='VAT'";
$result = $conn->query($query) or die($conn->error . __LINE__);
$fetch_data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $fetch_data[] = $row;
    }
}
$jResponse = json_encode($fetch_data);
echo $jResponse;

?>