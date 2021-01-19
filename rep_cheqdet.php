<?php
include 'config.php';
include 'includes/header.php';
include 'includes/side-bar.php';
?>
<div class="page-wrapper" ng-app="appCon" ng-controller="customerorderController" ng-cloak>
    <?php include 'includes/top-bar.php' ?>
    <!-- content -->-
    <div class="page-content" ng-show="view=='main'">
         <h3 class="d-inline-block">Cheque Detail</h3>
         <a href="rprint_rep_cheqdet.php" class="btn btn-primary" style="margin-left: 13px; margin-bottom: 15px;" target="_blank">PRINT</a>
        
        <!-- <div class="top-button float-right">
            <a href ng-click="userpage(type='page2',id='0')" class="btn btn-primary">
                <i class="svg_icons" data-feather="file-text"></i>
                <span style="margin-left: 3px;">Customer Order List</span>
            </a>
        </div> -->
        <ul class="nav nav-tabs" style="margin-top: 15px;">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#bpiwalk">Bank of the Philippine Islands CIB BPI Walk-in Sales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#cibweb">CIB BPI Website Sales</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#bdo">BDO</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#cash">Cash and cash equivalents</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#cibsales">CIB BPI Revived Sales</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#petty">Petty Cash Fund</a>
              </li>
          </ul>

          <div class="tab-content">
            <div id="bpiwalk" class="tab-pane active">
              <!-- content -->
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card" style="box-shadow: none;">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <th>DATE</th>
                                        <th>TRANSACTION TYPE</th>
                                        <th>NO.</th>
                                        <th>NAME</th>
                                        <th style="width: 255px;">MEMO/DESCRIPTION</th>
                                        <th>CLR</th>
                                        <th>AMOUNT</th>
                                    </thead>
                                    <tbody>
                                        <tr class="table-hover_cust" >
                                            <td class='tb-cursor cus_tbl-td'>07/31/2018</td>
                                            <td class='tb-cursor cus_tbl-td'>Expense</td>
                                            <td class='tb-cursor cus_tbl-td'>3220</td>
                                            <td class='tb-cursor cus_tbl-td'>Grepale Kidatan</td>
                                            <td class='tb-cursor cus_tbl-td'>0412 CHECK ENCASHMENT</td>
                                            <td class='tb-cursor cus_tbl-td'>C</td>
                                            <td class='tb-cursor cus_tbl-td'>-3,376.00</td>
                                        </tr>
                                    </tbody>
                                        
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content -->
            </div>

            <div id="cibweb" class="tab-pane">
                 <!-- content -->
                 <div class="row" style="margin-top: 10px;">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card" style="box-shadow: none;">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <th>DATE</th>
                                        <th>TRANSACTION TYPE</th>
                                        <th>NO.</th>
                                        <th>NAME</th>
                                        <th style="width: 255px;">MEMO/DESCRIPTION</th>
                                        <th>CLR</th>
                                        <th>AMOUNT</th>
                                    </thead>
                                    <tbody>
                                        <tr class="table-hover_cust" >
                                            <td class='tb-cursor cus_tbl-td'>07/31/2018</td>
                                            <td class='tb-cursor cus_tbl-td'>Expense</td>
                                            <td class='tb-cursor cus_tbl-td'>3220</td>
                                            <td class='tb-cursor cus_tbl-td'>Grepale Kidatan</td>
                                            <td class='tb-cursor cus_tbl-td'>0412 CHECK ENCASHMENT</td>
                                            <td class='tb-cursor cus_tbl-td'>C</td>
                                            <td class='tb-cursor cus_tbl-td'>-3,376.00</td>
                                        </tr>
                                    </tbody>
                                        
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content -->
            </div>
            <div id="bdo" class="tab-pane">
                 <!-- content -->
                 <div class="row" style="margin-top: 10px;">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card" style="box-shadow: none;">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <th>DATE</th>
                                        <th>TRANSACTION TYPE</th>
                                        <th>NO.</th>
                                        <th>NAME</th>
                                        <th style="width: 255px;">MEMO/DESCRIPTION</th>
                                        <th>CLR</th>
                                        <th>AMOUNT</th>
                                    </thead>
                                    <tbody>
                                    <tr class="table-hover_cust" >
                                            <td class='tb-cursor cus_tbl-td'>07/31/2018</td>
                                            <td class='tb-cursor cus_tbl-td'>Expense</td>
                                            <td class='tb-cursor cus_tbl-td'>3220</td>
                                            <td class='tb-cursor cus_tbl-td'>Grepale Kidatan</td>
                                            <td class='tb-cursor cus_tbl-td'>0412 CHECK ENCASHMENT</td>
                                            <td class='tb-cursor cus_tbl-td'>C</td>
                                            <td class='tb-cursor cus_tbl-td'>-3,376.00</td>
                                        </tr>
                                    </tbody>
                                        
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content -->
            </div>
            <div id="cash" class="tab-pane">
                <!-- content -->
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card" style="box-shadow: none;">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <th>DATE</th>
                                        <th>TRANSACTION TYPE</th>
                                        <th>NO.</th>
                                        <th>NAME</th>
                                        <th style="width: 255px;">MEMO/DESCRIPTION</th>
                                        <th>CLR</th>
                                        <th>AMOUNT</th>
                                    </thead>
                                    <tbody>
                                        <tr class="table-hover_cust" >
                                            <td class='tb-cursor cus_tbl-td'>07/31/2018</td>
                                            <td class='tb-cursor cus_tbl-td'>Expense</td>
                                            <td class='tb-cursor cus_tbl-td'>3220</td>
                                            <td class='tb-cursor cus_tbl-td'>Grepale Kidatan</td>
                                            <td class='tb-cursor cus_tbl-td'>0412 CHECK ENCASHMENT</td>
                                            <td class='tb-cursor cus_tbl-td'>C</td>
                                            <td class='tb-cursor cus_tbl-td'>-3,376.00</td>
                                        </tr>
                                    </tbody>
                                        
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content -->
            </div>
            <div id="cibsales" class="tab-pane">
                <!-- content -->
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card" style="box-shadow: none;">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <th>DATE</th>
                                        <th>TRANSACTION TYPE</th>
                                        <th>NO.</th>
                                        <th>NAME</th>
                                        <th style="width: 255px;">MEMO/DESCRIPTION</th>
                                        <th>CLR</th>
                                        <th>AMOUNT</th>
                                    </thead>
                                    <tbody>
                                        <tr class="table-hover_cust" >
                                            <td class='tb-cursor cus_tbl-td'>07/31/2018</td>
                                            <td class='tb-cursor cus_tbl-td'>Expense</td>
                                            <td class='tb-cursor cus_tbl-td'>3220</td>
                                            <td class='tb-cursor cus_tbl-td'>Grepale Kidatan</td>
                                            <td class='tb-cursor cus_tbl-td'>0412 CHECK ENCASHMENT</td>
                                            <td class='tb-cursor cus_tbl-td'>C</td>
                                            <td class='tb-cursor cus_tbl-td'>-3,376.00</td>
                                        </tr>
                                    </tbody>
                                        
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content -->
            </div>
            <div id="petty" class="tab-pane">
                <!-- content -->
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card" style="box-shadow: none;">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <th>DATE</th>
                                        <th>TRANSACTION TYPE</th>
                                        <th>NO.</th>
                                        <th>NAME</th>
                                        <th style="width: 255px;">MEMO/DESCRIPTION</th>
                                        <th>CLR</th>
                                        <th>AMOUNT</th>
                                    </thead>
                                    <tbody>
                                        <tr class="table-hover_cust" >
                                            <td class='tb-cursor cus_tbl-td'>07/31/2018</td>
                                            <td class='tb-cursor cus_tbl-td'>Expense</td>
                                            <td class='tb-cursor cus_tbl-td'>3220</td>
                                            <td class='tb-cursor cus_tbl-td'>Grepale Kidatan</td>
                                            <td class='tb-cursor cus_tbl-td'>0412 CHECK ENCASHMENT</td>
                                            <td class='tb-cursor cus_tbl-td'>C</td>
                                            <td class='tb-cursor cus_tbl-td'>-3,376.00</td>
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