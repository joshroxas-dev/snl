<?php
include 'config.php';
include 'includes/header.php';
include 'includes/side-bar.php';
?>
<div class="page-wrapper" ng-app="appCon" ng-controller="purchaseorderController" ng-cloak>
    <?php include 'includes/top-bar.php' ?>
    <!-- content -->
    <div class="page-content" ng-show="view=='main'">
         <h3 class="d-inline-block">Purchase Order</h3>
        <div class="top-button float-right">
            <a href ng-click="userpage(type='page2',id='0')" class="btn btn-primary">
                <i class="svg_icons" data-feather="file-text"></i>
                <span style="margin-left: 3px;">Placed/Drafts</span>
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
                                             <tr>
                                                 <input type="hidden" ng-model="data.stockname">
                                                 <input type="hidden" ng-model="data.stockcolor">
                                                 <input type="hidden" ng-model="data.stocksize">
                                                <td><label for="batchnumber">Batch Number: </label></td>
                                                <td><input id="batchnumber" class="form-control" name="batchnumber" ng-model="data.batchnumber" type="text">
                                                    <small ng-show="validate && data.batchnumber == ''" class="req-txt">Batch Number is required</small>
                                                </td>
                                            </tr> 
                                            <tr>
                                                <td><label for="ordernumber">Order Number: </label></td>
                                                <td><input id="ordernumber" class="form-control" name="ordernumber" ng-model="data.ordernumber"  type="text">
                                                    <small ng-show="validate && data.ordernumber == ''" class="req-txt">Order Number is required</small>
                                                </td>
                                            </tr>
                                            <!-- <tr>
                                                <td><label for="productbrand">Select Brand: </label></td>
                                                <td>
                                                    <select name="productbrand" class="form-control" id="" ng-model="data.productbrand" >
                                                        <option value="1">Angelus Importer</option>
                                                        <option value="2">Sneaks and Laces</option>
                                                        <option value="3">Chimera</option>
                                                    </select>
                                                    <small ng-show="validate && data.productbrand == ''" class="req-txt">Brand is required</small>
                                                </td>
                                            </tr> -->
                                            <tr>
                                                <td><label for="productid"> Product: </label></td>
                                                <td>
                                                    <!-- <input id="productid" class="form-control" name="productid" ng-model="data.productid"  type="text"> -->
                                                    <select ui-select2 ng-model="data.productid" ng-change="getprodinfo(data.productid)" placeholder="Pick a number">
                                                        <option value="" disabled selected>Select Product</option>
                                                        <option ng-repeat="row in prodlist" value="{{row.stocksid}}">{{row.stockname}}</option>
                                                    </select>
                                                    <small ng-show="validate && data.productid == ''" class="req-txt">Product is required</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="unitpricedollars">Unit Price ($): </label></td>
                                                <td><input id="unitpricedollars" class="form-control" name="unitpricedollars"  ng-model="data.unitpricedollars" currency-symbol="" ng-currency fraction="2" type="text" disabled>
                                                    <!-- <small ng-show="validate && data.unitpricedollars == ''" class="req-txt">Unit Price is required</small> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="quantity">Quantity: </label></td>
                                                <td><input id="quantity" class="form-control" ng-model="data.quantity" ng-change="setQuantity(data.quantity, data.unitpricephp, data.unitpricedollars)" name="quantity" type="text">
                                                    <small ng-show="validate && data.quantity == ''" class="req-txt">Quantity is required</small>
                                                </td>
                                            </tr>
                                             <tr>
                                                <td><label for="exchangerate">Exchange Rate: </label></td>
                                                <td><input title="{{lrate == data.exchangerate ? (updatedat | date: 'MM/dd/yyyy hh:mma') : ''}}" id="exchangerate" class="form-control" name="exchangerate"  ng-model="data.exchangerate" ng-change="setRate(data.exchangerate, data.quantity, data.unitpricedollars)" type="text">
                                                    <small ng-show="validate && data.exchangerate == ''" class="req-txt">Exchange Rate is required</small>
                                                </td>
                                            </tr> 
                                            <tr>
                                                <td><label for="unitpricephp">Unit Price (₱): </label></td>
                                                <td><input id="unitpricephp" class="form-control" name="unitpricephp"  ng-model="data.unitpricephp" currency-symbol="" ng-currency fraction="2" type="text" disabled>
                                                    <!-- <small ng-show="validate && data.unitpricephp == ''" class="req-txt">Unit Price is required</small> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="totalpricephp">Total Price (₱): </label></td>
                                                <td><input id="totalpricephp" class="form-control" name="totalpricephp"  ng-model="data.totalpricephp" currency-symbol="" ng-currency fraction="2" type="text" disabled>
                                                    <!-- <small ng-show="validate && data.totalpricephp == ''" class="req-txt">Total Price (₱) is required</small> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="totalpricedollars">Total Price ($): </label></td>
                                                <td><input id="totalpricedollars" class="form-control" name="totalpricedollars"  ng-model="data.totalpricedollars" currency-symbol="" ng-currency fraction="2" type="text" disabled>
                                                    <!-- <small ng-show="validate && data.totalpricedollars == ''" class="req-txt">Total Price ($) is required</small> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="freightintotal">Freight-In (per unit): </label></td>
                                                <td><input id="freightintotal" class="form-control" name="freightintotal" ng-model="data.freightintotal" type="text">
                                                    <small ng-show="validate && data.freightintotal == ''" class="req-txt">Freight-In (per unit) is required</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="freightinperunit">Freight-In (Total): </label></td>
                                                <td><input id="freightinperunit" class="form-control" name="freightinperunit" ng-model="data.freightinperunit" type="text">
                                                    <small ng-show="validate && data.freightinperunit == ''" class="req-txt">Freight-In (Total) is required</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="taxperunit">Taxes Per Unit: </label></td>
                                                <td><input id="taxperunit" class="form-control" name="taxperunit" ng-model="data.taxperunit" type="text">
                                                    <small ng-show="validate && data.taxperunit == ''" class="req-txt">Taxes Per Unit is required</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="taxtotalperproduct">Taxes Total Per Product : </label></td>
                                                <td><input id="taxtotalperproduct" class="form-control" name="taxtotalperproduct" ng-model="data.taxtotalperproduct" type="text">
                                                    <small ng-show="validate && data.taxtotalperproduct == ''" class="req-txt">Taxes Total Per Product is required</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="costperunit">Cost Per Unit: </label></td>
                                                <td><input id="costperunit" class="form-control" name="costperunit" ng-model="data.costperunit" ng-model="data.quantity"type="text">
                                                    <small ng-show="validate && data.costperunit == ''" class="req-txt">Taxes Total Per Product is required</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="totalcostofgoods">Total Cost of Goods: </label></td>
                                                <td><input id="totalcostofgoods" class="form-control" name="totalcostofgoods" ng-model="data.totalcostofgoods" type="text">
                                                    <small ng-show="validate && data.costperunit == ''" class="req-txt">Taxes Total Per Product is required</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="srp">Suggested Retail Price: </label></td>
                                                <td><input id="srp" class="form-control" name="srp" ng-model="data.srp" type="text">
                                                    <small ng-show="validate && data.srp == ''" class="req-txt">Suggested Retail Price is required</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="creditcard">Credit Card: </label></td>
                                                <td><select name="" class="form-control" id="creditcard" ng-model="data.creditcard">
                                                    <option value="1">BDO</option>
                                                    <option value="2">BPI</option>
                                                    <option value="">RCBC</option>
                                                    <option value="">PNB</option>
                                                    <option value="">Chinabank Savings</option>
                                                </select>
                                                <small ng-show="validate && data.creditcard == ''" class="req-txt">Credit Card is required</small>
                                            </td>
                                            </tr>
                                            <tr>
                                                <td><label for="courierid">Courier: </label></td>
                                                <td><select name="" class="form-co  ntrol" id="" ng-model="data.courierid">
                                                    <option value="1">Courier 1</option>
                                                    <option value="2">Courier 2</option>
                                                    <option value="">Courier 3</option>
                                                </select>
                                                <small ng-show="validate && data.courierid == ''" class="req-txt">Courier is required</small>
                                            </td>
                                            </tr>
                                            <tr>
                                                <td><label for="remarks">Add Remarks: </label></td>
                                                <td><textarea name="remarks" id="remarks" placeholder="Add Remarks..." class="form-control" cols="30" rows="10" ng-model="data.remarks"></textarea>
                                                    <!-- <small ng-show="validate && data.remarks == ''" class="req-txt">Remarks is required</small> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="trackingnumber">AWB/Tracking Number: </label></td>
                                                <td><input id="trackingnumber" class="form-control" name="trackingnumber" type="text" ng-model="data.trackingnumber">
                                                    <small ng-show="validate && data.trackingnumber == ''" class="req-txt">AWB/Tracking Number is required</small>
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
                                        <button class="btn btn-success" ng-click="save(data, 'placed')">Place Order</button>
                                        <button class="btn btn-primary" ng-click="save(data, 'draft')">Save as Draft</button>
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
                                    <img src="assets/images/image-empty.jpg" style="width:120px;height:120px;">
                                    <h4>{{prodinfo.stockname}}</h4>
                                </div>
                                <div class="table-responsive"><br />
                                    <table id="dataTableExample" class="table table-hover">
                                        <tbody>
                                            <!-- <tr>
                                                <td>SKU: </td>
                                                <td>Data</td>
                                            </tr> -->
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
                                                <td>Available Stock: </td>
                                                <td>{{prodinfo.availablestocks}}</td>
                                            </tr>
                                            <tr>
                                                <td>Status: </td>
                                                <td>
                                                    <h5><span class="badge badge-primary">{{prodinfo.availablestocks == '0' ? 'Not Available' : 'Available'}}</span></h5>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>SRP/Unit Price: </td>
                                                <td>{{prodinfo.unitprice}}</td>
                                            </tr>
                                            <!-- <tr>
                                                <td>Shipping Fee: </td>
                                                <td>Data</td>
                                            </tr> -->
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
    <!-- content -->

    <!-- content -->
    <div class="page-content" ng-show="view=='page2'" ng-init="page2='tab1'">
         <h3 class="d-inline-block">Purchase Order</h3>
        <div class="top-button float-right">
            <a href ng-click="userpage(type='main',id='0')" class="btn btn-primary">
                <i class="svg_icons" data-feather="arrow-left"></i>
                <span style="margin-left: 3px;">Back</span>
            </a>
        </div>
        <div class="row" ng-show="page2=='tab1'">
            <div class="col-md-12 stretch-card">
                <div class="card-boody">
                    <button class="btn btn-primary">Purchased</button>
                    <button class="btn btn-light" ng-click="page2='tab2'">Draft</button>
                </div>
            </div>
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Purchased Details</h6>
                        <div class="col-sm-12">
                            <div class="col-sm-5">
                                <div class="col-sm-4" style="top: 8px;" >Order Number:</div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <!-- <div class="col-sm-2"><label>Search Order Number:</label></div>
                                        <div class="col-sm-5">{{names}}
                                            <select class="js-example-responsive w-100" ng-model="selectedName" ng-options="item for item in names"></select>
                                        </div> -->
                                        <!-- <input type="text" class="form-control" ng-model="search" list="names">
                                        <datalist id="names" ng-model="name">
                                            <option ng-repeat="option in contacts | filter:search | limitTo:3" value="{{option.name}}"></option>
                                        </datalist> -->
                                        <select ui-select2 ng-model="select2" placeholder="Pick a number">
                                            <option value="" disabled selected>Select Order Number</option>
                                            <option ng-repeat="number in names" value="{{number}}">{{number}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <table class="table">
                                    <thead>
                                        <!-- <th>No.</th> -->
                                        <th>Batch Number&nbsp;<a ng-click=""><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Order Number&nbsp;<a ng-click=""><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Product&nbsp;<a ng-click=""><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Quantity&nbsp;<a ng-click=""><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Exchange Rate&nbsp;<a ng-click=""><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Credit Card&nbsp;<a ng-click=""><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Courier&nbsp;<a ng-click=""><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>AWB/Tracking Number&nbsp;<a ng-click=""><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Purchase Date&nbsp;<a ng-click=""><i class="glyphicon glyphicon-sort"></i></a></th>
                                        
                                        
                                    </thead>
                                    <tbody>
                
                                        <tr class="table-hover_cust">
                                           <td>Batch Number sample_001</td>
                                           <td>Order_Number sample_001</td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" ng-show="page2=='tab2'">
            <div class="col-md-12 stretch-card">
                <div class="card-boody">
                    <button class="btn btn-light" ng-click="page2='tab1'">Purchased</button>
                    <button class="btn btn-primary">Draft</button>
                    
                </div>
            </div>
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Draft List</h6>
                        <br>
                            <div class="col-sm-12">
                                <table class="table">
                                    <thead>
                                        <!-- <th>No.</th> -->
                                        <th>Batch Number&nbsp;<a ng-click=""><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Order Number&nbsp;<a ng-click=""><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Product&nbsp;<a ng-click=""><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Quantity&nbsp;<a ng-click=""><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Exchange Rate&nbsp;<a ng-click=""><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Credit Card&nbsp;<a ng-click=""><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Courier&nbsp;<a ng-click=""><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>AWB/Tracking Number&nbsp;<a ng-click=""><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Purchase Date&nbsp;<a ng-click=""><i class="glyphicon glyphicon-sort"></i></a></th>
                                        
                                        
                                    </thead>
                                    <tbody>
                
                                        <tr class="table-hover_cust">
                                        <td>Batch Number sample_001</td>
                                        <td>Order_Number sample_001</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content -->
</div>

<script src="app-controller/js-controller/purchaseorderCtrl.js"></script>
<?php include "includes/footer.php"; ?>