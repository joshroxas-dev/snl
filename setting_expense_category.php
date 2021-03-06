<?php
include 'includes/header.php';
include 'includes/side-bar.php';
if (!Role('expensecategory')) {
    echo "<script>window.location.href='index.php';</script>";
};
?>
<div class="page-wrapper" ng-app="appCon" ng-controller="managecategexpController">
    <?php include 'includes/top-bar.php'?>

    <!-- TABLE LIST-->
    <div class="page-content" style="margin-top: 60px">
        <h3 class="d-inline-block">Expense Category</h3>
        <div class="row">
            <div class="col-sm-5 grid-margin stretch-card">
                <div class="card">
                <form method="POST" ng-submit="addcategexpForm(data)">
                    <div class="card-body">
                        <h4 class="card-title">{{title}}</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <input class="form-control" name="" ng-model="data.categexpid" type="hidden">
                                    <tr>
                                        <td><label for="">Account Type: </label></td>
                                        <td>
                                            <select name="" class="form-control" id="" ng-model="data.categexptype">
                                                <option value="Accounts Receivable (A/R)">Accounts Receivable (A/R)</option>
                                                <option value="Current Assests">Current Assests</option>
                                                <option value="Cash and Cash Equivalents">Cash and Cash Equivalents</option>
                                                <option value="Fixed Assests">Fixed Assests</option>
                                                <option value="Non-current Assests">Non-current Assests</option>
                                                <option value="Accounts Payable (A/P)">Accounts Payable (A/P)</option>
                                                <option value="Credit Card">Credit Card</option>
                                                <option value="Current Liabilities">Current Liabilities</option>
                                                <option value="Non-current Liabilities">Non-current Liabilities</option>
                                                <option value="Owner's Equity">Owner's Equity</option>
                                                <option value="Income">Income</option>
                                                <option value="Other Income">Other Income</option>
                                                <option value="Cost of Sales">Cost of Sales</option>
                                                <option value="Expenses">Expenses</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="">Detail Type: </label></td>
                                        <td><input id="" class="form-control" name="" ng-model="data.detailtype" type="text">
                                            <!-- <small ng-show="" class="req-txt">credit care is required</small> -->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="">Name: </label></td>
                                        <td><input id="" class="form-control" name="" ng-model="data.categexpname" type="text" required>
                                            <!-- <small ng-show="" class="req-txt">credit care is required</small> -->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="">Description: </label></td>
                                        <td>
                                        <textarea name="" id="" cols="30" rows="10" class="form-control" ng-model="data.categexdesc"></textarea>
                                        <!-- <small ng-show="" class="req-txt">credit care is required</small> -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-sm-12" align="right">
                            <input class="btn btn-success" type="submit" name="addCategoryexpense" value="Save">
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
                                        <th>ID &nbsp;<a ng-click="sort_with('categexpid');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Account Type &nbsp;<a ng-click=""><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Name &nbsp;<a ng-click=""><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="data in searched = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*(data_limit == 'ALL' ? entire_user : data_limit) | limitTo:(data_limit == 'ALL' ? entire_user : data_limit)"> 
                                            <td>{{data.categexpid}}</td>
                                            <td>{{data.categexptype}}</td>
                                            <td>{{data.categexpname}}</td>
                                            <td>
                                                <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Edit Expense Category" style="width: 35px; margin: auto;">
                                                    <a href ng-click="categoryexpensepage(type='edit', id=data.categexpid)" class="btn mrcs-5 action__btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit svg_icons svg-Icolor" style="margin-top: 5px"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                    </a>
                                                </div>
                                                <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Delete Expense Category" style="width: 35px; margin: auto;">
                                                    <a href ng-click="deletecategexp(data.categexpid)" class="btn mrcs-5 action__btn">
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
        <!--Modal:End-->

    </div>
    <!-- END TABLE LIST -->

    <!--END content -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- TAB GROUP -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>
    <script src="app-controller/js-controller/categoryexpenseCtrl.js"></script>
    <?php include "includes/footer.php"; ?>