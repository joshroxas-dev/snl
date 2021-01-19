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

app.controller('reportsController', function($scope, $http, $timeout){
    $scope.success = false;
    $scope.error = false;
    $scope.data = [];
    $scope.data.supplierid = 'ALL';
    $scope.data.stocksid = 'ALL';
    $scope.init = function(){
        console.log('LOAD INIT');

       // $scope.loadselectedsupplier(0);
        $scope.loadcustomerorderlist();

        //supplier
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
    }

$scope.loadcustomerorderlist = function(){
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

        $scope.loadselectedsupplier = function(supplierid){
            $http({
                method:"POST",
                url:"app-controller/php-function/reports.php",
                data:{
                    'supplierid': supplierid,
                    'action':'loadsupplierlist',
                }
            }).success(function(user_data){
                console.log(user_data, 'yayyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy');
                $scope.file = user_data;
                $scope.current_grid = 1;
                $scope.data_limit = 10;
                $scope.filter_data = $scope.file.length;
                $scope.entire_user = $scope.file.length;
            });
        }

        $scope.loadselectedproduct = function(stocksid){
            $http({
                method:"POST",
                url:"app-controller/php-function/reports.php",
                data:{
                    'stocksid': stocksid,
                    'action':'loadproductlist',
                }
            }).success(function(user_data){
                //console.log(user_data, 'yayyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy');
                $scope.file = user_data;
                $scope.current_grid = 1;
                $scope.data_limit = 10;
                $scope.filter_data = $scope.file.length;
                $scope.entire_user = $scope.file.length;
            });
        }


    $scope.getsupplierinfo = function(res) {
        console.log(res, 'SUPPLIER INFO');
        $http({
            method:"POST",
            url:"app-controller/php-function/reports.php",
            data:{
                'id'    : res,
                'action':'getSupplierInfo',
            }
        }).success(function(datas){
            console.log(datas.data,'getSupplierInfo')
            if(datas.message == 'success'){
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


    
    $scope.getproductinfo = function(res) {
        console.log(res, 'product INFO');
        $http({
            method:"POST",
            url:"app-controller/php-function/reports.php",
            data:{
                'id'    : res,
                'action':'getProductInfo',
            }
        }).success(function(datas){
            console.log(datas.data,'getProductInfo')
            if(datas.message == 'success'){
                if(datas.data){
                    $scope.showstockinfo = {};
                    $scope.showstockinfo = datas.data;
                    $scope.data.stockname = $scope.showstockinfo.stockname;
                }else{
                    toastr.error('An error has been occured!');
                }
            }else{
                
            }
        });
        
    }

    $scope.getstockinfo = function(res) {
        console.log(res, 'STOCK INFO');
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : res,
                'action':'getProdlist',
            }
        }).success(function(datas){
            console.log(datas.data,'getProdlist')
            if(datas.message == 'success'){
                if(datas.data){
                    $scope.showstockinfo = {};
                    $scope.showstockinfo = datas.data;
                    //$scope.data.stockname = $scope.showstockinfo.stockname;
                }else{
                    toastr.error('An error has been occured!');
                }
            }else{
                
            }
        });
        
    }



    $scope.getCurrentReportPage = function(data){
        $scope.phppage = data;
        }

        
    /* ----------------------- PAGE LOAD FOR TABLES AND DETECT CURRENT PHP PAGE  ------------------ */

    //purchase by supplier details
    $scope.loadpurchsuppdet = function(){
        $http({
            method:"POST",
            url:"app-controller/php-function/reports.php",
            data:{
                'action':'getpurchsuppdet'
            }
        }).success(function(datas){
            console.log(datas,'hello');
         
                if(datas){
                    $scope.data = {};
                    $scope.data = datas;

                }else{
                    toastr.error('An error has been occured!');
                }
            
        });
    }

    //load function
    if($scope.phppage = 'rep_purchsuppdet.php'){
        $http.get('app-controller/php-function/customerorder-report.php').success(function(user_data) {
            $scope.file = user_data;
            $scope.current_grid = 1;
            $scope.data_limit = 10;
            $scope.filter_data = $scope.file.length;
            $scope.entire_user = $scope.file.length;
        });
        console.log("true");
    }else{
        console.log("false");
    }

    


      //Transaction List by Date
      $scope.loadtransaclistdate = function(){
        $http({
            method:"POST",
            url:"app-controller/php-function/reports.php",
            data:{
                'action':'gettransaclistdate'
            }
        }).success(function(datas){
            console.log(datas,'hello');
                if(datas){
                    $scope.data = {};
                    $scope.data = datas;

                }else{
                    toastr.error('An error has been occured!');
                }
        });
    }


 //purchaseproduct
 $scope.loadpurchasebyproduct = function(){
    $http({
        method:"POST",
        url:"app-controller/php-function/reports.php",
        data:{
            'action':'getpurchasebyproduct'
        }
    }).success(function(datas){
        console.log(datas,'hello');
            if(datas){
                $scope.data = {};
                $scope.data = datas;

            }else{
                toastr.error('An error has been occured!');
            }
    });
}
 //load function
 if($scope.phppage = 'rep_purchasebyproduct.php'){
    $scope.loadpurchasebyproduct();
    console.log("true");
}else{
    console.log("false");
}



 //load function
 if($scope.phppage = 'rep_transcalistdate.php'){
    $scope.loadtransaclistdate();
    console.log("true");
}else{
    console.log("false");
}


   //purchase by supplier details
   $scope.loadprofitlossbymonth = function(){
    $http({
        method:"POST",
        url:"app-controller/php-function/reports.php",
        data:{
            'action':'loadprofitlossbymonth'
        }
    }).success(function(datas){
        //console.log(datas,'hello');
            if(datas){
                $scope.data = {};
                $scope.data = datas;

            }else{
                toastr.error('An error has been occured!');
            }
        
    });
}

 //load function
 if($scope.phppage = 'rep_profitandlossbymonth.php'){
    $scope.loadprofitlossbymonth();
    console.log("true");
}else{
    console.log("false");
}


 //customer balance summary
 $scope.loadcustomerbalsum = function(){
    $http({
        method:"POST",
        url:"app-controller/php-function/reports.php",
        data:{
            'action':'getcustomerbalsum'
        }
    }).success(function(datas){
        console.log(datas,'hello0000000');
     
            if(datas){
            $scope.file = datas;
            $scope.current_grid = 1;
            $scope.data_limit = 10;
            $scope.filter_data = $scope.file.length;
            $scope.entire_user = $scope.file.length;

            }else{
                toastr.error('An error has been occured!');
            }
        
    });
}

//load function
if($scope.phppage = 'rep_customerbalsummary.php'){
    $scope.loadcustomerbalsum();
    console.log("true");
}else{
    console.log("false");
}




    $scope.init();




});