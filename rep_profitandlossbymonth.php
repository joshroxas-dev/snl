<?php
include 'config.php';
include 'includes/header.php';
include 'includes/side-bar.php';
$phppage = basename($_SERVER['PHP_SELF']);
?>
<div class="page-wrapper" ng-app="appCon" ng-controller="reportsController">
    <?php include 'includes/top-bar.php' ?>
    <!-- content -->-
    <div class="page-content" ng-init="getCurrentReportPage('<?php echo $phppage; ?>')">
         <h3 class="d-inline-block">Profit and Loss by Month</h3>
         <a href="documents/print_rep_profitandlossbymonth.php" class="btn btn-primary" style="margin-left: 13px; margin-bottom: 15px;" target="_blank">PRINT</a>
        <!-- <div class="top-button float-right">
            <a href ng-click="userpage(type='page2',id='0')" class="btn btn-primary">
                <i class="svg_icons" data-feather="file-text"></i>
                <span style="margin-left: 3px;">Customer Order List</span>
            </a>
        </div> -->

        <!-- content -->
        <div class="row" style="margin-top: 10px;">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th></th>
                                <th>JAN</th>
                                <th>FEB</th>
                                <th>MAR</th>
                                <th>APR</th>
                                <th>MAY</th>
                                <th>JUN</th>
                                <th>JUL</th>
                                <th>AUG</th>
                                <th>SEP</th>
                                <th>OCT</th>
                                <th>NOV</th>
                                <th>DEC</th>
                            </thead>
                            <tbody>
                                <tr><td class="" colspan="11"><strong>INCOME</strong></td></tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'>Purchase Order</td>
                                    <td class='tb-cursor cus_tbl-td'>{{data.totalamountpo}}</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'>Customer Order</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor'><strong>Total Income</strong></td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor'><strong>GROSS PROFIT</strong></td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                
                                <tr>
                                    <td class="" colspan="11"><strong>Expenses</strong></td>
                                </tr>
                                <tr>
                                    <td class="" colspan="10"><strong>Total Expenses</strong></td>
                                    <td class=""><strong>PHP 0.00</strong></td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor'><strong>NET EARNINGS</strong></td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                            </tbody>
                                
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- content -->

    </div>
   

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
 <!-- TAB GROUP -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>
  <script src="app-controller/js-controller/reportsCtrl.js"></script>
  <?php include "includes/footer.php"; ?>