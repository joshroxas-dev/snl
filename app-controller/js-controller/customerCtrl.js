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

app.controller('managecustomerController', function($scope, $http, $timeout){
    $scope.success = false;
    $scope.error = false;

    $scope.view = 'list';

    $scope.customerpage = function(type,id){
        console.log('change',type,id)
        if(type == 'addCustomer'){
            $scope.init();
            $scope.view = type;
            $scope.title = 'Add Customer'
            $scope.data = '';
        }
        if(type == 'edit'){
            $scope.init();
            $scope.view = type;
            $scope.title = 'Edit Customer'
            $scope.editcustomerdata(id)
        }
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


    $scope.init = function(){
        console.log('LOAD INIT');
        $scope.loadcustomerlist();
    }

    $scope.loadcustomerlist = function(){
        
        $http.get('app-controller/php-function/customer.php').success(function(user_data) {
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

    $scope.editcustomerdata = function(res){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : res,
                'action':'editcustomer',
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
    $scope.viewcustomerData = function(res){
        $scope.viewdata = '';
        console.log('test');
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : res,
                'action':'viewcustomerData',
            }
        }).success(function(datas){
            if(datas.message == 'success'){
                if(datas.data){
                    $scope.viewdata = {};
                    $scope.viewdata = datas.data;

                }else{
                    toastr.error('An error has been occured!');
                    $("#viewcustomerinfo").modal("hide");
                }
            }else{
            }
            
        });
    }

    $scope.deletecustomer = function(customerid, customerfirstname){
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
                        'id'    : customerid,
                        'action':'deletecustomer',
                    }
                }).success(function(datas){
                    if(datas.message == 'success'){
                        Swal.fire(
                            'Deleted!',
                            'Customer has been deleted.',
                            'success'
                        )
                        $scope.init();  
                        var logsdata = {
                            'event' : 'Delete',
                            'description' : 'Deleted Customer: '+ customerfirstname,
                            'module' : 'CUSTOMER'
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
    
    $scope.addcustomerForm = function(resp){
        console.log('bon',resp);
        
        if($scope.view == 'addCustomer'){
            $http({
                method:"POST",
                url:"app-controller/php-function/function.php",
                data:{
                    'customerfirstname':resp.customerfirstname, 
                    'customerlastname':resp.customerlastname, 
                    'customerbname':resp.customerbname, 
                    'cbillingaddress':resp.cbillingaddress, 
                    'cshippingaddress':resp.cshippingaddress, 
                    'cphonenumber':resp.cphonenumber, 
                    'cemailaddress':resp.cemailaddress, 
                    'action':'addCustomer', 
                    
                }
            }).success(function(data){
                if(data.message == 'success'){
                    toastr.success('New Customer has been added!');
                    //$("#addsuppliermodal").modal("hide");
                    //$('.modal-backdrop').remove();
                    //$(document.body).removeClass("modal-open");
                    $scope.loadcustomerlist();
                    $scope.data='';
                    $scope.errMessage = false;
                    var logsdata = {
                        'event' : 'Add',
                        'description' : 'Added New Customer: '+ resp.customerfirstname,
                        'module' : 'CUSTOMER'
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
                    'customerid' :resp.customerid,
                    'customerfirstname' :resp.customerfirstname,
                    'customerlastname':resp.customerlastname,
                    'customerbname':resp.customerbname,
                    'cbillingaddress' :resp.cbillingaddress,
                    'cshippingaddress' :resp.cshippingaddress,
                    'cphonenumber':resp.cphonenumber,
                    'cemailaddress' :resp.cemailaddress,
                    'action':'updateCustomer', 
                    
                }
            }).success(function(data){
                if(data.message == 'success'){
                    toastr.success('Customer has been updated!');
                    //$("#addbrandmodal").modal("hide");
                    //$('.modal-backdrop').remove();
                    //$(document.body).removeClass("modal-open");
                    $scope.loadcustomerlist();
                    $scope.data='';
                    $scope.errMessage = false;
                    var logsdata = {
                        'event' : 'Update',
                        'description' : 'Updated Customer: '+ resp.customerfirstname,
                        'module' : 'CUSTOMER'
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