var app = angular.module('appCon', ['ng-currency']);


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
app.controller('customerorderController', function($scope, $http, $timeout){

    $scope.validate = false;

    $scope.showprodinfo = false;
    
    $scope.data = {};

    $scope.view = 'main';

   
  _init = function(){
        console.log('LOAD INIT');
        $scope.mode = 'add';
        $scope.loadcustomerorderlist();
        $scope.loadcurrentrate();
    }
    $scope.loadcustomerorderlist = function(){
        
        $http.get('app-controller/php-function/customerorder.php').success(function(user_data) {
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

    $scope.loadcustomerorderlist = function(){
        
        $http.get('app-controller/php-function/customerorder.php').success(function(user_data) {
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

        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'getProdlist',
            }
        }).success(function(datas){
            console.log(datas,'hello')
            if(datas.message == 'success'){
                $scope.prodlist = {};
                $scope.prodlist = datas.data;
            }
        });
        
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'getCourierlist',
            }
        }).success(function(datas){
            console.log(datas,'hello')
            if(datas.message == 'success'){
                $scope.courierlist = {};
                $scope.courierlist = datas.data;
            }else{
            }
            
        });


        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'orderNumber',
            }
        }).success(function(datas){
            console.log(datas,'hello')
            if(datas.message == 'success'){
                // $scope.prodlist = {};
                // $scope.prodlist = datas.data;
            }
        });

        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'getCustomerlist',
            }
        }).success(function(datas){
            console.log(datas,'hello')
            if(datas.message == 'success'){
                $scope.customerlist = {};
                $scope.customerlist = datas.data;
            }else{
            }
            
        });

        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'getcustomerorderinfo',
            }
        }).success(function(datas){
            console.log(datas,'hello')
            if(datas.message == 'success'){
                $scope.customerorderlist = {};
                $scope.customerorderlist = datas.data;
            }else{
            }
            
        });


        //mode of payment
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'getModeofpaymentlist',
            }
        }).success(function(datas){
            console.log(datas,'hello')
            if(datas.message == 'success'){
                $scope.modeofpaymentlist = {};
                $scope.modeofpaymentlist = datas.data;
            }else{
            }
            
        });

        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'getmodeofpaymentinfo',
            }
        }).success(function(datas){
            console.log(datas,'hello')
            if(datas.message == 'success'){
                $scope.modeofpaymentlist = {};
                $scope.modeofpaymentlist = datas.data;
            }else{
            }
            
        });
        

$scope.loadcurrentrate = function(){
    
    var proxy = "//cors-anywhere.herokuapp.com";
    var url = "https://www.freeforexapi.com/api/live?pairs=USDPHP";
    $http.get(proxy +'/'+ url)
    .then(function(response) {
        console.log(response);
        $scope.updatedat = response.data.rates.USDPHP.timestamp * 1000;
        $scope.lrate = response.data.rates.USDPHP.rate;
        toastr.success('Latest exchage rate has been successfully loaded.');
        $scope.data.exchangerate = response.data.rates.USDPHP.rate;
        
    }).catch(function(response) {
        console.log(response)
        
    }) 
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
    $scope.getcustomerinfo = function(res) {
        console.log(res, 'CUSTOMER INFO');
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : res,
                'action':'getcustomerinfo',
            }
        }).success(function(datas){
            console.log(datas.data,'getcustomerinfo')
            if(datas.message == 'success'){
                $scope.showcustomerinfo = true;
                if(datas.data){
                    $scope.showcustomerinfo = {};
                    $scope.showcustomerinfo = datas.data;
                    $scope.data.customerid = $scope.showcustomerinfo.customerid;
                    $scope.data.customerfirstname = $scope.showcustomerinfo.customerfirstname;

                }else{
                    toastr.error('An error has been occured!');
                }
            }else{
                
            }
        });
    }

    $scope.getprodinfo = function(res) {
        console.log(res, 'PROD INFO');
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : res,
                'action':'getProdInfo2',
            }
        }).success(function(datas){
            console.log(datas.data,'getProdInfo')
            if(datas.message == 'success'){
                $scope.showprodinfo = true;
                if(datas.data){
                    $scope.prodinfo = {};
                    $scope.prodinfo = datas.data;
                    $scope.prodinfo.imgurl = datas.imgurl;
                    $scope.data.stockname = $scope.prodinfo.stockname;
                    $scope.data.stockcolor = $scope.prodinfo.stockcolor;
                    $scope.data.stocksize = $scope.prodinfo.stocksize;
                    $scope.data.supplierid = $scope.prodinfo.supplierid;
                    $scope.data.unitpricedollars = $scope.prodinfo.unitprice;
                    $scope.data.unitpricephp = $scope.data.unitpricedollars * $scope.data.exchangerate;

                }else{
                    toastr.error('An error has been occured!');
                }
            }else{
                toastr.error('An error has been occured!');
            }
        });
        
    }

    $scope.setQuantity = function(val, val2, val3) {
        $scope.data.totalpricephp = val2 * val;
        $scope.data.totalpricedollars = val3 * val;
    }

    $scope.setRate  = function(rate, qty, price){
        $scope.data.unitpricephp = price * rate;
        $scope.data.totalpricephp = $scope.data.unitpricephp * qty;
        $scope.data.totalpricedollars = price * qty;

    }


    $scope.save = function(data, type){
        $scope.mode = type;
        console.log(data, 'RETURN DATA');
if($scope.mode == 'add'){
        $scope.validate = true;
            if(data.ordernumber === '' || data.customerid === '' || data.productid === '' || data.purchasedate === ''){
                toastr.error('Oops please fill-up all required fields!');
            }else{
                console.log(data, 'add');
                $http({
                    method:"POST",
                    url:"app-controller/php-function/function.php",
                    data:{
                        'action':'saveCustomerOrder',
                        'customerid': data.customerid,
                        'ordernumber':data.ordernumber,
                        'productid': data.productid,
                        'supplierid': data.supplierid,
                        'modeofpayment': data.modeofpayment,
                        'courierid': data.courierid,
                        'orderplatform': data.orderplatform,
                        'quantity': data.quantity,
                        'shippingfee': data.shippingfee,
                        'shippingdate': data.shippingdate,
                        'purchasedate': data.purchasedate,
                        'totalamountdollar': data.totalpricedollars,
                        'totalamountpesos': data.totalpricephp,
                        'exchangerate': data.exchangerate,
                        'remarks': data.remarks,

                    }
                }).success(function(data){
                    if(data.message == 'success'){
                        _init();
                        $scope.prodinfo = {};
                        var logsdata = {
                            'event' : 'Add',
                            'description' : 'Added New Customer Order: '+ data.ordernumber,
                            'module' : 'CUSTOMER ORDER'
                        }
                        $scope.saveAuditLogs(logsdata);
                        $scope.data.ordernumber = data.ordernumber;
                        Swal.fire({
                            position: 'center',
                            type: 'success',
                            title: 'Customer Order has been successfully placed!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }else{
                        Swal.fire({
                            position: 'center',
                            type: 'error',
                            title: 'Saving error!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                    
                });
            }
    }else if($scope.mode == 'edit'){
        console.log(data, 'edit');
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'customerorderid' :  data.customerorderid,
                'ordernumber' :data.ordernumber,
                'orderplatform' :data.orderplatform,
                'modeofpayment' :data.modeofpayment,
                'courierid' :data.courierid,
                'productid' :data.productid,
                'supplierid' :data.supplierid,
                'quantity' :data.ordernumber,
                'shippingfee' :data.shippingfee,
                'shippingdate' :data.shippingdate,
                'purchasedate' :data.purchasedate,
                'totalamountdollar' :data.totalamountdollar,
                'totalamountpesos' :data.totalamountpesos,
                'exchangerate' :data.exchangerate,
                'remarks' :data.remarks,
                'dateupdated' :data.dateupdated,
                'action':'updateCustomerorder', 
            }
        }).success(function(data){
            if(data.message == 'success'){
                $scope.validate = false;
                toastr.success('Customer Order has been updated!');
                //$("#addcategorymodal").modal("hide");
                //$('.modal-backdrop').remove();
                //$(document.body).removeClass("modal-open");
                $scope.data='';
                 $scope.loadcustomerorderlist();
                $scope.errMessage = false;
                var logsdata = {
                    'event' : 'Update',
                    'description' : 'Updated Customer Order: '+ data.customerorderid,
                    'module' : 'CUSTOMER ORDER'
                }
                $scope.saveAuditLogs(logsdata);
            }else{
                $scope.errMessage = true;
                toastr.error('An error has been occured!');
            }
        });
    }
  
    }





    
    $scope.viewcustomerData = function(res){
        $scope.viewdata = '';
        console.log('test')
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : res,
                'action':'viewcustomerData',
            }
        }).success(function(datas){
            if(datas.message == 'success'){
                if(datas.data){
                    $scope.viewdata = {};
                    $scope.viewdata = datas.data;

                }else{
                    toastr.error('An error has been occured!');
                    $("#viewcustomerinfo").modal("hide");
                }
            }else{
            }
            
        });
    }


    $scope.deletecustomerorder = function(customerorderid){
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
                        'customerorderid' : customerorderid,
                        'action':'deletecustomerorder',
                    }
                }).success(function(datas){
                    if(datas.message == 'success'){
                        Swal.fire(
                            'Deleted!',
                            'Customer Order has been deleted.',
                            'success'
                        )
                       $scope.loadcustomerorderlist();
                        //$scope.init();  
                        var logsdata = {
                            'event' : 'Delete',
                            'description' : 'Deleted Customer Order: '+ customerorderid,
                            'module' : 'CUSTOMER ORDER'
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
    

    $scope.userpage = function(type, id){
        $scope.view = type;
        $scope.data = '';
        $scope.prodinfo = '';
        $scope.id = 0;
    }

    $scope.fetcheditdata = function(type, id, productid){
       $scope.view = 'main';
       $scope.mode = 'edit';
       $http({
        method:"POST",
        url:"app-controller/php-function/function.php",
        data:{
        'customerorderid' :id,
        'productid' :productid,
        'action':'fetchcustomerorderlist', 
        }
    }).success(function(data){
        console.log(data);
        if(data.message == 'success'){
            $scope.data = {};
            $scope.data = data.data.main;
            $scope.data.purchasedate = new Date(data.data.main.purchasedate);
            $scope.data.shippingdate = new Date(data.data.main.shippingdate);
            
            $scope.data.totalpricephp = data.data.main.totalamountpesos;
            $scope.data.totalpricedollars = data.data.main.totalamountdollar;
           
            $scope.loadcurrentrate();

            $scope.prodinfo = data.data.stock;
        
            $scope.data.unitpricephp = $scope.data.unitpricedollars * $scope.data.exchangerate;

            $scope.getprodinfo(productid);

           // toastr.success('customer order has been updated!');
            $scope.loadcustomerorderlist();
             $scope.errMessage = false;
            // var logsdata = {
            //     'event' : 'Edit',
            //     'description' : 'Updated Customer Order: '+ id.customerorderid,
            //     'module' : 'CUSTOMER ORDER'
            // }
            // $scope.saveAuditLogs(logsdata);
        }else{
            $scope.errMessage = true;
            toastr.error('An error has been occured!');
        }
    });


    }

    return _init();
});