<?php
include 'includes/header.php';
include 'includes/side-bar.php';
if (!Role('creditcard')) {
    echo "<script>window.location.href='index.php';</script>";
};
?>
<div class="page-wrapper" ng-app="appCon" ng-controller="managecreditcardController">
    <?php include 'includes/top-bar.php'?>

    <!-- TABLE LIST-->
    <div class="page-content" style="margin-top: 60px">
        <h3 class="d-inline-block">Credit Card</h3>
        <div class="row">
            <div class="col-sm-5 grid-margin stretch-card">
                <div class="card">
                <form method="POST" ng-submit="addcreditcardForm(data)">
                    <div class="card-body">
                        <h4 class="card-title">{{title}}</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <input class="form-control" name="" ng-model="data.creditcardid" type="hidden">
                                    <tr>
                                        <td><label for="">Credit Card: </label></td>
                                        <td><input id="" class="form-control" name="" ng-model="data.creditcard" type="text" required>
                                            <!-- <small ng-show="" class="req-txt">credit care is required</small> -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-sm-12" align="right">
                            <input class="btn btn-success" type="submit" name="addCreditcard" value="Save">
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
                                        <th>ID &nbsp;<a ng-click="sort_with('creditcard');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Credit Card &nbsp;<a ng-click=""><i class="glyphicon glyphicon-sort"></i></a></th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="data in searched = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*(data_limit == 'ALL' ? entire_user : data_limit) | limitTo:(data_limit == 'ALL' ? entire_user : data_limit)"> 
                                            <td>{{data.creditcardid}}</td>
                                            <td>{{data.creditcard}}</td>
                                            <td>
                                                <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Edit Credit Card" style="width: 35px; margin: auto;">
                                                    <a href ng-click="creditcardpage(type='edit', id=data.creditcardid)" class="btn mrcs-5 action__btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit svg_icons svg-Icolor" style="margin-top: 5px"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                    </a>
                                                </div>
                                                <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Delete Credit Card" style="width: 35px; margin: auto;">
                                                    <a href ng-click="deletecreditcard(data.creditcardid)" class="btn mrcs-5 action__btn">
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
    <script src="app-controller/js-controller/creditcardCtrl.js"></script>
    <?php include "includes/footer.php"; ?>