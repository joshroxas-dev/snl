<?php
include 'config.php';
include 'includes/header.php';
include 'includes/side-bar.php';
?>
<div class="page-wrapper" ng-app="appCon" ng-controller="customerorderController" ng-cloak>
    <?php include 'includes/top-bar.php' ?>
    <!-- content -->-
    <div class="page-content" ng-show="view=='main'">
         <h3 class="d-inline-block">Profit and Loss % of Total Income</h3>
         <a href="rprint_rep_profitandlosstotal.php" class="btn btn-primary" style="margin-left: 13px; margin-bottom: 15px;" target="_blank">PRINT</a>
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
                                <th>TOTAL</th>
                                <th></th>
                            </thead>
                            <thead>
                                <!-- <th>No.</th> -->
                                <th></th>
                                <th>1 JAN - 18 OCT, 2019</th>
                                <th>% OF INCOME</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Income</td>
                                    <td class="cus_tbl-td cus_tbl-th"></td>
                                    <td class="cus_tbl-td cus_tbl-th"></td>
                                </tr>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Discounts given</td>
                                    <td class="cus_tbl-td cus_tbl-th">-0.76123%</td>
                                    <td class="cus_tbl-td cus_tbl-th">-0.76123%</td>
                                </tr>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Sales</td>
                                    <td class="cus_tbl-td cus_tbl-th">99.41489%</td>
                                    <td class="cus_tbl-td cus_tbl-th">0.10699%</td>
                                </tr>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Sales of Product Income</td>
                                    <td class="cus_tbl-td cus_tbl-th">1,810,061.00</td>
                                    <td class="cus_tbl-td cus_tbl-th">99.41489%</td>
                                </tr>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Shipping Income</td>
                                    <td class="cus_tbl-td cus_tbl-th">22,565.00</td>
                                    <td class="cus_tbl-td cus_tbl-th">1.23935%</td>
                                </tr>

                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor'><strong>Total Income</strong></td>
                                    <td class='tb-cursor'><strong>PHP1,820,714.26</strong></td>
                                    <td class='tb-cursor'><strong>100.00%</strong></td>
                                </tr>

                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Cost of Sales</td>
                                    <td class="cus_tbl-td cus_tbl-th"></td>
                                    <td class="cus_tbl-td cus_tbl-th"></td>
                                </tr>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Cost of Sales</td>
                                    <td class="cus_tbl-td cus_tbl-th">339,693.73</td>
                                    <td class="cus_tbl-td cus_tbl-th">18.65717%</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor'><strong>Total Cost of Sales</strong></td>
                                    <td class='tb-cursor'><strong>PHP339,693.73</strong></td>
                                    <td class='tb-cursor'><strong>18.65717%</strong></td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor'><strong>GROSS PROFIT</strong></td>
                                    <td class='tb-cursor'><strong>PHP1,481,020.53</strong></td>
                                    <td class='tb-cursor'><strong>81.34283%</strong></td>
                                </tr>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Other Expenses</td>
                                    <td class="cus_tbl-td cus_tbl-th"></td>
                                    <td class="cus_tbl-td cus_tbl-th"></td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor'><strong>Unrealised Gain or Loss</strong></td>
                                    <td class='tb-cursor'><strong>0.00</strong></td>
                                    <td class='tb-cursor'><strong>0.00%</strong></td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor'><strong>Total Other Expenses</strong></td>
                                    <td class='tb-cursor'><strong>PHP0.00</strong></td>
                                    <td class='tb-cursor'><strong>0.00%</strong></td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor'><strong>NET EARNINGS</strong></td>
                                    <td class='tb-cursor'><strong>PHP1,481,020.53</strong></td>
                                    <td class='tb-cursor'><strong>81.34283%</strong></td>
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