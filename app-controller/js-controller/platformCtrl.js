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

app.controller('manageplatformController', function($scope, $http, $timeout){
    $scope.success = false;
    $scope.error = false;

    $scope.view = 'addPlatform';
    $scope.title = 'Add Platform';

    $scope.platformpage = function(type,id){
        console.log('change',type,id)
        if(type == 'addPlatform'){
            $scope.init();
            $scope.view = type;
            $scope.title = 'Add Platform'
            $scope.data = '';
        }
        if(type == 'edit'){
            $scope.init();
            $scope.view = type;
            $scope.title = 'Edit Platform'
            $scope.editplatformdata(id)
        }
        
    }

    $scope.init = function(){
        console.log('LOAD INIT');
        $scope.loadplatformlist();
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

    $scope.loadplatformlist = function(){
        
        $http.get('app-controller/php-function/platform.php').success(function(user_data) {
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

    $scope.editplatformdata = function(res){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : res,
                'action':'editplatform',
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

    $scope.deleteplatform = function(res, platform){
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
                        'action':'deleteplatform',
                    }
                }).success(function(datas){
                    if(datas.message == 'success'){
                        Swal.fire(
                            'Deleted!',
                            'Platform has been deleted.',
                            'success'
                        )
                        $scope.init();
                    var logsdata = {
                        'event' : 'Delete',
                        'description' : 'Deleted Platform: '+ platform,
                        'module' : 'PLATFORM'
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
    
    $scope.addplatformForm = function(resp){
        console.log('bon',resp);
        if($scope.view == 'addPlatform'){
            $http({
                method:"POST",
                url:"app-controller/php-function/function.php",
                data:{
                    'platform' :resp.platform,
                    'action':'addPlatform', 
                    
                }
            }).success(function(data){
                if(data.message == 'success'){
                    toastr.success('New Platform has been added!');
                    $scope.loadplatformlist();
                    $scope.data='';
                    $scope.errMessage = false;
                    var logsdata = {
                        'event' : 'Add',
                        'description' : 'Added New Platform: '+ resp.platform,
                        'module' : 'PLATFORM'
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
                    'platformid' :  resp.platformid,
                    'platform' :resp.platform,
                    'action':'updatePlatform', 
                }
            }).success(function(data){
                if(data.message == 'success'){
                    toastr.success('Platform has been updated!');
                    $scope.loadplatformlist();
                    $scope.view = 'addPlatform';
                    $scope.title = 'Add Platform';
                    $scope.data='';
                    $scope.errMessage = false;
                    var logsdata = {
                        'event' : 'Update',
                        'description' : 'Updated Platform: '+ resp.platform,
                        'module' : 'PLATFORM'
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