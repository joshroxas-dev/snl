<?php
include 'config.php';
include 'includes/header.php';
include 'includes/side-bar.php';
?>
<div class="page-wrapper" ng-app="appCon" ng-controller="customerorderController" ng-cloak>
    <?php include 'includes/top-bar.php' ?>
    <!-- content -->-
    <div class="page-content" ng-show="view=='main'">
         <h3 class="d-inline-block">Open Invoices   </h3>
         <a href="rprint_rep_openinvoice.php" class="btn btn-primary" style="margin-left: 13px; margin-bottom: 15px;" target="_blank">PRINT</a>
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
                                <th>DATE</th>
                                <th>TRANSACTION TYPE</th>
                                <th>NO.</th>
                                <th>TERMS</th>
                                <th>DUE DATE</th>
                                <th>PAST DUE</th>
                                <th>OPEN BALANCE</th>

                            </thead>
                            <tbody>

                                <tr>
                                    <th class="cus_tbl-th">
                                        Aaron Andre Alberto
                                    </th>
                                    <tr class="table-hover_cust" >
                                        <td class='tb-cursor cus_tbl-td'>08/08/2019</td>
                                        <td class='tb-cursor cus_tbl-td'>Invoice</td>
                                        <td class='tb-cursor cus_tbl-td'>2875</td>
                                        <td class='tb-cursor cus_tbl-td'>Due on receipt</td>
                                        <td class='tb-cursor cus_tbl-td'>Due on receipt</td>
                                        <td class='tb-cursor cus_tbl-td'>550.00</td>
                                    </tr>
                                    <tr>
                                        <th class='' colspan="5">Total for Aaron Andre Alberto</th>
                                        <th class=''>
                                            PHP3,728.00
                                        </th>
                                        <th class=''>
                                            PHP3,728.00
                                        </th>
                                    </tr>
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