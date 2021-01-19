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

app.controller('managebrandController', function($scope, $http, $timeout){
    $scope.success = false;
    $scope.error = false;

    $scope.view = 'list';

    $scope.brandpage = function(type,id){
        console.log('change',type,id)
        if(type == 'addBrand'){
            $scope.init();
            $scope.view = type;
            $scope.title = 'Add Brand'
            $scope.data = '';
        }
        if(type == 'edit'){
            $scope.init();
            $scope.view = type;
            $scope.title = 'Edit Brand'
            $scope.editbranddata(id)
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
        $scope.loadbrandlist();
    }

    $scope.loadbrandlist = function(){
        
        $http.get('app-controller/php-function/brands.php').success(function(user_data) {
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

    $scope.editbranddata = function(res){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : res,
                'action':'editbrand',
            }
        }).success(function(datas){
            console.log(datas,'hello');
            if(datas.message == 'success'){
                $scope.data = {};
                $scope.data = datas.data;
            }else{
            }
            
        });
    }
  
    $scope.viewbrandData = function(res){
        $scope.viewdata = '';
        console.log('test')
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : res,
                'action':'viewbrandData',
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

    $scope.deletebrand = function(id, brandname){
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
                        'id'    : id,
                        'action':'deletebrand',
                    }
                }).success(function(datas){
                    if(datas.message == 'success'){
                        Swal.fire(
                            'Deleted!',
                            'Brand has been deleted.',
                            'success'
                        )
                        $scope.init();
                    var logsdata = {
                        'event' : 'Delete',
                        'description' : 'Deleted Brand: '+ brandname,
                        'module' : 'BRAND'
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
    
    $scope.addbrandForm = function(resp){
        console.log('bon',resp);
        
        if($scope.view == 'addBrand'){
            $http({
                method:"POST",
                url:"app-controller/php-function/function.php",
                data:{
                    'brandname' :resp.brandname,
                    'branddesc':resp.branddesc,
                    'brandadd' :resp.brandadd,
                    'brandcontactperson':resp.brandcontactperson,
                    'brandphonenum' :resp.brandphonenum,
                    'brandemail' :resp.brandemail,
                    'brandwebsite':resp.brandwebsite,
                    'action':'addBrand', 
                    
                }
            }).success(function(data){
                if(data.message == 'success'){
                    toastr.success('New brand has been added!');
                    $scope.loadbrandlist();
                    $scope.data='';
                    $scope.errMessage = false;
                    var logsdata = {
                        'event' : 'Add',
                        'description' : 'Added New Brand: '+ resp.brandname,
                        'module' : 'BRAND'
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
                    'brandid' :resp.brandid,
                    'brandname' :resp.brandname,
                    'branddesc':resp.branddesc,
                    'brandadd' :resp.brandadd,
                    'brandcontactperson':resp.brandcontactperson,
                    'brandphonenum' :resp.brandphonenum,
                    'brandemail' :resp.brandemail,
                    'brandwebsite':resp.brandwebsite,
                    'action':'updateBrand', 
                    
                }
            }).success(function(data){
                if(data.message == 'success'){
                    toastr.success('Brand has been updated!');
                    $scope.loadbrandlist();
                    $scope.data='';
                    $scope.errMessage = false;
                    var logsdata = {
                        'event' : 'Update',
                        'description' : 'Updated Brand: '+ resp.brandname,
                        'module' : 'BRAND'
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