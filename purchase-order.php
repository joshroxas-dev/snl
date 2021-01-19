<?php
include 'config.php';
include 'includes/header.php';
include 'includes/side-bar.php';
$phppage = basename($_SERVER['PHP_SELF']);
?>
<div class="page-wrapper" ng-app="appCon" ng-controller="purchaseorderController" ng-cloak>
    <?php include 'includes/top-bar.php' ?>
    <!-- content -->
    <div class="page-content" ng-show="view=='main'">
        <div class="top-button float-right">
            <!-- <a href data-target="#changevat" data-toggle="modal" ng-click="loadVAT()" class="btn btn-primary">
                <span style="margin-left: 3px;">Edit VAT</span>
            </a> -->
            <a href ng-click="userpage(type='page2',id='0')" class="btn btn-primary">
                <i class="svg_icons" data-feather="file-text"></i>
                <span style="margin-left: 3px;">Placed/Drafts</span>
            </a>
        </div>
         
        <h3>Purchase Order</h3>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form name="mainFormf" action="" method="">
                            <div class="col-sm-6">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Batch Number:</label>
                                        <input id="batchnumber" class="form-control" ng-model="main.batchnumber" ng-change="checkIfExist('batchnumber', main.batchnumber)" type="text">
                                        <small ng-show="validatemain && main.batchnumber == ''" class="req-txt">Batch Number is required</small>
                                        <small ng-show="existval.batchnumber" class="req-txt">Batch Number is already exist.</small>
                                    </div>
                                    <fieldset ng-disabled="mainForm">
                                    <div class="form-group">
                                        <label>Order Number:</label>
                                        <input id="ordernumber" class="form-control" ng-model="main.ordernumber" ng-change="checkIfExist('ordernumber', main.ordernumber)" type="text">
                                        <small ng-show="validatemain && main.ordernumber == ''" class="req-txt">Order Number is required</small>
                                        <small ng-show="existval.ordernumber" class="req-txt">Order Number is already exist.</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Exchange Rate:</label>
                                        <input id="exchangerate" class="form-control" ng-model="main.exchangerate" type="text">
                                        <small ng-show="validatemain && main.exchangerate == ''" class="req-txt">Exchangerate is required</small>
                                    </div>
                                    </fieldset>
                                </div>

                                <div class="col-sm-6">
                                    <fieldset ng-disabled="mainForm">
                                    <div class="form-group">
                                        <label>Freight-in (per unit):</label>
                                        <input id="freightinperunit" class="form-control" name="freightinperunit" ng-model="main.freightinperunit" type="text">
                                        <small ng-show="validate && main.freightinperunit == ''" class="req-txt">Freight-In (Total) is required</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Tracking Number (AWB):</label>
                                        <input id="trackingnumber" class="form-control" name="trackingnumber" type="text" ng-model="main.trackingnumber">
                                        <small ng-show="validate && main.trackingnumber == ''" class="req-txt">AWB/Tracking Number is required</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Purchase Date:</label>
                                        <input id="date" class="form-control" name="purchasedate" type="date" ng-model="main.purchasedate">
                                        <small ng-show="validate && (main.purchasedate == '' || main.purchasedate == 'null')" class="req-txt">Purchase Date is required</small>
                                    </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-sm-6 p-r-0">
                                <fieldset ng-disabled="mainForm">
                                <div class="col-sm-6 p-l-0">
                                    <div class="form-group">
                                        <label>Credit Card:</label> 
                                        <!--Ready na yung table para sa Credit Card, 
                                        ikaw nalang maglagay ng fetching nito baka may magalaw pa ako. 
                                        -KEN -->
                                        <select class="" id="creditcard" ng-model="main.creditcard">
                                            <option ng-repeat="row in creditcard" value="{{row.accountid}}">{{row.accountname}}</option>
                                        </select>
                                        <small ng-show="validate && (main.creditcard == '')" class="req-txt">Creditcard is required</small>
                                    </div>
                                </div>
                                <div class="col-sm-6 p-r-0">
                                    <div class="form-group">
                                        <label>Courier:</label>
                                        <select class="" ng-model="main.courierid">
                                            <option ng-repeat="row in courier" value="{{row.courierid}}">{{row.couriername}}</option>
                                        </select>
                                        <small ng-show="validate && (main.courierid == '')" class="req-txt">Courier is required</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Remarks:</label>
                                    <textarea class="form-control" name="" id="" cols="30" rows="7" ng-model="main.remarks" placeholder="Enter remarks...">
                                </textarea>
                                </div>
                                </fieldset>
                            </div>
                            <div align="right">
                                <!-- <input class="btn btn-success" type="" name="" value="Apply"> -->
                                <a href="" ng-click="applyMain(main)" class="btn btn-success m-t-10" ng-class="{'btn_disabled' : (mainForm || isOLD || existmain)}">Apply</a>
                                <!-- <span href="" ng-click="applyMain()" class="btn btn-success m-t-10" ng-disabled="mainForm"><span>Apply</span></a> -->
                            </div>
                        </form>
                        <!-- Put datatable here start -->

                        <!-- Datatable end -->

                    </div>
                </div>
            </div>
            <div class="" style="width: 100%;" ng-show="hasActive">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <fieldset ng-disabled="!isOLD">
                            <form action="" method="">
                                <table class="table">
                                    <thead>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Info</th>
                                        <th>Unit Price(&#36;)</th>
                                        <th>Quantity</th>
                                        <!-- <th>Price (&#36;)</th> -->
                                        <th>Rate (&#8369;)</th>
                                        <!-- <th>Unit Price(&#8369;)</th> -->
                                        <th>Total Amount</th>
                                        <th>Tax(U)</th>
                                        <th>Tax(T)</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="podata in postock">
                                            <td>{{$index + 1}}</td>
                                            <td>
                                                <div class="form-group m-b-0">
                                                    <!-- <select class="" ng-model="podata.stocksid" ng-change="getproddinfo(podata.stocksid, $index)">
                                                        <option ng-repeat="row in prodlist" value="{{row.stocksid}}" >{{row.stockname}}</option>
                                                    </select> -->
                                                    <select ng-model="podata.stocksid" ng-change="getproddinfo(podata.stocksid, $index, podata.id)" ng-options="item.stocksid as item.stockname for item in prodlist" ng-selected="true"></select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="popover__wrapper wrap_cus">
                                                    <!-- ICON -->
                                                    <div  class="d-inline-block"  style="width: 35px; margin: auto;" ng-hide="!podata.stocksid">
                                                        <a href="#" ng-mouseover="getinfop(podata.stocksid, podata.stockguid, podata.rate, podata.unitprice);" class="mrcs-5 popover__title">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info svg_icons"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                                                        </a>
                                                    </div>
                                                    <!-- ICON -->
                                                    <!-- CONTENT -->
                                                    <div class="popover__content pop_cus content_cus">
                                                        <!-- <div style="margin: auto; width: 150px; margin-bottom: 20px;"> 
                                                            <img class="img_ttp" ng-show="!prodintf.imgurl" alt="" src="https://static.pexels.com/photos/111788/pexels-photo-111788-large.jpeg">
                                                            <img class="img_ttp" ng-show="prodintf.imgurl" alt="" src="{{prodintf.imgurl}}" style="width:150px;height:150px;">
                                                        </div> -->
                                                        <div class="container_imgPO">
                                                            <!--  Image start  -->
                                                            <div class="image-wrapper">
                                                              <img ng-show="!prodintf.imgurl" src="https://placehold.it/888x500&text=16:9" alt="" />
                                                              <img ng-show="prodintf.imgurl" alt="" src="{{prodintf.imgurl}}">
                                                            </div>
                                                            <!--  Image end  -->
                                                          </div>
                                                        <div class="col-sm-12 potabletd"> 
                                                            <table>
                                                                <tr>
                                                                    <td><strong>Brand</strong></td>
                                                                    <td>{{prodintf.brandname}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Classification</strong></td>
                                                                    <td>{{prodintf.categorydesc}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Color</strong></td>
                                                                    <td>{{prodintf.stockcolor}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Size</strong></td>
                                                                    <td>{{prodintf.stocksize}}</td>
                                                                </tr>
                                                                <!-- <tr>
                                                                    <td><strong>Quantity</strong></td>
                                                                    <td>{{prodintf.availablestocks}}</td>
                                                                </tr> -->
                                                                <!-- <tr>
                                                                    <td><strong>Unit Price ($)</strong></td>
                                                                    <td>{{prodintf.unitprice}}</td>
                                                                </tr> -->
                                                                <!-- <tr>
                                                                    <td><strong>Unit Price (PHP)</strong></td>
                                                                    <td>{{podata.unitprice ? (prodintf.unitpricephp | number:2) : '-'}}</td>
                                                                </tr> -->
                                                            </table>
                                                        </div>
                                                        
                                                    </div>
                                                    <!-- CONTENT -->
                                                  </div>
                                                <!-- <div  class="d-inline-block"  style="width: 35px; margin: auto;">
                                                    <a href class="mrcs-5">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info svg_icons"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                                                    </a>
                                                </div> -->
                                            </td>
                                            <!-- <td>
                                                <div class="form-group m-b-0">
                                                <input id="ablquantity" class="form-control" ng-model="podata.ablquantity" type="text" disabled>
                                                </div>
                                            </!--> 
                                            <!-- <td>
                                            {{podata.availablestocks ? podata.availablestocks : '0'}}
                                            </td> -->
                                            <td>
                                                <div class="form-group m-b-0" style="max-width:117px;" title="&#8369; {{podata.unitpricephp ? ((podata.unitpricephp * podata.rate) | number:2) : '0.00'}}">
                                                <input id="unitpricephp" class="form-control" placeholder="0" number-input ng-model="podata.unitpricephp" ng-blur="setUnitprice()" ng-disabled="!podata.stocksid">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group m-b-0" style="max-width:84px;">
                                                <input id="quantity" class="form-control" placeholder="0" pattern="^[0-9]+$" ng-pattern-restrict ng-model="podata.quantity" ng-blur="setQuantity(podata.quantity, podata.unitpricephp, podata.rate, $index, podata.id, podata.stocksid, podata.availablestocks)" type="text" ng-disabled="!podata.stocksid">
                                                </div>
                                            </td>
                                            <!-- <td>
                                                <div class="form-group m-b-0">
                                                <input id="unitprice" class="form-control" placeholder="0.00" ng-model="podata.unitpricephp" type="text" disabled>
                                                </div>
                                            </td> -->
                                            <td>
                                                <div class="form-group m-b-0" style="max-width:108px;">
                                                <input id="rate" class="form-control txt-right" ng-model="podata.rate" type="text" ng-blur="setRateR(podata.id, podata.rate, $index);">
                                                </div>
                                            </td>
                                            <!-- <td>
                                                <div class="form-group m-b-0 txt-right">
                                                {{podata.unitprice ? ((podata.unitprice * podata.rate) | number:2) : '0.00'}}
                                                </div> 
                                            </td> -->
                                            <td>
                                                <div class="form-group m-b-0 txt-right">
                                                <!-- <input type="hidden" ng-model="podata.totalpricephp"> -->
                                                <!-- {{podata.rate * (podata.quantity * podata.unitpricephp)}} -->
                                                {{podata.totalamount ? podata.totalamount : '0.00'}}
                                                </div>
                                            </td>
                                            <td>{{podata.quantity ? (podata.quantity == '0' ? '0.00' : podata.ftaxperunit) : '0.00'}}</td>
                                            <td>{{podata.quantity ? (podata.quantity == '0' ? '0.00' : podata.ftaxtotalperproduct) : '0.00'}}</td>
                                            <td>
                                                <div  class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Delete Product" style="width: 35px; margin: auto;">
                                                    <a href class="mrcs-5" ng-class="{'btn_disabled' : !isOLD}" ng-click="delStockRow(podata.id)">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle svg_icons">
                                                            <circle cx="12" cy="12" r="10"></circle>
                                                            <line x1="15" y1="9" x2="9" y2="15"></line>
                                                            <line x1="9" y1="9" x2="15" y2="15"></line>
                                                        </svg>
                                                    </a>
                                                </div>
                                                {{podata.autosave}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="addrow"><i class="zmdi zmdi-plus txt-bold m-r-5"></i><a ng-class="{'btn_disabled' : !isOLD}" ng-click="newStockRow();">Add Row</a></td>
                                        </tr>

                                        <tr>
                                            <td colspan="5"></td>
                                            <td class="txt-right">
                                                <strong>Total</strong>
                                            </td>
                                            <td class="txt-right">
                                                <strong>&#8369; {{total ? total : '0.00'}}</strong>
                                            </td>
                                            <td></td>
                                            <td>
                                                <strong>&#8369; {{taxtotal ? taxtotal : '0.00'}}</strong>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div align="right" class="m-t-30">
                                    <!-- <input class="btn btn-success" type="" name="" value="Place Order"> -->
                                    <!-- <input class="btn btn-primary" type="" name="" value="Save as Draft"> -->
                                    <a href="" ng-click="save('placed');" class="btn btn-success" ng-class="{'btn_disabled' : !isOLD}" ng-show="!placedorder" >Place Order</span></a>
                                    
                                    <a href="" ng-click="save('draft');" class="btn btn-primary m-l-10" ng-class="{'btn_disabled' : !isOLD}" ng-show="!placedorder"><span>Save as Draft</span></a>
                                    <a href="" ng-click="cancelEdit();" class="btn btn-primary m-l-10" ng-show="placedorder"><span>Cancel</span></a>
                                </div>
                            </form>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content -->
    <!-- content -->
    <div class="page-content" ng-show="view=='page2'">
    <h3 class="d-inline-block">Purchase Order</h3>
       <div class="top-button float-right">
           <a href ng-click="userpage(type='main',id='0')" class="btn btn-primary">
               <i class="svg_icons" data-feather="arrow-left"></i>
               <span style="margin-left: 3px;">Back</span>
           </a>
           <a href="app-controller/php-function/generate_data.php?export=true&page=<?php echo $phppage; ?>" target="_blank" class="btn btn-primary">
                <i class="svg_icons" data-feather="activity"></i>
                <span style="margin-left: 3px;">Export</span>
            </a>
       </div>
       <div class="row" ng-show="page2=='placed'">
           <div class="col-md-12 stretch-card">
               <div class="card-boody">
                   <button class="btn btn-primary">Placed</button>
                   <button class="btn btn-light" ng-click="loadpurchasemain('draft');">Draft</button>
               </div>
           </div>
           <div class="col-md-12 stretch-card">
               <div class="card">
                   <div class="card-body">
                     
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
                        <br/>
                        <div class="row">
                            <div class="col-md-12" ng-show="filter_data > 0">
                                <table class="table">
                                    <thead>
                                        <!-- <th># &nbsp;<a ng-click="sort_with('id');"><i class="glyphicon glyphicon-sort"></i></a></th> -->
                                        <th>Purchase ID: &nbsp;<a ng-click="sort_with('pom_id');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Batch Number: &nbsp;<a ng-click="sort_with('batchnumber');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Order Number: &nbsp;<a ng-click="sort_with('ordernumber');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                    <tr class="table-hover_cust" ng-repeat="data in searched = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*(data_limit == 'ALL' ? entire_user : data_limit) | limitTo:(data_limit == 'ALL' ? entire_user : data_limit)">
                                            <!-- <td>{{data.id}}</td> -->
                                            <td>{{data.pom_id}}</td>
                                            <td>{{data.batchnumber}}</td>
                                            <td>{{data.ordernumber}}</td>
                                            <td>
                                                <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Edit Purchase Order" style="width: 35px; margin: auto;">
                                                    <a href ng-click="editPurchasedPO(data.id)" class="mrcs-5">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit svg_icons"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                    </a> 
                                                </div>
                                                <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="print" style="width: 35px; margin: auto;">
                                                    <a href="documents/purchase_order.php?docid={{data.pom_id}}" target="_blank" class="mrcs-5">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
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
       <!-- SIMULA DITO MASTER KEN -->
       <div class="row" ng-show="page2=='draft'">
           <div class="col-md-12 stretch-card">
               <div class="card-boody">
                   <button class="btn btn-light" ng-click="loadpurchasemain('placed');">Placed</button>
                   <button class="btn btn-primary">Draft</button>
                   
               </div>
           </div>
           <div class="col-md-12 stretch-card">
               <div class="card">
                   <div class="card-body">
                     
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
                        <br/>
                        <div class="row">
                            <div class="col-md-12" ng-show="filter_data > 0">
                                <table class="table">
                                    <thead>
                                        <!-- <th># &nbsp;<a ng-click="sort_with('id');"><i class="glyphicon glyphicon-sort"></i></a></th> -->
                                        <th>Purchase ID: &nbsp;<a ng-click="sort_with('pom_id');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Batch Number: &nbsp;<a ng-click="sort_with('batchnumber');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Order Number: &nbsp;<a ng-click="sort_with('ordernumber');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                    <tr class="table-hover_cust" ng-repeat="data in searched = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*(data_limit == 'ALL' ? entire_user : data_limit) | limitTo:(data_limit == 'ALL' ? entire_user : data_limit)">
                                            <!-- <td>{{data.id}}</td> -->
                                            <td>{{data.pom_id}}</td>
                                            <td>{{data.batchnumber}}</td>
                                            <td>{{data.ordernumber}}</td>
                                           <td>
                                            <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Edit Purchase Order" style="width: 35px; margin: auto;">
                                                <a href ng-click="editPurchasedPO(data.id)" class="mrcs-5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit svg_icons"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                </a> 
                                            </div>
                                            <div  class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Delete Product" style="width: 35px; margin: auto;">
                                                <a href class="mrcs-5" ng-click="delPOdraft(data.pom_id)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle svg_icons">
                                                        <circle cx="12" cy="12" r="10"></circle>
                                                        <line x1="15" y1="9" x2="9" y2="15"></line>
                                                        <line x1="9" y1="9" x2="15" y2="15"></line>
                                                    </svg>
                                                </a>
                                            </div>
                                                <!-- <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="View Purchase Order" style="width: 35px; margin: auto;">
                                                    <a href ng-click="viewpomainData(data.id)" class="mrcs-5" disabled>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file svg_icons">
                                                            <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                                            <polyline points="13 2 13 9 20 9"></polyline>
                                                        </svg>
                                                    </a>
                                                </div> -->
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

    <!--CHANGE PASSWORD: Modal:start-->
    <div class="modal fade" id="changevat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit VAT value</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                <!-- <div class="col-sm-12" align="center">
                    <img src="assets/images/image-empty.jpg" class="userview-image">
                    <h4>{{viewdata.lastname + ' ' + viewdata.firstname}}</h4>
                </div> -->
                <!-- <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" name="password" type="password">
                </div> -->
              <div class="form-group">
                  <label for="vat">VAT</label>
                  <input class="form-control" name="vat" ng-model="vat" type="text">
                  <div class="col-sm-12 mt-4" align="right">
                      <input class="btn btn-cancel btn-cancelcus" data-dismiss="modal" type="submit" value="Cancel">
                      <input class="btn btn-success btn-sucbox" type="submit" ng-click="saveVAT(vat)" value="Save">
                  </div>
              </div>
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
          </div>
        </div>
      </div>
    </div>
    <!--Modal:End-->

    
   <!-- content -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <!-- TAB GROUP -->


  <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>

   
    <script src="app-controller/js-controller/purchaseorder2Ctrl.js"></script>
    <?php include "includes/footer.php"; ?>