<?php
include 'includes/header.php';
include 'includes/side-bar.php';
if(!Role('suppliersmanagement')){
    echo "<script>window.location.href='index.php';</script>";
  };
?>
<?php include 'includes/top-bar.php' ?>

<div class="page-wrapper" ng-app="appCon" ng-controller="managesupplierController">
    
    <!-- TABLE LIST-->
    <div class="page-content" style="margin-top: 60px">
        <h3 class="d-inline-block">Suppliers Management</h3>
        <?php if(Role('addsuppliers')){ ?>
            <div class="top-button float-right">
                <a class="btn btn-primary" href data-toggle="modal" data-target="#addsuppliermodal" role="button" ng-click="supplierpage(type='addSupplier',id='0')">
                    <i class="svg_icons" data-feather="user-plus"></i>
                    <span style="margin-left: 3px;">Add Supplier</span>
                </a>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body" ng-cloak>
                        <!-- <h6 class="card-title">Data Table</h6> -->
                        <div class="row">
                            <div class="pull-right" style="margin-left: 0.75em !important">
                                <label>Search:</label>
                                <input type="text" ng-model="search" ng-change="filter()" placeholder="Search" class="form-control" style="width: 25em;" />
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
                        <div class="row">
                            <div class="col-md-12" ng-show="filter_data > 0">
                                <table class="table">
                                    <thead>
                                        <th>Supplier Name: &nbsp;<a ng-click="sort_with('suppliername');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Address: &nbsp;<a ng-click="sort_with('supplieraddress');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                    <tr class="table-hover_cust" ng-repeat="data in searched = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*(data_limit == 'ALL' ? entire_user : data_limit) | limitTo:(data_limit == 'ALL' ? entire_user : data_limit)">
                                            <td>{{data.suppliername}}</td>
                                            <td>{{data.supplieraddress}}</td>
                                           <td>
                                                <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Edit Supplier" style="width: 35px; margin: auto;">
                                                <a href data-toggle="modal" data-target="#addsuppliermodal" ng-click="supplierpage('edit', data.supplierid)" class="mrcs-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit svg_icons"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </a> 
                            </div>

                                                <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="View Supplier" style="width: 35px; margin: auto;">
                                                    <a href ng-click="viewsupplierData(data.supplierid)" class="mrcs-5" data-target="#viewsupplierinfo" data-toggle="modal">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file svg_icons">
                                                            <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                                            <polyline points="13 2 13 9 20 9"></polyline>
                                                        </svg>
                                                    </a>
                                                </div>
                                        <?php if(Role('deletesuppliers')){ ?> 
                                                <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Delete Category" style="width: 35px; margin: auto;">
                                                    <a href ng-click="deletesupplier(data.supplierid, data.suppliername)" class="mrcs-5">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle svg_icons">
                                                            <circle cx="12" cy="12" r="10"></circle>
                                                            <line x1="15" y1="9" x2="9" y2="15"></line>
                                                            <line x1="9" y1="9" x2="15" y2="15"></line>
                                                        </svg>
                                                    </a>
                                                </div>
                                        <?php } ?>
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
                                <div class="col-md-12" ng-show="filter_data > 0">
                                    <div pagination="" page="current_grid" on-select-page="page_position(page)" boundary-links="true" total-items="filter_data" items-per-page="data_limit" class="pagination-small pull-right" previous-text="&laquo;" next-text="&raquo;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- END TABLE LIST -->


    <!-- ===================================================================================== -->
    <!-- =================================ADD/EDIT FORM======================================= -->
    <!-- ===================================================================================== -->


    <!--Modal:start-->
    <div class="modal fade" id="addsuppliermodal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">{{title}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" ng-submit="addsupplierForm(data)">
                        <div class="form-group">
                        <input type="hidden" ng-model='data.supplierid'>
                            <label for="suppliername">Supplier Name:</label>
                            <input id="suppliername" class="form-control" ng-model="data.suppliername" type="text" required>
                            <!-- <small class="req-txt">Supplier name is required</small> -->
                        </div>
                        <div class="form-group">
                            <label for="supplieraddress">Address:</label>
                            <input id="supplieraddress" class="form-control" ng-model="data.supplieraddress" type="text">
                            <!-- <small class="req-txt">Supplier address is required</small> -->
                        </div>
                        <div class="form-group">
                            <label for="scontactperson">Contact Person:</label>
                            <input id="scontactperson" class="form-control" ng-model="data.scontactperson" type="text">
                            <!-- <small class="req-txt">Contact person is required</small> -->
                        </div>
                        <div class="form-group">
                            <label for="sphonenumber">Phone Number:</label>
                            <input id="sphonenumber" class="form-control" ng-model="data.sphonenumber" type="text">
                        </div>
                        <div class="form-group">
                            <label for="semail">Email:</label>
                            <input id="semail" class="form-control" ng-model="data.semail" type="text">
                        </div>
                        <div class="form-group">
                            <label for="swebsite">Website:</label>
                            <input id="swebsite" class="form-control" ng-model="data.swebsite" type="text">
                        </div>
                        <div align="right">
                            <input class="btn btn-success" type="submit" name="addSupplier" value="Save">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Modal:End-->
 <!--Modal:start-->
 <div class="modal fade" id="viewsupplierinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="tru e">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Supplier Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="table-responsive">
              <table id="dataTableExample" class="table">
                <tbody>
                    <tr>
                    <td>Supplier Name: </td>
                    <td>{{viewdata.suppliername}}</td>
                  </tr>
                  <tr>
                    <td>Address: </td>
                    <td>{{viewdata.supplieraddress}}</td>
                  </tr>
                  <tr>
                    <td>Contact Person: </td>
                    <td>{{viewdata.scontactperson}}</td>
                  </tr>
                  <tr>
                    <td>Email Address: </td>
                    <td>{{viewdata.semail}}</td>
                  </tr>
                  <tr>
                    <td>Website: </td>
                    <td>{{viewdata.swebsite}}</td>
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
    <!-- END ADD/EDIT FORM -->




    <!--END content -->                                                         
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
 <!-- TAB GROUP -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>
  <script src="app-controller/js-controller/supplierCtrl.js"></script>
  <?php include "includes/footer.php"; ?>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- TAB GROUP -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>
    <script src="app-controller/js-controller/supplierCtrl.js"></script>
    <?php include "includes/footer.php"; ?>