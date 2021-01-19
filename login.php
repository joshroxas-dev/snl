<?php
include "session.php";

if(loggedIn()){
    echo "<script>window.location.href='index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sneaks and Laces - Inventory and Accounting System</title>
    <!-- AngularJs plugins -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
    <!-- core:css -->
    <link rel="stylesheet" href="assets/vendors/core/core.css">
    <!-- endinject -->
    <link rel="stylesheet" href="assets/vendors/sweetalert2/sweetalert2.min.css">
    <!-- end plugin css for this page -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- end plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/fonts/feather-font/css/iconfont.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/demo_1/style.css">

    <link rel="stylesheet" href="assets/css/snl-style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    
</head>

<body class="sidebar-dark">
    <div class="main-wrapper">
        <!-- header -->

          <img src="assets/images/bg-login.png" class="" style="width: 100%; z-index: 0; position: absolute; " alt="medisource-logo">

          <div class="login-box" style="margin-top: 60px;" ng-app="appCon" ng-controller="loginController">
            <div class="auth-form-wrapper login-wrapper px-4 py-5 ">
              <div style="width: 160px; margin: auto; margin-bottom: 20px;"><img src="assets/images/snl_logo.png" style="width: 100%;"></div>

                <form class="forms-sample" method="post" ng-submit="loginForm(data)">

                    <div class="form-group">
                      <label for="exampleInputEmail1" class="text-white">Username</label>
                      <input type="text" class="form-control form-black" ng-model="data.username" placeholder="Enter username" id="" style="margin-bottom: 5px;" required>
                      <!-- <small class="req-txt">Username required</small> -->
                    </div>

                    <div class="form-group">
                      <label for="" class="text-white">Password</label>
                      <input type="password" class="form-control form-black" ng-model="data.password" id="" placeholder="Enter password"autocomplete="" style="margin-bottom: 5px;" required>
                      <small ng-show='errMessage' class="req-txt">Invald Username or Password</small>
                    </div>
                     <!-- <small class="req-txt">Password required</small> -->
                      <!-- <label class="checkbox">
                          <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> 
                          <span class="text-white">
                            Remember me
                          </span> 
                      </label> -->

                      <div class="mt-5" align="right">
                        <button type="submit" class="btn btn-primary btn_Mylw btn_round mr-2 mb-2 mb-md-0" style="width: 100%;">
                          Login
                        </button>
                        <!-- <a href="index.php" class="btn btn-primary btn_Mylw btn_round mr-2 mb-2 mb-md-0" style="width: 100%;">Login</a> -->
                      </div>

                  </form>

              </div>
          </div>






<!-- footer -->
</div>
<!-- core:js -->
<script src="assets/vendors/core/core.js"></script>
<!-- endinject -->
<script src="app.js"></script>
<!-- plugin js for this page -->
<script src="assets/vendors/chartjs/Chart.min.js"></script>
<script src="assets/vendors/jquery.flot/jquery.flot.js"></script>
<script src="assets/vendors/jquery.flot/jquery.flot.resize.js"></script>
<script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="assets/vendors/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
<!-- end plugin js for this page -->
<script src="assets/vendors/sweetalert2/sweetalert2.min.js"></script>
<script src="assets/js/sweet-alert.js"></script>
<!-- inject:js -->
<script src="assets/vendors/feather-icons/feather.min.js"></script>
<script src="assets/js/template.js"></script>
<!-- endinject -->
<!-- custom js for this page -->
<script src="assets/js/dashboard.js"></script>
<script src="assets/js/datepicker.js"></script>
<!-- end custom js for this page -->
</body>

</html>