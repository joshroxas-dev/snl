<?php
include 'config.php';
include 'includes/header.php';
include 'includes/side-bar.php';

?>
<div class="page-wrapper">
  <?php include 'includes/top-bar.php' ?>
  <!-- content -->
  <div class="page-content ng-cloak" ng-app="appCon" ng-controller="dashboardController">
      <h3>Dashboard</h3>
    <br>
    <div class="col-sm-12">
      <div class="col-sm-6 p-l-0">
        <div class="card">
          <h6 class="card-title mb-0" style="padding: 10px" ><strong>My Income</strong></h6>
          <div class="p-l-0">
            <div class="col-sm-12">
                FROM: <input type="date" ng-model="set.myincomedatefrom" ng-change="dataIncome(set.myincomedatefrom, set.myincomedateto)"> TO: <input type="date" ng-model="set.myincomedateto" ng-change="dataIncome(set.myincomedatefrom, set.myincomedateto)">
            </div>
          </div>
          <div class="p-l-0">
            <div style="text-align: right;padding-right: 15px;padding-top: 15px;">
              Total: PHP {{myincometotal ? (myincometotal | number:2) : '0.00'}}
            </div>
          </div>
          <div class="card-body" style="padding-top: 0px;">
            <div id="myincome" style="height: 400px; max-width: 100%;"></div>
            </div>
          </div>
        </div>

      <div class="col-sm-6 p-r-0">
        <div class="card">
          <h6 class="card-title mb-0" style="padding: 10px" ><strong>My Expenses</strong></h6>
          <div class="p-l-0">
            <div class="col-sm-12">
                FROM: <input type="date" ng-model="set.myexpensefrom" ng-change="dataExpense(set.myexpensefrom, set.myexpenseto)"> TO: <input type="date" ng-model="set.myexpenseto" ng-change="dataExpense(set.myexpensefrom, set.myexpenseto)">
            </div>
          </div>
          <div class="p-l-0">
            <div style="text-align: right;padding-right: 15px;padding-top: 15px;">
              Total: PHP {{myexpensetotal ? (myexpensetotal | number:2) : '0.00'}}
            </div>
          </div>
          <div class="card-body" style="padding-top: 0px;">
            <div id="myexpenses" style="height: 400px; max-width: 100%;"></div>
          </div>
          </div>
        </div>
      </div>

      <div class="col-sm-12 grid-margin stretch-card m-t-20">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline mb-2">
              <h6 class="card-title mb-0">Previous Year Income Comparison</h6>
            </div>
            <div class="p-l-0">
              <div class="col-sm-12 p-l-0" style="width: 200px;">
                <select name="" class="form-control" id="" ng-model="set.incomecomparison" ng-change="setcomparison(set.incomecomparison)">
                    <option value="Monthly">Monthly</option>
                    <option value="Quarterly">Quarterly</option>
                    <option value="Annually">Annually</option>
                </select>
              </div>
              <div class="col-sm-12 p-l-0">
                <div id="incomecomparison" style="height: 400px; max-width: 100%;"></div>
              </div>
              <!-- <div  class="p-r-0"  style="text-align: right; padding-right: 15px;">
                Total: PHP 1,231,123
              </div> -->
            </div>
          </div> 
        </div>
      </div>
    </div>
        
  </div>
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="app-controller/js-controller/dashboardCtrl.js"></script>

<?php include "includes/footer.php"; ?>