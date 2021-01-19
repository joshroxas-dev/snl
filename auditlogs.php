<?php
include 'includes/header.php';
include 'includes/side-bar.php';

if(!Role('auditlogs')){
  echo "<script>window.location.href='index.php';</script>";
};
?>
<?php include 'includes/top-bar.php' ?>
<div class="page-wrapper" ng-app="appCon" ng-controller="auditlogsController">


  <!-- TABLE LIST-->
  <div class="page-content" style="margin-top: 60px">
    <h3 class="d-inline-block">Audit Logs</h3>
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
                        <th>Log ID &nbsp;<a ng-click="sort_with('log_id');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>User&nbsp;<a ng-click="sort_with('users_id');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>Event &nbsp;<a ng-click="sort_with('event');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>Description &nbsp;<a ng-click="sort_with('description');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>Module &nbsp;<a ng-click="sort_with('module');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>Log Date/Time &nbsp;<a ng-click="sort_with('datecreated');"><i class="glyphicon glyphicon-sort"></i></a></th>         
                    </thead>
                    <tbody>
                    <tr class="table-hover_cust" ng-repeat="data in searched = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*(data_limit == 'ALL' ? entire_user : data_limit) | limitTo:(data_limit == 'ALL' ? entire_user : data_limit)">
                            <td>{{data.log_id}}</td>
                            <td>{{data.users_id}}</td>
                            <td>{{data.event}}</td>
                            <td>{{data.description}}</td>
                            <td>{{data.module}}</td>
                            <td>{{data.datecreated}}</td>
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




  <!--END content -->

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
 <!-- TAB GROUP -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>
  <script src="app-controller/js-controller/auditlogsCtrl.js"></script>
  <?php include "includes/footer.php"; ?>

