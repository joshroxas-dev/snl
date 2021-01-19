var app = angular.module('appCon', ['ng-currency','angularjsFileModel']);

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

app.controller('expenserController', function($scope, $http, $timeout, fileUpload){
    $scope.main = {};
    $scope.category = {};
    $scope.item = {};

    _init = function(){
        $scope.isUploading = false;
        $scope.expenseCheck();
        $scope.formView = 'list';
        $scope.load();
        $scope.loadCurrentRate();
        $scope.loadexpenseslist();
    }

    $scope.init = function(){
        return _init();
    }

    $scope.expenseCheck = function(){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'expenseCheck',
            }
        }).success(function(res){
            // console.log(res,'expenseCheck')
            $scope.expenseid = res.expenseid;
            $scope.loadActiveExpense($scope.expenseid);
        });
    }

    $scope.loadCurrentRate = function(){
        var proxy = "//cors-anywhere.herokuapp.com";
        var url = "https://www.freeforexapi.com/api/live?pairs=USDPHP";
        $http.get(proxy +'/'+ url)
        .then(function(response) {
            // console.log(response)
            $scope.updatedat = response.data.rates.USDPHP.timestamp * 1000;
            $scope.lrate = response.data.rates.USDPHP.rate;
            // toastr.success('Latest exchage rate has been successfully loaded.');
            // $scope.main.exchangerate = response.data.rates.USDPHP.rate;
            
        }).catch(function(response) {
            // console.log(response)
            
        })
    }

    $scope.load = function(){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'getProdlist',
            }
        }).success(function(datas){
            // console.log(datas,'hello')
            if(datas.message == 'success'){
                $scope.prodlist = {};
                $scope.prodlist = datas.data;
            }
        });

        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'getCatlist',
            }
        }).success(function(datas){
            // console.log(datas,'catlist')
            if(datas.message == 'success'){
                $scope.catlist = {};
                $scope.catlist = datas.data;
            }
        });
        
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'paymentActList',
            }
        }).success(function(res){
            // console.log(res,'paymentActList')
            if(res.message == 'success'){
                $scope.paymentActList = {};
                $scope.paymentActList = res.data;
            }else{
                toastr.error('An error has been occured!');
            }
        });

        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'paymentMethod',
            }
        }).success(function(res){
            // console.log(res,'paymentMethod')
            if(res.message == 'success'){
                $scope.paymentMethod = {};
                $scope.paymentMethod = res.data;
            }else{
                toastr.error('An error has been occured!');
            }
        });

        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'payeeList',
            }
        }).success(function(res){
            // console.log(res,'payeeList')
            if(res.message == 'success'){
                $scope.payeeList = {};
                $scope.payeeList = res.data;
            }else{
                toastr.error('An error has been occured!');
            }
        });
    }

    $scope.edit = function(id){
        $scope.formView = 'add';
        $scope.loadActiveExpense(id);
    }

    $scope.loadActiveExpense = function(id){
        // $scope.formView = 'add';
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'loadActiveExpense',
                'expenseid':id
            }
        }).success(function(res){
            // console.log(res,'loadActiveExpense')
            $scope.main = res.data.main;
            $scope.category = res.data.category;
            $scope.item = res.data.item;
            $scope.totalamount = res.data.totalamount;
            $scope.totalitemamount = res.data.totalitemamount;
            $scope.main.paymentdate = res.data.main.paymentdate == '0000-00-00' || res.data.main.paymentdate == '1970-01-01' ? '' : new Date(res.data.main.paymentdate);
            $scope.loadfiles($scope.main.expenseid);
            $scope.main.paymentaccount ? $scope.getaccountbalinfo($scope.main.paymentaccount) : '';
            // $scope.loadTotal($scope.main.expenseid);

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
                module : 'expense',
                folder : 'expense',
                type : 'multiple',
            };
            fileUpload.uploadFileToUrl(file, uploadUrl, data);

            $timeout(function(){
                $scope.isUploading = false;
                $scope.uiname = '';
                $scope.loadfiles($scope.main.expenseid);
                
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
                'module': 'expense',
            }
        }).success(function(res){

            if(res.message){
                $scope.loadfiles($scope.main.expenseid);
                toastr.success('File has been successfully deleted!');
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
                'module':'expense'
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

    $scope.getaccountbalinfo = function(id) {
        // console.log(res, $scope.store, 'PROD INFO');
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : id,
                'action':'getAccountbal',
            }
        }).success(function(datas){
           console.log(datas.data,'getAccountbal')
            if(datas.message == 'success'){
                if(datas.data){
                    $scope.main.accountbal = datas.data.accbalance;
                }else{
                    toastr.error('An error has been occured!');
                }
            }else{
                toastr.error('An error has been occured!');
            }
        });
        
    }

    $scope.getproddinfo = function(id, index, poid) {
        // console.log(id, index, 'PROD INFO');
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'       : id,
                'poid'     : poid,
                'action'   :'ExpenseGetProdInfo',
                'expenseid': $scope.main.expenseid
            }
        }).success(function(datas){
            // console.log(datas,'getProdInfo')
            if(datas.exist){
                toastr.error('This Product is already selected!');
                $scope.item[index].stocksid = '';
                $scope.item[index].quantity = '';
                $scope.item[index].unitpricephp = '';
                $scope.item[index].amount = '';

                $scope.floadItem();
            }else{
                if(datas.message == 'success'){
                    if(datas.data){
                        $scope.item[index].quantity = '';
                        $scope.item[index].unitpricephp = datas.data.unitprice;
                        $scope.inSave = true;
                    }else{
                        toastr.error('An error has been occured!');
                    }
                }else{
                    toastr.error('An error has been occured!');
                }
            }
            $scope.floadItem();
        });   
    }

    $scope.floadItem = function(){
        var data = angular.copy($scope.item);
        var item = [];
        angular.forEach(data,function(val){
            angular.forEach(val,function(v){
                item.push(v);
            })
        });

        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'expenseupdatestocks',
                'data': data
            }
        }).success(function(datas){
            $scope.inSave ? $scope.loadActiveExpense($scope.main.expenseid) : '';
            $scope.inSave = false;
            $scope.loadActiveExpense($scope.main.expenseid);
            // setTimeout($scope.loadStockPO($scope.main.pom_id), 4000);
        });
    }

    $scope.deleteexpense = function(id){
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
                        'action':'deleteexpense',
                        'id': id
                    }
                }).success(function(datas){
                    if(datas.message == 'success'){
                        $scope.init();
                        Swal.fire(
                            'Deleted!',
                            'Item has been deleted.',
                            'success'
                        )
                        // $scope.init();
                        // var logsdata = {
                        //     'event' : 'Delete',
                        //     'description' : 'Deleted User: '+ username,
                        //     'module' : 'SYSTEM USER'
                        // }
                        // $scope.saveAuditLogs(logsdata);
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

    // $scope.$watch('item', function(){
        
    //     $scope.validateStocks($scope.main.expenseid);
        // console.log(postock,'multiple')
    // }, true);

    $scope.setQuantity = function(val, val2, val3, index, id, sid, ablQty) {
        // console.log(val, val2, val3, index, id, ablQty);
        
        $scope.item[index].amount = val3 * (val * val2);

        // $http({
        //     method:"POST",
        //     url:"app-controller/php-function/function.php",
        //     data:{
        //         'action':'expenseresetquantitystock',
        //         'id': id,
        //         'qty': val,
        //     }
        // }).success(function(datas){
        //     // console.log(datas,'STOCK PO')
        //     if(datas.outofstocks){
        //         $scope.item[index].quantity = '0';
        //         toastr.error('Insufficient Quantity!');
        //         $scope.loadActiveExpense($scope.main.expenseid);
        //     }else{
                $scope.item[index].autosave = 'saved';
                $scope.floadItem();
        //     }
        // });
       
    }

    $scope.validateStocks = function(id){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'expensevalidatestock',
                'expenseid': id
            }
        }).success(function(data){
            // console.log(data, 'hello');
            $scope.invalidStock = data;
        });
    }


    $scope.$watch('main', function(){
        $scope.savemain();
    }, true);

    $scope.savemain = function(){
        // console.log('sdgagsdgsdg')
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'expenseSavemain',
                'data' : $scope.main
            }
        }).success(function(res){
            // console.log(res);
        });
    }

    $scope.updatecategory = function(){
        var data = angular.copy($scope.category);
        var category = [];
        angular.forEach(data,function(val){
            angular.forEach(val,function(v){
                category.push(v);
            })
        });

        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'ExpenseUpdatecategory',
                'data': data
            }
        }).success(function(datas){
            $scope.loadActiveExpense($scope.main.expenseid);
            // console.log(datas,'HHHH');
            // $scope.inSave ? $scope.loadStockPO($scope.main.pom_id) : '';
            // $scope.inSave = false;
            // $scope.loadStockPO($scope.main.pom_id);
            // setTimeout($scope.loadStockPO($scope.main.pom_id), 4000);
        });
    }

    $scope.addrow = function(mod){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'expenseAddrow',
                'expenseid' : $scope.main.expenseid,
                'mod' : (mod == 'cat' ? 'expense_category' : 'expense_item'),
                'rate' : $scope.lrate
            }
        }).success(function(res){
            $scope.loadActiveExpense($scope.main.expenseid);
        });
    }

    $scope.removerow = function(mod, id){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'expenseRemoverow',
                'id' : id,
                'expenseid' : $scope.main.expenseid,
                'mod' : (mod == 'cat' ? 'expense_category' : 'expense_item')
            }
        }).success(function(res){
            $scope.loadActiveExpense($scope.main.expenseid);
        });
    }

    $scope.loadexpenseslist = function(){

        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'loadexpenseslist'
            }
        }).success(function(user_data){
            // console.log(user_data), 'listdata';
            $scope.file = user_data;
            $scope.current_grid = 1;
            $scope.data_limit = 10;
            $scope.filter_data = $scope.file.length;
            $scope.entire_user = $scope.file.length;
        });
    }
    
    $scope.save = function(){
        $scope.validateStocks($scope.main.expenseid);
        $scope.validate = true;

        if($scope.invalidStock >= 1){
            toastr.error('Ops please fill-up all fields!');
            var required = true;
        }else{
            var data = $scope.main;
            if(data.payeeid === '' || data.paymentaccount === '' || data.paymentdate === '' || data.paymentmethod === '' || data.referenceno === ''){
                toastr.error('Ops please fill-up all fields!');
                var required = true;
            }else{
                var required = false;
                $scope.validate = false;
                $scope.validatemain = false;
            }
        }

        if(!required){
            $http({
                method:"POST",
                url:"app-controller/php-function/function.php",
                data:{
                    'action':'saveExpense',
                    'id':$scope.main.expenseid,
                    'accountid':$scope.main.paymentaccount
                }
            }).success(function(res){
                // console.log(res,'expenseCheck')
                if(res.message == 'success'){
                    Swal.fire({
                        position: 'center',
                        type: 'success',
                        title: 'Expense has been successfully saved!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(){
                        _init();
                        // var logsdata = {
                        //     'event' : 'Add',
                        //     'description' : 'Added New User: '+ resp.username,
                        //     'module' : 'PURCHASE ORDER'
                        // }
                        // $scope.saveAuditLogs(logsdata);
                    })
                }else{
                    toastr.error('An error has been occured!');
                }
            });
        }
    }

    return _init();
});