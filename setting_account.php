<?php
include 'includes/header.php';
include 'includes/side-bar.php';
if (!Role('account')) {
    echo "<script>window.location.href='index.php';</script>";
};
?>
<div class="page-wrapper" ng-app="appCon" ng-controller="manageaccountController">
    <?php include 'includes/top-bar.php'?>

    <!-- TABLE LIST-->
    <div class="page-content" style="margin-top: 60px">
        <h3 class="d-inline-block">Account</h3>
        <div class="row">
            <div class="col-sm-5 grid-margin stretch-card">
                <div class="card">
                <form method="POST" ng-submit="addaccountForm(data)">
                    <div class="card-body">
                        <h4 class="card-title">{{title}}</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <input class="form-control" name="" ng-model="data.accountid" type="hidden">
                                    <tr>
                                        <td><label for="">Name: </label></td>
                                        <td><input id="" class="form-control" name="" ng-model="data.accountname" type="text" required>
                                            <!-- <small ng-show="" class="req-txt">credit care is required</small> -->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="">Account Type: </label></td>
                                        <td>
                                        <select class="" ng-model="data.acctypeid" ng-change="getacctypeinfo(data.acctypeid)">
                                        <option ng-repeat="row in accounttypelist" value="{{row.acctypeid}}">{{row.accounttype}}</option> 
                                        </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="">Detail Type: </label></td>
                                        <td>
                                        <select class="" ng-model="data.accdetailsid" ng-change="getaccdetailinfo(data.accdetailsid)">
                                        <option ng-repeat="row in accountdetaillist" value="{{row.accdetailsid}}">{{row.accdetails}}</option> 
                                        </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="">Currency: </label></td>
                                        <td>
                                        <select name="" class="form-control" id="" ng-model="data.currency">
                                                <option value="PHP">PHP</option>
                                                <option value="$">Dollars</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="">Balance: </label></td>
                                        <td><input id="" class="form-control" name="" ng-model="data.accbalance" type="text" required>
                                            <!-- <small ng-show="" class="req-txt">credit care is required</small> -->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="">as of: </label></td>
                                        <td><input id="" class="form-control" name="" ng-model="data.balancedate" type="date" required>
                                            <!-- <small ng-show="" class="req-txt">credit care is required</small> -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-sm-12" align="right">
                            <input class="btn btn-success" type="submit" name="addAccount" value="Save">
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            <div class="col-sm-7 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body" ng-cloak>
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
                        <br />
                        <div class="row">
                            <div class="col-md-12" ng-show="filter_data > 0">
                                <table class="table">
                                    <thead>
                                        <th>ID &nbsp;<a ng-click="sort_with('accountid');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Account&nbsp;<a ng-click=""><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Type&nbsp;<a ng-click=""><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Balance&nbsp;<a ng-click=""><i class="glyphicon glyphicon-sort"></i></a></th>
                                         <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="data in searched = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*(data_limit == 'ALL' ? entire_user : data_limit) | limitTo:(data_limit == 'ALL' ? entire_user : data_limit)"> 
                                            <td>{{data.accountid}}</td>
                                            <td>{{data.accountname}}</td>
                                            <td>{{data.acctypeid}}</td>
                                            <td>{{data.accbalance}}</td>
                                            <td>
                                            <div class="d-inline-block" data-toggle="tooltip" data-placement="top"  title="View Account"  style="width: 35px; margin: auto;">
                                                    <a href ng-click="viewaccountData(data.accountid)" class="mrcs-5" data-target="#viewaccountinfo" data-toggle="modal">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file svg_icons">
                                                            <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                                            <polyline points="13 2 13 9 20 9"></polyline>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Edit Account" style="width: 35px; margin: auto;">
                                                    <a href ng-click="accountpage(type='edit', id=data.accountid)" class="btn mrcs-5 action__btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit svg_icons svg-Icolor" style="margin-top: 5px"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                    </a>
                                                </div>
                                                <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Delete Account" style="width: 35px; margin: auto;">
                                                    <a href ng-click="deleteaccount(data.accountid)" class="btn mrcs-5 action__btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle svg_icons svg-Icolor" style="margin-top: 5px"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
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

     <!--Modal:start-->
     <div class="modal fade" id="viewaccountinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Account Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <tbody>
                                    <tr>
                                        <td>Account Name: </td>
                                        <td>{{viewdata.accountname}}</td>
                                    </tr>
                                    <tr>
                                        <td>Account Type: </td>
                                        <td>{{viewdata.accounttype}}</td>
                                    </tr>
                                    <tr>
                                        <td>Detail Type: </td>
                                        <td>{{viewdata.accdetails}}</td>
                                    </tr>
                                    <tr>
                                        <td>Currency: </td>
                                        <td>{{viewdata.currency}}</td>
                                    </tr>
                                    <tr>
                                        <td>Balance: </td>
                                        <td>{{viewdata.accbalance}}</td>
                                    </tr>
                                    <tr>
                                        <td>Balance as of: </td>
                                        <td>{{viewdata.balancedate}}</td>
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

    <!--END content -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- TAB GROUP -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>
    <script src="app-controller/js-controller/accountCtrl.js"></script>
    <?php include "includes/footer.php"; ?>