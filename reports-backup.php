<?php
include 'includes/header.php';
include 'includes/side-bar.php';
// if(!Role('auditlogs')){
//   echo "<script>window.location.href='index.php';</script>";
// };
?>
<?php include 'includes/top-bar.php' ?>
<div class="page-wrapper" ng-app="appCon" ng-controller="auditlogsController">

  <!-- TABLE LIST-->
  <div class="page-content" style="margin-top: 60px">
    <h3 class="d-inline-block">Reports</h3>
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body" ng-cloak>
          <!-- <h6 class="card-title">Data Table</h6> -->
          <div class="row col-md-12">
            <div class="col-md-6">
              <ul>
                <li><a href="rep_purchasebyproduct.php">Purchases by Product/Service Detail - x print</a></li>
                <li><a href="rep_trialbal.php">Trial Balance</a></li>
                <li><a href="rep_transaclistdate.php"><strong>Transaction List by Date</strong></a></li>
                <li><a href="rep_purchsuppdet.php"><strong>Purchase by Supplier Detail</strong></a></li>
                <li><a href="rep_transaccount.php">Transaction by Account</a></li>
                <li><a href="rep_genledger.php">General Ledger</a></li>
                <li><a href="rep_journal.php">Journal</a></li>
                <li><a href="rep_billpayment.php">Bill Payment List</a></li>
                <li><a href="rep_cheqdet.php">Cheque Detail</a></li>
              </ul>
            </div>
            
            <div class="col-md-6">
              <ul>
                <li><a href="rep_customerbalsummary.php"><strong>Customer Balance Summary</strong></a></li>
                <li><a href="rep_collectionreport.php">Collections Report</a></li>
                <li><a href="rep_statechange.php">Statement of Changes in Equity</a></li>
                <li><a href="rep_statecash.php">Statement of Cash Flows</a></li>
                <li><a href="rep_balsheet.php">Balance Sheet Comparison</a></li>
                <li><a href="rep_openinvoice.php">Open Invoices</a></li>
                <li><a href="rep_profitandlosstotal.php">Profit and Loss % of Total Income</a></li>
                <li><a href="rep_balancesheet.php">Balance Sheet</a></li>
                <li><a href="rep_profitandlossbymonth.php">Profit and Loss by Month</a></li>  
              </ul>
            </div>
          </div>
        </div>  
      </div>
    </div>

  </div>
  <!-- END TABLE LIST -->




  <!--END content -->

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
 <!-- TAB GROUP -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>
  <script src="app-controller/js-controller/auditlogsCtrl.js"></script>
  <?php include "includes/footer.php"; ?>

