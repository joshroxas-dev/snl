<?php
include 'includes/header.php';
include 'includes/side-bar.php';

if(!Role('categoriesmanagement')){
  echo "<script>window.location.href='index.php';</script>";
};
?>
<?php include 'includes/top-bar.php' ?>
<div class="page-wrapper" ng-app="appCon" ng-controller="managecategoryController">
<style>
.tableFixHead          { overflow-y: auto; height: 159px; margin: auto; width: 100%;}
.tableFixHead thead th { position: sticky; top: 0; background-color: white;}
.tableFixHead tbody tr td { 
    padding-top: 5px;
    padding-bottom: 5px;
}
</style>

  <!-- TABLE LIST-->
  <div class="page-content" style="margin-top: 60px">
    <h3 class="d-inline-block">Category Management</h3>
<?php if(Role('addcategories')){ ?> 
    <div class="top-button float-right">
      <a class="btn btn-primary" href data-toggle="modal" data-target="#addcategorymodal" role="button" ng-click="categorypage('addCategory','0')">
                <i class="svg_icons" data-feather="user-plus"></i>
                <span style="margin-left: 3px;">Add Category</span>
            </a>
    </div>
<?php } ?>
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
                        <th>Category Description: &nbsp;<a ng-click="sort_with('categorydesc');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    <tr class="table-hover_cust" ng-repeat="data in searched = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*(data_limit == 'ALL' ? entire_user : data_limit) | limitTo:(data_limit == 'ALL' ? entire_user : data_limit)">
                            <td>{{data.categorydesc}}</td>
                            <td>
                              <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Manage Color" style="width: 35px; margin: auto;">
                                <a href class="mrcs-5" data-target="#addcategorycolor" ng-click="formcolor.set(data.categoryid, data.categorydesc)" data-toggle="modal">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file svg_icons">
                                      <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                      <polyline points="13 2 13 9 20 9"></polyline>
                                  </svg>
                                </a>
                              </div>
                              <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Edit Category" style="width: 35px; margin: auto;">
                                <a href data-toggle="modal" data-target="#addcategorymodal" ng-click="categorypage('edit', data.categoryid)" class="mrcs-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit svg_icons"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </a>
                              </div>
                              <?php if(Role('deletecategories')){ ?> 
                              <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Delete Category" style="width: 35px; margin: auto;">
                                <a href ng-click="deletecategory(data.categoryid, data.categorydesc)" class="mrcs-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle svg_icons"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                </a>
                              </div>
                              <?php } ?>
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
  <!-- END TABLE LIST -->


  <!-- ===================================================================================== -->
  <!-- =================================ADD/EDIT FORM======================================= -->
  <!-- ===================================================================================== -->


 <!--Modal:start-->
 <div class="modal fade" id="addcategorymodal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="">{{title}}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form method="POST" ng-submit="addcategoryForm(data)">
                  <div class="form-group">
                    <input type="hidden" ng-model='data.categoryid'>
                                <label for="categorydesc">Category Description:</label>
                              <input id="categorydesc" class="form-control" ng-model="data.categorydesc" type="text" required>
                              <!-- <small class="req-txt">Category description is required</small> -->
                            </div>
                      <div align="right">
                          <input class="btn btn-success" type="submit" name="addCategory" value="Save">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>

  <div class="modal fade" id="addcategorycolor" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="">Manage Color ({{formcolor.title}})</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <div class="col-sm-12">
                    <div class="col-sm-7">
                      <input id="categorydesc" class="form-control" ng-model="colordesc" type="text" required>
                    </div>
                    <div class="col-sm-5">
                      <input type="file" name="img" ng-model="myFile" file-model="myFile" ng-change="uploadFile((formcolor.color_guid ? formcolor.color_guid : 'temp'))" class="file-upload-default">
                      <button class="file-upload-browse btn btn-primary" type="button" ng-show="!isUploading">Upload</button>
                      <button class="btn btn-primary" type="button" disabled ng-show="isUploading">
                          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                          Uploading...
                      </button>
                      <input style="margin-left: 5px" class="btn btn-success" type="submit" ng-click="formcolor.save(colordesc)" name="addCategoryColor" value="{{formcolor.isEdit ? 'SAVE' : 'ADD'}}" ng-show="!isUploading" ng-disabled="!colordesc">
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <br>
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
                  <!-- <small class="req-txt">Category description is required</small> -->
                </div>
              </div>
              <div class="modal-footer">
                <div class="tableFixHead">
                  <table class="table">
                      <thead>
                          <tr>
                              <th width="15%">No.</th>
                              <th></th>
                              <th width="60%">Color</th>
                              <th width="25%">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        <tr ng-if="colorlist.length > 0" ng-repeat="data in colorlist">
                          <td><center>{{$index + 1}}</center></td>
                          <td><img src="{{data.path ? data.path : 'https://placehold.it/888x500&text=16:9'}}" alt="" /></td>
                          <td>{{data.color}}</td>
                          <td>
                            <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Edit" style="width: 35px; margin: auto;">
                              <a href ng-click="formcolor.edit(data.id, data.color, data.color_guid)" class="mrcs-5">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit svg_icons"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                              </a>
                            </div>
                            <div class="d-inline-block" data-toggle="tooltip" data-placement="top" title="delete" style="width: 35px; margin: auto;">
                              <a href ng-click="formcolor.delete(data.id, data.color)" class="mrcs-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle svg_icons"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                </a>
                            </div>
                          </td>
                        </tr>
                        <tr ng-if="colorlist.length == 0">
                          <td colspan='3'><center>No Records Found</center></td>
                        </tr>
                      </tbody>
                  </table>
                </div>
              </div>
          </div>
      </div>
  </div>
        <!--Modal:End-->

  <!-- END ADD/EDIT FORM -->




  <!--END content -->

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
 <!-- TAB GROUP -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>
  <script src="app-controller/js-controller/categoryCtrl.js"></script>
  <?php include "includes/footer.php"; ?>

