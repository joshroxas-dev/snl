<?php
include 'config.php';
include 'includes/header.php';
include 'includes/side-bar.php';
?>
<div class="page-wrapper"  ng-app="appCon" ng-controller="managestockController">
  <?php include 'includes/top-bar.php' ?>
  <!-- content -->
  <div class="page-content" ng-show="view=='addstocks'">
    <h3><a href="stock_management.php"><b data-feather="chevron-left"></b></a>Add New Stocks</h3><br>
    <form  class="cmxform form_wrapper" name="myForm" method="post" ng-submit="addstockForm(data)">
      <fieldset>
        <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Product Information</h4>
                <div class="form-group">
                  <label for="name">Product Name</label>
                  <input id="name" class="form-control" name="name" type="text" ng-model="data.stockname">
                </div>
                <div class="form-group">
                  <label for="name">Category</label>
                  <select id="" class="form-control" ng-model="data.categoryid">
                    <option>Category</option>
                    <option>Category</option>
                    <option>Category</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="name">Brand</label>
                  <select id="" class="form-control"  ng-model="data.brandid">
                    <option>Brand</option>
                    <option>Brand</option>
                    <option>Brand</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="name">Supplier</label>
                  <select id="" class="form-control" ng-model="data.supplierid">
                    <option>Supplier</option>
                    <option>Supplier</option>
                    <option>Supplier</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="name">Color</label>
                  <input id="name" class="form-control" name="name" type="text" ng-model="data.stockcolor">
                </div>
                <div class="form-group">
                  <label for="name">Size</label>
                  <select id="" class="form-control" ng-model="data.stocksize">
                    <option>Extra Small</option>
                    <option>Small</option>
                    <option>Medium</option>
                    <option>Large</option>
                    <option>Extra Large</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="name">Unit Price</label>
                  <input id="name" class="form-control" name="name" type="text" ng-model="unitprice">
                </div>
                <div class="form-group">
                  <label for="name">Rate</label>
                  <input id="name" class="form-control" name="name" type="text" ng-model="data.rate">
                </div>
                <div class="form-group">
                  <label for="name">Available Stocks</label>
                  <input id="name" class="form-control" name="name" type="text" ng-model="data.availablestocks">
                </div>
                <div class="card-body">
                  <h4 class="card-title">Choose Product Pictures</h4>
                  <input type="file" id="" class="" />
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-12" align="right">
            <input class="btn btn-success" type="submit" value="Save">
          </div>
        </div>
      </fieldset>
    </form>
  </div>
  <!-- content -->
  <?php include "includes/footer.php"; ?>