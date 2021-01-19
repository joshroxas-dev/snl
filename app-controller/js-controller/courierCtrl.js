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

app.controller('managecourierController', function($scope, $http, $timeout){
    $scope.success = false;
    $scope.error = false;

    $scope.view = 'list';

    $scope.courierpage = function(type,id){
        console.log('change',type,id)
        if(type == 'addCourier'){
            $scope.init();
            $scope.view = type;
            $scope.title = 'Add Courier'
            $scope.data = '';
        }
        if(type == 'edit'){
            $scope.init();
            $scope.view = type;
            $scope.title = 'Edit Courier'
            $scope.editcourierdata(id)
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
        $scope.loadcourierlist();
    }

    $scope.loadcourierlist = function(){
        
        $http.get('app-controller/php-function/courier.php').success(function(user_data) {
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

    $scope.editcourierdata = function(res){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : res,
                'action':'editcourier',
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

    $scope.viewcourierData = function(res){
        $scope.viewdata = '';
        console.log('test')
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : res,
                'action':'viewcourierData',
            }
        }).success(function(datas){
            console.log(datas,'hello')
            if(datas.message == 'success'){
                if(datas.data){
                    $scope.viewdata = {};
                    $scope.viewdata = datas.data;

                }else{
                    toastr.error('An error has been occured!');
                    $("#viewcourierinfo").modal("hide");
                }
            }else{
            }
            
        });
    }

    $scope.deletecourier = function(courierid, couriername){
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
                        'id'    : courierid,
                        'action':'deletecourier',
                    }
                }).success(function(datas){
                    if(datas.message == 'success'){
                        Swal.fire(
                            'Deleted!',
                            'Courier has been deleted.',
                            'success'
                        )
                        $scope.init();
                        var logsdata = {
                            'event' : 'Delete',
                            'description' : 'Deleted Courier: '+ couriername,
                            'module' : 'COURIER'
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
    
    $scope.addcourierForm = function(resp){
        console.log('bon',resp);
        if($scope.view == 'addCourier'){
            $http({
                method:"POST",
                url:"app-controller/php-function/function.php",
                data:{
                'couriername' :resp.couriername,
                'courierbranch' :resp.courierbranch,
                'courierphonenum':resp.courierphonenum,
                'courieremail':resp.courieremail,
                'courierwebsite':resp.courierwebsite,
                    'action':'addCourier', 
                    
                }
            }).success(function(data){
                if(data.message == 'success'){
                    toastr.success('New courier has been added!');
                    //$("#addbrandmodal").modal("hide");
                    //$('.modal-backdrop').remove();
                    //setTimeout(function() {$('#addbrandmodal').modal('hide');}, 10000);
                    //$(document.body).removeClass("modal-open");
                    $scope.loadcourierlist();
                    $scope.data='';
                    $scope.errMessage = false;
                    var logsdata = {
                        'event' : 'Add',
                        'description' : 'Added New Courier: '+ resp.couriername,
                        'module' : 'COURIER'
                    }
                    $scope.saveAuditLogs(logsdata);
                }else{
                    $scope.errMessage = true;
                    toastr.error('An error has been occured!');
                }
                $(document.body).addClass("modal-open");
            });
        }else{
            $http({
                method:"POST",
                url:"app-controller/php-function/function.php",
                data:{
                    'courierid' :resp.courierid,
                    'couriername' :resp.couriername,
                    'courierbranch':resp.courierbranch,
                    'courierphonenum' :resp.courierphonenum,
                    'courieremail':resp.courieremail,
                    'courierwebsite' :resp.courierwebsite,
                    'action':'updateCourier', 
                    
                }
            }).success(function(data){
                if(data.message == 'success'){
                    toastr.success('Courier has been updated!');
                    //$("#addcouriermodal").modal("hide");
                    //$('.modal-backdrop').remove();
                    //$(document.body).removeClass("modal-open");
                    $scope.loadcourierlist();
                    $scope.data='';
                    $scope.errMessage = false;
                    var logsdata = {
                        'event' : 'Update',
                        'description' : 'Updated Courier: '+ resp.couriername,
                        'module' : 'COURIER'
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