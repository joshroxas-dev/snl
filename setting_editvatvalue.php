<?php
include 'includes/header.php';
include 'includes/side-bar.php';
if (!Role('editvatvalue')) {
    echo "<script>window.location.href='index.php';</script>";
};
?>
<div class="page-wrapper" ng-app="appCon" ng-controller="managevatController">
    <?php include 'includes/top-bar.php' ?>

    <!-- TABLE LIST-->
    <div class="page-content" style="margin-top: 60px">
        <h3 class="d-inline-block">Edit VAT Value</h3>
        <div class="row">
            <div class="col-sm-5 grid-margin stretch-card">
                <div class="card">
                <form method="POST" ng-submit="addvatForm(data)">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td><label for="">Current VAT Value: </label></td>
                                        <td><input id="" class="form-control" name="" ng-model="data.sys_value" type="text" required>
                                            <!-- <small ng-show="" class="req-txt">platform name is required</small> -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-sm-12" align="right">
                            <input class="btn btn-success" type="submit" name="addVAT" value="Save">
                            </div>
                        </div>
                    </div>
                </form>
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
    <script src="app-controller/js-controller/vatCtrl.js"></script>
    <?php include "includes/footer.php"; ?>