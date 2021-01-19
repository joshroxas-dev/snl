<?php
include 'config.php';
include 'includes/header.php';
include 'includes/side-bar.php';
?>
<div class="page-wrapper" ng-app="appCon" ng-controller="customerorderController" ng-cloak>
    <?php include 'includes/top-bar.php' ?>
    <!-- content -->-
    <div class="page-content" ng-show="view=='main'">
         <h3 class="d-inline-block">Statement of Cash Flows</h3>
         <a href="rprint_rep_statecash.php" class="btn btn-primary" style="margin-left: 13px; margin-bottom: 15px;" target="_blank">PRINT</a>
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
                                <!-- <th>No.</th> -->
                                <th></th>
                                <th>Total</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Cash flows from operating activities</td>
                                    <td></td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor'>Profit for the year</td>
                                    <td class='tb-cursor'>1,481,020.53</td>
                                </tr>
                                <tr>
                                    <td> Adjustments for non-cash income and expenses:</td>
                                    <td></td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor'>Accounts Receivable (A/R)</td>
                                    <td class='tb-cursor'>-1,532,895.26</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor'>Inventory Asset</td>
                                    <td class='tb-cursor'>339,693.73</td>
                                </tr>
                                <tr class="table-hover_cust">
                                    <td><strong>Total Adjustments for non-cash income and expenses:</strong></td>
                                    <td><strong>-1,193,201.53</strong></td>
                                </tr>
                                <tr class="table-hover_cust">
                                    <td><strong>Net cash from operating activities</strong></td>
                                    <td><strong>PHP287,819.00</strong></td>
                                </tr>
                                <tr >
                                    <td>Cash flows from financing activities</td>
                                    <td></td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor'>Opening Balance Equity</td>
                                    <td class='tb-cursor'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust"> 
                                    <td><strong>Net cash used in financing activities</strong></td>
                                    <td><strong>PHP0.00</strong></td>
                                </tr>
                                <tr class="table-hover_cust">
                                    <td class='tb-cursor'>NET INCREASE (DECREASE) IN CASH AND CASH EQUIVALENTS</td>
                                    <td><strong>PHP287,819.00</strong></td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor'>Cash and cash equivalents at beginning of year</td>
                                    <td class='tb-cursor'>398,742.00</td>
                                </tr>
                                <tr class="table-hover_cust">
                                    <td class='tb-cursor'>CASH AND CASH EQUIVALENTS AT END OF YEAR</td>
                                    <td><strong>PHP686,561.00</strong></td>
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