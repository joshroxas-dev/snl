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
        console.log(attrs,'yaaaaay');
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
            console.log("Success");
         })
         .error(function(){
            console.log("Success");
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

app.controller('managestockController', function($scope, $http, $timeout, fileUpload){
    $scope.success = false;
    $scope.error = false;

    $scope.view = 'list';

    $scope.stockpage = function(type,id){
        console.log('change',type,id, $scope.uuidv4())
        if(type == 'addStock'){
            $scope.loadGUID();
            $scope.view = type;
            $scope.title = 'Add Stock'
            $scope.data = '';
            var imagenUrl = false;
            var drEvent = $('#myDropify').dropify(
            {
                defaultFile: imagenUrl
            });
            // drEvent.on('dropify.afterClear', function(event, element){
            //     console.log('hellodel');
            // });
            drEvent = drEvent.data('dropify');
            drEvent.resetPreview();
            drEvent.clearElement();
            drEvent.settings.defaultFile = imagenUrl;
            drEvent.destroy();
            drEvent.init();
        }
        if(type == 'edit'){
            $scope.init();
            $scope.view = type;
            $scope.title = 'Edit Stock'
            $scope.editstockdata(id)
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

    $scope.loadGUID = function(){
        $scope.tempId = $scope.uuidv4();
    }

    $scope.uuidv4 = function(){
        return ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c =>
          (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
        );
    }

    $scope.uploadFile = function(itemid){
        var file = $scope.myFile[0]._file;
        console.log('file is ' );
        console.dir(file);

        var uploadUrl = "upload.php";
        var data = {
            itemid : itemid ? itemid : $scope.tempId,
            name : $scope.name,
            module : 'stocks',
            folder : 'stocks',
            type : 'single',
        };
        fileUpload.uploadFileToUrl(file, uploadUrl, data);

        // $scope.editstockdata(itemid);
   };

    $scope.init = function(){
        console.log('LOAD INIT');
        $scope.loadstocklist();
        
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'getCategorylist',
            }
        }).success(function(datas){
            console.log(datas,'hello')
            if(datas.message == 'success'){
                $scope.categorylist = {};
                $scope.categorylist = datas.data;
            }else{
            }
            
        });

        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'getBrandlist',
            }
        }).success(function(datas){
            console.log(datas,'hello')
            if(datas.message == 'success'){
                $scope.brandlist = {};
                $scope.brandlist = datas.data;
            }else{
            }
            
        });

        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'getSupplierlist',
            }
        }).success(function(datas){
            console.log(datas,'hello')
            if(datas.message == 'success'){
                $scope.supplierlist = {};
                $scope.supplierlist = datas.data;
            }else{
            }
            
        });

        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'getSizelist',
            }
        }).success(function(datas){
            console.log(datas,'hellosizes')
            if(datas.message == 'success'){
                $scope.sizelist = {};
                $scope.sizelist = datas.data;
            }else{
            }
            
        });

    }

    $scope.loadstocklist = function(){
        $http.get('app-controller/php-function/stocks.php').success(function(user_data) {
            console.log('ddddddd',user_data);
            $scope.file = user_data;
            $scope.current_grid = 1;
            $scope.data_limit = 10;
            $scope.filter_data = $scope.file.length;
            $scope.entire_user = $scope.file.length;
        });
    }

    $scope.uploadImage = function () {
        console.log("Changed");
    }

    $scope.uploadImage2 = function (test) {
        console.log("Changed2", test);
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

    $scope.editstockdata = function(res){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : res,
                'action':'editstock',
            }
        }).success(function(data){
            console.log(data,'hello')
            if(data.message == 'success'){
                // $scope.data = {}; 
                // $scope.data = datas.data;
                $scope.data = data.data.main;
                $scope.data.reorderpoint = new Date(data.data.main.reorderpoint);

                // var nameImage =  $scope.data.imageurl;
                // $("#myDropify").dropify({
                //     defaultFile: nameImage ,
                // });

                var imagenUrl = $scope.data.imageurl;
                var drEvent = $('#myDropify').dropify(
                {
                    defaultFile: imagenUrl
                });
                // drEvent.on('dropify.afterClear', function(event, element){
                //     console.log('hellodel');
                // });
                drEvent = drEvent.data('dropify');
                drEvent.resetPreview();
                drEvent.clearElement();
                drEvent.settings.defaultFile = imagenUrl;
                drEvent.destroy();
                drEvent.init();
            }else{
            }
            
        });
    }

    $scope.deleteimage = function(id, url){
        console.log(id, url,'lllllllll')
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : id,
                'imageurl': url,
                'action':'deleteStocksimage',
            }
        }).success(function(){});
    }

    $scope.viewstocksData = function(res, guid){
        $scope.viewdata = '';
        console.log('test')
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : res,
                'guid'    : guid,
                'action':'viewstocksData',
            }
        }).success(function(datas){
            console.log(datas,'hello')
            if(datas.message == 'success'){
                if(datas.data){
                    $scope.viewdata = {};
                    $scope.viewdata = datas.data;
                    $scope.viewdata.imgurl = datas.img;

                }else{
                    toastr.error('An error has been occured!');
                    $("#viewstockinfo").modal("hide");
                }
            }else{
            }
            
        });
    }

    $scope.deletestock = function(stocksid, stockname){
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
                        'id'    : stocksid,
                        'action':'deletestock',
                    }
                }).success(function(datas){
                    if(datas.message == 'success'){
                        Swal.fire(
                            'Deleted!',
                            'Stock has been deleted.',
                            'success'
                        )
                        $scope.init();
                        var logsdata = {
                            'event' : 'Delete',
                            'description' : 'Deleted Stock: '+ stockname,
                            'module' : 'STOCK'
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

    $scope.getinfostocks = function(guid){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'guid'    : guid,
                'action':'getinfostocks'
            }
        }).success(function(res){
            if(res.message == 'success'){
                if(res.data){
                    $scope.stockintf = res.data;
                }else{
                    toastr.error('An error has been occured!');
                }
            }else{
                toastr.error('An error has been occured!');
            }
           
        });
    }
    
    $scope.addstockForm = function(resp){
        console.log('bon',resp);
        
        if($scope.view == 'addStock'){
	$http({
			method:"POST",
			url:"app-controller/php-function/function.php",
			data:{
                'stockname' :resp.stockname,
                'guid' : $scope.tempId,
                'categoryid':resp.categoryid ? resp.categoryid : '',
                'brandid' :resp.brandid ? resp.brandid : '',
                'supplierid':resp.supplierid ? resp.supplierid : '',
                'sku' :resp.sku ? resp.sku : '',
                'stockcolor' :resp.stockcolor ? resp.stockcolor : '',
                'stocksize' :resp.stocksize ? resp.stocksize : '',
                'costperunit':resp.costperunit ? resp.costperunit : '',
                'reorderpoint':resp.reorderpoint ? resp.reorderpoint : '',
                'threshold':resp.threshold ? resp.threshold : '',
                'action':'addStock' 
            }
		}).success(function(data){
            if(data.message == 'success'){
                toastr.success('New stock has been added!');
                //$("#addbrandmodal").modal("hide");
                //$('.modal-backdrop').remove();
                //setTimeout(function() {$('#addbrandmodal').modal('hide');}, 10000);
                //$(document.body).removeClass("modal-open");
                $scope.loadGUID();
                $scope.loadstocklist();
                $scope.data='';
                $scope.errMessage = false;
                var logsdata = {
                    'event' : 'Add',
                    'description' : 'Added New Stock: '+ resp.stockname,
                    'module' : 'STOCK'
                }
                $scope.saveAuditLogs(logsdata);
                var imagenUrl = false;
                var drEvent = $('#myDropify').dropify(
                {
                    defaultFile: imagenUrl
                });
                // drEvent.on('dropify.afterClear', function(event, element){
                //     console.log('hellodel');
                // });
                drEvent = drEvent.data('dropify');
                drEvent.resetPreview();
                drEvent.clearElement();
                drEvent.settings.defaultFile = imagenUrl;
                drEvent.destroy();
                drEvent.init();
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
                    'stocksid' :resp.stocksid,
                    'stockname' :resp.stockname,
                    'categoryid':resp.categoryid ? resp.categoryid : '',
                    'brandid' :resp.brandid ? resp.brandid : '',
                    'supplierid':resp.supplierid ? resp.supplierid : '',
                    'sku' :resp.sku ? resp.sku : '',
                    'stockcolor' :resp.stockcolor ? resp.stockcolor : '',
                    'stocksize' :resp.stocksize ? resp.stocksize : '',
                    'availablestocks':resp.availablestocks ? resp.availablestocks : '',
                    'costperunit':resp.costperunit ? resp.costperunit : '',
                    'unitprice':resp.unitprice ? resp.unitprice : '',
                    'reorderpoint':resp.reorderpoint ? resp.reorderpoint : '',
                    'threshold':resp.threshold ? resp.threshold : '',
                    'action':'updateStock' 
                    
                }
            }).success(function(data){
                if(data.message == 'success'){
                    toastr.success('Stock has been updated!');
                    //$("#addbrandmodal").modal("hide");
                    //$('.modal-backdrop').remove();
                    //setTimeout(function() {$('#addbrandmodal').modal('hide');}, 10000);
                    //$(document.body).removeClass("modal-open");
                    $scope.loadstocklist();
                    $scope.data='';
                    $scope.errMessage = false;
                    var logsdata = {
                        'event' : 'Update',
                        'description' : 'Updated Stock: '+ resp.stockname,
                        'module' : 'STOCK'
                    }
                    $scope.saveAuditLogs(logsdata);
                }else{
                    $scope.errMessage = true;
                    toastr.error('An error has been occured!');
                }
                $(document.body).addClass("modal-open");
            });

        }
	
    };

    $scope.getcategoryinfo = function(res) {
        console.log(res, 'CATEGORY INFO');
        $scope.categColor = null;
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : res,
                'action':'getCategoryInfo',
            }
        }).success(function(datas){
            console.log(datas.data,'getCategoryInfo')
            if(datas.message == 'success'){
                $scope.showcateginfo = true;
                if(datas.data){
                    $scope.showcateginfo = {};
                    $scope.showcateginfo = datas.data;
                    $scope.data.categorydesc = $scope.showcateginfo.categorydesc;

                }else{
                    toastr.error('An error has been occured!');
                }
            }else{
                
            }
        });

        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'categoryid' : res,
                'action':'getcategColor',
            }
        }).success(function(datas){
            console.log(datas,'hellosizes')
            if(datas.message == 'success'){
                $scope.categColor = datas.data;
            }else{
            }
            
        });
        
    }

    $scope.getbrandinfo = function(res) {
        console.log(res, 'BRAND INFO');
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : res,
                'action':'getBrandInfo',
            }
        }).success(function(datas){
            console.log(datas.data,'getBrandInfo')
            if(datas.message == 'success'){
                $scope.showbrandinfo = true;
                if(datas.data){
                    $scope.showbrandinfo = {};
                    $scope.showbrandinfo = datas.data;
                    $scope.data.brandname = $scope.showbrandinfo.brandname;

                }else{
                    toastr.error('An error has been occured!');
                }
            }else{
                
            }
        });
        
    }

    $scope.getsupplierinfo = function(res) {
        console.log(res, 'SUPPLIER INFO');
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : res,
                'action':'getSupplierInfo',
            }
        }).success(function(datas){
            console.log(datas.data,'getSupplierInfo')
            if(datas.message == 'success'){
                $scope.showbrandinfo = true;
                if(datas.data){
                    $scope.showsuppliernfo = {};
                    $scope.showsuppliernfo = datas.data;
                    $scope.data.suppliername = $scope.showsuppliernfo.suppliername;

                }else{
                    toastr.error('An error has been occured!');
                }
            }else{
                
            }
        });
        
    }

    $scope.init();

});
