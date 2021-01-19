<?php
include 'config.php';
include 'includes/header.php';
include 'includes/side-bar.php';
?>
<div class="page-wrapper" ng-app="appCon" ng-controller="customerorderController" ng-cloak>
    <?php include 'includes/top-bar.php' ?>
    <!-- content -->-
    <div class="page-content" ng-show="view=='main'">
         <h3 class="d-inline-block">Statement of Changes of Equity</h3>
         <a href="rprint_rep_statechange.php" class="btn btn-primary" style="margin-left: 13px; margin-bottom: 15px;" target="_blank">PRINT</a>
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
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor'>Opening Balance Equity</td>
                                    <td class='tb-cursor'>60,936.53</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor'>Retained Earnings</td>
                                    <td class='tb-cursor'>646,786.49</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="table-hover_cust" >
                                    <td><strong>Total Equity</strong></td>
                                    <td><strong>PHP707,723.02</strong></td>
                                </tr>
                            </tfoot>
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