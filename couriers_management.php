<?php
include 'includes/header.php';
include 'includes/side-bar.php';
if(!Role('couriersmanagement')){
  echo "<script>window.location.href='index.php';</script>";
};
?>
<?php include 'includes/top-bar.php' ?>
<div class="page-wrapper" ng-app="appCon" ng-controller="managecourierController">
  

  <!-- TABLE LIST-->
  <div class="page-content" style="margin-top: 60px">
    <h3 class="d-inline-block">Courier Management</h3>
    <?php if(Role('addcouriers')){ ?> 
    <div class="top-button float-right">
      <a class="btn btn-primary" href data-toggle="modal" data-target="#addcouriermodal" role="button"  ng-click="courierpage('addCourier','0')">
                <i class="svg_icons" data-feather="user-plus"></i>
                <span style="margin-left: 3px;">Add Courier</span>
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
                    <input type="text" ng-model="search" ng-change="filter()" placeholder="Search" class="form-control" style="width: 25em;"/>
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
            <br/>
            <div class="row">
                <div class="col-md-12" ng-show="filter_data > 0">
                <table class="table">
                    <thead>
                        <th>Courier Name&nbsp;<a ng-click="sort_with('couriername');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>Branch Address&nbsp;<a ng-click="sort_with('courierbranch');"><i class="glyphicon glyphicon-sort"></i></a></th>
                         <th>Website&nbsp;<a ng-click="sort_with('courierwebsite');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    <tr class="table-hover_cust" ng-repeat="data in searched = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*(data_limit == 'ALL' ? entire_user : data_limit) | limitTo:(data_limit == 'ALL' ? entire_user : data_limit)">
                    <td>{{data.couriername}}</td>
                            <td>{{data.courierbranch}}</td> 
                             <td>{{data.courierwebsite}}</td>
                            <td>
                              <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="View Courier" style="width: 35px; margin: auto;">
                                <a href ng-click="viewcourierData(data.courierid)"  class="mrcs-5" data-target="#viewcourierinfo" data-toggle="modal" >
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file svg_icons"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                                </a>
                              </div>
                              
                              <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Edit Courier" style="width: 35px; margin: auto;">
                              <a href data-toggle="modal" data-target="#addcouriermodal" ng-click="courierpage('edit', data.courierid)" class="mrcs-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit svg_icons"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </a>
                              </div>
                              <?php if(Role('deletecouriers')){ ?> 
                              <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Delete Brand" style="width: 35px; margin: auto;">
                                <a href ng-click="deletecourier(data.courierid, data.couriername)" class="mrcs-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle svg_icons"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
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

    <!--Modal:start-->
    <div class="modal fade" id="viewcourierinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Courier Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="table-responsive">
              <table id="dataTableExample" class="table">
                <tbody>
                    <tr>
                    <td>Courier Name: </td>
                    <td>{{viewdata.couriername}}</td>
                  </tr>
                  <tr>
                    <td>Branch Address: </td>
                    <td>{{viewdata.courierbranch}}</td>
                  </tr>
                  <tr>
                    <td>Phone Number: </td>
                    <td>{{viewdata.courierphonenum}}</td>
                  </tr>
                  <tr>
                    <td>Email Address: </td>
                    <td>{{viewdata.courieremail}}</td>
                  </tr>
                    <td>Website: </td>
                    <td>{{viewdata.courierwebsite}}</td>
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
  <!-- END TABLE LIST -->


  <!-- ===================================================================================== -->
  <!-- =================================ADD/EDIT FORM======================================= -->
  <!-- ===================================================================================== -->


 <!--Modal:start-->
 <div class="modal fade" id="addcouriermodal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">{{title}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" ng-submit="addcourierForm(data)">
                        <div class="form-group">
                        <input type="hidden" ng-model='data.courierid'>
                                     <label for="couriername">Courier Name:</label>
                                    <input id="couriername" class="form-control" ng-model="data.couriername" type="text" required>
                                    <!-- <small class="req-txt">Courier name is required</small> -->
                                  </div>
                                  <div class="form-group">
                                    <label for="courierbranch">Branch Address:</label>
                                    <input id="courierbranch" class="form-control" ng-model="data.courierbranch" type="text" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="courierphonenum">Phone Number:</label>
                                    <input id="courierphonenum" class="form-control" ng-model="data.courierphonenum" type="text" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="courieremail">Email Address:</label>
                                    <input id="courieremail" class="form-control" ng-model="data.courieremail" type="text">
                                  </div>
                                  <div class="form-group">
                                    <label for="courierwebsite">Website:</label>
                                    <input id="courierwebsite" class="form-control" ng-model="data.courierwebsite" type="text">
                                  </div>
                            <div align="right">
                                <input class="btn btn-success" type="submit" name="addCourier" value="Save">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
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
  <script src="app-controller/js-controller/courierCtrl.js"></script>
  <?php include "includes/footer.php"; ?>

