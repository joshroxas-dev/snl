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

app.controller('managecategexpController', function($scope, $http, $timeout){
    $scope.success = false;
    $scope.error = false;

    $scope.view = 'addCategoryexpense';
    $scope.title = 'Add Expense Category';

    $scope.categoryexpensepage = function(type,id){
        console.log('change',type,id)
        if(type == 'addCategoryexpense'){
            $scope.init();
            $scope.view = type;
            $scope.title = 'Add Expense Category'
            $scope.data = '';
        }
        if(type == 'edit'){
            $scope.init();
            $scope.view = type;
            $scope.title = 'Edit Expense Category'
            $scope.editcategexpdata(id)
        }
        
    }

    $scope.init = function(){
        console.log('LOAD INIT');
        $scope.loadcategexplist();
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

    $scope.loadcategexplist = function(){
        
        $http.get('app-controller/php-function/categoryexpense.php').success(function(user_data) {
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

    $scope.editcategexpdata = function(res){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : res,
                'action':'editcategexp',
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

    $scope.deletecategexp = function(res, categexp){
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
                        'action':'deletecategexp',
                    }
                }).success(function(datas){
                    if(datas.message == 'success'){
                        Swal.fire(
                            'Deleted!',
                            'Expense Category has been deleted.',
                            'success'
                        )
                        $scope.init();
                    var logsdata = {
                        'event' : 'Delete',
                        'description' : 'Deleted Expense Category: '+ categexp,
                        'module' : 'EXPENSE CATEGORY'
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
    
    $scope.addcategexpForm = function(resp){
        console.log('bon',resp);
        if($scope.view == 'addCategoryexpense'){
            $http({
                method:"POST",
                url:"app-controller/php-function/function.php",
                data:{
                    'categexptype' :resp.categexptype,
                    'detailtype'   :resp.detailtype,
                    'categexpname' :resp.categexpname,
                    'categexdesc' :resp.categexdesc,
                    'action':'addCategoryexpense', 
                    
                }
            }).success(function(data){
                if(data.message == 'success'){
                    toastr.success('New Credit Card has been added!');
                    $scope.loadcategexplist();
                    $scope.data='';
                    $scope.errMessage = false;
                    var logsdata = {
                        'event' : 'Add',
                        'description' : 'Added New Expense Category: '+ resp.categexp,
                        'module' : 'EXPENSE CATEGORY'
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
                    'categexpid' :  resp.categexpid,
                    'categexptype' :resp.categexptype,
                    'detailtype'   :resp.detailtype,
                    'categexpname' :resp.categexpname,
                    'categexdesc' :resp.categexdesc,
                    'action':'updateCategexpense', 
                }
            }).success(function(data){
                if(data.message == 'success'){
                    toastr.success('Expense Category has been updated!');
                    $scope.loadcategexplist();
                    $scope.view = 'addCategoryexpense';
                    $scope.title = 'Add Expense Category';
                    $scope.data='';
                    $scope.errMessage = false;
                    var logsdata = {
                        'event' : 'Update',
                        'description' : 'Updated Expense Category: '+ resp.categexp,
                        'module' : 'EXPENSE CATEGORY'
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