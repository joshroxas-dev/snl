<?php
include 'includes/header.php';
include 'includes/side-bar.php';
if(!Role('systemusers')){
  echo "<script>window.location.href='index.php';</script>";
};
?>
<?php include 'includes/top-bar.php' ?>
<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> -->

<div class="page-wrapper" ng-app="appCon" ng-controller="manageuserController">

  <!-- TABLE LIST-->
  <div class="page-content" ng-show="view==='list'" style="margin-top: 60px">
    <h3 class="d-inline-block">System Users</h3>

    <div class="top-button float-right">
      <a href ng-click="userpage(type='adduser',id='0')" class="btn btn-primary">
        <i class="svg_icons" data-feather="user-plus"></i>
        <span style="margin-left: 3px;">Add User</span>
      </a>
    </div>

    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body" ng-cloak>
            <!-- <h6 class="card-title">Data Table</h6> -->
            <div class="row">
              <div class="pull-right" style="margin-left: 0.75em !important">
                <label>Search:</label>
                <input type="text" ng-model="search" ng-change="filter()" placeholder="Search" class="form-control"
                  style="width: 25em;" />
              </div>

              <div class="col-sm-2 pull-right">
                <label>PageSize:</label>
                <select ng-model="data_limit" class="form-control" style="width: 75px;">
                  <option>10</option>
                  <option>20</option>
                  <option>50</option>
                  <option>100</option>
                  <option>ALL</option>
                </select>
              </div>
            </div>
            <br />
            <!-- <table class="table">
              
              <tbody>
                <tr> 
                  <td>
                      <img class="round" width="60" height="60" avatar="Jayther Dasd">
                  </td>
                </tr>
              </tbody>
            </table> -->

            <div class="row">
              <div class="col-md-12" ng-show="filter_data > 0">
                <table class="table">
                    <thead>
                        <!-- <th>No.</th> -->
                        <th>Full Name&nbsp;<a ng-click="sort_with('lastname');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>Phone Number&nbsp;<a ng-click="sort_with('contactnumber');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>Email Address&nbsp;<a ng-click="sort_with('email');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>Action</th>
                    </thead>
                    <tbody>

                        <tr class="table-hover_cust" ng-repeat="data in searched = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*(data_limit == 'ALL' ? entire_user : data_limit) | limitTo:(data_limit == 'ALL' ? entire_user : data_limit)">
                            <!-- <td>{{$index + 1}}</td> -->
                            <td class='tb-cursor' ng-click="viewData(data.user_id)" data-target="#viewuserinfo" data-toggle="modal">{{data.firstname + ' ' + data.lastname}}</td>
                            <td class='tb-cursor' ng-click="viewData(data.user_id)" data-target="#viewuserinfo" data-toggle="modal">{{data.contactnumber}}</td>
                            <td class='tb-cursor' ng-click="viewData(data.user_id)" data-target="#viewuserinfo" data-toggle="modal">{{data.email}}</td>
                            <td>
                              <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Change Password" style="width: 35px; margin: auto;">
                                  <a href ng-click="viewData(data.user_id)"  class="btn mrcs-5 action__btn" data-target="#changepassw" data-toggle="modal" >
                                      <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="key" role="img" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-key fa-w-16 fa-7x svg_icons svg-Icolor" style="margin-top: 5px"><path fill="currentColor" d="M336 32c79.529 0 144 64.471 144 144s-64.471 144-144 144c-18.968 0-37.076-3.675-53.661-10.339L240 352h-48v64h-64v64H32v-80l170.339-170.339C195.675 213.076 192 194.968 192 176c0-79.529 64.471-144 144-144m0-32c-97.184 0-176 78.769-176 176 0 15.307 1.945 30.352 5.798 44.947L7.029 379.716A24.003 24.003 0 0 0 0 396.686V488c0 13.255 10.745 24 24 24h112c13.255 0 24-10.745 24-24v-40h40c13.255 0 24-10.745 24-24v-40h19.314c6.365 0 12.47-2.529 16.971-7.029l30.769-30.769C305.648 350.055 320.693 352 336 352c97.184 0 176-78.769 176-176C512 78.816 433.231 0 336 0zm48 108c11.028 0 20 8.972 20 20s-8.972 20-20 20-20-8.972-20-20 8.972-20 20-20m0-28c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48z" class=""></path></svg>
                                  </a>
                              </div>
                              <!-- <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="View User" style="width: 35px; margin: auto;">
                                <a href ng-click="viewData(data.user_id)"  class="btn mrcs-5 action__btn" data-target="#viewuserinfo" data-toggle="modal" >
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file svg_icons svg-Icolor" style="margin-top: 5px"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                                </a>
                              </div> -->
                              
                              <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Edit User" style="width: 35px; margin: auto;">
                                <a href ng-click="userpage(type='edit',id=data.user_id)" class="btn mrcs-5 action__btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit svg_icons svg-Icolor" style="margin-top: 5px"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </a>
                              </div>
            
                              <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Delete User" style="width: 35px; margin: auto;">
                                <a href ng-click="deleteuser(data.user_id, data.username)" class="btn mrcs-5 action__btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle svg_icons svg-Icolor" style="margin-top: 5px"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                </a>
                              </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
              </div>
              <div class="col-md-12" ng-show="filter_data == 0">
                <div class="col-md-12">
                  <h4>No records found..</h4>
                </div>
              </div>
              <div class="col-md-12">
                <!-- <div class="col-md-6 pull-left"> -->
                <!-- <h5>Showing {{ searched.length }} of {{ entire_user}} entries</h5> -->
                <!-- </div> -->
                <div class="col-md-12" ng-show="filter_data > 0">
                  <div pagination="" page="current_grid" on-select-page="page_position(page)" boundary-links="true"
                    total-items="filter_data" items-per-page="data_limit" class="pagination-small pull-right"
                    previous-text="&laquo;" next-text="&raquo;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--Modal:start-->
    <div class="modal fade" id="viewuserinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
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
              <h4>{{viewdata.lastname + ' ' + viewdata.firstname}}</h4>
            </div><br />
            <div class="table-responsive"><br />
              <table id="dataTableExample" class="table">
                <tbody>
                  <tr>
                    <td><strong>Uername</strong></td>
                    <td>{{viewdata.username}}</td>
                  </tr>
                  <tr>
                    <td><strong>Phone Number</strong></td>
                    <td>{{viewdata.contactnumber}}</td>
                  </tr>
                  <tr>
                    <td><strong>Address</strong></td>
                    <td>{{viewdata.email}}</td>
                  </tr>
                  <tr>
                    <td><strong>User Roles</strong></td>
                    <td>
                      <!-- {{rolelist.length}} -->
                      <!-- ng-class="{'icon-pfeil_unten': category.16}" -->
                      <ul class="" ng-class="{'hgt-sc scrollbar scroll-d' : rolelist.length > '7'}"
                        style="padding-left: 15px; margin-bottom: 0;">
                        <li ng-repeat="data in rolelist" style="line-height: 1.5;">
                          {{data}}
                        </li>
                      </ul>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
          </div>
        </div>
      </div>
    </div>
    <!--Modal:End-->

    <!--CHANGE PASSWORD: Modal:start-->
    <div class="modal fade" id="changepassw" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
            <button id="btnClosePopup" type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="form-group">
                  <label for="new1password">New Password</label>
                  <input class="form-control" ng-model="newpass" name="new1password" type="password">
                  <div class="col-sm-12 mt-4" align="right">
                      <input class="btn btn-cancel btn-cancelcus" type="submit" data-dismiss="modal" value="Cancel">
                      <input class="btn btn-success btn-sucbox" type="submit" ng-click="saveChangePass(newpass)" value="Save">
                  </div>
              </div>
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
          </div>
        </div>
      </div>
    </div>
    <!--Modal:End-->

  </div>
  <!-- END TABLE LIST -->


  <!-- ===================================================================================== -->
  <!-- =================================ADD/EDIT FORM======================================= -->
  <!-- ===================================================================================== -->

  <div class="page-content" ng-show="view=='adduser' || view=='edit'" ng-cloak>
    <h3><a href ng-click="userpage(type='list',id='1')"><b data-feather="chevron-left"></b></a>{{title}}</h3>
    <form class="cmxform" name="myForm" method="post" ng-submit="adduserForm(data=data, mode='{{view}}')">
      <fieldset>
        <div class="">
          <!-- col-md-12 grid-margin stretch-card -->
          <div class="col-md-12 p-0">
            <!-- card -->
            <!-- card -->
            <div class="">
              <!-- card-body -->
              <div class="">
                <div>
                  <!-- <h2>Personal Information</h2> -->
                  <div class="">
                    <div class="col-sm-6 p-0">
                      <div class="card">
                        <div class="card-body">
                          <h3 class="card-title card-t-cus">Login Credentials</h3>
                          <div class="form-group">
                            <label for="username">Username</label>
                            <input class="form-control" name="username" ng-model="data.username" type="text" required>
                          </div>
                          <div class="form-group" ng-show="view=='adduser'">
                            <label for="password">Password</label>
                            <input class="form-control" name="password" ng-model="data.password" type="password">
                          </div>
                          <div class="form-group" ng-show="view=='adduser'">
                            <label for="confirm_password">Confirm password</label>
                            <input class="form-control" name="confirm_password" ng-model="data.password2"
                              type="password">
                            <small class="req-txt" ng-show="data.password2 && data.password != data.password2">Password
                              dont match!</small>
                          </div>

                          <div class="mt-5">
                            <h3 class="card-title card-t-cus">Personal Information</h3>
                            <div class="form-group">
                              <label for="firstname">First Name</label>
                              <input id="firstname" class="form-control" ng-model="data.firstname" type="text" required>
                            </div>
                            <div class="form-group">
                              <label for="lastname">Last Name</label>
                              <input id="lastname" class="form-control" ng-model="data.lastname" type="text" required>
                            </div>
                            <div class="form-group">
                              <label for="address">Address</label>
                              <input id="address" class="form-control" ng-model="data.address" type="text" required>
                            </div>
                            <div class="form-group">
                              <label for="contactnumber">Contact Number</label>
                              <input id="contactnumber" class="form-control" ng-model="data.contactnumber" type="text"
                                required>
                            </div>
                            <div class="form-group">
                              <label for="email">Email Address</label>
                              <input id="email" class="form-control" ng-model="data.email" type="text" required>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>


                    <!-- <h2>Choose User Role</h2> -->
                    <div class="col-sm-6">
                      <div class="card">
                        <div class="card-body">
                          <h3 class="card-title card-t-cus">Choose User Roles</h3>
                          <div class="col-sm-6 form-check_custom" style="padding-bottom: 82px;">
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="customerorder"
                                  ng-model="data.customerorder" id="customerorder" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                Customer Order
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="supplierorder"
                                  ng-model="data.supplierorder" id="supplierorder" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                Supplier Order
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="stockmanagement"
                                  ng-model="data.stockmanagement" id="stockmanagement" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                Stock Management
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="addstock" ng-model="data.addstock"
                                  id="addstock" ng-true-value="'true'" ng-false-value="'false'">
                                Add Stock
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="deletestock"
                                  ng-model="data.deletestock" id="deletestock" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                Delete Stock
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="productmanagement"
                                  ng-model="data.productmanagement" id="productmanagement" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                Product Management
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="categoriesmanagement"
                                  ng-model="data.categoriesmanagement" id="categoriesmanagement" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                Categories Management
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="addcategories"
                                  ng-model="data.addcategories" id="addcategories" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                Add Categories
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="deletecategories"
                                  ng-model="data.deletecategories" id="deletecategories" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                Delete Categories
                              </label>
                            </div>

                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="brandsmanagement"
                                  ng-model="data.brandsmanagement" id="brandsmanagement" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                Brands Management
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="addbrands"
                                  ng-model="data.addbrands" id="addbrands" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                Add Brands
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="deletebrands"
                                  ng-model="data.deletebrands" id="deletebrands" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                Delete Brands
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="suppliersmanagement"
                                  ng-model="data.suppliersmanagement" id="suppliersmanagement" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                Suppliers Management
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="addsuppliers"
                                  ng-model="data.addsuppliers" id="addsuppliers" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                Add Suppliers
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="deletesuppliers"
                                  ng-model="data.deletesuppliers" id="deletesuppliers" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                Delete Suppliers
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="couriersmanagement"
                                  ng-model="data.couriersmanagement" id="couriersmanagement" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                Couriers Management
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="addcouriers"
                                  ng-model="data.addcouriers" id="addcouriers" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                Add Couriers
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="deletecouriers"
                                  ng-model="data.deletecouriers" id="deletecouriers" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                Delete Couriers
                              </label>
                            </div>
                          </div>


                          <div class="col-sm-6 form-check_custom">
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="customersmangement"
                                  ng-model="data.customermanagement" id="customermanagement" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                Customers Management
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="addcustomer"
                                  ng-model="data.addcustomer" id="addcustomer" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                Add Customer
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="deletecustomer"
                                  ng-model="data.deletecustomer" id="deletecustomer" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                Delete Customer
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="systemuser"
                                  ng-model="data.systemusers" id="systemusers" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                System Users
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="reports" ng-model="data.report"
                                  id="reports" ng-true-value="'true'" ng-false-value="'false'">
                                Report
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="dashboard"
                                  ng-model="data.dashboard" id="dashboard" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                Dashboard
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="auditlogs"
                                  ng-model="data.auditlogs" id="auditlogs" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                Audit Logs
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="settings"
                                  ng-model="data.settings" id="settings" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                Settings
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="platform"
                                  ng-model="data.platform" id="platform" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                  Platform
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="modeofpayment"
                                  ng-model="data.modeofpayment" id="modeofpayment" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                  Mode of Payment
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="editvalue"
                                  ng-model="data.editvalue" id="editvalue" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                  Edit Value
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="creditcard"
                                  ng-model="data.creditcard" id="creditcard" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                  Credit Card
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="expenses"
                                  ng-model="data.expenses" id="expenses" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                  Expenses
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="expensecategory"
                                  ng-model="data.expensecategory" id="expensecategory" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                  Expense Catagory
                              </label>
                            </div>
                            <div class="form-check form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="sizes"
                                  ng-model="data.sizes" id="sizes" ng-true-value="'true'"
                                  ng-false-value="'false'">
                                  Manage Sizes
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- BUTTON SAVE -->
                  <div class="col-sm-6 mt-4" align="right">
                    <input class="btn btn-success btn-sucbox" type="submit" value="Save">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </fieldset>
    </form>
  </div>

  <!-- ===================================================================================== -->
  <!-- =================================ADD/EDIT FORM======================================= -->
  <!-- ===================================================================================== -->






  <!-- TAB GROUP for add user -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <!-- TAB GROUP -->


  <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>
  <script src="app-controller/js-controller/systemusersCtrl.js"></script>

  <!-- ================================= -->
  <!-- =============AVATAR ICON========= -->
  <!-- ================================= -->
  <script>
    /*
     * LetterAvatar
     * 
     * Artur Heinze
     * Create Letter avatar based on Initials
     * based on https://gist.github.com/leecrossley/6027780
     */
    (function (w, d) {
      function LetterAvatar(name, size) {
        name = name || '';
        size = size || 60;

        var colours = [
          "#1abc9c", "#2ecc71", "#3498db", "#9b59b6", "#34495e", "#16a085", "#27ae60", "#2980b9", "#8e44ad", "#2c3e50",
          "#f1c40f", "#e67e22", "#e74c3c", "#ecf0f1", "#95a5a6", "#f39c12", "#d35400", "#c0392b", "#bdc3c7", "#7f8c8d"
        ],

          nameSplit = String(name).toUpperCase().split(' '),
          initials, charIndex, colourIndex, canvas, context, dataURI;


        if (nameSplit.length == 1) {
          initials = nameSplit[0] ? nameSplit[0].charAt(0) : '?';
        } else {
          initials = nameSplit[0].charAt(0) + nameSplit[1].charAt(0);
        }

        if (w.devicePixelRatio) {
          size = (size * w.devicePixelRatio);
        }

        charIndex = (initials == '?' ? 72 : initials.charCodeAt(0)) - 64;
        colourIndex = charIndex % 20;
        canvas = d.createElement('canvas');
        canvas.width = size;
        canvas.height = size;
        context = canvas.getContext("2d");

        context.fillStyle = colours[colourIndex - 1];
        context.fillRect(0, 0, canvas.width, canvas.height);
        context.font = Math.round(canvas.width / 2) + "px Arial";
        context.textAlign = "center";
        context.fillStyle = "#FFF";
        context.fillText(initials, size / 2, size / 1.5);

        dataURI = canvas.toDataURL();
        canvas = null;

        return dataURI;
      }

      LetterAvatar.transform = function () {

        Array.prototype.forEach.call(d.querySelectorAll('img[avatar]'), function (img, name) {
          name = img.getAttribute('avatar');
          img.src = LetterAvatar(name, img.getAttribute('width'));
          img.removeAttribute('avatar');
          img.setAttribute('alt', name);
        });
      };


      // AMD support
      if (typeof define === 'function' && define.amd) {

        define(function () { return LetterAvatar; });

        // CommonJS and Node.js module support.
      } else if (typeof exports !== 'undefined') {

        // Support Node.js specific `module.exports` (which can be a function)
        if (typeof module != 'undefined' && module.exports) {
          exports = module.exports = LetterAvatar;
        }

        // But always support CommonJS module 1.1.1 spec (`exports` cannot be a function)
        exports.LetterAvatar = LetterAvatar;

      } else {

        window.LetterAvatar = LetterAvatar;

        d.addEventListener('DOMContentLoaded', function (event) {
          LetterAvatar.transform();
        });
      }

    })(window, document);
  </script>
  <!-- ================================= -->
  <!-- ========== AVATAR ICON END ====== -->
  <!-- ================================= -->


  <?php include "includes/footer.php"; ?>