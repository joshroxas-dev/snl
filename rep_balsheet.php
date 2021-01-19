<?php
include 'config.php';
include 'includes/header.php';
include 'includes/side-bar.php';
?>
<div class="page-wrapper" ng-app="appCon" ng-controller="customerorderController" ng-cloak>
    <?php include 'includes/top-bar.php' ?>
    <!-- content -->-
    <div class="page-content" ng-show="view=='main'">
         <h3 class="d-inline-block">Balance Sheet Comparison</h3>
         <a href="rprint_rep_balancesheetcomp.php" class="btn btn-primary" style="margin-left: 13px; margin-bottom: 15px;" target="_blank">PRINT</a>
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
                                <th>AS OF OCT 18, 2019</th>
                                <th>AS OF OCT 18, 2018 (PY)</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Assets</td>
                                    <td class="cus_tbl-td"></td>
                                    <td class="cus_tbl-td"></td>
                                </tr>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Current Assets</td>
                                    <td class="cus_tbl-td"></td>
                                    <td class="cus_tbl-td"></td>
                                </tr>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Accounts receivable</td>
                                    <td class="cus_tbl-td"></td>
                                    <td class="cus_tbl-td"></td>
                                </tr>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Accounts Receivable (A/R)</td>
                                    <td class="cus_tbl-td">1,910,376.26</td>
                                    <td class="cus_tbl-td">166,066.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor'><strong>Total Accounts receivable</strong></td>
                                    <td class='tb-cursor'><strong>PHP1,910,376.26</strong></td>
                                    <td class='tb-cursor'><strong>PHP166,066.00</strong></td>
                                </tr>

                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Bank of the Philippine Islands</td>
                                    <td class="cus_tbl-td cus_tbl-th">1,030.00</td>
                                    <td class="cus_tbl-td cus_tbl-th">1,030.00</td>
                                </tr>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">CIB BPI Walk-in Sales</td>
                                    <td class="cus_tbl-td cus_tbl-th">1,030.00</td>
                                    <td class="cus_tbl-td cus_tbl-th">1,030.00</td>
                                </tr>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">CIB BPI Website Sales</td>
                                    <td class="cus_tbl-td cus_tbl-th">1,030.00</td>
                                    <td class="cus_tbl-td cus_tbl-th">1,030.00</td>
                                </tr>


                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor'><strong>Total Bank of the Philippine Islands</strong></td>
                                    <td class='tb-cursor'><strong>159,192.45</strong></td>
                                    <td class='tb-cursor'><strong>22,638.45</strong></td>
                                </tr>

                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">BDO</td>
                                    <td class="cus_tbl-td cus_tbl-th">1,030.00</td>
                                    <td class="cus_tbl-td cus_tbl-th">1,030.00</td>
                                </tr>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Cash and cash equivalents</td>
                                    <td class="cus_tbl-td cus_tbl-th">1,030.00</td>
                                    <td class="cus_tbl-td cus_tbl-th">1,030.00</td>
                                </tr>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">CIB BPI Revived Sales</td>
                                    <td class="cus_tbl-td cus_tbl-th">1,030.00</td>
                                    <td class="cus_tbl-td cus_tbl-th">1,030.00</td>
                                </tr>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Money Market</td>
                                    <td class="cus_tbl-td cus_tbl-th">1,030.00</td>
                                    <td class="cus_tbl-td cus_tbl-th">1,030.00</td>
                                </tr>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Petty Cash Fund</td>
                                    <td class="cus_tbl-td cus_tbl-th">1,030.00</td>
                                    <td class="cus_tbl-td cus_tbl-th">1,030.00</td>
                                </tr>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">RCBC</td>
                                    <td class="cus_tbl-td cus_tbl-th">1,030.00</td>
                                    <td class="cus_tbl-td cus_tbl-th">1,030.00</td>
                                </tr>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Inventory Asset</td>
                                    <td class="cus_tbl-td cus_tbl-th">1,030.00</td>
                                    <td class="cus_tbl-td cus_tbl-th">1,030.00</td>
                                </tr>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Prepaid expenses</td>
                                    <td class="cus_tbl-td cus_tbl-th">1,030.00</td>
                                    <td class="cus_tbl-td cus_tbl-th">1,030.00</td>
                                </tr>
                               
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor'><strong>Total Current Assets</strong></td>
                                    <td class='tb-cursor'><strong>PHP2,432,983.76</strong></td>
                                    <td class='tb-cursor'><strong>PHP302,508.17</strong></td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor'><strong>Total Assets</strong></td>
                                    <td class='tb-cursor'><strong>PHP2,432,983.76</strong></td>
                                    <td class='tb-cursor'><strong>PHP302,508.17</strong></td>
                                </tr>

                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Liabilities and shareholder's equity</td>
                                    <td class="cus_tbl-td cus_tbl-th"></td>
                                    <td class="cus_tbl-td cus_tbl-th"></td>
                                </tr>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Current liabilities:</td>
                                    <td class="cus_tbl-td cus_tbl-th"></td>
                                    <td class="cus_tbl-td cus_tbl-th"></td>
                                </tr>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Accounts payable</td>
                                    <td class="cus_tbl-td cus_tbl-th"></td>
                                    <td class="cus_tbl-td cus_tbl-th"></td>
                                </tr>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Accounts Payable (A/P)</td>
                                    <td class="cus_tbl-td cus_tbl-th">0.00</td>
                                    <td class="cus_tbl-td cus_tbl-th">-71,474.02</td>
                                </tr>
                                
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor'><strong>Total Accounts payable</strong></td>
                                    <td class='tb-cursor'><strong>PHP0.00</strong></td>
                                    <td class='tb-cursor'><strong>PHP -71,474.02</strong></td>
                                </tr>

                                
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">BPI Mastercard</td>
                                    <td class="cus_tbl-td cus_tbl-th">20,030.63</td>
                                    <td class="cus_tbl-td cus_tbl-th">20,130.63</td>
                                </tr>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">PNB VISA</td>
                                    <td class="cus_tbl-td cus_tbl-th">152,735.56</td>
                                    <td class="cus_tbl-td cus_tbl-th">1,516.25</td>
                                </tr>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">RCBC Mastercard</td>
                                    <td class="cus_tbl-td cus_tbl-th">71,474.02</td>
                                    <td class="cus_tbl-td cus_tbl-th">71,474.02</td>
                                </tr>
                                
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor'><strong>Total current liabilities</strong></td>
                                    <td class='tb-cursor'><strong>PHP244,240.21</strong></td>
                                    <td class='tb-cursor'><strong>PHP21,646.88</strong></td>
                                </tr>

                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Shareholders' equity:</td>
                                    <td class="cus_tbl-td cus_tbl-th"></td>
                                    <td class="cus_tbl-td cus_tbl-th"></td>
                                </tr>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Net Income</td>
                                    <td class="cus_tbl-td cus_tbl-th">1,481,020.53</td>
                                    <td class="cus_tbl-td cus_tbl-th">221,611.12</td>
                                </tr>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Opening Balance Equity</td>
                                    <td class="cus_tbl-td cus_tbl-th">71,474.02</td>
                                    <td class="cus_tbl-td cus_tbl-th">71,474.02</td>
                                </tr>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Retained Earnings</td>
                                    <td class="cus_tbl-td cus_tbl-th">71,474.02</td>
                                    <td class="cus_tbl-td cus_tbl-th"></td>
                                </tr>

                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor'><strong>Total shareholders' equity</strong></td>
                                    <td class='tb-cursor'><strong>PHP2,188,743.55</strong></td>
                                    <td class='tb-cursor'><strong>PHP280,861.29</strong></td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor'><strong>Total liabilities and equity</strong></td>
                                    <td class='tb-cursor'><strong>PHP2,432,983.76</strong></td>
                                    <td class='tb-cursor'><strong>PHP302,508.17</strong></td>
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