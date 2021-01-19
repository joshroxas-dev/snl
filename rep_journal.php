<?php
include 'config.php';
include 'includes/header.php';
include 'includes/side-bar.php';
$phppage = basename($_SERVER['PHP_SELF']);
?>
<div class="page-wrapper" ng-app="appCon" ng-controller="reportsController-new">
    <?php include 'includes/top-bar.php' ?>
    <!-- content -->-
    <div class="page-content"  ng-init="getCurrentReportPage('<?php echo $phppage; ?>')">
         <h3 class="d-inline-block">Journal</h3>
         <div class="top-button float-right">
    <a href="documents/print_rep_journal.php" class="btn btn-primary" target="_blank">
                <i class="svg_icons" data-feather="file-text"></i>
                <span style="margin-left: 3px;">  </span>
            </a>
    </div>

        <!-- content -->
        <div class="row" style="margin-top: 10px;">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>DATE</th>
                                <th>TRANSACTION TYPE</th>
                                <th>NO.</th>
                                <th>NAME</th>
                                <th style="width: 255px;">MEMO/DESCRIPTION</th>
                                <th style="width: 255px;">ACCOUNT</th>
                                <th>DEBIT</th>
                                <th>CREDIT</th>
                            </thead>
                            <tbody>
                                <tr class="table-hover_cust" >
                                    <td class='tb-cursor cus_tbl-td'>10/01/2019</td>
                                    <td class='tb-cursor cus_tbl-td'>Invoice</td>
                                    <td class='tb-cursor cus_tbl-td'>3220</td>
                                    <td class='tb-cursor cus_tbl-td'>Aaron Dale Carpio</td>
                                    <td class='tb-cursor cus_tbl-td'>Brush Cleaner - Opening inventory and value</td>
                                    <td class='tb-cursor cus_tbl-td'>
                                        <ul class="p-0">
                                            <li style="line-height: 1.7;">Accounts Receivable (A/R)</li>
                                            <li style="line-height: 1.7;">Cost of sales</li>
                                        </ul>
                                    </td>
                                    <td class='tb-cursor cus_tbl-td'>PHP657.00</td>
                                    <td class='tb-cursor cus_tbl-td'>0.00</td>
                                </tr>
                            </tbody>
                                
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- content -->

    </div>
   

</div>

<script src="app-controller/js-controller/reportsCtrl-new.js"></script>
<?php include "includes/footer.php"; ?>