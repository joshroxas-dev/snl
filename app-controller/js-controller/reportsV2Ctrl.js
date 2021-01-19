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

app.controller('reportsV2Controller', function($scope, $http, $timeout){

    var _init = function(){
        $scope.module = 'main';
    }

    $scope.openModule = function(module){
        $scope.module = module;

        $scope.loadModuleData(module);
    }

    $scope.loadModuleData = function(module){

        if(module === 'purchasebyproduct'){
            // console.log('purchasebyproduct');
            $http({
                method:"POST",
                url:"app-controller/php-function/reportsV2.php",
                data:{
                    'action':'getpurchasebyproduct'
                }
            }).success(function(response){
                // console.log(response, module);
                    if(response){
                        $scope.dataPurchasebyproduct = [];
                        $scope.dataPurchasebyproduct = response.data;
                        $scope.purchasebyproductTotal = response.total;
                    }else{
                        toastr.error('An error has been occured!');
                    }
            });
        }

        //---------------------------- DIVISION ----------------------------

        if(module === 'customerbalsummary'){
            // console.log('customerbalsummary');
            $http({
                method:"POST",
                url:"app-controller/php-function/reportsV2.php",
                data:{
                    'action':'getcustomerbalsummary'
                }
            }).success(function(response){
                // console.log(response, module);
                    if(response){
                        $scope.dataCustomerbalsummary = [];
                        $scope.dataCustomerbalsummary = response.data;
                        $scope.customerbalsummary = response.total;
    
                    }else{
                        toastr.error('An error has been occured!');
                    }
            });
        }

        //---------------------------- DIVISION ----------------------------

        if(module === 'transaclistdate'){
            // console.log('transaclistdate');
            $http({
                method:"POST",
                url:"app-controller/php-function/reportsV2.php",
                data:{
                    'action':'gettransaclistdate'
                }
            }).success(function(response){
                // console.log(response, module);
                    if(response){
                        $scope.dataTransaclistdate = [];
                        $scope.dataTransaclistdate = response.data;
                        $scope.transaclistdatetotal = response.total;
    
                    }else{
                        toastr.error('An error has been occured!');
                    }
            });
        }

          //---------------------------- DIVISION ----------------------------

        if(module === 'purchsuppdet'){
            // console.log('purchsuppdet');
            $http({
                method:"POST",
                url:"app-controller/php-function/reportsV2.php",
                data:{
                    'action':'getpurchsuppdet'
                }
            }).success(function(response){
                // console.log(response, module);
                    if(response){
                        $scope.dataPurchsuppdet = [];
                        $scope.dataPurchsuppdet = response.data;
                        $scope.dataPurchsuppdettotal = response.total;
    
                    }else{
                        toastr.error('An error has been occured!');
                    }
            });
        }
         //---------------------------- DIVISION ----------------------------

        if(module === 'purchsuppdet'){
            // console.log('purchsuppdet');
            $http({
                method:"POST",
                url:"app-controller/php-function/reportsV2.php",
                data:{
                    'action':'getpurchsuppdet'
                }
            }).success(function(response){
                // console.log(response, module);
                    if(response){
                        $scope.dataPurchsuppdet = [];
                        $scope.dataPurchsuppdet = response.data;
                        $scope.dataPurchsuppdettotal = response.total;
    
                    }else{
                        toastr.error('An error has been occured!');
                    }
            });
        }

             //---------------------------- DIVISION ----------------------------

        if(module === 'journal'){
            // console.log('journal');
            $http({
                method:"POST",
                url:"app-controller/php-function/reportsV2.php",
                data:{
                    'action':'getjournal'
                }
            }).success(function(response){
                // console.log(response, module);
                    if(response){
                        $scope.dataJournal = [];
                        $scope.dataJournal = response;
    
                    }else{
                        toastr.error('An error has been occured!');
                    }
            });
        }

        //---------------------------- DIVISION ----------------------------

        if(module === 'transaccount'){
            // console.log('transaccount');
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
                    $scope.categexpid = datas.data[0].categexpid;

                    $scope.loadCatData($scope.categexpid);
                }
            });

            $scope.loadCatData = function(categexpid){
                // console.log(categexpid, 'testtttt');
            $http({
                method:"POST",
                url:"app-controller/php-function/reportsV2.php",
                data:{
                    'action':'transaccount',
                    'categexpid': categexpid
                }
            }).success(function(response){
                // console.log(response, module);
                    if(response){
                        $scope.datatransaccount = [];
                        $scope.datatransaccount = response.data;
                        $scope.datatransaccounttotal = response.total;
    
                    }else{
                        toastr.error('An error has been occured!');
                    }
            });
            }
        }

        
        //---------------------------- DIVISION ----------------------------

        if(module === 'billpaymentlist'){
            // console.log('billpaymentlist');
            $http({
                method:"POST",
                url:"app-controller/php-function/function.php",
                data:{
                    'action':'getModeofpaymentlist',
                }
            }).success(function(datas){
                // console.log(datas,'getModeofpaymentlist')
                if(datas.message == 'success'){
                    $scope.moplist = {};
                    $scope.moplist = datas.data;
                    $scope.mopid = datas.data[0].mopid;
                    $scope.loadmopData($scope.mopid);
                }
            });

            $scope.loadmopData = function(mopid){
                // console.log(mopid, 'Test');
            $http({
                method:"POST",
                url:"app-controller/php-function/reportsV2.php",
                data:{
                    'action':'billpaymentlist',
                    'mopid': mopid
                }
            }).success(function(response){
                // console.log(response, module);
                    if(response){
                        $scope.dataBillpaymentlist = [];
                        $scope.dataBillpaymentlist = response.data;
                        $scope.dataBillpaymenttotal = response.total;
    
                    }else{
                        toastr.error('An error has been occured!');
                    }
            });
            }
        }

        //---------------------------- DIVISION ----------------------------

        if(module === 'cheqdet'){
            // console.log('cheqdet');
            $http({
                method:"POST",
                url:"app-controller/php-function/function.php",
                data:{
                    'action':'getCreditcardlist',
                }
            }).success(function(datas){
                // console.log(datas,'getCreditcardlist')
                if(datas.message == 'success'){
                    $scope.creditcardlist = {};
                    $scope.creditcardlist = datas.data;
                    $scope.creditcardid = datas.data[0].creditcardid;
                    $scope.loadccData($scope.creditcardid);
                }
            });

            $scope.loadccData = function(creditcardid){
                // console.log(creditcardid, 'Test');
            $http({
                method:"POST",
                url:"app-controller/php-function/reportsV2.php",
                data:{
                    'action':'creditcardlist',
                    'creditcardid': creditcardid
                }
            }).success(function(response){
                // console.log(response, module);
                    if(response){
                        $scope.dataCheqdetlist = [];
                        $scope.dataCheqdetlist = response.data;
                        $scope.dataCheqdettotal = response.total;
    
                    }else{
                        toastr.error('An error has been occured!');
                    }
            });
            }
        }

         //---------------------------- DIVISION ----------------------------

         if(module === 'openinvoice'){
            // console.log('openinvoice');
            $http({
                method:"POST",
                url:"app-controller/php-function/reportsV2.php",
                data:{
                    'action':'getOpeninvoicelist'
                }
            }).success(function(response){
                // console.log(response, module);
                    if(response){
                        $scope.dataOpeninvoicelist = [];
                        $scope.dataOpeninvoicelist = response;
                        // $scope.dataOpeninvoicetotal = response.total;
    
                    }else{
                        toastr.error('An error has been occured!');
                    }
            });
        }

           //---------------------------- DIVISION ----------------------------

        if(module === 'profitlossincome'){
            // console.log('profitlossincome');
            $http({
                method:"POST",
                url:"app-controller/php-function/reportsV2.php",
                data:{
                    'action':'getProfitlossincome'
                }
            }).success(function(response){
                // console.log(response, module);
                    if(response){
                        $scope.dataCustomerorder = response.data;
                        $scope.dataPurchaseorder = response.dataPo;
                        $scope.dataShippingIncome = response.shippingfeetotal;
                        $scope.dataTotalPOCO = response.datatotalPOCO;
                        $scope.dataExp = response.dataExp;
                        $scope.dataNetearning = response.dataNetearning;
                        $scope.dataGrossprofit = response.dataGrossprofit;

                    }else{
                        toastr.error('An error has been occured!');
                    }
            });
        }

        //---------------------------- DIVISION ----------------------------

        if(module === 'profitandlossbymonth'){
            // console.log('profitandlossbymonth');
            $http({
                method:"POST",
                url:"app-controller/php-function/reportsV2.php",
                data:{
                    'action':'getYearplm'
                }
            }).success(function(response){
                // console.log(response, module);
                    if(response){
                        $scope.listplmyear = response.data;
                        $scope.profitandlossbymonthfilter = response.data[0].year;

                        $scope.loadPLMdata($scope.profitandlossbymonthfilter);
                    }else{
                        toastr.error('An error has been occured!');
                    }
            });

            $scope.loadPLMdata = function(year){
                $http({
                    method:"POST",
                    url:"app-controller/php-function/reportsV2.php",
                    data:{
                        'action':'profitandlossbymonth',
                        'year'  : year
                    }
                }).success(function(response){
                    // console.log(response, module);
                        if(response){
                            $scope.dataPO = response.dataPO;
                            $scope.dataCO = response.dataCO;
                            $scope.dataExp = response.dataExp;
                            $scope.totalPOCO = response.totalPOCO;
                            $scope.totalCOG = response.totalCOG;
                            $scope.totalExp = response.totalExp;
                        }else{
                            toastr.error('An error has been occured!');
                        }
                });
            }
        }

    //---------------------------- end module close ----------------------------

    }

    return _init();

});
