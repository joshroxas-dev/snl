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

app.controller('purchaseorderController', function($scope, $http, $timeout){

    $scope.validate = false;
    $scope.mainForm = false;
    $scope.showprodinfo = false;
    $scope.data = {};
    $scope.main = {};
    $scope.view = 'main';
    $scope.inSave = false;
    $scope.hasActive = false;
    $scope.poType = 'edit';
    $scope.isMain = true;
    $scope.validatemain = false;
    $scope.cancelm = false;
    $scope.existval = {};
    $scope.existval.batchnumber = false;
    $scope.existval.ordernumber = false;

    _init = function(){
        // console.log('TEST INIT')
        $scope.validatemain = false;
        $scope.loadpurchasemain('placed');
        $scope.loadActive('active');

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

        $scope.loadVAT();

        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'getCourierlist',
            }
        }).success(function(datas){
            // console.log(datas,'hello')
            if(datas.message == 'success'){
                $scope.courier = {};
                $scope.courier = datas.data;
            }
        });

    };

    $scope.loadVAT = function(){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'getVat',
            }
        }).success(function(datas){
            // console.log(datas,'hellovat')
            if(datas.message == 'success'){
                $scope.vat = datas.data.sys_value;
            }
        });
    }

    $scope.saveVAT = function(vatdata){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'saveVat',
                'sys_vat': vatdata
            }
        }).success(function(datas){
            if(datas.message == 'success'){
                toastr.success('VAT has been successfully updated.');
                $scope.loadVAT();
            }
        });
    }

    $scope.cancelEdit = function(){
        $scope.loadActive('active');
        $scope.cancelm = true; 
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


    $scope.loadActive = function(id, type){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'getActivePO',
                'id'    : id
            }
        }).success(function(datas){
            // console.log(datas,'hellddddo')
            if(datas.message == 'success'){
                $scope.hasActive = true;
                $scope.poType = 'active';

                $scope.main = {};
                $scope.mainold = {};
                $scope.main = datas.data;
                $scope.placedorder = datas.data.status == 'placed' ? true : false;
                $scope.mainold = datas.data;
                $scope.main.purchasedate = datas.data.purchasedate == '0000-00-00' ? '' : new Date(datas.data.purchasedate);
                $scope.loadStockPO(datas.data.pom_id);
                $scope.validateStocks($scope.main.pom_id);
                if($scope.cancelm){
                    toastr.success('Unsaved Purchase Order has been successfully loaded!.');
                    $scope.cancelm = false;
                }
                compareValues();
            }else{
                $scope.loadfieldmain();
                $scope.hasActive = false;
                $scope.poType = 'new';
                $scope.loadCurrentRate();
                $scope.cancelm = false;
                compareValues();

            }
        });
    }

    // $scope.$watch('main', function() {
        // console.log('an input has changed'); //this will never fire
    //     $scope.result = angular.equals($scope.main, $scope.mainold);
    // }, true);

    var compareValues = function(){        
        $scope.mainold = angular.copy($scope.main);
        $scope.$watch('main', function(){
            $scope.isOLD = angular.equals($scope.mainold, $scope.main);
        }, true);
    }

    $scope.$watch('main', function(){
        $scope.isOLD = angular.equals($scope.mainold, $scope.main);
    }, true);


    $scope.userpage = function(type, id){
        $scope.view = type;
        $scope.loadActive('active');
    }

    $scope.loadfieldmain = function() {
        $scope.main.batchnumber = '';
        $scope.main.ordernumber = '';
        $scope.main.exchangerate = '';
        $scope.main.freightinperunit = '';
        $scope.main.trackingnumber = '';
        $scope.main.purchasedate = '';
        $scope.main.creditcard = '';
        $scope.main.courierid = '';
        $scope.main.remarks = '';
    }

    $scope.getproddinfo = function(id, index, poid) {
        // console.log(id, index, 'PROD INFO');
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : id,
                'poid'  : poid,
                'action':'getProdInfo',
                'pom_id': $scope.main.pom_id
            }
        }).success(function(datas){
            // console.log(datas,'getProdInfo')
            if(datas.exist){
                toastr.error('This Product is already selected!');
                $scope.postock[index].stocksid = '';
                $scope.postock[index].quantity = '';
                $scope.postock[index].unitpricephp = '';
            }else{
                if(datas.message == 'success'){
                    if(datas.data){
                        $scope.postock[index].quantity = '';
                        $scope.postock[index].unitpricephp = datas.data.unitprice;
                        $scope.inSave = true;
                    }else{
                        toastr.error('An error has been occured!');
                    }
                }else{
                    toastr.error('An error has been occured!');
                }
            }
            $scope.floadPO();
        });
        
        
    }

    $scope.applyMain = function(data) {
        // console.log($scope.poType, data,'SAVING');
        $scope.validatemain = true;
        if($scope.poType == 'active'){
            if(data.batchnumber === '' || data.ordernumber === '' || data.exchangerate === ''){
                toastr.error('Ops please fill-up all required fields!');
            }else{
                $http({
                    method:"POST",
                    url:"app-controller/php-function/function.php",
                    data:{
                        'action':'updateActivePO',
                        'id'    : data.id,
                        'pom_id'    : data.pom_id,
                        'batchnumber'    : data.batchnumber,
                        'ordernumber'    : data.ordernumber,
                        'exchangerate'    : data.exchangerate,
                        'freightinperunit'    : data.freightinperunit,
                        'trackingnumber'    : data.trackingnumber,
                        'purchasedate'    : data.purchasedate,
                        'creditcard'    : data.creditcard,
                        'courierid'    : data.courierid,
                        'remarks'    : data.remarks,
                    }
                }).success(function(res){
                    // console.log(res);
                    toastr.success('Purchase Order detail has been successfully updated.');
                    var logsdata = {
                        'event' : 'Update',
                        'description' : 'Updated Purchase Order: Order Number - '+ data.ordernumber,
                        'module' : 'PURCHASE ORDER'
                    }
                    $scope.saveAuditLogs(logsdata);
                    $scope.loadpurchasemain('placed');
                    $scope.loadStockPO(data.pom_id);
                    compareValues();
                    // _init();
                })
            }
        }
        if($scope.poType == 'new'){
            if(data.batchnumber === '' || data.ordernumber === ''){
                toastr.error('Ops please fill-up all required fields!');
            }else{
                $http({
                    method:"POST",
                    url:"app-controller/php-function/function.php",
                    data:{
                        'action':'saveNewPO',
                        'batchnumber'    : data.batchnumber,
                        'ordernumber'    : data.ordernumber,
                        'exchangerate'    : data.exchangerate,
                        'freightinperunit'    : data.freightinperunit,
                        'trackingnumber'    : data.trackingnumber,
                        'purchasedate'    : data.purchasedate,
                        'creditcard'    : data.creditcard,
                        'courierid'    : data.courierid,
                        'remarks'    : data.remarks,
                    }
                }).success(function(res){
                    // console.log(res);
                    toastr.success('Purchase Order detail has been successfully saved.');
                    var logsdata = {
                        'event' : 'Add',
                        'description' : 'Added new Purchase Order: Order ID - ' + data.ordernumber,
                        'module' : 'PURCHASE ORDER'
                    }
                    $scope.saveAuditLogs(logsdata);
                    _init();
                })
            }
        }
    }

    $scope.editPurchasedPO = function(id){
        $scope.view = 'main';
        $scope.loadActive(id);
    }

    $scope.loadStockPO = function(id){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'getStockPOt',
                'pom_id': id
            }
        }).success(function(datas){
            if(datas.data){
                if(datas.message == 'success'){
                    $scope.postock = [];
                    $scope.postock = datas.data;
                    $scope.total = datas.total;
                }
            }else{
                $scope.postock = []; 
                $scope.total = '0.00';
            }
            // console.log($scope.postock, 'helllllllll')
        });
    }

    $scope.newStockRow = function(){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'addstockrow',
                'pom_id': $scope.main.pom_id,
                'rate': $scope.main.exchangerate,
            }
        }).success(function(datas){
            // console.log(datas,'STOCK PO')
            if(datas.message == 'success'){
                $scope.loadStockPO($scope.main.pom_id);
            }
        });
    }

    $scope.setQuantity = function(val, val2, val3, index, id, sid, ablQty) {
        // console.log(val, val2, val3, index, id, ablQty);
        
        $scope.postock[index].totalpricephp = val3 * (val * val2);

        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'resetquantitystock',
                'id': id,
                'qty': val,
            }
        }).success(function(datas){
            // console.log(datas,'STOCK PO')
            if(datas.outofstocks){
                $scope.postock[index].quantity = '0';
                toastr.error('Insufficient Quantity!');
                $scope.loadStockPO($scope.main.pom_id);
            }else{
                $scope.postock[index].autosave = 'saved';
                $scope.floadPO();
            }
        });
       
    }

    $scope.setRateR = function(id, val, index) {
        console.log(id, val);

        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'setRateR',
                'id': id,
                'rate': val,
            }
        }).success(function(datas){
            // console.log(datas,'STOCK PO')
            if(datas.message){
                $scope.postock[index].autosave = 'saved';
                $scope.floadPO();
            }
        });
       
    }

    $scope.checkIfExist = function(type, text){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'checkIfExist',
                'type': type,
                'text': text,
                'active': $scope.poType,
                'pom_id' : $scope.main.pom_id,
            }
        }).success(function(datas){
            // console.log(datas, $scope.poType, 'CHECK EXIST VALIDATE')
            
            if(datas.type == 'batchnumber'){
                $scope.existval.batchnumber = datas.exist;
            }else{
                $scope.existval.ordernumber = datas.exist;
            }

            $scope.existmain = $scope.existval.batchnumber || $scope.existval.ordernumber;

            // console.log($scope.existval, $scope.existmain)
        });
    }

    $scope.delPOdraft = function(pom_id){
        // console.log(pom_id,'delete draft item')
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
                        'action':'delPOdraftf',
                        'pom_id': pom_id
                    }
                }).success(function(datas){
                    if(datas.message == 'success'){
                        $scope.loadpurchasemain('draft');
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
        

        // $http({
        //     method:"POST",
        //     url:"app-controller/php-function/function.php",
        //     data:{
        //         'action':'delPOdraft',
        //         'id': id
        //     }
        // }).success(function(datas){
            console.log(datas,'STOCK PO')
        //     if(datas.message == 'success'){
                console.log('wwwww')
        //     }
        // });
    }

    $scope.delStockRow = function(id){
        // console.log(id,'feeee')
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'dellstockrow',
                'id': id
            }
        }).success(function(datas){
            // console.log(datas,'STOCK PO')
            if(datas.message == 'success'){
                $scope.loadStockPO($scope.main.pom_id);
                // console.log('wwwww')
            }
        });
    }

    $scope.$watch('postock.stocksid', function(){
        
        $scope.floadPO();
        // console.log(postock,'multiple')
    }, true);

    $scope.$watch('postock', function(){
        
        $scope.validateStocks($scope.main.pom_id);
        // console.log(postock,'multiple')
    }, true);

    $scope.floadPO = function(){
        var data = angular.copy($scope.postock);
        var postock = [];
        angular.forEach(data,function(val){
            angular.forEach(val,function(v){
                postock.push(v);
            })
        });

        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'updatestocks',
                'data': data
            }
        }).success(function(datas){
            $scope.inSave ? $scope.loadStockPO($scope.main.pom_id) : '';
            $scope.inSave = false;
            $scope.loadStockPO($scope.main.pom_id);
            // setTimeout($scope.loadStockPO($scope.main.pom_id), 4000);
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
            toastr.success('Latest exchage rate has been successfully loaded.');
            $scope.main.exchangerate = response.data.rates.USDPHP.rate;
            
        }).catch(function(response) {
            // console.log(response)
            
        })
    }

    // KHEN CODE HERE
    

    $scope.loadpurchasemain = function(type){
        
        // $http.get('app-controller/php-function/purchaseordermain.php').success(function(user_data) {
            
        //    console.log(user_data);
        //     $scope.file = user_data;
        //     $scope.current_grid = 1;
        //     $scope.data_limit = 10;
        //     $scope.filter_data = $scope.file.length;
        //     $scope.entire_user = $scope.file.length;
        // });

        $scope.page2 = type;

        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'loadPOlist',
                'status': type
            }
        }).success(function(user_data){
            // console.log(user_data);
            $scope.file = user_data;
            $scope.current_grid = 1;
            $scope.data_limit = 10;
            $scope.filter_data = $scope.file.length;
            $scope.entire_user = $scope.file.length;
        });
    }

    $scope.validateStocks = function(id){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'validatestock',
                'pom_id': id
            }
        }).success(function(data){
            // console.log(data, 'hello');
            $scope.invalidStock = data;
        });
    }

    // console.log('active', $scope.main.pom_id)

    $scope.save = function(type){
        // console.log(type);
        if(type == 'placed'){
            $scope.validateStocks($scope.main.pom_id);
            $scope.validate = true;
            $scope.validatemain = true;

            if($scope.invalidStock >= 1){
                toastr.error('Ops please fill-up all fields!');
                var required = true;
            }else{
                var data = $scope.main;
                if(data.batchnumber === '' || data.ordernumber === '' || data.exchangerate === '' || data.freightinperunit === '' || data.trackingnumber === '' || data.purchasedate === '' || data.creditcard === '' || data.freightinperunit === ''){
                    toastr.error('Ops please fill-up all fields!');
                    var required = true;
                }else{
                    var required = false;
                    $scope.validate = false;
                    $scope.validatemain = false;
                }
            }
        }else{
            $scope.validate = false;
            var required = false;
        }

        if(!required){
            $http({
                method:"POST",
                url:"app-controller/php-function/function.php",
                data:{
                    'action':'POfinalsave',
                    'pom_id': $scope.main.pom_id,
                    'status': type,
                    'sys_vat': $scope.vat
                }
            }).success(function(datas){
                if(datas.message == 'success'){
                    Swal.fire({
                        position: 'center',
                        type: 'success',
                        title: 'Purchase Order has been successfully '+ type +'!',
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


    // END KHEN CODE HERE

    return _init();
});