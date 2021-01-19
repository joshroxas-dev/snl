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

app.controller('managesupplierController', function($scope, $http, $timeout){
    $scope.success = false;
    $scope.error = false;
    $scope.data = [];

    $scope.view = 'list';

    $scope.supplierpage = function(type,id){
        console.log('change',type,id)
        if(type == 'addSupplier'){
            $scope.init();
            $scope.view = type;
            $scope.title = 'Add Supplier'
            $scope.data = '';
        }
        if(type == 'edit'){
            $scope.init();
            $scope.view = type;
            $scope.title = 'Edit Supplier'
            $scope.editsupplierdata(id)
        }
        if(type == 'list'){
            $scope.view = type;
            $scope.init();
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
        $scope.loadsupplierlist();
    }

    $scope.loadsupplierlist = function(){
        
        $http.get('app-controller/php-function/supplier.php').success(function(user_data) {
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

    $scope.editsupplierdata = function(res){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : res,
                'action':'editsupplier',
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


    $scope.viewsupplierData = function(res){
        $scope.viewdata = '';
        console.log('test')
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : res,
                'action':'viewsupplierData',
            }
        }).success(function(datas){
            console.log(datas,'hello')
            if(datas.message == 'success'){
                if(datas.data){
                    $scope.viewdata = {};
                    $scope.viewdata = datas.data;

                }else{
                    toastr.error('An error has been occured!');
                    $("#viewbrandinfo").modal("hide");
                }
            }else{
            }
            
        });
    }

    $scope.deletesupplier = function(res, suppliername){
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
                        'action':'deletesupplier',
                    }
                }).success(function(datas){
                    if(datas.message == 'success'){
                        Swal.fire(
                            'Deleted!',
                            'Supplier has been deleted.',
                            'success'
                        )
                        $scope.init();
                    var logsdata = {
                        'event' : 'Delete',
                        'description' : 'Deleted Supplier: '+ suppliername,
                        'module' : 'SUPPLIER'
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
    
    $scope.addsupplierForm = function(resp){
        console.log('bon',resp);
        
        if($scope.view == 'addSupplier'){
            
		$http({
			method:"POST",
			url:"app-controller/php-function/function.php",
			data:{
                'suppliername':resp.suppliername,
                'supplieraddress':resp.supplieraddress ? resp.supplieraddress : '',
                'scontactperson':resp.scontactperson ? resp.scontactperson : '',
                'sphonenumber':resp.sphonenumber ? resp.sphonenumber : '',
                'semail':resp.semail ? resp.semail : '',
                'swebsite':resp.swebsite ? resp.swebsite : '',
                'action':'addSupplier', 
                
            }
		}).success(function(data){
            if(data.message == 'success'){
                toastr.success('New supplier has been added!');
                //$("#addsuppliermodal").modal("hide");
                //$('.modal-backdrop').remove();
                //$(document.body).removeClass("modal-open");
                $scope.loadsupplierlist();
                $scope.data='';
                $scope.errMessage = false;
                var logsdata = {
                    'event' : 'Add',
                    'description' : 'Added a New Supplier: '+ resp.suppliername,
                    'module' : 'SUPPLIER'
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
                    'supplierid' :resp.supplierid,
                    'suppliername' :resp.suppliername,
                    'supplieraddress':resp.supplieraddress,
                    'scontactperson' :resp.scontactperson,
                    'sphonenumber':resp.sphonenumber,
                    'semail' :resp.semail,
                    'swebsite' :resp.swebsite,
                    'action':'updateSupplier', 
                    
                }
            }).success(function(data){
                if(data.message == 'success'){
                    toastr.success('Supplier has been updated!');
                    //$("#addbrandmodal").modal("hide");
                    //$('.modal-backdrop').remove();
                    //$(document.body).removeClass("modal-open");
                    $scope.loadsupplierlist();
                    $scope.data='';
                    $scope.errMessage = false;
                var logsdata = {
                    'event' : 'Update',
                    'description' : 'Updated Supplier: '+ resp.suppliername,
                    'module' : 'SUPPLIER'
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