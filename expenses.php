<?php
include 'config.php';
include 'includes/header.php';
include 'includes/side-bar.php';
if (!Role('expenses')) {
    echo "<script>window.location.href='index.php';</script>";
};
?>
<div class="page-wrapper" ng-app="appCon" ng-controller="expenserController" ng-cloak>
    <?php include 'includes/top-bar.php' ?>
    <!-- content -->
    <div class="page-content">
        <h3>Expense</h3>
        <div class="row" ng-show="formView=='add'">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form name="mainFormf" action="" method="">
                            <div class="col-sm-6 p-r-0">
                                <fieldset ng-disabled="mainForm">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Payee:</label>
                                        <!-- <select name="" class="form-control" ng-model="main.payeeid"  ng-change="savemain();">
                                            <!-- <option value="">Customers and Suppliers table</option> 
                                            <option ng-repeat="row in payeeList" value="{{row.id}}">{{row.name}}</option>
                                        </select> -->
                                        <small ng-show="validate && !main.payeeid" class="req-txt">Payee is required</small>
                                        <select ng-model="main.payeeid" ng-options="item.id as item.name for item in payeeList" ng-selected="true"></select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Payment Account:</label>
                                        <!-- <select class="" ng-model="main.paymentaccount">
                                            <option ng-repeat="row in paymentActList" value="{{row.creditcardid}}">{{row.creditcard}}</option>
                                            <option value="">credit card table muna ilabas mo dito</option>
                                        </select> -->
                                        <select ng-model="main.paymentaccount" ng-options="item.accountid as item.accountname for item in paymentActList" ng-selected="true"  ng-change="getaccountbalinfo(main.paymentaccount)"></select>
                                        <!-- for now credit cards muna yung nilalabas namin mag-add ng iba based sa modal sa QB. -->
                                        <small ng-show="" class="req-txt">Payment account is required</small>
                                    </div>
                                    <div class="form-group" ng-if="main.paymentaccount">
                                    <input type="hidden" ng-model="main.accountbal"/>
                                        <label><b>Balance:</b> {{ main.accountbal | number:2 }}</label>
                                     </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Payment Date:</label>
                                        <input id="date" class="form-control" name="" type="date" ng-model="main.paymentdate">
                                        <small ng-show="" class="req-txt">payment date is required</small>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Payment Method:</label>
                                        <!-- <select class="" ng-model="main.paymentmethod"">
                                            <!-- <option value="">mode of payment table</option> 
                                            <option ng-repeat="row in paymentMethod" value="{{row.mopid}}">{{row.modeofpayment}}</option>
                                        </select> -->
                                        <select ng-model="main.paymentmethod" ng-options="item.mopid as item.modeofpayment for item in paymentMethod" ng-selected="true"></select>
                                        <small ng-show="" class="req-txt">payment method is required</small>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Reference No.</label>
                                        <input class="form-control" name="" type="text" ng-model="main.referenceno">
                                        <small ng-show="" class="req-txt">Reference number is required</small>
                                    </div>
                                </div>
                                </fieldset>
                            </div>
                            <div align="right">
                            <div class="form-group">
                                        <label><h3>Total Amount</h3></label><br/>
                                        <label><h4>{{totalamount}}</h4></label>
                                    </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="" style="width: 100%;">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="">
                                <h5>Category Details</h5>
                                <table class="table">
                                    <thead>
                                        <th width="3%">#</th>
                                        <th width="17%">Category</th>
                                        <th width="57.72%">Description</th>
                                        <th width="12.28%">Amount (PHP)</th>
                                        <th width="10%"></th>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="catdata in category">
                                            <td>{{$index + 1}}</td>
                                            <td> 
                                                <select ng-model="catdata.categoryid" ng-options="item.categexpid as item.categexpname for item in catlist" ng-selected="true"></select>
                                                <!-- <select name="" class="form-control" ng-model="catdata.categoryid" ng-change="updatecategory();">
                                                    <option value="Amortisation Expense">Amortisation Expense</option>
                                                    <option value="Bad Debts">Bad Debts</option> 
                                                    <option value="ank Charges">Bank Charges</option>
                                                    <option value="Checkbook Reorder">Checkbook Reorder</option>
                                                    <option value="Commissions and Fees">Commissions and Fees</option>
                                                    <option value="Bank">Bank</option> 
                                                    <option value="Dues and Subscriptions">Dues and Subscriptions</option> 
                                                    <option value="Income Tax Expenses">Income Tax Expenses</option> 
                                                    <option value="Insurance - Disability">Insurance - Disability</option>
                                                    <option value="Insurance - General">Insurance - General</option>
                                                    <option value="Insurance - Liability">Insurance - Liability</option>
                                                    <option value="Interest Expenses">Interest Expenses</option>
                                                    <option value="Legal and Professional Fees">Legal and Professional Fees</option>
                                                    <option value="Loss on discontinued operations, net of tax">Loss on discontinued operations, net of tax </option>
                                                    <option value="Management Compensations">Management Compensations</option>
                                                </select> -->
                                            </td>
                                            <td><input class="form-control" name="" type="text" ng-blur="updatecategory();" ng-model="catdata.description" ng-disabled="!catdata.categoryid"></td>
                                            <td><input class="form-control" name="" type="text" ng-blur="updatecategory();" ng-model="catdata.amount" ng-disabled="!catdata.categoryid"></td>
                                            <td>
                                                <div  class="d-inline-block" data-toggle="tooltip" data-placement="top" title="" style="width: 35px; margin: auto;">
                                                        <a href class="mrcs-5" ng-click="removerow('cat', catdata.id)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle svg_icons">
                                                            <circle cx="12" cy="12" r="10"></circle>
                                                            <line x1="15" y1="9" x2="9" y2="15"></line>
                                                            <line x1="9" y1="9" x2="15" y2="15"></line>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="addrow"><i class="zmdi zmdi-plus txt-bold m-r-5"></i><a ng-click="addrow('cat');">Add Row</a></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <h5 style="padding-top: 45px;">Item Details</h5>
                                <table class="table">
                                    <thead>
                                        <th width="3%">#</th>
                                        <th width="17%">Product Name</th>
                                        <th width="33.12%">Description</th>
                                        <th width="12.28%">QTY</th>
                                        <th width="12.28%">Rate</th>
                                        <th width="12.28%">Amount (PHP)</th>
                                        <th width="10%"></th>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="itemdata in item">
                                            <td>{{$index + 1}}</td>
                                            <td>
                                                <!-- <select name="hjfhjg" class="form-control" ng-model="itemdata.stocksid">
                                                    <option value="">stocks table</option>
                                                </select> -->
                                                <select ng-model="itemdata.stocksid" ng-change="getproddinfo(itemdata.stocksid, $index, itemdata.id)" ng-options="item.stocksid as item.stockname for item in prodlist" ng-selected="true"></select>
                                            </td>
                                            <td><input class="form-control" type="text" ng-model="itemdata.description" ng-disabled="!itemdata.stocksid" ng-blur="floadItem()"></td>
                                            <td><input class="form-control" type="text" ng-model="itemdata.quantity" ng-disabled="!itemdata.stocksid || !itemdata.rate" ng-blur="setQuantity(itemdata.quantity, itemdata.unitpricephp, itemdata.rate, $index, itemdata.id, itemdata.stocksid, itemdata.availablestocks)"></td>
                                            <td><input class="form-control" type="text" ng-model="itemdata.rate" ng-disabled="!itemdata.stocksid"" ng-blur="floadItem()"></td>
                                            <td><input class="form-control" type="text" ng-model="itemdata.amountse" disabled></td>
                                            <td>
                                                <div  class="d-inline-block" data-toggle="tooltip" data-placement="top" title="" style="width: 35px; margin: auto;">
                                                        <a href class="mrcs-5" ng-click="removerow('item', itemdata.id)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle svg_icons">
                                                            <circle cx="12" cy="12" r="10"></circle>
                                                            <line x1="15" y1="9" x2="9" y2="15"></line>
                                                            <line x1="9" y1="9" x2="15" y2="15"></line>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"></td>
                                            <td class="addrow"><i class="zmdi zmdi-plus txt-bold m-r-5"></i><a ng-click="addrow('item');">Add Row</a></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"></td>
                                            <td class="txt-right">
                                                <strong>Total Amount</strong>
                                            </td>
                                            <td class="txt-right">
                                                <strong>&#8369; {{totalitemamount ? totalitemamount : '0.00'}}</strong>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label>Remarks:</label>
                                        <textarea class="form-control" name="" cols="30" rows="7" ng-model="main.remarks" placeholder="Enter remarks..."></textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group col-sm-12">
                                    <label>Attachments</label><br>
                                    <div ng-repeat="data in attachFile">
                                    <div  class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Delete" style="width: 25px; margin: auto;">
                                        <a href class="mrcs-5" ng-click="deleteFile(data.id, data.path)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle svg_icons">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <line x1="15" y1="9" x2="9" y2="15"></line>
                                                <line x1="9" y1="9" x2="15" y2="15"></line>
                                            </svg>
                                        </a>
                                    </div>
                                    <a href="{{data.path}}" download="{{data.name}}">{{data.name}}</a>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="file" name="img" ng-model="myFile" file-model="myFile" ng-change="uploadFile(main.expenseid)" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <!-- <input type="text" class="form-control file-upload-info" ng-model="uiname" disabled="" placeholder="Upload Image"> -->
                                        <!-- <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-primary" type="button">SELECT FILE</button>
                                        </span>
                                        <div ng-show="isUploading">
                                            <div class="spinner-border" role="status" style="margin-left: 5px;">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            <span>Uploading..</span>
                                        </div> -->
                                        <button class="file-upload-browse btn btn-primary" type="button" ng-show="!isUploading">Upload</button>
                                        <button class="btn btn-primary" type="button" disabled ng-show="isUploading">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            Uploading...
                                        </button>
                                    </div>
                                </div>
                                <div align="right" class="col-sm-12">
                                    <a href="" ng-click="save()" class="btn btn-success">Save</span></a>
                                    <a href="" ng-click="init()" class="btn btn-primary m-l-10"><span>Cancel</span></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" ng-show="formView=='list'">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body" ng-cloak>  
                        <div class="top-button float-right">
                            <a href ng-click="formView='add'" class="btn btn-primary">
                                <i class="svg_icons" data-feather="file-text"></i>
                                <span style="margin-left: 3px;">Add an Expense</span>
                            </a>
                        </div>
                        <!-- <h6 class="card-title">Data Table</h6> -->
                        <div class="row">
                            <div class="pull-right" style="margin-left: 0.75em !important">
                                <label>Search:</label>
                                <input type="text" ng-model="search" ng-change="filter()" placeholder="Search" class="form-control" style="width: 25em;" />
                            </div>

                            <div class="col-sm-2 pull-right">
                                <label>PageSize:</label>
                                <select ng-model="data_limit" class="form-control" style="width: 75px;">
                                    <option>10</option>
                                    <option>20</option>
                                    <option>50</option>
                                    <option>100</option>
                                    <option>ALL</option>
                                </select>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-12" ng-show="filter_data > 0">
                                <table class="table">
                                    <thead>
                                        <th>ID&nbsp;<a ng-click="sort_with('');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Ref No.</th>   
                                        <th>Payee</th>  
                                        <th>Payment Method</th> 
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <tr class="table-hover_cust" ng-repeat="data in searched = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*(data_limit == 'ALL' ? entire_user : data_limit) | limitTo:(data_limit == 'ALL' ? entire_user : data_limit)">
                                            <td>{{data.expenseid}}</td>
                                            <td>{{data.referenceno}}</td>
                                            <td>{{data.payeename}}</td>
                                            <td>{{data.modeofpayment}}</td>
                                            <td>
                                            <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="print" style="width: 35px; margin: auto;">
                                                    <a href="documents/expenses-report.php?docid={{data.expenseid}}" target="_blank" class="mrcs-5">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                                                    </a>
                                                </div>
                                                <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Edit" style="width: 35px; margin: auto;">
                                                    <a href ng-click="edit(data.expenseid);" class="mrcs-5">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit svg_icons">
                                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Delete" style="width: 35px; margin: auto;">
                                                    <a href ng-click="deleteexpense(data.expenseid)" class="mrcs-5">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle svg_icons">
                                                            <circle cx="12" cy="12" r="10"></circle>
                                                            <line x1="15" y1="9" x2="9" y2="15"></line>
                                                            <line x1="9" y1="9" x2="15" y2="15"></line>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12" ng-show="filter_data == 0">
                                <div class="col-md-12">
                                    <h4>No records found..</h4>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-12" ng-show="filter_data > 0">
                                    <div pagination="" page="current_grid" on-select-page="page_position(page)" boundary-links="true" total-items="filter_data" items-per-page="data_limit" class="pagination-small pull-right" previous-text="&laquo;" next-text="&raquo;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!-- TAB GROUP -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>


<script src="app-controller/js-controller/expenseCtrl.js"></script>
<?php include "includes/footer.php"; ?>