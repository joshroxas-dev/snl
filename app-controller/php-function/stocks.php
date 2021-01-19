<?php

include '../../config.php';
$conn  = new mysqli($db_host, $db_username, $db_password, $db_tablename);

$query = "SELECT * FROM stocks ORDER BY datecreated ASC";
$result = $conn->query($query) or die($conn->error . __LINE__);
$fetch_data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        $checkqty = "SELECT SUM(stockslist.available_qty) as newalbqty FROM stockslist 
        LEFT JOIN po_stock ON stockslist.pos_id = po_stock.pos_id
        LEFT JOIN po_main ON po_stock.pom_id = po_main.pom_id
        WHERE po_main.status='placed' 
        AND po_stock.stockguid='".$row['guid']."'";
        $resultqty = $conn->query($checkqty) or die($conn->error . __LINE__);
        $rowqty = $resultqty->fetch_assoc();

        // if($rowqty->num_rows > 0){
            $row['newalbqty'] = $rowqty['newalbqty'] ? $rowqty['newalbqty'] : 0;
        // }else{
        //     $row['newalbqty'] = 0;
        // }

        $checksql = "SELECT * FROM snldata WHERE module='stocks' AND itemid='".$row['guid']."'";
        $resultimg = $conn->query($checksql) or die($conn->error . __LINE__);
        $rowimg = $resultimg->fetch_assoc();

        if($resultimg->num_rows > 0){
            $row['imageurl'] = $rowimg['path'];
        }else{
            $row['imageurl'] = null;
        }
        
        $fetch_data[] = $row;
    }
}
$jResponse = json_encode($fetch_data);
echo $jResponse;

?>