var app = angular.module('appCon', ['ui.bootstrap']);

app.filter('beginning_data', function() {
    return function(input, begin) {
        if (input) {
            begin = +begin;
            return input.slice(begin);
        }
        return [];
    }
});

app.run(function($window, $rootScope) {
    $rootScope.online = navigator.onLine;
    $window.addEventListener("offline", function () {
      $rootScope.$apply(function() {
        $rootScope.online = false;
        Swal.fire({
            type: 'error',
            title: 'Network Error!',
            text: 'You ve disconnected from the network please check your internet connection!',
            allowOutsideClick: false,
            showConfirmButton: false,
        })
      });
    }, false);
    $window.addEventListener("online", function () {
      $rootScope.$apply(function() {
        $rootScope.online = true;
        swal.close();
        Swal.fire({
            type: 'success',
            title: 'Connected',
            allowOutsideClick: false,
            showConfirmButton: false,
            timer: 2000
        })
      });
    }, false);
});

app.controller('manageaccountController', function($scope, $http, $timeout){
    $scope.success = false;
    $scope.error = false;

    $scope.view = 'addAccount';
    $scope.title = 'Add Account';

    $scope.accountpage = function(type,id){
        console.log('change',type,id)
        if(type == 'addAccount'){
            $scope.init();
            $scope.view = type;
            $scope.title = 'Add Account'
            $scope.data = '';
        }
        if(type == 'edit'){
            $scope.init();
            $scope.view = type;
            $scope.title = 'Edit Account'
            $scope.editaccountdata(id)
        }
        
    }

    $scope.init = function(){
        console.log('LOAD INIT');
        $scope.loadaccountlist();

        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'getAccountTypelist',
            }
        }).success(function(datas){
            console.log(datas,'hello')
            if(datas.message == 'success'){
                $scope.accounttypelist = {};
                $scope.accounttypelist = datas.data;
            }else{
            }
        });

        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'getAccountDetailslist',
            }
        }).success(function(datas){
            console.log(datas,'hello')
            if(datas.message == 'success'){
                $scope.accountdetaillist = {};
                $scope.accountdetaillist = datas.data;
            }else{
            }
        });


    }

    $scope.saveAuditLogs = function(logsdata){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'auditLogs',
                'event': logsdata.event,
                'description': logsdata.description,
                'module': logsdata.module,
            }
        });
    }

    $scope.loadaccountlist = function(){
        
        $http.get('app-controller/php-function/account.php').success(function(user_data) {
            $scope.file = user_data;
            $scope.current_grid = 1;
            $scope.data_limit = 10;
            $scope.filter_data = $scope.file.length;
            $scope.entire_user = $scope.file.length;
        });
    }

    $scope.page_position = function(page_number) {
        $scope.current_grid = page_number;
    };
    $scope.filter = function() {
        $timeout(function() {
            $scope.filter_data = $scope.searched.length;
        }, 20);
    };
    $scope.sort_with = function(base) {
        $scope.base = base;
        $scope.reverse = !$scope.reverse;
    };

    $scope.editaccountdata = function(res){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : res,
                'action':'editaccount',
            }
        }).success(function(datas){
            console.log(datas,'hello')
            if(datas.message == 'success'){
                $scope.data = {};
                $scope.data = datas.data;
                $scope.data.balancedate = datas.data.balancedate == '0000-00-00' ? '' : new Date(datas.data.balancedate);
            }else{
            }
        });
    }


     

    $scope.viewaccountData = function(res, accountid){
        $scope.viewdata = '';
        console.log('test')
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : res,
                'action':'viewaccountData',
            }
        }).success(function(datas){
            console.log(datas,'hello')
            if(datas.message == 'success'){
                if(datas.data){
                    $scope.viewdata = {};
                    $scope.viewdata = datas.data;

                }else{
                    toastr.error('An error has been occured!');
                    $("#viewaccountinfo").modal("hide");
                }
            }else{
            }
            
        });
    }

    $scope.deleteaccount = function(res, accountname){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.value) {
                $http({
                    method:"POST",
                    url:"app-controller/php-function/function.php",
                    data:{
                        'id'    : res,
                        'action':'deleteaccount',
                    }
                }).success(function(datas){
                    if(datas.message == 'success'){
                        Swal.fire(
                            'Deleted!',
                            'Account has been deleted.',
                            'success'
                        )
                        $scope.init();
                    var logsdata = {
                        'event' : 'Delete',
                        'description' : 'Deleted Account: '+ accountname,
                        'module' : 'CREDIT CARD'
                    }
                    $scope.saveAuditLogs(logsdata);
                    }else{
                        Swal.fire(
                            'Delete Failed!',
                            'An error has been occured!',
                            'error'
                        )
                    }
                })
            }
        })
    }
    $scope.addaccountForm = function(resp){
        console.log('bon',resp);
        if($scope.view == 'addAccount'){
            $http({
                method:"POST",
                url:"app-controller/php-function/function.php",
                data:{
                    'accountname' :resp.accountname,
                    'acctypeid' :resp.acctypeid,
                    'accdetailsid' :resp.accdetailsid,
                    'currency' :resp.currency,
                    'accbalance' :resp.accbalance,
                    'balancedate' :resp.balancedate,
                    'action':'addAccount'
                    
                }
            }).success(function(data){
                if(data.message == 'success'){
                    toastr.success('New Account has been added!');
                    $scope.loadaccountlist();
                    $scope.data='';
                    $scope.errMessage = false;
                    var logsdata = {
                        'event' : 'Add',
                        'description' : 'Added Account: '+ resp.accountname,
                        'module' : 'ACCOUNT'
                    }
                    $scope.saveAuditLogs(logsdata);
                }else{
                    $scope.errMessage = true;
                    toastr.error('An error has been occured!');
                }
            });
        }else{
            $http({
                method:"POST",
                url:"app-controller/php-function/function.php",
                data:{
                    'accountid' :  resp.accountid,
                    'accountname' :resp.accountname,
                    'acctypeid' :resp.acctypeid,
                    'accdetailsid' :resp.accdetailsid,
                    'currency' :resp.currency,
                    'accbalance' :resp.accbalance,
                    'balancedate' :resp.balancedate,
                    'action':'updateAccount' 
                }
            }).success(function(data){
                if(data.message == 'success'){
                    toastr.success('Account has been updated!');
                    $scope.loadaccountlist();
                    $scope.view = 'addAccount';
                    $scope.title = 'Add Account';
                    $scope.data='';
                    $scope.errMessage = false;
                    var logsdata = {
                        'event' : 'Update',
                        'description' : 'Updated Account: '+ resp.accountname,
                        'module' : 'ACCOUNT'
                    }
                    $scope.saveAuditLogs(logsdata);
                }else{
                    $scope.errMessage = true;
                    toastr.error('An error has been occured!');
                }
            });
        }	
    };

    
$scope.deleteaccount = function(accountid, accountname){
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.value) {
            $http({
                method:"POST",
                url:"app-controller/php-function/function.php",
                data:{
                    'id'    : accountid,
                    'action':'deleteaccount',
                }
            }).success(function(datas){
                if(datas.message == 'success'){
                    Swal.fire(
                        'Deleted!',
                        'Account has been deleted.',
                        'success'
                    )
                    $scope.init();
                    var logsdata = {
                        'event' : 'Delete',
                        'description' : 'Deleted Account: '+ accountname,
                        'module' : 'Account'
                    }
                    $scope.saveAuditLogs(logsdata);
                }else{
                    Swal.fire(
                        'Delete Failed!',
                        'An error has been occured!',
                        'error'
                    )
                }
            })
        }
    })
}

    $scope.getacctypeinfo = function(res) {
        console.log(res, 'ACCOUNT TYPE INFO');
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : res,
                'action':'getAccountTypeInfo',
            }
        }).success(function(datas){
            console.log(datas.data,'getAccountTypeInfo')
            if(datas.message == 'success'){
                $scope.showinfo = true;
                if(datas.data){
                    $scope.showinfo = {};
                    $scope.showinfo = datas.data;
                    $scope.data.accounttype = $scope.showinfo.accounttype;

                }else{
                    toastr.error('An error has been occured!');
                }
            }else{
                
            }
        });
        
    }

    $scope.getaccdetailinfo = function(res) {
        console.log(res, 'ACCOUNT DETAIL INFO');
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : res,
                'action':'getAccountDetailsInfo',
            }
        }).success(function(datas){
            console.log(datas.data,'getAccountDetailsInfo')
            if(datas.message == 'success'){
                $scope.showinfo = true;
                if(datas.data){
                    $scope.showinfo = {};
                    $scope.showinfo = datas.data;
                    $scope.data.accdetails = $scope.showinfo.accdetails;

                }else{
                    toastr.error('An error has been occured!');
                }
            }else{
                
            }
        });
        
    }



    $scope.init();

});