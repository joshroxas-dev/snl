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

app.controller('managemodeofpaymentController', function($scope, $http, $timeout){
    $scope.success = false;
    $scope.error = false;

    $scope.view = 'addModeofpayment';
    $scope.title = 'Add Mode of Payment';

    $scope.moppage = function(type,id){
        console.log('change',type,id)
        if(type == 'addModeofpayment'){
            $scope.init();
            $scope.view = type;
            $scope.title = 'Add Mode of Payment'
            $scope.data = '';
        }
        if(type == 'edit'){
            $scope.init();
            $scope.view = type;
            $scope.title = 'Edit Mode of Payment'
            $scope.editmodeofpaymentdata(id)
        }
        
    }

    $scope.init = function(){
        console.log('LOAD INIT');
        $scope.loadmodeofpaymentlist();
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

    $scope.loadmodeofpaymentlist = function(){
        
        $http.get('app-controller/php-function/modeofpayment.php').success(function(user_data) {
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

    $scope.editmodeofpaymentdata = function(res){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : res,
                'action':'editmodeofpayment',
            }
        }).success(function(datas){
            console.log(datas,'hello')
            if(datas.message == 'success'){
                $scope.data = {};
                $scope.data = datas.data;
            }else{
            }
        });
    }

    $scope.deletemodeofpayment = function(res, modeofpayment){
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
                        'action':'deletemodeofpayment',
                    }
                }).success(function(datas){
                    if(datas.message == 'success'){
                        Swal.fire(
                            'Deleted!',
                            'Mode of Payment has been deleted.',
                            'success'
                        )
                        $scope.init();
                    var logsdata = {
                        'event' : 'Delete',
                        'description' : 'Deleted Mode of Payment: '+ modeofpayment,
                        'module' : 'MODE OF PAYMENT'
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
    
    $scope.addmopForm = function(resp){
        console.log('bon',resp);
        if($scope.view == 'addModeofpayment'){
            $http({
                method:"POST",
                url:"app-controller/php-function/function.php",
                data:{
                    'modeofpayment' :resp.modeofpayment,
                    'action':'addModeofpayment', 
                    
                }
            }).success(function(data){
                if(data.message == 'success'){
                    toastr.success('New Mode of Payment has been added!');
                    $scope.loadmodeofpaymentlist();
                    $scope.data='';
                    $scope.errMessage = false;
                    var logsdata = {
                        'event' : 'Add',
                        'description' : 'Added New Mode of Payment: '+ resp.modeofpayment,
                        'module' : 'MODE OF PAYMENT'
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
                    'mopid' :  resp.mopid,
                    'modeofpayment' :resp.modeofpayment,
                    'action':'updateModeofpayment', 
                }
            }).success(function(data){
                if(data.message == 'success'){
                    toastr.success('Mode of Payment has been updated!');
                    $scope.loadmodeofpaymentlist();
                    $scope.view = 'addModeofpayment';
                    $scope.title = 'Add Mode of Payment';
                    $scope.data='';
                    $scope.errMessage = false;
                    var logsdata = {
                        'event' : 'Update',
                        'description' : 'Updated Mode of Payment: '+ resp.modeofpayment,
                        'module' : 'MODE OF PAYMENT'
                    }
                    $scope.saveAuditLogs(logsdata);
                }else{
                    $scope.errMessage = true;
                    toastr.error('An error has been occured!');
                }
            });
        }
		
    };

    $scope.init();

});