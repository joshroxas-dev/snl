<?php
include 'config.php';
include 'includes/header.php';
include 'includes/side-bar.php';
?>
<div class="page-wrapper" ng-app="appCon" ng-controller="manageuserController">
  <?php include 'includes/top-bar.php' ?>

  <!-- Start content -->
  <div class="page-content" ng-show="view==='list'" style="margin-top: 60px">
    <h3 class="d-inline-block">System Users</h3>

    <div class="top-button float-right">
      <a href ng-click="userpage(type='adduser',id='0')" class="btn btn-primary">
        <i class="svg_icons" data-feather="user-plus"></i>
        <span style="margin-left: 3px;">Add User</span>
      </a>
    </div>
    <nav class="page-breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Tables</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Table</li>
      </ol>
    </nav>

    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card" ng-show='!preloader'>
          <div class="card-body">
          <h6 class="card-title">Data Table</h6>
            <div class="table-responsive" >
              <table id="dataTableExample" class="table" ng-init="loaduserlist()">
                <thead>
                  <tr>
                    <th>Full Name</th>
                    <th>Phone Number</th>
                    <th>Email Address</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr ng-repeat="data in userlist">
                    <td>{{data.firstname + ' ' + data.lastname}}</td>
                    <td>{{data.contactnumber}}</td>
                    <td>{{data.email}}</td>
                    <td>
                        <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="View User" style="width: 35px; margin: auto;">
                          <a href=""  class="mrcs-5" data-target="#viewuserinfo" data-toggle="modal" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file svg_icons"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                          </a>
                        </div>
                        
                        <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Edit User" style="width: 35px; margin: auto;">
                          <a href ng-click="userpage(type='edit',id=data.user_id)" class="mrcs-5">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit svg_icons"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                          </a>
                        </div>
      
                        <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Delete User" style="width: 35px; margin: auto;">
                          <a href="" class="mrcs-5">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle svg_icons"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                          </a>
                        </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!--Modal:start-->
    <div class="modal fade" id="viewuserinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">User Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="col-sm-12" align="center">
              <img src="assets/images/image-empty.jpg" class="userview-image">
              <h4>Khenard M. Figuracion</h4>
            </div><br />
            <div class="table-responsive"><br />
              <table id="dataTableExample" class="table">
                <tbody>
                  <tr>
                    <td>Uername: </td>
                    <td>ken@snl</td>
                  </tr>
                  <tr>
                    <td>Password: </td>
                    <td>p@ssWord</td>
                  </tr>
                  <tr>
                    <td>Role: </td>
                    <td>System Admin</td>
                  </tr>
                  <tr>
                    <td>Phone Number: </td>
                    <td>09473877134</td>
                  </tr>
                  <tr>
                    <td>Email Address: </td>
                    <td>khenard.figuracion@gmail.com</td>
                  </tr>
                  <tr>
                    <td>Granted User Roles: </td>
                    <td>Product Management, Customer Order</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!--Modal:End-->
  </div>




  <div class="page-content " ng-show="view=='adduser' || view=='edit'">
      <h3><a href ng-click="userpage(type='list',id='1')"><b data-feather="chevron-left"></b></a>{{title}}</h3>
      <form class="cmxform form_wrapper" name="myForm" method="post" ng-submit="adduserForm(data)">
        <fieldset>

          <ul class="cd-breadcrumb triangle nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#Ideate" aria-controls="ideate" role="tab" data-toggle="tab" aria-expanded="true">
                    <span class="octicon octicon-light-bulb"></span>Profile
                </a>
            </li>
            <li role="presentation" class="">
                <a href="#Submit" aria-controls="submit" role="tab" data-toggle="tab" aria-expanded="false">
                    <span class="octicon octicon-diff-added"></span>Credentials
                </a>
            </li>
            <li role="presentation" class="">
                <a href="#Discuss" aria-controls="discuss" role="tab" data-toggle="tab" aria-expanded="false">
                    <span class="octicon octicon-comment-discussion"></span>Roles
                </a>
            </li>
            <li role="presentation" class="">
                <a href="#GetValidated" aria-controls="get-validated" role="tab" data-toggle="tab" aria-expanded="false">
                    <span class="octicon octicon-verified"></span>Upload Photo
                </a>
            </li>
            <!-- <li role="presentation" class="">
                <a href="#Work" aria-controls="work" role="tab" data-toggle="tab" aria-expanded="false">
                    <span class="octicon octicon-tools"></span>Work
                </a>
            </li> -->
        </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="Ideate">
                    <div class="col-sm-12 grid-margin stretch-card form_wrapper">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">Personal Information</h4>
                            <div class="form-group">
                              <label for="firstname">First Name</label>
                              <input id="firstname" class="form-control" ng-model="data.firstname" type="text" required>
                              <small class="req-txt">First Name required</small>
                            </div>
                            <div class="form-group">
                              <label for="lastname">Last Name</label>
                              <input id="lastname" class="form-control" ng-model="data.lastname" type="text" required>
                              <small class="req-txt">Last Name required</small>
                            </div>
                            <div class="form-group">
                              <label for="address">Address</label>
                              <input id="address" class="form-control" ng-model="data.address" type="text" required>
                            </div>
                            <div class="form-group">
                              <label for="contactnumber">Contact Number</label>
                              <input id="contactnumber" class="form-control" ng-model="data.contactnumber" type="text" required>
                            </div>
                            <div class="form-group">
                              <label for="email">Email Address</label>
                              <input id="email" class="form-control" ng-model="data.email" type="text" required>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="Submit">
                    <div class="col-sm-12 grid-margin stretch-card form_wrapper">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">Login Credentials</h4>
                            <div class="form-group">
                              <label for="username">Username</label>
                              <input class="form-control" name="username" ng-model="data.username" type="text" required>
                              <small class="req-txt">Username required</small>
                            </div>
                            <div class="form-group">
                              <label for="password">Password</label>
                              <input class="form-control" name="password" ng-model="data.password" type="password" required>
                            </div>
                            <div class="form-group">
                              <label for="confirm_password">Confirm password</label>
                              <input class="form-control" name="confirm_password" ng-model="data.password2" type="password" required>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="Discuss">
                    <div class="col-sm-12 grid-margin stretch-card form_wrapper">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">Choose User Roles</h4>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="customerorder" ng-model="data.customerorder" id="customerorder" ng-true-value="'true'" ng-false-value="'false'">
                                Customer Order
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="supplierorder" ng-model="data.supplierorder" id="supplierorder" ng-true-value="'true'" ng-false-value="'false'">
                                Supplier Order
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="stockmanagement" ng-model="data.stockmanagement" id="stockmanagement" ng-true-value="'true'" ng-false-value="'false'">
                                Stock Management
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="addstock" ng-model="data.addstock" id="addstock" ng-true-value="'true'" ng-false-value="'false'">
                                Add Stock
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="deletestock" ng-model="data.deletestock" id="deletestock" ng-true-value="'true'" ng-false-value="'false'">
                                Delete Stock
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="productmanagement" ng-model="data.productmanagement" id="productmanagement" ng-true-value="'true'" ng-false-value="'false'">
                                Product Management
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="categoriesmanagement" ng-model="data.categoriesmanagement" id="categoriesmanagement" ng-true-value="'true'" ng-false-value="'false'">
                                Categories Management
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="addcategories" ng-model="data.addcategories" id="addcategories" ng-true-value="'true'" ng-false-value="'false'">
                                Add Categories
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="deletecategories" ng-model="data.deletecategories" id="deletecategories" ng-true-value="'true'" ng-false-value="'false'">
                                Delete Categories
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="brandsmanagement" ng-model="data.brandsmanagement" id="brandsmanagement" ng-true-value="'true'" ng-false-value="'false'">
                                Brands Management
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="addbrands" ng-model="data.addbrands" id="addbrands" ng-true-value="'true'" ng-false-value="'false'">
                                Add Brands
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="deletebrands" ng-model="data.deletebrands" id="deletebrands" ng-true-value="'true'" ng-false-value="'false'">
                                Delete Brands
                              </label>
                            </div>
                            
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="suppliersmanagement" ng-model="data.suppliersmanagement" id="suppliersmanagement" ng-true-value="'true'" ng-false-value="'false'">
                                Suppliers Management
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="addsuppliers" ng-model="data.addsuppliers" id="addsuppliers" ng-true-value="'true'" ng-false-value="'false'">
                                Add Suppliers
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="deletesuppliers" ng-model="data.deletesuppliers" id="deletesuppliers" ng-true-value="'true'" ng-false-value="'false'">
                                Delete Suppliers
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="couriersmanagement" ng-model="data.couriersmanagement" id="couriersmanagement" ng-true-value="'true'" ng-false-value="'false'">
                                Couriers Management
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="addcouriers" ng-model="data.addcouriers" id="addcouriers" ng-true-value="'true'" ng-false-value="'false'">
                                Add Couriers
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="deletecouriers" ng-model="data.deletecouriers" id="deletecouriers" ng-true-value="'true'" ng-false-value="'false'">
                                Delete Couriers
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="customersmangement" ng-model="data.customermanagement" id="customermanagement" ng-true-value="'true'" ng-false-value="'false'">
                                Customers Management
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="addcustomer" ng-model="data.addcustomer" id="addcustomer" ng-true-value="'true'" ng-false-value="'false'">
                                Add Customer
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="deletecustomer" ng-model="data.deletecustomer" id="deletecustomer" ng-true-value="'true'" ng-false-value="'false'">
                                Delete Customer
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="systemuser" ng-model="data.systemusers" id="systemusers" ng-true-value="'true'" ng-false-value="'false'">
                                System Users
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="reports" ng-model="data.report" id="reports" ng-true-value="'true'" ng-false-value="'false'">
                                Report
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="dashboard" ng-model="data.dashboard" id="dashboard" ng-true-value="'true'" ng-false-value="'false'">
                                Dashboard
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="auditlogs" ng-model="data.auditlogs" id="auditlogs" ng-true-value="'true'" ng-false-value="'false'">
                                Audit Logs
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="GetValidated">
                  <div class="col-sm-12 grid-margin stretch-card form_wrapper">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Choose Profile Picture</h4>
                        <input type="file" id="" class="" />
                        <br />
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <div role="tabpanel" class="tab-pane" id="Work">
                    <h3>Start working on the standard definition</h3>
                </div> -->

                <div class="col-sm-12 mb-3" align="right" style="">
                  <input class="btn btn-success" type="submit" value="Save">
                </div>
            </div>

            
            
            
   <!-- TAB GROUP
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
   <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> -->


        </fieldset>
      </form>
  </div>























  

  <!-- ---------------------------------------------------------------------- -->
  <!---------------------------  ADD USER content  -------------------------- -->
  <!-- ---------------------------------------------------------------------- -->
  
  <!-- <div class="page-content" ng-show="view=='adduser' || view=='edit'">
      <h3><a href ng-click="userpage(type='list',id='1')"><b data-feather="chevron-left"></b></a>{{title}}</h3>
      <form class="cmxform" name="myForm" method="post" ng-submit="adduserForm(data)">
        <fieldset>
          <div class="row">
            <div class="col-sm-12 grid-margin stretch-card form_wrapper">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Personal Information</h4>
                  <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input id="firstname" class="form-control" ng-model="data.firstname" type="text" required>
                    <small class="req-txt">First Name required</small>
                  </div>
                  <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input id="lastname" class="form-control" ng-model="data.lastname" type="text" required>
                    <small class="req-txt">Last Name required</small>
                  </div>
                  <div class="form-group">
                    <label for="address">Address</label>
                    <input id="address" class="form-control" ng-model="data.address" type="text" required>
                  </div>
                  <div class="form-group">
                    <label for="contactnumber">Contact Number</label>
                    <input id="contactnumber" class="form-control" ng-model="data.contactnumber" type="text" required>
                  </div>
                  <div class="form-group">
                    <label for="email">Email Address</label>
                    <input id="email" class="form-control" ng-model="data.email" type="text" required>
                  </div>
                  
                </div>
              </div>
            </div>


            <div class="col-sm-12 grid-margin stretch-card form_wrapper">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Login Credentials</h4>
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control" name="username" ng-model="data.username" type="text" required>
                    <small class="req-txt">Username required</small>
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" name="password" ng-model="data.password" type="password" required>
                  </div>
                  <div class="form-group">
                    <label for="confirm_password">Confirm password</label>
                    <input class="form-control" name="confirm_password" ng-model="data.password2" type="password" required>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-sm-12 grid-margin stretch-card form_wrapper">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Choose User Roles</h4>
                  <div class="form-check form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="customerorder" ng-model="data.customerorder" id="customerorder" ng-true-value="'true'" ng-false-value="'false'">
                      Customer Order
                    </label>
                  </div>
                  <div class="form-check form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="supplierorder" ng-model="data.supplierorder" id="supplierorder" ng-true-value="'true'" ng-false-value="'false'">
                      Supplier Order
                    </label>
                  </div>
                  <div class="form-check form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="stockmanagement" ng-model="data.stockmanagement" id="stockmanagement" ng-true-value="'true'" ng-false-value="'false'">
                      Stock Management
                    </label>
                  </div>
                  <div class="form-check form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="addstock" ng-model="data.addstock" id="addstock" ng-true-value="'true'" ng-false-value="'false'">
                      Add Stock
                    </label>
                  </div>
                  <div class="form-check form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="deletestock" ng-model="data.deletestock" id="deletestock" ng-true-value="'true'" ng-false-value="'false'">
                      Delete Stock
                    </label>
                  </div>
                  <div class="form-check form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="productmanagement" ng-model="data.productmanagement" id="productmanagement" ng-true-value="'true'" ng-false-value="'false'">
                      Product Management
                    </label>
                  </div>
                  <div class="form-check form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="categoriesmanagement" ng-model="data.categoriesmanagement" id="categoriesmanagement" ng-true-value="'true'" ng-false-value="'false'">
                      Categories Management
                    </label>
                  </div>
                  <div class="form-check form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="addcategories" ng-model="data.addcategories" id="addcategories" ng-true-value="'true'" ng-false-value="'false'">
                      Add Categories
                    </label>
                  </div>
                  <div class="form-check form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="deletecategories" ng-model="data.deletecategories" id="deletecategories" ng-true-value="'true'" ng-false-value="'false'">
                      Delete Categories
                    </label>
                  </div>
                  <div class="form-check form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="brandsmanagement" ng-model="data.brandsmanagement" id="brandsmanagement" ng-true-value="'true'" ng-false-value="'false'">
                      Brands Management
                    </label>
                  </div>
                  <div class="form-check form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="addbrands" ng-model="data.addbrands" id="addbrands" ng-true-value="'true'" ng-false-value="'false'">
                      Add Brands
                    </label>
                  </div>
                  <div class="form-check form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="deletebrands" ng-model="data.deletebrands" id="deletebrands" ng-true-value="'true'" ng-false-value="'false'">
                      Delete Brands
                    </label>
                  </div>
                  
                  <div class="form-check form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="suppliersmanagement" ng-model="data.suppliersmanagement" id="suppliersmanagement" ng-true-value="'true'" ng-false-value="'false'">
                      Suppliers Management
                    </label>
                  </div>
                  <div class="form-check form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="addsuppliers" ng-model="data.addsuppliers" id="addsuppliers" ng-true-value="'true'" ng-false-value="'false'">
                      Add Suppliers
                    </label>
                  </div>
                  <div class="form-check form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="deletesuppliers" ng-model="data.deletesuppliers" id="deletesuppliers" ng-true-value="'true'" ng-false-value="'false'">
                      Delete Suppliers
                    </label>
                  </div>
                  <div class="form-check form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="couriersmanagement" ng-model="data.couriersmanagement" id="couriersmanagement" ng-true-value="'true'" ng-false-value="'false'">
                      Couriers Management
                    </label>
                  </div>
                  <div class="form-check form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="addcouriers" ng-model="data.addcouriers" id="addcouriers" ng-true-value="'true'" ng-false-value="'false'">
                      Add Couriers
                    </label>
                  </div>
                  <div class="form-check form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="deletecouriers" ng-model="data.deletecouriers" id="deletecouriers" ng-true-value="'true'" ng-false-value="'false'">
                      Delete Couriers
                    </label>
                  </div>
                  <div class="form-check form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="customersmangement" ng-model="data.customermanagement" id="customermanagement" ng-true-value="'true'" ng-false-value="'false'">
                      Customers Management
                    </label>
                  </div>
                  <div class="form-check form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="addcustomer" ng-model="data.addcustomer" id="addcustomer" ng-true-value="'true'" ng-false-value="'false'">
                      Add Customer
                    </label>
                  </div>
                  <div class="form-check form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="deletecustomer" ng-model="data.deletecustomer" id="deletecustomer" ng-true-value="'true'" ng-false-value="'false'">
                      Delete Customer
                    </label>
                  </div>
                  <div class="form-check form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="systemuser" ng-model="data.systemusers" id="systemusers" ng-true-value="'true'" ng-false-value="'false'">
                      System Users
                    </label>
                  </div>
                  <div class="form-check form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="reports" ng-model="data.report" id="reports" ng-true-value="'true'" ng-false-value="'false'">
                      Report
                    </label>
                  </div>
                  <div class="form-check form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="dashboard" ng-model="data.dashboard" id="dashboard" ng-true-value="'true'" ng-false-value="'false'">
                      Dashboard
                    </label>
                  </div>
                  <div class="form-check form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="auditlogs" ng-model="data.auditlogs" id="auditlogs" ng-true-value="'true'" ng-false-value="'false'">
                      Audit Logs
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12 grid-margin stretch-card form_wrapper">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Choose Profile Picture</h4>
                  <input type="file" id="" class="" />
                  <br />
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-12" align="right">
            <input class="btn btn-success" type="submit" value="Save">
          </div>
        </fieldset>
      </form>
    </div> -->
  <!-- ---------------------------------------------------------------------- -->
  <!-------------------------  END ADD USER content  ------------------------ -->
  <!-- ---------------------------------------------------------------------- -->







</div>
  <!--END content -->

  <?php include "includes/footer.php"; ?>
  

  <script>
    $(document).ready( function () {
      $('#dataTableExample').DataTable();
    } );
  </script>

