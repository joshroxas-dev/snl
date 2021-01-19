<?php 
include 'session.php'; 
//include(@$baseUrl."session.php");
if(!loggedIn()){
    echo "<script>window.location.href='login.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sneaks and laces </title>
    <link rel="icon" href="assets/images/icon.png" type="image" sizes="16x16">
    <!-- <link rel="shortcut icon" href="favicon.ico"/> -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sneaks and Laces - Inventory and Accounting System</title>
    <!-- AngularJs plugins -->

    <link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">

    <!-- core:css -->
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/vendors/core/core.css">

    <!-- endinject -->
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/vendors/sweetalert2/sweetalert2.min.css">
    <!-- end plugin css for this page -->

    <!-- plugin css for this page -->
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/vendors/dropify/dist/dropify.min.css">
    <!-- end plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/fonts/feather-font/css/iconfont.css">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/demo_1/style.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/snl-style.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/css/components.css">
    <!-- End layout styles -->

    <!-- MATERIAL DESIGN CDN -->
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/css/mdb.min.css" rel="stylesheet"> -->
    <!-- MATERIAL DESIGN CDN -->
    
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/vendors/select2/select2.min.css">
    <link rel="shortcut icon" href="<?php echo $baseUrl; ?>assets/images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- ZMDI MATERIAL DESIGN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <!-- ZMDI MATERIAL DESIGN -->
    <script src="<?php echo $baseUrl; ?>assets/js/angular.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/ng-currency/1.2.3/ng-currency.js"></script>
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	<link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/vendors/bootstrap-colorpicker/bootstrap-colorpicker.min.css">
</head>

<body class="sidebar-dark">
    <div class="main-wrapper">
        <!-- header -->