<?php
include 'includes/header.php';
include 'includes/side-bar.php';
if (!Role('stockmanagement')) {
    echo "<script>window.location.href='index.php';</script>";
};
?>
<style>
.tableFixHead          { overflow-y: auto; height: 159px; }
.tableFixHead thead th { position: sticky; top: 0; background-color: white;}
.tableFixHead tbody tr td { 
    padding-top: 5px;
    padding-bottom: 5px;
}
.popover__content{
    top: 294px !important;
}
/* Just common table stuff. Really. */
/* table  { border-collapse: collapse; width: 100%; }
th, td { padding: 8px 16px; }
th     { background:#eee; } */
</style>
<?php include 'includes/top-bar.php' ?>

<div class="page-wrapper" ng-app="appCon" ng-controller="managestockController">


    <!-- TABLE LIST-->
    <div class="page-content" style="margin-top: 60px">
        <h3 class="d-inline-block">Product Management</h3>
         <?php if (Role('addstock')) { ?>
            <div class="top-button float-right">
                <a class="btn btn-primary" href data-toggle="modal" data-target="#addstockmodal" role="button" ng-click="stockpage(type='addStock',id='0')">
                    <i class="svg_icons" data-feather="user-plus"></i>
                    <span style="margin-left: 3px;">Add Product</span>
                </a>
            </div>
        <?php } ?>
        <div class="top-button float-right">
                <!-- <a class="btn btn-primary" href="" role="button">
                    <i class="svg_icons" data-feather="box"></i>
                    <span>LOAD LAZADA PRODUCTS</span>
                </a> -->
            </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body" ng-cloak>
                        <div class="row">
                            <div class="pull-right" style="margin-left: 0.75em !important">
                                <label>Search:</label>
                                <input type="text" ng-model="search" ng-change="filter()" placeholder="Search" class="form-control" style="width: 25em;" />
                            </div>
                            <div class="col-sm-2 pull-right">
                                <label>Page Size:</label>
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
                                        <th></th>
                                        <th>Product &nbsp;<a ng-click="sort_with('stockname');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Available Stocks&nbsp;<a ng-click="sort_with('availablestocks');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <!-- <th>Suggested Retail Price&nbsp;<a ng-click="sort_with('unitprice');"><i class="glyphicon glyphicon-sort"></i></a></th> -->
                                         <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <tr class="table-hover_cust" ng-repeat="data in searched = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*(data_limit == 'ALL' ? entire_user : data_limit) | limitTo:(data_limit == 'ALL' ? entire_user : data_limit)">
                                            <td><img src="{{data.imageurl ? data.imageurl : 'https://placehold.it/888x500&text=16:9'}}" alt="" />
                                            <td>{{data.stockname}}</td>
                                            <!-- <img ng-show="viewdata.imgurl" alt="" src="{{viewdata.imgurl}}"> -->
                                            </td>
                                            <!-- <td>{{data.availablestocks}}</td> -->
                                            <td>
                                                <div class="popover__wrapper wrap_cus">
                                                    <!-- ICON -->
                                                    <div  class="d-inline-block"  style="width: 35px; margin: auto;">
                                                        <a href="#" ng-mouseover="getinfostocks(data.guid);" class="mrcs-5 popover__title">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info svg_icons"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                                                        </a>
                                                    </div>{{data.newalbqty}}
                                                    <!-- ICON -->
                                                    <!-- CONTENT -->
                                                    <div class="popover__content pop_cus content_cus">
                                                        <!-- <div style="margin: auto; width: 150px; margin-bottom: 20px;"> 
                                                            <img class="img_ttp" ng-show="!prodintf.imgurl" alt="" src="https://static.pexels.com/photos/111788/pexels-photo-111788-large.jpeg">
                                                            <img class="img_ttp" ng-show="prodintf.imgurl" alt="" src="{{prodintf.imgurl}}" style="width:150px;height:150px;">
                                                        </div> -->
                                                        <div class="container_imgPO">
                                                            Purchase Order History
                                                            <!--  Image start  -->
                                                            <!-- <div class="image-wrapper">
                                                              <img ng-show="!prodintf.imgurl" src="https://placehold.it/888x500&text=16:9" alt="" />
                                                              <img ng-show="prodintf.imgurl" alt="" src="{{prodintf.imgurl}}">
                                                            </div> -->
                                                            <!--  Image end  -->
                                                        </div>
                                                        <div class="tableFixHead">
                                                            <table>
                                                                <thead>
                                                                    <tr>
                                                                        <th>No.</th>
                                                                        <th>Purchase Date</th>
                                                                        <th>Purchase QTY</th>
                                                                        <th>Abl. QTY</th>
                                                                        <th>Unit Price</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr ng-if="stockintf.length > 0" ng-repeat="data in stockintf">
                                                                        <td>{{$index + 1}}</td>
                                                                        <td>{{data.purchasedate}}</td>
                                                                        <td>{{data.purchased_qty}}</td>
                                                                        <td>{{data.available_qty}}</td>
                                                                        <td>{{data.unitprice}}</td>
                                                                    </tr>
                                                                    <tr ng-if="stockintf.length == 0">
                                                                        <td colspan='5'><center>No Records Found</center></td>
                                                                    </tr>
                                                                </tbody>
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
                                            <!-- <td>{{data.unitprice}}</td> -->
                                            <td>
                                                <div class="d-inline-block" data-toggle="tooltip" data-placement="top"  title="Reorder Point - Stocks: {{data.threshold}} as of: {{data.reorderpoint}}"  style="width: 35px; margin: auto;">
                                                    <a href ng-click="viewstocksData(data.stocksid, data.guid)" class="mrcs-5" data-target="#viewstockinfo" data-toggle="modal">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file svg_icons">
                                                            <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                                            <polyline points="13 2 13 9 20 9"></polyline>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Edit Stock" style="width: 35px; margin: auto;">
                                                    <a href ng-click="stockpage(type='edit', id=data.stocksid)" class="mrcs-5" data-target="#addstockmodal" data-toggle="modal">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit svg_icons">
                                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Delete Stock" style="width: 35px; margin: auto;">
                                                    <a href ng-click="deletestock(data.stocksid, data.stockname)" class="mrcs-5">
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
                                    <h4>No records found.</h4>
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

        <!--Modal:start-->
        <div class="modal fade" id="viewstockinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Product Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <div>
                        <div class="image-wrapper stocks">
                            <img ng-show="!viewdata.imgurl" src="https://placehold.it/888x500&text=16:9" alt="" />
                            <img ng-show="viewdata.imgurl" alt="" src="{{viewdata.imgurl}}">
                        </div>
                    </div>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <tbody>
                                    <tr>
                                        <td>Product Name: </td>
                                        <td>{{viewdata.stockname}}</td>
                                    </tr>
                                    <tr>
                                        <td>Category: </td>
                                        <td>{{viewdata.categoryid}}</td>
                                    </tr>
                                    <tr>
                                        <td>Brand: </td>
                                        <td>{{viewdata.brandid}}</td>
                                    </tr>
                                    <tr>
                                        <td>Supplier: </td>
                                        <td>{{viewdata.supplierid}}</td>
                                    </tr>
                                    <tr>
                                        <td>Product Color: </td>
                                        <td>{{viewdata.stockcolor}}</td>
                                    </tr>
                                    <tr>
                                        <td>Product Size: </td>
                                        <td>{{viewdata.stocksize}}</td>
                                    </tr>   
                                    <tr>
                                        <td>SKU: </td>
                                        <td>{{viewdata.sku}}</td>
                                    </tr>
                                    <!-- <tr>
                                        <td>Available Stocks: </td>
                                        <td>{{viewdata.availablestocks}}</td>
                                    </tr> -->
                                    <tr>
                                        <td>Cost Per Unit: </td>
                                        <td>{{viewdata.costperunit}}</td>
                                    </tr>
                                    <tr>
                                        <td>Suggested Retail Price: </td>
                                        <td>{{viewdata.unitprice}}</td>
                                    </tr>
                                    <tr><td colspan="2"><strong>Reorder Point</strong></b></tr>
                                    <tr>
                                        <td>Stocks as of: </td>
                                        <td>{{viewdata.reorderpoint}}</td>
                                    </tr>
                                    <tr>
                                        <td>Threshold: </td>
                                        <td>{{viewdata.threshold}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Modal:End-->

    </div>
    <!-- END TABLE LIST -->


    <!-- ===================================================================================== -->
    <!-- =================================ADD/EDIT FORM======================================= -->
    <!-- ===================================================================================== -->


    <!--Modal:start-->
    <div class="modal fade" id="addstockmodal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">{{title}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" ng-submit="addstockForm(data)">
                    <input type="hidden" ng-model='data.stocksid'>
                        <div class="form-group">
                            <label for="stockname">Product Name:</label>
                            <input id="stockname" class="form-control" ng-model="data.stockname" type="text" required>
                            <!-- <small class="req-txt">Stock name is required</small> -->
                        </div>
                        <div class="form-group">
                            <label>Category: </label>
                            <select class="" ng-model="data.categoryid" ng-change="getcategoryinfo(data.categoryid)">
                                <option ng-repeat="row in categorylist" value="{{row.categoryid}}">{{row.categorydesc}}</option> 
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Brand: </label>
                            <select class=""  ng-model="data.brandid" ng-change="getbrandinfo(data.brandid)">
                                <option ng-repeat="row in brandlist" value="{{row.brandid}}">{{row.brandname}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Supplier: </label>
                            <select class=""  ng-model="data.supplierid" ng-change="getsupplierinfo(data.supplierid)">  
                                <option ng-repeat="row in supplierlist" value="{{row.supplierid}}">{{row.suppliername}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                        <label>Choose Color: </label>
                            <!-- <input id="stockcolor" class="form-control" ng-model="data.stockcolor" type="text" required> -->
                            <select class="" ng-model="data.stockcolor" ng-disabled="!data.categoryid">
                                <option ng-if="categColor" ng-repeat="row in categColor" value="{{row.color}}">{{row.color}}</option> 
                                <option ng-if="!categColor">No Record Found!</option> 
                            </select>
                        </div>
                        <div class="form-group">
                        <label>Choose Size: </label>
                        <select name="" class="form-control" id="stocksize" ng-model="data.stocksize">
                            <option ng-repeat="row in sizelist" value="{{row.size}}">{{row.size}}</option>
                        </select>
                        </div>
                     <!-- <div class="form-group">
                            <label for="availablestocks">Available Stocks:</label>
                            <input id="availablestocks" class="form-control" ng-model="data.availablestocks" type="text" required>
                        </div> -->
                        <div class="form-group">
                            <label for="costperunit">Cost per Unit:</label>
                            <input id="costperunit" class="form-control" ng-model="data.costperunit" type="text">
                        </div>
                        <div class="form-group">
                        <label>SKU: </label>
                            <input id="sku" class="form-control" ng-model="data.sku" type="text" >
                        </div>
                        <div class="form-group">
                            <label for="unitprice">Suggested Retail Price:</label>
                            <input id="unitprice" class="form-control" ng-model="data.unitprice" type="text" >
                        </div>
                        <!-- <div class="form-group">
                            <label for="dtperunit">Duties and Taxes (per unit): </label>
                            <input id="dtperunit" class="form-control" ng-model="data.dtperunit" type="text" required>
                        </div>
                        <div class="form-group">
                            <label for="dttotal">Duties and Taxes (total): </label>
                            <input id="dttotal" class="form-control" ng-model="data.dttotal" type="text" required>
                        </div> -->
                        <div class="form-group">
                            <p>
                            <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                Reorder Point</a>
                            </p>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body">
                                    <div class="form-group">
                                        <label  for="stocksasof">Stock as of:</label>
                                        <input id="stocksasof" class="form-control" type="date" ng-model="data.reorderpoint">
                                    </div>
                                    <div class="form-group">
                                        <label for="threshold">Threshold:</label>
                                        <input id="threshold" class="form-control" type="text" ng-model="data.threshold">
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="form-group">
                            <label for="stockimage">Picture:</label>
                            <input id="myDropify" class="form-control dropify" ng-model="myFile" file-model="myFile" ng-change="uploadFile(data.guid)" type="file" >
                        </div>
                        <div align="right">
                            <input class="btn btn-success" type="submit" name="addStock" value="Save">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Modal:End-->

    <!-- END ADD/EDIT FORM -->
</div>

    <!--END content -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- TAB GROUP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>
    <script src="app-controller/js-controller/stockCtrl.js"></script>
    <?php include "includes/footer.php"; ?>