<?php
include 'config.php';
include 'includes/header.php';
include 'includes/side-bar.php';
?>
<div class="page-wrapper" ng-app="appCon" ng-controller="customerorderController" ng-cloak>
    <?php include 'includes/top-bar.php' ?>
    <!-- content -->-
    <div class="page-content" ng-show="view=='main'">
         <h3 class="d-inline-block">Bill Payment List</h3>
         <a href="rprint_rep_billpaymentlist.php" class="btn btn-primary" style="margin-left: 13px; margin-bottom: 15px;" target="_blank">PRINT</a>
        <!-- <div class="top-button float-right">
            <a href ng-click="userpage(type='page2',id='0')" class="btn btn-primary">
                <i class="svg_icons" data-feather="file-text"></i>
                <span style="margin-left: 3px;">Customer Order List</span>
            </a>
        </div> -->
        <ul class="nav nav-tabs" style="margin-top: 15px;">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#bpimaster">BPI Mastercard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#pnb">PNB VISA</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#rcbc">RCBC Mastercard</a>
              </li>
          </ul>

          <div class="tab-content">
            <div id="bpimaster" class="tab-pane active">
              <!-- content -->
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card" style="box-shadow: none;">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <th>DATE</th>
                                        <th>NO.</th>
                                        <th>SUPPLIER</th>
                                        <th>AMOUNT</th>
                                    </thead>
                                    <tbody>
                                        <tr class="table-hover_cust" >
                                            <td class='tb-cursor cus_tbl-td'>10/12/2019</td>
                                            <td class='tb-cursor cus_tbl-td'>3220</td>
                                            <td class='tb-cursor cus_tbl-td'>Inventory Asset</td>
                                            <td class='tb-cursor cus_tbl-td'>0.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><strong>Total for BPI Mastercard</strong></td>
                                            <td><strong>PHP91,162.45</strong></td>
                                        </tr>
                                    </tbody>
                                        
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content -->
            </div>

            <div id="pnb" class="tab-pane">
                 <!-- content -->
                 <div class="row" style="margin-top: 10px;">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card" style="box-shadow: none;">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <th>DATE</th>
                                        <th>NO.</th>
                                        <th>SUPPLIER</th>
                                        <th>AMOUNT</th>
                                    </thead>
                                    <tbody>
                                        <tr class="table-hover_cust" >
                                            <td class='tb-cursor cus_tbl-td'>10/12/2019</td>
                                            <td class='tb-cursor cus_tbl-td'>3220</td>
                                            <td class='tb-cursor cus_tbl-td'>Inventory Asset</td>
                                            <td class='tb-cursor cus_tbl-td'>0.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><strong>Total for PNB VISA</strong></td>
                                            <td><strong>PHP91,162.45</strong></td>
                                        </tr>
                                    </tbody>
                                        
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content -->
            </div>
            <div id="rcbc" class="tab-pane">
                 <!-- content -->
                 <div class="row" style="margin-top: 10px;">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card" style="box-shadow: none;">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <th>DATE</th>
                                        <th>NO.</th>
                                        <th>SUPPLIER</th>
                                        <th>AMOUNT</th>
                                    </thead>
                                    <tbody>
                                        <tr class="table-hover_cust" >
                                            <td class='tb-cursor cus_tbl-td'>10/12/2019</td>
                                            <td class='tb-cursor cus_tbl-td'>3220</td>
                                            <td class='tb-cursor cus_tbl-td'>Inventory Asset</td>
                                            <td class='tb-cursor cus_tbl-td'>0.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><strong>Total for RCBC Mastercard</strong></td>
                                            <td><strong>PHP91,162.45</strong></td>
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
    </div>
   

</div>

<script src="app-controller/js-controller/customerorderCtrl.js"></script>
<?php include "includes/footer.php"; ?>