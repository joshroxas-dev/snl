<?php
include 'config.php';
include 'includes/header.php';
include 'includes/side-bar.php';
?>
<div class="page-wrapper" ng-app="appCon" ng-controller="customerorderController" ng-cloak>
<?php include 'includes/top-bar.php' ?>
    <!-- content -->
    <div class="page-content" ng-show="view == 'main'">
        <h3 class="d-inline-block">{{formview == 'add' ? 'Customer Order' : 'Edit Customer Order'}}</h3>
        <div class="top-button float-right">
            <a href ng-click="view='list';" class="btn btn-primary">
                <i class="svg_icons" data-feather="file-text"></i>
                <span style="margin-left: 3px;">Customer Order List</span>
            </a>
        </div>
        <form class="cmxform">
            <fieldset>
                <div class="row">
                    <div class="col-lg-8 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"></h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <input id="customerorderid" class="form-control" name="ordernumber" ng-model="data.customerorderid" type="hidden">
                                            <input id="productid" class="form-control" name="productid" ng-model="data.productid" type="hidden">
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <div class="form-group row" style="padding-left: 160px; padding-top: 0px; padding-bottom: 0px;">
                                                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label" style="margin-bottom: 0px;">Filter: </label>
                                                        <div class="col-sm-9">
                                                            <select name="" class="form-control" id="" ng-model="data.filter" ng-change="data.filter=data.filter">
                                                                <option value="Local">Local</option>
                                                                <option value="International">International</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="ordernumber">Order Number: </label></td>
                                                <td><input id="ordernumber" class="form-control" name="ordernumber" ng-model="data.ordernumber" type="text">
                                                    <small ng-show="validate && data.ordernumber == ''" class="req-txt">Order Number is required</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="name">Platform: </label></td>
                                                <td>
                                                    <select name="" class="form-control" id="" ng-model="data.orderplatform">
                                                        <option value="" selected disabled>Select Platform</option>
                                                        <option value="Shopee">Shopee</option>
                                                        <option value="Lazada">Lazada</option>
                                                        <option value="Website">Official Website</option>
                                                    </select>
                                                    <small ng-show="validate && data.orderplatform == ''" class="req-txt">Platform is required</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label> Customer: </label></td>
                                                <td>
                                                    <!-- <input id="productid" class="form-control" name="productid" ng-model="data.productid"  type="text"> -->
                                                    <select ui-select2 ng-model="data.customerid" ng-change="getcustomerinfo(data.customerid)">
                                                        <option value="" disabled selected>Select Customer</option>
                                                        <option ng-repeat="row in customerlist" value="{{row.customerid}}">{{row.customerfirstname}}</option>
                                                    </select>
                                                    <small ng-show="validate && data.customerid == ''" class="req-txt">Customer is required</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="name">Classification: </label></td>
                                                <td>
                                                    <select name="" class="form-control" id="" ng-model="data.classification">
                                                        <option value="" selected disabled>Select Classification</option>
                                                        <option value="Wholesale">Wholesale</option>
                                                        <option value="Retail">Retail</option>
                                                    </select>
                                                    <small ng-show="validate && data.classification == ''" class="req-txt">Classification is required</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="productid"> Product: </label></td>
                                                <td>
                                                    <!-- <input id="productid" class="form-control" name="productid" ng-model="data.productid"  type="text"> -->
                                                    <select ui-select2 ng-model="data.productid" ng-change="getprodinfo(data.productid, true)" placeholder="Pick a number">
                                                        <option value="" disabled selected>Select Product</option>
                                                        <option ng-repeat="row in prodlist" value="{{row.stocksid}}">{{row.stockname}}</option>
                                                    </select>
                                                    <small ng-show="validate && data.productid == ''" class="req-txt">Product is required</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="name">Mode of Payment: </label></td>
                                                <td>
                                                    <select name="" class="form-control" id="" ng-model="data.modeofpayment">
                                                        <option value="" selected disabled>Select Mode of Payment</option>
                                                        <option value="COD">Cash on Delivery</option>
                                                        <option value="Paypal">Paypal</option>
                                                        <option value="Bank">Bank</option>
                                                    </select>
                                                    <small ng-show="validate && data.modeofpayment == ''" class="req-txt">Mode of Paymen is required</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="courierid"> Courier: </label></td>
                                                <td>
                                                    <select ui-select2 ng-model="data.courierid" ng-change="getcourierinfo(data.courierid)" placeholder="Pick a number">
                                                        <option value="" disabled selected>Select Courier</option>
                                                        <option ng-repeat="row in courierlist" value="{{row.courierid}}">{{row.couriername}}</option>
                                                    </select>
                                                    <small ng-show="validate && data.courierid == ''" class="req-txt">Courier is required</small>
                                                </td>
                                            </tr>
                                            <tr ng-show="data.filter=='International'">
                                                <td><label for="unitpricedollars">Unit Price ($): </label></td>
                                                <td><input id="unitpricedollars" class="form-control" name="unitpricedollars" ng-model="data.unitpricedollars" currency-symbol="" ng-currency fraction="2" type="text" disabled>
                                                    <!-- <small ng-show="validate && data.unitpricedollars == ''" class="req-txt">Unit Price is required</small> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="quantity">Quantity: </label></td>
                                                <td><input id="quantity" class="form-control" ng-model="data.quantity" ng-change="setQuantity(data.quantity, data.unitpricephp, data.unitpricedollars)" name="quantity" type="text" ng-disabled="!data.productid">
                                                    <small ng-show="validate && data.quantity == ''" class="req-txt">Quantity is required</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="exchangerate">Exchange Rate: </label></td>
                                                <td><input title="{{lrate == data.exchangerate ? (updatedat | date: 'MM/dd/yyyy hh:mma') : ''}}" id="exchangerate" class="form-control" name="exchangerate" ng-model="data.exchangerate" ng-change="setRate(data.exchangerate, data.quantity, data.unitpricedollars)" type="text">
                                                    <small ng-show="validate && data.exchangerate == ''" class="req-txt">Exchange Rate is required</small>
                                                </td>
                                            </tr>
                                            <tr ng-show="data.filter=='Local'">
                                                <td><label for="unitpricephp">Unit Price (₱): </label></td>
                                                <td><input id="unitpricephp" class="form-control" name="unitpricephp" ng-model="data.unitpricephp" currency-symbol="" ng-currency fraction="2" type="text" disabled>
                                                    <!-- <small ng-show="validate && data.unitpricephp == ''" class="req-txt">Unit Price is required</small> -->
                                                </td>
                                            </tr>
                                            <tr ng-show="data.filter=='Local'">
                                                <td><label for="totalpricephp">Total Price (₱): </label></td>
                                                <td><input id="totalpricephp" class="form-control" name="totalpricephp" ng-model="data.totalpricephp" currency-symbol="" ng-currency fraction="2" type="text" disabled>
                                                    <!-- <small ng-show="validate && data.totalpricephp == ''" class="req-txt">Total Price (₱) is required</small> -->
                                                </td>
                                            </tr>
                                            <tr ng-show="data.filter=='International'">
                                                <td><label for="totalpricedollars">Total Price ($): </label></td>
                                                <td><input id="totalpricedollars" class="form-control" name="totalpricedollars" ng-model="data.totalpricedollars" currency-symbol="" ng-currency fraction="2" type="text" disabled>
                                                    <!-- <small ng-show="validate && data.totalpricedollars == ''" class="req-txt">Total Price ($) is required</small> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="shippingfee">Shipping Fee: </label></td>
                                                <td>
                                                    <input id="date" class="form-control" name="shippingfee" type="text" ng-model="data.shippingfee">
                                                    <small ng-show="validate && (data.shippingfee == '')" class="req-txt">Shipping Fee is required</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="shippingdate">Shipping Date: </label></td>
                                                <td>
                                                    <input id="date" class="form-control" name="shippingdate" type="date" ng-model="data.shippingdate">
                                                    <small ng-show="validate && (data.shippingdate == '' || data.shippingdate == NULL)" class="req-txt">Shipping Date is required</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="remarks">Add Remarks: </label></td>
                                                <td><textarea name="remarks" id="remarks" placeholder="Add Remarks..." class="form-control" cols="30" rows="10" ng-model="data.remarks"></textarea>
                                                    <!-- <small ng-show="validate && data.remarks == ''" class="req-txt">Remarks is required</small> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="purchasedate">Purchase Date: </label></td>
                                                <td>
                                                    <input id="date" class="form-control" name="purchasedate" type="date" ng-model="data.purchasedate">
                                                    <small ng-show="validate && (data.purchasedate == '' || data.purchasedate == NULL)" class="req-txt">Purchase Date is required</small>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="col-sm-12" align="right">
                                        <button class="btn btn-success" ng-click="save(data)">{{formview == 'add' ? 'Place Order' : 'Save'}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Product Information</h4>
                                <div class="col-sm-12" align="center">
                                    <!-- <img src="assets/images/image-empty.jpg" style="width:120px;height:120px;"> -->
                                    <h4>{{prodinfo.stockname}}</h4>
                                </div>
                                <div class="table-responsive"><br />
                                    <table id="dataTableExample" class="table table-hover">
                                        <tbody>
                                            <tr>
                                                <td>Category: </td>
                                                <td>{{prodinfo.categorydesc}}</td>
                                            </tr>
                                            <tr>
                                                <td>Color: </td>
                                                <td>{{prodinfo.stockcolor}}</td>
                                            </tr>
                                            <tr>
                                                <td>Size: </td>
                                                <td>{{prodinfo.stocksize}}</td>
                                            </tr>
                                            <tr>
                                                <td>Brand: </td>
                                                <td>{{prodinfo.brandname}}</td>
                                            </tr>
                                            <tr>
                                                <td>Supplier: </td>
                                                <td>{{prodinfo.suppliername}}</td>
                                            </tr>
                                            <tr>
                                                <td>Available Stock: </td>
                                                <td>{{prodinfo.availablestocks}}</td>
                                            </tr>
                                            <tr>
                                                <td>Status: </td>
                                                <td>
                                                    <h5><span class="badge badge-primary">{{prodinfo.availablestocks ? (prodinfo.availablestocks == '0' ? 'Not Available' : 'Available') : ''}}</span></h5>
                                                </td> 
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>

    <!-- VIEW TWO -->
    <div class="page-content" ng-show="view == 'list'">
        <h3 class="d-inline-block">Customer Order List</h3>
        <div class="top-button float-right">
            <a href ng-click="view='main'; resetForm();" class="btn btn-primary">
                <i class="svg_icons" data-feather="arrow-left"></i>
                <span style="margin-left: 3px;">Back</span>
            </a>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body" ng-cloak>
                        <!-- <h6 class="card-title">Data Table</h6> -->
                        <div class="row">
                            <div class="pull-right" style="margin-left: 0.75em !important">
                                <label>Search:</label>
                                <input type="text" ng-model="search" ng-change="filter()" placeholder="Search" class="form-control" style="width: 25em;"/>
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
                        <br/>
                        <div class="row">
                            <div class="col-md-12" ng-show="filter_data > 0">
                            <table class="table">
                                <thead>
                                    <th>Order Number: &nbsp;<a ng-click="sort_with('ordernumber');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                    <th>Customer ID: &nbsp;<a ng-click="sort_with('customerid');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                    <th>Product ID: &nbsp;<a ng-click="sort_with('productid');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                    <th>Total Amount (₱): &nbsp;<a ng-click="sort_with('totalamountpesos');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                    <th>Purchase Date: &nbsp;<a ng-click="sort_with('purchasedate');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <tr class="table-hover_cust" ng-repeat="data in searched = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*(data_limit == 'ALL' ? entire_user : data_limit) | limitTo:(data_limit == 'ALL' ? entire_user : data_limit)">
                                        <td>{{data.ordernumber}}</td>
                                        <td>{{data.customerid}}</td>
                                        <td>{{data.productid}}</td>
                                        <td>{{data.totalamountpesos}}</td>
                                        <td>{{data.purchasedate}}</td>
                                        <td>
                                        <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Edit Customer Order" style="width: 35px; margin: auto;">
                                            <a href ng-click="fetcheditdata(data.customerorderid)" class="mrcs-5">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit svg_icons"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                            </a>
                                        </div>
                                        <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Print Customer Order" style="width: 35px; margin: auto;">
                                            <a href="documents/customerorder-report.php?coid={{data.customerorderid}}" role="button" class="mrcs-5" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                                            </a>
                                        </div>
                                        <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Delete Customer Order" style="width: 35px; margin: auto;">
                                            <a href ng-click="deletecustomerorder(data.customerorderid)" class="mrcs-5">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle svg_icons"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
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


</div>
<script src="app-controller/js-controller/customerorderCtrl1.js"></script>
<?php include "includes/footer.php"; ?>