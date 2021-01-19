<?php
include 'config.php';
include 'includes/header.php';
include 'includes/side-bar.php';
$phppage = basename($_SERVER['PHP_SELF']);
?>
<?php include 'includes/top-bar.php' ?>
<!-- <div class="page-wrapper" ng-app="appCon" ng-controller="reportsController-new"> -->


  <!-- TABLE LIST-->
  <div class="page-content" style="margin-top: 60px"  ng-init="getCurrentReportPage('<?php echo $phppage; ?>')">
    <h3 class="d-inline-block">Customer Balance Summary</h3>
    <div class="top-button float-right">
    <a href="documents/print_rep_customerbalsummary.php" class="btn btn-primary" target="_blank">
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
                  <label>Page Size:</label>
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
                   <th>DATE</th>
                    <th>TRANSACTION TYPE</th>
                     <th>NO.</th>
                     <th>NAME</th>
                     <th style="width: 255px;">MEMO/DESCRIPTION</th>
                    <th style="width: 255px;">ACCOUNT</th>
                    <th>DEBIT</th>
                     <th>CREDIT</th>
                            </thead>
                    <tbody>
                        <tr class="table-hover_cust" ng-repeat="data in searched = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*(data_limit == 'ALL' ? entire_user : data_limit) | limitTo:(data_limit == 'ALL' ? entire_user : data_limit)"> 
                        <td class='tb-cursor cus_tbl-td'>10/01/2019</td>
                                    <td class='tb-cursor cus_tbl-td'>Invoice</td>
                                    <td class='tb-cursor cus_tbl-td'>3220</td>
                                    <td class='tb-cursor cus_tbl-td'>Aaron Dale Carpio</td>
                                    <td class='tb-cursor cus_tbl-td'>Brush Cleaner - Opening inventory and value</td>
                                    <td class='tb-cursor cus_tbl-td'>
                                        <ul class="p-0">
                                            <li style="line-height: 1.7;">Accounts Receivable (A/R)</li>
                                            <li style="line-height: 1.7;">Cost of sales</li>
                                        </ul>
                                    </td>
                                    <td class='tb-cursor cus_tbl-td'>PHP657.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
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
  <script src="app-controller/js-controller/reportsCtrl-new.js"></script>
  <?php include "includes/footer.php"; ?>

