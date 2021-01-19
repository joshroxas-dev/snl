<?php

include '../../config.php';
$conn  = new mysqli($db_host, $db_username, $db_password, $db_tablename);

$query = "SELECT customerorder.purchasedate, customerorder.customerorderid, stocks.stockname, suppliers.supplierid, suppliers.suppliername, customerorder.remarks, customerorder.quantity, customerorder.exchangerate, customerorder.totalamountpesos
FROM customerorder
LEFT JOIN stocks ON customerorder.productid = stocks.stocksid
LEFT JOIN suppliers ON stocks.supplierid = suppliers.supplierid
ORDER BY customerorder.customerorderid";
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