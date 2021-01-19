<?php
include 'config.php';
include 'includes/header.php';
include 'includes/side-bar.php';
?>
<div class="page-wrapper" ng-app="appCon" ng-controller="customerorderController" ng-cloak>
    <?php include 'includes/top-bar.php' ?>
    <!-- content -->-
    <div class="page-content" ng-show="view=='main'">
         <h3 class="d-inline-block">General Ledger</h3>
         <a href="rprint_rep_transaccount.php" class="btn btn-primary" style="margin-left: 13px; margin-bottom: 15px;" target="_blank">PRINT</a>
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
                                <th>DATE</th>
                                <th>TRANSACTION TYPE</th>
                                <th>NO.</th>
                                <th>NAME</th>
                                <th style="width: 255px;">MEMO/DESCRIPTION</th>
                                <th>SPLIT</th>
                                <th>AMOUNT</th>
                                <th>BALANCE</th>
                                
                            </thead>
                            <tbody>
                                <tr class="" >
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='cus_tbl-td'><strong>Bank of the Philippine Islands</strong></td>
                                    <td class='tb-cursor cus_tbl-td' colspan="6"></td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'>Beginning Balance</td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'><strong>Total for Bank of the Philippine Islands</strong></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'><strong>0.00</strong></td>
                                </tr>

                                <tr class="" >
                                    <td class='tb-cursor'></td>
                                    <td class=''><strong>CIB BPI Walk-in Sales</strong></td>
                                    <td class='tb-cursor' colspan="6"></td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'>Beginning Balance</td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'><strong>Total for CIB BPI Walk-in Sales</strong></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'><strong>0.00</strong></td>
                                </tr>

                                <tr class="" >
                                    <td class='tb-cursor'></td>
                                    <td class=''><strong>CIB BPI Website Sales</strong></td>
                                    <td class='tb-cursor' colspan="6"></td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'>Beginning Balance</td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'><strong>Total for CIB BPI Website Sales</strong></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'><strong>0.00</strong></td>
                                </tr>

                                <tr class="" >
                                    <td class='tb-cursor'></td>
                                    <td class=''><strong>Philippine Islands with sub-accounts</strong></td>
                                    <td class='tb-cursor' colspan="6"></td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'>Beginning Balance</td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'><strong>Total for Philippine Islands with sub-accounts</strong></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'><strong>0.00</strong></td>
                                </tr>

                                <tr class="" >
                                    <td class='tb-cursor'></td>
                                    <td class=''><strong>BDO</strong></td>
                                    <td class='tb-cursor' colspan="6"></td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'>Beginning Balance</td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'><strong>Total for BDO</strong></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'><strong>0.00</strong></td>
                                </tr>

                                <tr class="" >
                                    <td class='tb-cursor'></td>
                                    <td class=''><strong>Cash and cash equivalents</strong></td>
                                    <td class='tb-cursor' colspan="6"></td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'>Beginning Balance</td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'><strong>Total for Cash and cash equivalents</strong></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'><strong>0.00</strong></td>
                                </tr>

                                <tr class="" >
                                    <td class='tb-cursor'></td>
                                    <td class=''><strong>Cash and cash equivalents</strong></td>
                                    <td class='tb-cursor' colspan="6"></td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'>Beginning Balance</td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'><strong>Total for CIB BPI Revived Sales</strong></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'><strong>0.00</strong></td>
                                </tr>

                                <tr class="" >
                                    <td class='tb-cursor'></td>
                                    <td class=''><strong>Money Market</strong></td>
                                    <td class='tb-cursor' colspan="6"></td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'>Beginning Balance</td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'><strong>Total for Money Market</strong></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'><strong>0.00</strong></td>
                                </tr>
                                
                                <tr class="" >
                                    <td class='tb-cursor'></td>
                                    <td class=''><strong>Petty Cash Fund</strong></td>
                                    <td class='tb-cursor' colspan="6"></td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'>Beginning Balance</td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'><strong>Total for Petty Cash Fund</strong></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'><strong>0.00</strong></td>
                                </tr>

                                <tr class="" >
                                    <td class='tb-cursor'></td>
                                    <td class=''><strong>RCBC</strong></td>
                                    <td class='tb-cursor' colspan="6"></td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'>Beginning Balance</td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'><strong>Total for RCBC</strong></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'></td>
                                    <td class='tb-cursor cus_tbl-td'><strong>0.00</strong></td>
                                </tr>
                            </tbody>
                                
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- content -->

        
        <ul class="nav nav-tabs" style="margin-top: 15px;">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#accrec">Accounts Receivable (A/R)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#invent">Inventory Asset</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#opening">Opening Balance Equity</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#sales">Sales of Product Income</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#shippin">Shipping Income</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#cost">Cost of sales</a>
              </li>
          </ul>

          <div class="tab-content">
            <div id="accrec" class="tab-pane active">
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
                                        <th>MEMO/DESCRIPTION</th>
                                        <th class="wspace" style="width: 255px;">SPLIT</th>
                                        <th>AMOUNT</th>
                                        <th>BALANCE</th>
                                    </thead>
                                    <tbody>
                                        <tr class="table-hover_cust" >
                                            <td class='tb-cursor cus_tbl-td'>10/01/2019</td>
                                            <td class='tb-cursor cus_tbl-td'>Invoice</td>
                                            <td class='tb-cursor cus_tbl-td'>3220</td>
                                            <td class='tb-cursor cus_tbl-td'>Yes</td>
                                            <td class='tb-cursor cus_tbl-td'>Aaron Dale Carpio</td>
                                            <td class='tb-cursor cus_tbl-td'>Brush Cleaner - Opening inventory and value</td>
                                            <td class='tb-cursor cus_tbl-td'>Inventory Asset</td>
                                            <td class='tb-cursor cus_tbl-td'>0.00</td>
                                        </tr>
                                        <tr class="table-hover_cust" >
                                            <td class='tb-cursor cus_tbl-td'>10/01/2019</td>
                                            <td class='tb-cursor cus_tbl-td'>Invoice</td>
                                            <td class='tb-cursor cus_tbl-td'>3220</td>
                                            <td class='tb-cursor cus_tbl-td'>Yes</td>
                                            <td class='tb-cursor cus_tbl-td'>Aaron Dale Carpio</td>
                                            <td class='tb-cursor cus_tbl-td'>Brush Cleaner - Opening inventory and value</td>
                                            <td class='tb-cursor cus_tbl-td'>Inventory Asset</td>
                                            <td class='tb-cursor cus_tbl-td'>0.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"><strong>Total for Accounts Receivable (A/R)</strong></td>
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

            <div id="invent" class="tab-pane">
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
                                        <th>MEMO/DESCRIPTION</th>
                                        <th class="wspace" style="width: 255px;">SPLIT</th>
                                        <th>AMOUNT</th>
                                    </thead>
                                    <tbody>
                                        <tr class="table-hover_cust" >
                                            <td class='tb-cursor cus_tbl-td'>11/01/2019</td>
                                            <td class='tb-cursor cus_tbl-td'>Invoice</td>
                                            <td class='tb-cursor cus_tbl-td'>3220</td>
                                            <td class='tb-cursor cus_tbl-td'>Yes</td>
                                            <td class='tb-cursor cus_tbl-td'>Aaron Dale Carpio</td>
                                            <td class='tb-cursor cus_tbl-td'>Brush Cleaner - Opening inventory and value</td>
                                            <td class='tb-cursor cus_tbl-td'>Inventory Asset</td>
                                            <td class='tb-cursor cus_tbl-td'>0.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"><strong>Total for Inventory Asset</strong></td>
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
            <div id="opening" class="tab-pane">
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
                                        <th>MEMO/DESCRIPTION</th>
                                        <th class="wspace" style="width: 255px;">SPLIT</th>
                                        <th>AMOUNT</th>
                                    </thead>
                                    <tbody>
                                        <tr class="table-hover_cust" >
                                            <td class='tb-cursor cus_tbl-td'>10/12/2019</td>
                                            <td class='tb-cursor cus_tbl-td'>Invoice</td>
                                            <td class='tb-cursor cus_tbl-td'>3220</td>
                                            <td class='tb-cursor cus_tbl-td'>Yes</td>
                                            <td class='tb-cursor cus_tbl-td'>Aaron Dale Carpio</td>
                                            <td class='tb-cursor cus_tbl-td'>Brush Cleaner - Opening inventory and value</td>
                                            <td class='tb-cursor cus_tbl-td'>Inventory Asset</td>
                                            <td class='tb-cursor cus_tbl-td'>0.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"><strong>Total for Opening Balance Equity</strong></td>
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
            <div id="sales" class="tab-pane">
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
                                        <th>MEMO/DESCRIPTION</th>
                                        <th class="wspace" style="width: 255px;">SPLIT</th>
                                        <th>AMOUNT</th>
                                    </thead>
                                    <tbody>
                                        <tr class="table-hover_cust" >
                                            <td class='tb-cursor cus_tbl-td'>06/10/2019</td>
                                            <td class='tb-cursor cus_tbl-td'>Invoice</td>
                                            <td class='tb-cursor cus_tbl-td'>3220</td>
                                            <td class='tb-cursor cus_tbl-td'>Yes</td>
                                            <td class='tb-cursor cus_tbl-td'>Aaron Dale Carpio</td>
                                            <td class='tb-cursor cus_tbl-td'>Brush Cleaner - Opening inventory and value</td>
                                            <td class='tb-cursor cus_tbl-td'>Inventory Asset</td>
                                            <td class='tb-cursor cus_tbl-td'>0.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"><strong>Total for Sales of Product Income</strong></td>
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
            <div id="shippin" class="tab-pane">
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
                                        <th>MEMO/DESCRIPTION</th>
                                        <th class="wspace" style="width: 255px;">SPLIT</th>
                                        <th>AMOUNT</th>
                                    </thead>
                                    <tbody>
                                        <tr class="table-hover_cust" >
                                            <td class='tb-cursor cus_tbl-td'>03/03/2019</td>
                                            <td class='tb-cursor cus_tbl-td'>Invoice</td>
                                            <td class='tb-cursor cus_tbl-td'>3220</td>
                                            <td class='tb-cursor cus_tbl-td'>Yes</td>
                                            <td class='tb-cursor cus_tbl-td'>Aaron Dale Carpio</td>
                                            <td class='tb-cursor cus_tbl-td'>Brush Cleaner - Opening inventory and value</td>
                                            <td class='tb-cursor cus_tbl-td'>Inventory Asset</td>
                                            <td class='tb-cursor cus_tbl-td'>0.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"><strong>Total for Shipping Income</strong></td>
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
            <div id="cost" class="tab-pane">
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
                                        <th>MEMO/DESCRIPTION</th>
                                        <th class="wspace" style="width: 255px;">SPLIT</th>
                                        <th>AMOUNT</th>
                                    </thead>
                                    <tbody>
                                        <tr class="table-hover_cust" >
                                            <td class='tb-cursor cus_tbl-td'>12/11/2019</td>
                                            <td class='tb-cursor cus_tbl-td'>Invoice</td>
                                            <td class='tb-cursor cus_tbl-td'>3220</td>
                                            <td class='tb-cursor cus_tbl-td'>Yes</td>
                                            <td class='tb-cursor cus_tbl-td'>Aaron Dale Carpio</td>
                                            <td class='tb-cursor cus_tbl-td'>Brush Cleaner - Opening inventory and value</td>
                                            <td class='tb-cursor cus_tbl-td'>Inventory Asset</td>
                                            <td class='tb-cursor cus_tbl-td'>0.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"><strong>Total for Cost of sales</strong></td>
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