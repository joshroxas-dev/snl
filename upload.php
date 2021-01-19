<?php
 include_once "config.php";
 $target_dir = "data/".$_POST['folder']."/";
 $name = $_POST['name'];
 $module = $_POST['module'];
 $itemid = $_POST['itemid'];
 $folder = $_POST['folder'];
 

 function generateId($length = 15) {
    $characters = '0123456789ABCDEFGHIJKLMNOP';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// $genid = generateId();

$file_name = $_FILES["file"]["name"];
$file_name = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file_name);

$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

$imagename = generateId() . time() . "." . $ext;

 print_r($_FILES);
 $target_file = $target_dir . $imagename;
 if(!isset($name) || $name=="undefined"){
    $name = $_FILES["file"]["name"];     
 }
 move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
 //write code for saving to database 
 // Create connection
 $conn = new mysqli($db_host, $db_username, $db_password, $db_tablename);
 // Check connection
 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
 }
 if($_POST['type'] ==='single'){
   $checksql = "SELECT * FROM snldata WHERE module='".$module."' AND itemid='".$itemid."'";
   $result = $conn->query($checksql) or die($conn->error . __LINE__);
   $row = $result->fetch_assoc();

   if($result->num_rows > 0){
      unlink($target_dir.''.$row['filename']);

      $delsql = "DELETE FROM snldata WHERE id='".$row['id']."'";
      $resultdel = $conn->query($delsql) or die($conn->error . __LINE__);
   }
 }
//  echo json_encode($resultdel);

 $sql = "INSERT INTO snldata (name,filename,itemid,module,folder,path) VALUES ('".$name."','".$imagename."','".$itemid."','".$module."','".$folder."','".$target_file."')";
 if ($conn->query($sql) === TRUE) {
     echo json_encode($_FILES["file"]); // new file uploaded
 } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
 }
 $conn->close();