<?php
include 'includes/header.php';
include 'includes/side-bar.php';

if (!Role('categoriesmanagement')) {
    echo "<script>window.location.href='index.php';</script>";
};
?>

<div class="page-wrapper" ng-app="appCon" ng-controller="managedraftController">
    <?php include 'includes/top-bar.php' ?>

    <!-- TABLE LIST-->
    <div class="page-content" style="margin-top: 60px">
        <h3 class="d-inline-block">Draft Management</h3>
        <div class="col-md-12 grid-margin stretch-card">
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
                    <div class="row"><br></div>

                    <ul class="cd-breadcrumb triangle nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#purchaseorder-table" aria-controls="purchaseorder-table" role="tab" data-toggle="tab" aria-expanded="true">
                                <span class="octicon octicon-light-bulb"></span>Purchase Orders
                            </a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#customerorder-table" aria-controls="customerorder-table" role="tab" data-toggle="tab" aria-expanded="false">
                                <span class="octicon octicon-diff-added"></span>Customer Orders
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="purchaseorder-table">
                            <div class="row">
                                <div class="col-md-12" ng-show="filter_data > 0">
                                    <!-- <table class="table">
                                        <thead>
                                            <th>Category Description: &nbsp;<a ng-click="sort_with('categorydesc');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <tr class="table-hover_cust" ng-repeat="data in searched = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*(data_limit == 'ALL' ? entire_user : data_limit) | limitTo:(data_limit == 'ALL' ? entire_user : data_limit)">
                                                <td>{{data.categorydesc}}</td>
                                                <td>
                                                    <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Edit Category" style="width: 35px; margin: auto;">
                                                        <a href ng-click="categorypage(type='edit',id=data.categoryid)" class="mrcs-5">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit svg_icons">
                                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <?php if (Role('deletecategories')) { ?>
                                                        <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Delete Category" style="width: 35px; margin: auto;">
                                                            <a href ng-click="deletecategory(data.categoryid)" class="mrcs-5">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle svg_icons">
                                                                    <circle cx="12" cy="12" r="10"></circle>
                                                                    <line x1="15" y1="9" x2="9" y2="15"></line>
                                                                    <line x1="9" y1="9" x2="15" y2="15"></line>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table> -->
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
                        <div role="tabpanel" class="tab-pane" id="customerorder-table">
                        <div class="row">
                                <div class="col-md-12" ng-show="filter_data > 0">
                                    <!-- <table class="table">
                                        <thead>
                                            <th>Category Description: &nbsp;<a ng-click="sort_with('categorydesc');"><i class="glyphicon glyphicon-sort"></i></a></th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <tr class="table-hover_cust" ng-repeat="data in searched = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*(data_limit == 'ALL' ? entire_user : data_limit) | limitTo:(data_limit == 'ALL' ? entire_user : data_limit)">
                                                <td>{{data.categorydesc}}</td>
                                                <td>
                                                    <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Edit Category" style="width: 35px; margin: auto;">
                                                        <a href ng-click="categorypage(type='edit',id=data.categoryid)" class="mrcs-5">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit svg_icons">
                                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <?php if (Role('deletecategories')) { ?>
                                                        <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Delete Category" style="width: 35px; margin: auto;">
                                                            <a href ng-click="deletecategory(data.categoryid)" class="mrcs-5">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle svg_icons">
                                                                    <circle cx="12" cy="12" r="10"></circle>
                                                                    <line x1="15" y1="9" x2="9" y2="15"></line>
                                                                    <line x1="9" y1="9" x2="15" y2="15"></line>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table> -->
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








    <script src="app-controller/js-controller/categoryCtrl.js"></script>
    <?php include "includes/footer.php"; ?>