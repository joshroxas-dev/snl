var app = angular.module('appCon', ['ui.bootstrap','angularjsFileModel']);

app.filter('beginning_data', function() {
    return function(input, begin) {
        if (input) {
            begin = +begin;
            return input.slice(begin);
        }
        return [];
    }
});

app.directive('fileModel', ['$parse', function ($parse) {
    return {
    restrict: 'A',
    link: function(scope, element, attrs) {
        // console.log(attrs,'yaaaaay');
        var model = $parse(attrs.fileModel);
        var modelSetter = model.assign;

        element.bind('change', function(){
            scope.$apply(function(){
                modelSetter(scope, element[0].files[0]);
            });
        });
    }
   };
}]);

app.service('fileUpload', ['$http', function ($http) {
    this.uploadFileToUrl = function(file, uploadUrl, data){
         var fd = new FormData();
         fd.append('file', file);
         fd.append('name', data.name);
         fd.append('itemid', data.itemid);
         fd.append('folder', data.folder);
         fd.append('module', data.module);
         fd.append('type', data.type);
         $http.post(uploadUrl, fd, {
             transformRequest: angular.identity,
             headers: {'Content-Type': undefined,'Process-Data': false}
         })
         .success(function(){
            // console.log("Success");
         })
         .error(function(){
            // console.log("Success");
         });
     }
 }]);

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

app.controller('managecategoryController', function($scope, $http, $timeout, fileUpload){
    $scope.success = false;
    $scope.error = false;

    $scope.view = 'list';

    $scope.categorypage = function(type,id){
        console.log('change',type,id)
        if(type == 'addCategory'){
            $scope.init();
            $scope.view = type;
            $scope.title = 'Add Category'
            $scope.data = '';
        }
        if(type == 'edit'){
            $scope.init();
            $scope.view = type;
            $scope.title = 'Edit Category'
            $scope.editcategorydata(id)
        }
        
    }

    $scope.init = function(){
        console.log('LOAD INIT');
        $scope.loadcategorylist();
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

    $scope.loadcategorylist = function(){
        
        $http.get('app-controller/php-function/category.php').success(function(user_data) {
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

    $scope.editcategorydata = function(res){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : res,
                'action':'editcategory',
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

    $scope.uploadFile = function(itemid){
        $scope.isUploading = true;
        if(!$scope.myFile[0]){
            $scope.isUploading = false;
            
        }else{
            var file = $scope.myFile[0]._file;
            // console.log('file is ' );
            console.dir(file);

            var uploadUrl = "upload.php";
            var data = {
                itemid : itemid,
                name : $scope.name,
                module : 'category',
                folder : 'color',
                type : 'single',
            };
            fileUpload.uploadFileToUrl(file, uploadUrl, data);

            $timeout(function(){
                $scope.isUploading = false;
                $scope.uiname = '';
                $scope.loadfiles('temp');
                $scope.loadfiles($scope.formcolor.color_guid ? $scope.formcolor.color_guid : 'temp');
                if($scope.formcolor.isEdit){
                    $scope.formcolor.loadList($scope.formcolor.categoryid);
                }
                
            }, 2000);
        }
        
        // $scope.isUploading = false;
        // $scope.editstockdata(itemid);
   };

    $scope.deleteFile = function(id, path){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'deleteFile',
                'id'    : id,
                'path': path,
                'module': 'category',
            }
        }).success(function(res){

            if(res.message){
                $scope.loadfiles($scope.formcolor.color_guid ? $scope.formcolor.color_guid : 'temp');
                $scope.formcolor.loadList($scope.formcolor.categoryid);
                if(path){
                    toastr.success('File has been successfully deleted!');
                }
            }else{
                toastr.error('An error has been occured!');
            }
        });
    }

    $scope.loadfiles = function(id){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'getMultiFile',
                'id': id,
                'module':'category'
            }
        }).success(function(res){
        //    console.log(res,'Attachment')
            if(res){
                $scope.attachFile = {};
                $scope.attachFile = res;
                $scope.uiname = '';
            }else{
            }
            
        });
    }

    $scope.deletecategory = function(res, categorydesc){
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
                        'action':'deletecategory',
                    }
                }).success(function(datas){
                    if(datas.message == 'success'){
                        Swal.fire(
                            'Deleted!',
                            'Category has been deleted.',
                            'success'
                        )
                        $scope.init();
                    var logsdata = {
                        'event' : 'Delete',
                        'description' : 'Deleted Category: '+ categorydesc,
                        'module' : 'CATEGORY'
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
    
    $scope.addcategoryForm = function(resp){
        console.log('bon',resp);
        if($scope.view == 'addCategory'){
            $http({
                method:"POST",
                url:"app-controller/php-function/function.php",
                data:{
                    'categorydesc' :resp.categorydesc,
                    'action':'addCategory', 
                    
                }
            }).success(function(data){
                if(data.message == 'success'){
                    toastr.success('New Category has been added!');
                    $scope.loadcategorylist();
                    $scope.data='';
                    $scope.errMessage = false;
                    var logsdata = {
                        'event' : 'Add',
                        'description' : 'Added New Category: '+ resp.categorydesc,
                        'module' : 'CATEGORY'
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
                    'categoryid' :  resp.categoryid,
                    'categorydesc' :resp.categorydesc,
                    'action':'updateCategory', 
                }
            }).success(function(data){
                if(data.message == 'success'){
                    toastr.success('Category has been updated!');
                    //$("#addcategorymodal").modal("hide");
                    //$('.modal-backdrop').remove();
                    //$(document.body).removeClass("modal-open");
                    $scope.loadcategorylist();
                    $scope.data='';
                    $scope.errMessage = false;
                    var logsdata = {
                        'event' : 'Update',
                        'description' : 'Updated Category: '+ resp.categorydesc,
                        'module' : 'CATEGORY'
                    }
                    $scope.saveAuditLogs(logsdata);
                }else{
                    $scope.errMessage = true;
                    toastr.error('An error has been occured!');
                }
            });
        }
		
    };

    $scope.formcolor = {
        title : null,
        categoryid : null,
        colorid : null,
        color_guid : null,
        isEdit : false,
        set : function(id, title){
            $scope.colordesc = "";
            console.log(id, title)
            this.categoryid = id;
            this.title = title;
            this.colorid = null;
            this.color_guid = null;
            this.isEdit = false;
            this.loadList(id);
            $scope.deleteFile('temp', null)
        },
        loadList : function(id){
            $http({
                method:"POST",
                url:"app-controller/php-function/function.php",
                data:{
                    'categoryid' :  id,
                    'action':'loadFormcolorList', 
                }
            }).success(function(res){
                if(res.message == 'success'){
                    if(res.data){
                        $scope.colorlist = res.data;
                    }else{
                        toastr.error('An error has been occured!');
                    }
                }else{
                    toastr.error('An error has been occured!');
                }
               
            });
        },
        save : function(desc){
            var d = this;
            if(this.isEdit){
                
                $http({
                    method:"POST",
                    url:"app-controller/php-function/function.php",
                    data:{
                        'colorid' : d.colorid,
                        'desc' :  desc,
                        'action':'savecategorycolor', 
                    }
                }).success(function(res){
                    console.log(d,'hhhhh')
                    if(res.message == 'success'){
                        toastr.success('Color has been successfully updated!');
                        d.set(d.categoryid, d.title);
                    }else{
                        toastr.error('An error has been occured!');
                    }
                   
                });
            }else{
                $http({
                    method:"POST",
                    url:"app-controller/php-function/function.php",
                    data:{
                        'categoryid' : d.categoryid,
                        'desc' :  desc,
                        'action':'addcategorycolor', 
                    }
                }).success(function(res){
                    console.log(d,'hhhhh')
                    if(res.message == 'success'){
                        toastr.success('Color has been successfully saved!');
                        d.set(d.categoryid, d.title);
                    }else{
                        toastr.error('An error has been occured!');
                    }
                   
                });
            }
        },
        edit : function(id, colordesc, guid){
            this.colorid = id;
            this.color_guid = guid;
            this.isEdit = true;
            $scope.colordesc = colordesc;
            $scope.loadfiles(guid);

        },
        delete : function(id, desc){
            var d = this;
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
                            'action':'deletecategorycolor',
                        }
                    }).success(function(datas){
                        if(datas.message == 'success'){
                            Swal.fire(
                                'Deleted!',
                                'Color has been successfully deleted!',
                                'success'
                            )
                            var logsdata = {
                                'event' : 'Delete',
                                'description' : 'Deleted Color: '+ desc +' from category ' + d.title,
                                'module' : 'category'
                            }
                            $scope.saveAuditLogs(logsdata);
                            d.set(d.categoryid, d.title);
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
    }

    $scope.init();

});