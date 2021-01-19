<?php
include 'config.php';
include 'includes/header.php';
include 'includes/side-bar.php';
?>
<div class="page-wrapper" ng-app="appCon" ng-controller="customerorderController" ng-cloak>
    <?php include 'includes/top-bar.php' ?>
    <!-- content -->-
    <div class="page-content" ng-show="view=='main'">
         <h3 class="d-inline-block">Trial Balance</h3>
         <a href="rprint_rep_trialbal.php" class="btn btn-primary" style="margin-left: 13px; margin-bottom: 15px;" target="_blank">PRINT</a>
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
                                <th>DEBIT</th>
                                <th>CREDIT</th>
                                
                            </thead>
                            <tbody>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'>Bank of the Philippine Islands</td>
                                    <td class='tb-cursor cus_tbl-td'>1,030.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'>Bank of the Philippine Islands:CIB BPI Walk-in Sales</td>
                                    <td class='tb-cursor cus_tbl-td'>1,030.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'>Bank of the Philippine Islands:CIB BPI Website Sales</td>
                                    <td class='tb-cursor cus_tbl-td'>1,030.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'>BDO</td>
                                    <td class='tb-cursor cus_tbl-td'>1,030.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'>Cash and cash equivalents</td>
                                    <td class='tb-cursor cus_tbl-td'>1,030.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'>CIB BPI Revived Sales</td>
                                    <td class='tb-cursor cus_tbl-td'>1,030.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'>Money Market</td>
                                    <td class='tb-cursor cus_tbl-td'>1,030.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'>Petty Cash Fund</td>
                                    <td class='tb-cursor cus_tbl-td'>1,030.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'>RCBC</td>
                                    <td class='tb-cursor cus_tbl-td'>1,030.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'>Accounts Receivable (A/R)</td>
                                    <td class='tb-cursor cus_tbl-td'>1,030.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'>Inventory Asset</td>
                                    <td class='tb-cursor cus_tbl-td'>1,030.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'>Prepaid expenses</td>
                                    <td class='tb-cursor cus_tbl-td'>1,030.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'>Accounts Payable (A/P)</td>
                                    <td class='tb-cursor cus_tbl-td'>1,030.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'>BPI Mastercard</td>
                                    <td class='tb-cursor cus_tbl-td'>1,030.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'>PNB VISA</td>
                                    <td class='tb-cursor cus_tbl-td'>1,030.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'>RCBC Mastercard</td>
                                    <td class='tb-cursor cus_tbl-td'>1,030.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'>Opening Balance Equity</td>
                                    <td class='tb-cursor cus_tbl-td'>1,030.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'>Retained Earnings</td>
                                    <td class='tb-cursor cus_tbl-td'>1,030.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'>Discounts given</td>
                                    <td class='tb-cursor cus_tbl-td'>1,030.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'>Sales</td>
                                    <td class='tb-cursor cus_tbl-td'>1,030.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'>Sales of Product Income</td>
                                    <td class='tb-cursor cus_tbl-td'>1,030.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'>Shipping Income</td>
                                    <td class='tb-cursor cus_tbl-td'>1,030.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'>Cost of sales</td>
                                    <td class='tb-cursor cus_tbl-td'>1,030.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'><strong>TOTAL</strong></td>
                                    <td class='tb-cursor cus_tbl-td'><strong>PHP2,959,868.73</strong></td>
                                    <td class='tb-cursor cus_tbl-td'><strong>PHP2,959,868.73</strong></td>
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

<script src="app-controller/js-controller/customerorderCtrl.js"></script>
<?php include "includes/footer.php"; ?>