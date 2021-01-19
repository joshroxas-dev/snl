<?php
include 'includes/header.php';
include 'includes/side-bar.php';
// if(!Role('auditlogs')){
//   echo "<script>window.location.href='index.php';</script>";
// };
?>
<?php include 'includes/top-bar.php' ?>
<style>
    table, th, td {
        border: 1px solid black;
        text-align: center;
    }
</style>
<div class="page-wrapper ng-cloak" ng-app="appCon" ng-controller="reportsV2Controller">
    <div class="page-content" style="margin-top: 60px" ng-show="module == 'main'">
        <h3 class="d-inline-block">Reports</h3>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row col-md-12">
                            <div class="col-md-6">
                                <ul>
                                    <li><b><a href="" ng-click="openModule('purchasebyproduct')">Purchases by Product/Service Detail </a></b></li>
                                    <li><a href="" ng-click="openModule('customerbalsummary')"><strong>Customer Balance Summary </strong></a></li>
                                    <li><a href="" ng-click="openModule('transaclistdate')"><strong>Transactions List by Date </strong></a></li>
                                    <li><a href="" ng-click="openModule('purchsuppdet')"><strong>Purchase by Supplier Detail </strong></a></li>
                                    <li><a href="" ng-click="openModule('journal')"><strong>Journal </strong></a></li>
                                    <li><a href="" ng-click="openModule('transaccount')"><strong>Transaction by Account </strong></a></li> 
                                    <li><a href="rep_balancesheet.php"><b style="color:red;">Balance Sheet</b></a></li> 
                                    <li><a href="rep_genledger.php"><b style="color:red;">General Ledger</b></a></li>
                                    <li><a href="rep_trialbal.php"><b style="color:red;">Trial Balance</b></a></li>      
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul>
                                    <li><a href="" ng-click="openModule('billpaymentlist')"><strong>Bill Payment List</strong></a></li>
                                    <li><a href="" ng-click="openModule('cheqdet')"> <strong>Cheque Detail  </strong></a></li>
                                    <li><a href="" ng-click="openModule('openinvoice')"><strong>Open Invoices</strong></a></li>
                                    <li><a href="" ng-click="openModule('profitlossincome')"><strong>Profit and Loss % of Total Income</strong></a></li>
                                    <li><a href="" ng-click="openModule('profitandlossbymonth')"><strong>Profit and Loss by Month</strong></a></li> 
                                    <li><a href="" ng-click="openModule('collectionsreport')"><b style="color:red;">Collections Report</b></a></li> 
                                    <li><a href="rep_statechange.php"><b style="color:red;">Statement of Changes in Equity</b></a></li>
                                    <li><a href="rep_statecash.php"><b style="color:red;">Statement of Cash Flows</b></a></li>
                                    <li><a href="rep_balsheet.php"><b style="color:red;">Balance Sheet Comparison</b></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  ---------------------- DIVISION -----------------------------  -->

    <div class="page-content" style="margin-top: 60px" ng-show="module == 'purchasebyproduct'">
        <h3 class="d-inline-block">Purchases by Product/Service Detail</h3>
        <div class="top-button float-right">
            <a href ng-click="module = 'main'" class="btn btn-primary">
                <i class="svg_icons" data-feather="arrow-left"></i>
                <span style="margin-left: 3px;">Back</span>
            </a>
            <a href="documents/print_rep_purchasebyproduct.php" class="btn btn-primary" target="_blank">
                <i class="svg_icons" data-feather="file-text"></i>
                <span style="margin-left: 3px;">  </span>
            </a>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <table style="width: 100%;">
                            <thead>
                                <th>DATE</th>
                                <th>TRANSACTION TYPE</th>
                                <th>SUPPLIER</th>
                                <th>REMARKS</th>
                                <th>QTY</th>
                                <th>RATE</th>
                                <th>AMOUNT (₱)</th>
                                <th>TOTAL</th>
                            </thead>
                            <tbody>
                                <tr ng-repeat="data in dataPurchasebyproduct" ng-if="dataPurchasebyproduct.length > 0">
                                    <td>{{data.purchasedate}}</td>
                                    <td>Customer Order</td>
                                    <td>{{data.suppliername}}</td>
                                    <td>{{data.remarks}}</td>
                                    <td>{{data.quantity}}</td>
                                    <td>{{data.exchangerate}}</td>
                                    <td>{{data.totalamountpesos}}</td>
                                    <td>{{data.ftotal}}</td>
                                </tr>
                                <tr ng-if="dataPurchasebyproduct.length == 0">
                                    <td colspan="8">NO RECORDS!</td>
                                </tr>
                                <tr>
                                    <td colspan='7' style='text-align:left;'><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL</strong></td>
                                    <td><strong>{{purchasebyproductTotal}}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  ---------------------- DIVISION -----------------------------  -->
    
    <div class="page-content" style="margin-top: 60px" ng-show="module == 'customerbalsummary'">
        <h3 class="d-inline-block">Customer Balance Summary</h3>
        <div class="top-button float-right">
            <a href ng-click="module = 'main'" class="btn btn-primary">
                <i class="svg_icons" data-feather="arrow-left"></i>
                <span style="margin-left: 3px;">Back</span>
            </a>
            <a href="documents/print_rep_customerbalsummary.php" class="btn btn-primary" target="_blank">
                <i class="svg_icons" data-feather="file-text"></i>
                <span style="margin-left: 3px;">  </span>
            </a>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <table style="width: 100%;">
                            <thead>
                                <th>CUSTOMER NAME</th>
                                <th>TOTAL</th>
                            </thead>
                            <tbody>
                                <tr ng-repeat="data in dataCustomerbalsummary">
                                    <td>{{data.cfullname}}</td>
                                    <td>{{data.totalamountexp | number : 2 }}</td>
                                </tr>
                                <tr ng-if="dataCustomerbalsummary.length == 0">
                                    <td colspan="2">NO RECORDS!</td>
                                </tr>
                                <tr>
                                    <td style='text-align:left;'><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL</strong></td>
                                    <td><strong>{{customerbalsummary | number : 2}}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--  ---------------------- DIVISION -----------------------------  -->
    
    <div class="page-content" style="margin-top: 60px" ng-show="module == 'transaclistdate'">
        <h3 class="d-inline-block">Transaction List by Date</h3>
        <div class="top-button float-right">
            <a href ng-click="module = 'main'" class="btn btn-primary">
                <i class="svg_icons" data-feather="arrow-left"></i>
                <span style="margin-left: 3px;">Back</span>
            </a>
            <a href="reports/print_rep_transaclisdate.php" class="btn btn-primary" target="_blank">
                <i class="svg_icons" data-feather="file-text"></i>
                <span style="margin-left: 3px;">  </span>
            </a>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <table style="width: 100%;">
                            <thead>
                                <th>DATE</th>
                                <th>TRANS TYPE</th>
                                <th>NO.</th>
                                <th>POSTING</th>
                                <th>BUSINESS NAME</th>
                                <th>MEMO/DESCRIPTION</th>
                                <th>ACCOUNT</th>
                                <th>SPLIT</th>
                                <th>AMOUNT</th>
                            </thead>
                            <tbody>
                                <tr ng-repeat="data in dataTransaclistdate">
                                    <td>{{data.purchasedate}}</td>
                                    <td>INVOICE</td>
                                    <td>{{data.productid}}</td>
                                    <td>YES</td>
                                    <td>{{data.customerbname}}</td>
                                    <td>{{data.remarks}}</td>
                                    <td>Accounts Receivable (A/R)</td>
                                    <td>Sales of Product Income</td>
                                    <td>{{data.totalamountpesos | number : 2}}</td>
                                </tr>
                                <tr ng-if="transaclistdate.length == 0">
                                    <td colspan="9">NO RECORDS!</td>
                                </tr>
                                <tr>
                                    <td colspan="8" style='text-align:left;'><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL</strong></td>
                                    <td><strong>{{transaclistdatetotal | number : 2}}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--  ---------------------- DIVISION -----------------------------  -->
    
    <div class="page-content" style="margin-top: 60px" ng-show="module == 'purchsuppdet'">
        <h3 class="d-inline-block">Purchase by Supplier Details Report</h3>
        <div class="top-button float-right">
            <a href ng-click="module = 'main'" class="btn btn-primary">
                <i class="svg_icons" data-feather="arrow-left"></i>
                <span style="margin-left: 3px;">Back</span>
            </a>
            <a href="documents/print_rep_purchsuppdet.php" class="btn btn-primary" target="_blank">
                <i class="svg_icons" data-feather="file-text"></i>
                <span style="margin-left: 3px;">  </span>
            </a>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <table style="width: 100%;">
                            <thead>
                                <th>DATE</th> 
                                <th>TRANS TYPE</th>
                                <th>NO.</th>
                                <th>PRODUCT</th>
                                <th>SUPPLIER</th>
                                <th>REMARKS</th>
                                <th>QTY</th>
                                <th>RATE</th>
                                <th>AMOUNT</th>
                                <th>TOTAL AMOUNT</th>
                            </thead>
                            <tbody>
                                <tr ng-repeat="data in dataPurchsuppdet">
                                    <td>{{data.purchasedate}}</td>
                                    <td>INVOICE</td>
                                    <td>{{data.customerorderid}}</td>
                                    <td>{{data.stockname}}</td>
                                    <td>{{data.suppliername}}</td>
                                    <td>{{data.remarks}}</td>
                                    <td>{{data.quantity}}</td>
                                    <td>{{data.exchangerate}}</td>
                                    <td>{{data.totalamountpesos | number : 2}}</td>
                                    <td>{{data.famountpesos | number : 2}}</td>
                                </tr>
                                <tr ng-if="dataPurchsuppdet.length == 0">
                                    <td colspan="10">NO RECORDS!</td>
                                </tr>
                                <tr>
                                    <td colspan="9" style='text-align:left;'><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL</strong></td>
                                    <td><strong>{{dataPurchsuppdettotal | number : 2}}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--  ---------------------- DIVISION -----------------------------  -->
    
    <div class="page-content" style="margin-top: 60px" ng-show="module == 'journal'">
        <h3 class="d-inline-block">Journal Report</h3>
        <div class="top-button float-right">
            <a href ng-click="module = 'main'" class="btn btn-primary">
                <i class="svg_icons" data-feather="arrow-left"></i>
                <span style="margin-left: 3px;">Back</span>
            </a>
            <a href="documents/print_rep_journal.php" class="btn btn-primary" target="_blank">
                <i class="svg_icons" data-feather="file-text"></i>
                <span style="margin-left: 3px;">  </span>
            </a>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <table style="width: 100%;">
                            <thead>
                                <td>DATE</td> 
                                <td>TRANS TYPE</td>
                                <td>NO.</td>
                                <td>NAME</td>
                                <td>MEMO/DESCRIPTION</td>
                                <td>ACCOUNT</td>
                                <td>DEBIT</td>
                                <td>CREDIT</td>
                            </thead>
                            <tbody>
                                <tr ng-repeat="data in dataJournal">
                                    <td>{{data.paymentdate}}</td>
                                    <td>EXPENSES</td>
                                    <td>{{data.payeeid}}</td>
                                    <td>{{data.payeename}}</td>
                                    <td>{{data.remarks}}</td>
                                    <td>{{data.categexptype}}</td>
                                    <td>{{data.amount}}</td>
                                    <td>{{ 0 }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  ---------------------- DIVISION -----------------------------  -->
    
    <div class="page-content" style="margin-top: 60px" ng-show="module == 'transaccount'">
        <h3 class="d-inline-block">Transaction by Account</h3>
        <div class="top-button float-right">
            <a href ng-click="module = 'main'" class="btn btn-primary">
                <i class="svg_icons" data-feather="arrow-left"></i>
                <span style="margin-left: 3px;">Back</span>
            </a>
            <a href="documents/print_rep_transaccount.php?docid={{categexpid}}" class="btn btn-primary" target="_blank">
                <i class="svg_icons" data-feather="file-text"></i>
                <span style="margin-left: 3px;">  </span>
            </a>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-3" style="padding-left: 0px; padding-bottom: 5px;">
                            <!-- <select ng-model="catcatcat" ng-options="categexpid as item.categexpname for item in catlist" ng-selected="true"></select> -->
                            <select class="" id="categexpid" ng-model="categexpid" ng-change="loadCatData(categexpid)">
                                <option ng-repeat="row in catlist" value="{{row.categexpid}}">{{row.categexpname}}</option>
                            </select>
                        </div>
                        <table style="width: 100%;">
                            <thead>
                                <td>DATE</td> 
                                <td>TRANSACTION TYPE</td>
                                <td>NAME</td>
                                <td>MEMO/DESCRIPTION</td>
                                <td>AMOUNT</td>
                            </thead>
                            <tbody>
                                <tr ng-repeat="data in datatransaccount">
                                    <td>{{data.paymentdate}}</td>
                                    <td>Invoice</td>
                                    <td>{{data.categexpname}}</td>
                                    <td>{{data.description}}</td>
                                    <td>{{data.amount ? (data.amount | number : 2) : '0.00'}}</td>
                                </tr>
                                <tr ng-if="datatransaccount.length == 0">
                                    <td colspan="5">NO RECORDS!</td>
                                </tr>
                                <tr>
                                    <td colspan="4" style='text-align:left;'><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL</strong></td>
                                    <td><strong>{{datatransaccounttotal | number : 2}}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!--  ---------------------- DIVISION -----------------------------  -->
    
    <div class="page-content" style="margin-top: 60px" ng-show="module == 'billpaymentlist'">
        <h3 class="d-inline-block">Bill Payment List</h3>
        <div class="top-button float-right">
            <a href ng-click="module = 'main'" class="btn btn-primary">
                <i class="svg_icons" data-feather="arrow-left"></i>
                <span style="margin-left: 3px;">Back</span>
            </a>
            <a href="documents/print_rep_billpaymentlist.php?docid={{mopid}}" class="btn btn-primary" target="_blank">
                <i class="svg_icons" data-feather="file-text"></i>
                <span style="margin-left: 3px;">  </span>
            </a>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-3" style="padding-left: 0px; padding-bottom: 5px;">
                            <!-- <select ng-model="catcatcat" ng-options="categexpid as item.categexpname for item in catlist" ng-selected="true"></select> -->
                            <select class="" id="mopid" ng-model="mopid" ng-change="loadmopData(mopid)">
                                <option ng-repeat="row in moplist" value="{{row.mopid}}">{{row.modeofpayment}}</option>
                            </select>
                        </div>
                        <table style="width: 100%;">
                            <thead>
                                <th>DATE</th>
                                <th>NO.</th>
                                <th>SUPPLIER</th>
                                <th>AMOUNT</th>
                            </thead>
                            <tbody>
                                <tr ng-repeat="data in dataBillpaymentlist">
                                    <td>{{data.paymentdate}}</td>
                                    <td>{{data.id}}</td>
                                    <td>{{data.payeename}}</td>
                                    <td>{{data.amount ? (data.amount | number : 2) : '0.00'}}</td>
                                </tr>
                                <tr ng-if="dataBillpaymentlist.length == 0">
                                    <td colspan="4">NO RECORDS!</td>
                                </tr>
                                <tr>
                                    <td colspan="3" style='text-align:left;'><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL</strong></td>
                                    <td><strong>{{dataBillpaymenttotal | number : 2}}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!--  ---------------------- DIVISION -----------------------------  -->
    
    <div class="page-content" style="margin-top: 60px" ng-show="module == 'cheqdet'">
        <h3 class="d-inline-block">Cheque Details</h3>
        <div class="top-button float-right">
            <a href ng-click="module = 'main'" class="btn btn-primary">
                <i class="svg_icons" data-feather="arrow-left"></i>
                <span style="margin-left: 3px;">Back</span>
            </a>
            <a href="documents/print_rep_cheqdet.php?docid={{creditcardid}}" class="btn btn-primary" target="_blank">
                <i class="svg_icons" data-feather="file-text"></i>
                <span style="margin-left: 3px;">  </span>
            </a>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-3" style="padding-left: 0px; padding-bottom: 5px;">
                            <!-- <select ng-model="catcatcat" ng-options="categexpid as item.categexpname for item in catlist" ng-selected="true"></select> -->
                            <select class="" id="creditcardid" ng-model="creditcardid" ng-change="loadccData(creditcardid)">
                                <option ng-repeat="row in creditcardlist" value="{{row.creditcardid}}">{{row.creditcard}}</option>
                            </select>
                        </div>
                        <table style="width: 100%;">
                            <thead>
                                <th>DATE</th>
                                <th>TRANSACTION TYPE</th>
                                <th>NO.</th>
                                <th>NAME</th>
                                <th>MEMO/DESCRIPTION</th>
                                <th>CLR</th>
                                <th>AMOUNT</th>
                            </thead>
                            <tbody>
                                <tr ng-repeat="data in dataCheqdetlist">
                                    <td>{{data.paymentdate}}</td>
                                    <td>EXPENSES</td>
                                    <td>{{data.id}}</td>
                                    <td>{{data.payeename}}</td>
                                    <td>{{data.remarks}}</td>
                                    <td>C</td>
                                    <td>{{data.amount ? (data.amount | number : 2) : '0.00'}}</td>
                                </tr>
                                <tr ng-if="dataCheqdetlist.length == 0">
                                    <td colspan="5">NO RECORDS!</td>
                                </tr>
                                <tr>
                                    <td colspan="6" style='text-align:left;'><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL</strong></td>
                                    <td><strong>{{dataCheqdettotal | number : 2}}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!--  ---------------------- DIVISION -----------------------------  -->
    
    <div class="page-content" style="margin-top: 60px" ng-show="module == 'openinvoice'">
        <h3 class="d-inline-block">Open Invoices</h3>
        <div class="top-button float-right">
            <a href ng-click="module = 'main'" class="btn btn-primary">
                <i class="svg_icons" data-feather="arrow-left"></i>
                <span style="margin-left: 3px;">Back</span>
            </a>
            <a href="documents/print_rep_openinvoice.php" class="btn btn-primary" target="_blank">
                <i class="svg_icons" data-feather="file-text"></i>
                <span style="margin-left: 3px;">  </span>
            </a>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <table style="width: 100%;">
                            <thead>
                                <th>NAME</th>
                                <th>DATE</th>
                                <th>TRANSACTION TYPE</th>
                                <th>NO.</th>
                                <th>TERMS</th>
                                <!-- <th>DUE DATE</th> -->
                                <th>OPEN BALANCE</th>
                                <!-- <th>TOTAL</th> -->
                            </thead>
                            <tbody>
                                <tr ng-repeat="data in dataOpeninvoicelist">
                                    <th>{{ data.payeename }}</th>
                                    <td>{{data.paymentdate}}</td>
                                    <td>INVOICE</td>
                                    <td>{{data.id}}</td>
                                    <td>Due on receipt</td>
                                    <!-- <td>{{data.id}}</td> -->
                                    <!-- <td>{{data.paymentdate}}</td> -->
                                    <td>{{data.amount ? (data.amount | number : 2) : '0.00'}}</td>
                                </tr>
                                <tr ng-if="dataOpeninvoicelist.length == 0">
                                    <td colspan="5">NO RECORDS!</td>
                                </tr>
                                <tr>
                                    <td colspan="6" style='text-align:left;'><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL</strong></td>
                                    <!-- <td><strong>{{dataOpeninvoicetotal | number : 2}}</strong></td> -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

     
    <!--  ---------------------- DIVISION -----------------------------  -->
    
    <div class="page-content" style="margin-top: 60px" ng-show="module == 'profitlossincome'">
        <h3 class="d-inline-block">Profit and Loss % of Total Income </h3>
        <div class="top-button float-right">
            <a href ng-click="module = 'main'" class="btn btn-primary">
                <i class="svg_icons" data-feather="arrow-left"></i>
                <span style="margin-left: 3px;">Back</span>
            </a>
            <a href="documents/print_rep_profitandlosstotal.php" class="btn btn-primary" target="_blank">
                <i class="svg_icons" data-feather="file-text"></i>
                <span style="margin-left: 3px;">  </span>
            </a>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <table style="width: 100%;">
                            <thead>
                                <!-- <th>No.</th> -->
                                <th></th>
                                <th>TOTAL</th>
                            </thead>
                            <thead>
                                <!-- <th>No.</th> -->
                                <th></th>
                                <th>1 January - <?php echo date("F j, Y"); ?></th>
                            </thead>
                            <!-- ng-repeat="data in dataOpeninvoicelist" -->
                            <tbody>
                            <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Income</td>
                                    <td class="cus_tbl-td cus_tbl-th"></td>
                                </tr>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Sales of Customer Order</td>
                                    <td class="cus_tbl-td cus_tbl-th">{{ dataCustomerorder | number : 2 }}</td>
                                </tr>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Sales of Purchase Order</td>
                                    <td class="cus_tbl-td cus_tbl-th">{{ dataPurchaseorder | number : 2 }}</td>
                                </tr>
                                <tr>
                                    <td class="cus_tbl-td cus_tbl-th">Shipping Income</td>
                                    <td class="cus_tbl-td cus_tbl-th">{{ dataShippingIncome | number : 2 }}</td>
                                </tr>

                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor'><strong>Total Income (PO and CO)</strong></td>
                                    <td class='tb-cursor'><strong>{{ dataTotalPOCO  |  number : 2 }}</strong></td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor'><strong>GROSS PROFIT</strong></td>
                                    <td class='tb-cursor'><strong>{{ dataGrossprofit |  number : 2  }}</strong></td>
                                </tr>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor'><strong>Total Expenses</strong></td>
                                    <td class='tb-cursor'><strong>{{ dataExp |  number : 2 }}</strong></td>
                                </tr>
                                <!-- <tr class="table-hover_cust" >
                                    <td class='tb-cursor'><strong>NET EARNINGS</strong></td>
                                    <td class='tb-cursor'><strong>{{ dataNetearning  |  number : 2  }}</strong></td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!--  ---------------------- DIVISION -----------------------------  -->

    <div class="page-content" style="margin-top: 60px" ng-show="module == 'profitandlossbymonth'">
        <h3 class="d-inline-block">Profit and Loss by Month</h3>
        <div class="top-button float-right">
            <a href ng-click="module = 'main'" class="btn btn-primary">
                <i class="svg_icons" data-feather="arrow-left"></i>
                <span style="margin-left: 3px;">Back</span>
            </a>
            <a href="documents/print_rep_profitandlossbymonth.php?year={{profitandlossbymonthfilter}}" class="btn btn-primary" target="_blank">
                <i class="svg_icons" data-feather="file-text"></i>
                <span style="margin-left: 3px;">  </span>
            </a>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-3" style="padding-left: 0px; padding-bottom: 5px;">
                            <!-- <select ng-model="catcatcat" ng-options="categexpid as item.categexpname for item in catlist" ng-selected="true"></select> -->
                            <select class="" id="profitandlossbymonthfilter" ng-model="profitandlossbymonthfilter" ng-change="loadPLMdata(profitandlossbymonthfilter)">
                                <option ng-repeat="row in listplmyear" value="{{row.year}}">{{row.year}}</option>
                            </select>
                        </div>
                        <table style="width: 100%;">
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
                                <tr>
                                    <td colspan="13" style="text-align: left;"><strong>INCOME</strong></td>
                                </tr>
                                <tr>
                                    <td>Purchase Order</td>
                                    <td ng-repeat="data in dataPO track by $index">{{data | number : 2}}</td>
                                </tr>
                                <tr>
                                    <td>Customer Order</td>
                                    <td ng-repeat="data in dataCO track by $index">{{data | number : 2}}</td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;"><strong>TOTAL INCOME</strong></td>
                                    <td ng-repeat="data in totalPOCO track by $index">{{data | number : 2}}</td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;"><strong>GROSS PROFIT</strong></td>
                                    <td ng-repeat="data in totalCOG track by $index">{{data | number : 2}}</td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;"><strong>EXPENSE</strong></td>
                                    <td ng-repeat="data in dataExp track by $index">{{data | number : 2}}</td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;"><strong>EXPENSE TOTAL</strong></td>
                                    <td colspan="12" style="text-align: right;padding-right: 20px;"><strong>{{totalExp | number : 2}}</strong></td>
                                </tr>
                                <!-- <tr ng-repeat="data in dataBillpaymentlist">
                                    <td>{{data.paymentdate}}</td>
                                    <td>INVOICE</td>
                                    <td>{{data.id}}</td>
                                    <td>Due on receipt</td>
                                    <td>{{data.id}}</td>
                                    <td>{{data.amount ? (data.amount | number : 2) : '0.00'}}</td>
                                </tr>
                                <tr ng-if="dataBillpaymentlist.length == 0">
                                    <td colspan="5">NO RECORDS!</td>
                                </tr>
                                <tr>
                                    <td colspan="3" style='text-align:left;'><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL</strong></td>
                                    <td><strong>{{dataBillpaymenttotal | number : 2}}</strong></td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

      <!--  ---------------------- DIVISION -----------------------------  -->

      
    <div class="page-content" style="margin-top: 60px" ng-show="module == 'collectionsreport'">
        <h3 class="d-inline-block">Collections Report</h3>
        <div class="top-button float-right">
            <a href ng-click="module = 'main'" class="btn btn-primary">
                <i class="svg_icons" data-feather="arrow-left"></i>
                <span style="margin-left: 3px;">Back</span>
            </a>
            <a href="documents/print_rep_collectionsreport.php?docid={{categexpid}}" class="btn btn-primary" target="_blank">
                <i class="svg_icons" data-feather="file-text"></i>
                <span style="margin-left: 3px;">  </span>
            </a>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-3" style="padding-left: 0px; padding-bottom: 5px;">
                            <!-- <select ng-model="catcatcat" ng-options="categexpid as item.categexpname for item in catlist" ng-selected="true"></select> -->
                            <select class="" id="categexpid" ng-model="categexpid" ng-change="loadCatData(categexpid)">
                                <option ng-repeat="row in catlist" value="{{row.categexpid}}">{{row.categexpname}}</option>
                            </select>
                        </div>
                        <table style="width: 100%;">
                            <thead>
                                <td>DATE</td> 
                                <td>TRANSACTION TYPE</td>
                                <td>NAME</td>
                                <td>NO.</td>
                                <td>DUE DATE<td>
                                <td>PAST DUE<td>
                                <td>AMOUNT</td>
                                <td>OPEN BALANCE</td>
                            </thead>
                            <tbody>
                                <tr ng-repeat="data in datatransaccount">
                                    <td>{{ }}</td>
                                    <td>{{ }}</td>
                                    <td>{{ }}</td>
                                    <td>{{ }}</td>
                                    <td>{{ }}</td>
                                    <td>{{ }}</td>
                                    <td>{{ }}</td>
                                    <td>{{ }}</td>
                                </tr>
                                <tr ng-if="datatransaccount.length == 0">
                                    <td colspan="5">NO RECORDS!</td>
                                </tr>
                                <tr>
                                    <td colspan="4" style='text-align:left;'><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL</strong></td>
                                    <td><strong>{{datatransaccounttotal | number : 2}}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!--  ---------------------- END DIV -----------------------------  -->

</div>

<!--END content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!-- TAB GROUP -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>
<script src="app-controller/js-controller/reportsV2Ctrl.js"></script>
<?php include "includes/footer.php"; ?>
