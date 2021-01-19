<?php
include 'config.php';
include 'includes/header.php';
include 'includes/side-bar.php';
$phppage = basename($_SERVER['PHP_SELF']);
?>
<?php include 'includes/top-bar.php' ?>
<div class="page-wrapper" ng-app="appCon" ng-controller="reportsController">


  <!-- TABLE LIST-->
  <div class="page-content" style="margin-top: 60px"  ng-init="getCurrentReportPage('<?php echo $phppage; ?>')">
    <h3 class="d-inline-block">Transaction List by Date</h3>
    <div class="top-button float-right">
    <a href="reports/print_rep_transaclisdate.php" class="btn btn-primary" target="_blank">
                <i class="svg_icons" data-feather="file-text"></i>
                <span style="margin-left: 3px;">  </span>
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
                <!-- <div class="col-sm-5 pull-right">
                <label>Date: </label>
                <input type="date" class="form-control" id="from-date" name="from-date">
                <input type="date" class="form-control" id="to-date" name="to-date">
                </div> -->
            </div>
            <br/>
            <div class="row">
                <div class="col-md-12" ng-show="filter_data > 0">
                <table class="table">
                <thead>
                                <th>DATE<a ng-click="sort_with('purchasedate');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                <th>TRANS TYPE</th>
                                <!-- <th>POSTING</th>
                                <th>NAME</th> -->
                                <th>MEMO</th>
                                <!-- <th>ACCOUNT</th>
                                <th>SPLIT</th> -->
                                <th>AMOUNT (₱)</th>
                            </thead>
                    <tbody>
                        <tr class="table-hover_cust" ng-repeat="data in searched = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*(data_limit == 'ALL' ? entire_user : data_limit) | limitTo:(data_limit == 'ALL' ? entire_user : data_limit)">
                            <td class='tb-cursor cus_tbl-td'>{{data.purchasedate}}</td>
                            <td class='tb-cursor cus_tbl-td'>INVOICE</td>
                            <!-- <td class='tb-cursor cus_tbl-td'>YES</td>
                            <td class='tb-cursor cus_tbl-td'>{{data.customerbname}}</td> -->
                            <td class='tb-cursor cus_tbl-td'>{{data.remarks}}</td>
                            <!-- <td class='tb-cursor cus_tbl-td'>Inventory Assets</td> -->
                            <!-- <td class='tb-cursor cus_tbl-td'>{{data.customerfirstname + " " +  data.customerlastname}}</td> -->
                            <td class='tb-cursor cus_tbl-td'>{{data.totalamountpesos}}</td>
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
  <script src="app-controller/js-controller/reportsCtrl.js"></script>
  <?php include "includes/footer.php"; ?>

