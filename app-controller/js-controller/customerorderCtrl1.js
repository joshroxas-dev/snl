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
    $scope.view = "main";
    $scope.store = [];

    _init = function(){
        $scope.isChangeProd = false;
        $scope.data = {};
        $scope.prodinfo = '';
        $scope.validate = false;
        $scope.data.shippingdate = '';
        $scope.data.purchasedate = '';
        $scope.data.quantity = '0';
        $scope.data.ordernumber = '';
        $scope.data.platformid = '';
        $scope.data.customerid = '';
        $scope.data.filter = 'Local';
        $scope.data.classification = '';
        $scope.data.productid = '';
        $scope.data.mopid = '';
        $scope.data.courierid = '';
        $scope.data.remarks = '';
        $scope.data.shippingfee = '';
        $scope.data.reorderpoint = '';
        $scope.data.threshold = '';
        $scope.formview = 'add';
        $scope.load();
        $scope.loadcustomerorderlist();
    }

    $scope.load = function(){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'getCustomerlist',
            }
        }).success(function(datas){
            // console.log(datas,'hello')
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
                'action':'getProdlist',
            }
        }).success(function(datas){
            // console.log(datas,'hello')
            if(datas.message == 'success'){
                $scope.prodlist = {};
                $scope.prodlist = datas.data;
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

        //platform
        //   $http({
        //     method:"POST",
        //     url:"app-controller/php-function/function.php",
        //     data:{
        //         'action':'getPlatformlist',
        //     }
        // }).success(function(datas){
        //     console.log(datas,'hello')
        //     if(datas.message == 'success'){
        //         $scope.platformlist = {};
        //         $scope.platformlist = datas.data;
        //     }else{
        //     }
            
        // });

        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'getplatforminfo',
            }
        }).success(function(datas){
            console.log(datas,'hello')
            if(datas.message == 'success'){
                $scope.platformlist = {};
                $scope.platformlist = datas.data;
            }else{
            }
            
        });

        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'getPlatformlist',
            }
        }).success(function(datas){
            if(datas.message == 'success'){
                $scope.platformlist = {};
                $scope.platformlist = datas.data;
            }
        });

        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'getCourierlist',
            }
        }).success(function(datas){
            // console.log(datas,'hello')
            if(datas.message == 'success'){
                $scope.courierlist = {};
                $scope.courierlist = datas.data;
            }else{
            }
            
        });

        var proxy = "//cors-anywhere.herokuapp.com";
        var url = "https://www.freeforexapi.com/api/live?pairs=USDPHP";
        $http.get(proxy +'/'+ url)
        .then(function(response) {
            // console.log(response);
            $scope.updatedat = response.data.rates.USDPHP.timestamp * 1000;
            $scope.lrate = response.data.rates.USDPHP.rate;
            toastr.success('Latest exchage rate has been successfully loaded.');
            $scope.data.exchangerate = response.data.rates.USDPHP.rate;
            
        }).catch(function(response) {
            // console.log(response)
            
        }) 
    }

    $scope.fetcheditdata = function(id){
        $scope.view = "main";
        $scope.formview = 'edit';
        $scope.isChangeProd = false;
        $scope.data = '';
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
            'customerorderid' :id,
            'action':'fetchcustomerorderlist', 
            }
        }).success(function(data){
            // console.log(data,'65556565');
            if(data.message == 'success'){
                $scope.data = data.data.main;
                $scope.data.purchasedate = new Date(data.data.main.purchasedate);
                $scope.data.shippingdate = new Date(data.data.main.shippingdate);
                $scope.data.totalpricedollars = data.data.main.totalamountdollar;
                $scope.data.totalpricephp = data.data.main.totalamountpesos;

                // console.log(($scope.data.unitpricedollars * $scope.data.exchangerate), data.data.main.quantity)
                $scope.store.productid = $scope.data.productid;
                $scope.store.totalpricedollars = $scope.data.totalpricedollars;
                $scope.store.totalpricephp = $scope.data.totalpricephp;
                $scope.store.quantity = $scope.data.quantity;

    
                $scope.getprodinfo($scope.data.productid, false);
    
               // toastr.success('customer order has been updated!');
                // $scope.loadcustomerorderlist();
                //  $scope.errMessage = false;
                // var logsdata = {
                //     'event' : 'Edit',
                //     'description' : 'Updated Customer Order: '+ id.customerorderid,
                //     'module' : 'CUSTOMER ORDER'
                // }
                // $scope.saveAuditLogs(logsdata);
            }else{
                // $scope.errMessage = true;
                toastr.error('An error has been occured!');
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
        // console.log(res, 'CUSTOMER INFO');
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : res,
                'action':'getcustomerinfo',
            }
        }).success(function(datas){
            // console.log(datas.data,'getcustomerinfo')
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

    $scope.getprodinfo = function(res, status) {
        // console.log(res, $scope.store, 'PROD INFO');
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : res,
                'action':'getProdInfo2',
            }
        }).success(function(datas){
            // console.log(datas.data,'getProdInfo')
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

                    if($scope.formview == 'add'){
                        $scope.data.totalpricephp = '0.00';
                        $scope.data.quantity = '0';
                        $scope.data.totalpricedollars = '0.00';
                    }else{
                        if(!status){
                            $scope.prodinfo.newalbqty = (Number($scope.prodinfo.newalbqty) + Number($scope.data.quantity));
                        }else{
                            if(res == $scope.store.productid){
                                $scope.data.totalpricephp = $scope.store.totalpricephp;
                                $scope.data.quantity = $scope.store.quantity;
                                $scope.data.totalpricedollars = $scope.store.totalpricedollars;
                                $scope.prodinfo.newalbqty = (Number($scope.prodinfo.newalbqty) + Number($scope.store.quantity));
                            }else{
                                $scope.data.totalpricephp = '0.00';
                                $scope.data.quantity = '0';
                                $scope.data.totalpricedollars = '0.00';
                            }
                        }
                    }

                }else{
                    toastr.error('An error has been occured!');
                }
            }else{
                toastr.error('An error has been occured!');
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

    $scope.setQuantity = function(val, val2, val3) {
        console.log($scope.prodinfo.newalbqty, '$scope.prodinfo.newalbqty')
        var y = $scope.prodinfo.newalbqty;
        
        if(Number(val) > Number(y)){
            toastr.error('Insufficient Quantity!');
            $scope.data.quantity = '0';
            $scope.data.totalpricephp = '0.00';
            $scope.data.totalpricedollars = '0.00';
        }else{
            $scope.data.totalpricephp = val2 * val;
            $scope.data.totalpricedollars = val3 * val;
        }
    }

    $scope.resetForm = function(){
        _init();
    }

    $scope.setRate  = function(rate, qty, price){
        $scope.data.unitpricephp = price * rate;
        $scope.data.totalpricephp = $scope.data.unitpricephp * qty;
        $scope.data.totalpricedollars = price * qty;

    }

    $scope.save = function(data){
        // console.log(data)
        $scope.validate = true;
        if(data.shippingdate === '' || data.shippingdate === null || data.purchasedate  === '' || data.purchasedate  === null || data.shippingfee === '' || data.quantity  === '' || data.ordernumber  === '' || data.customerid  === '' || data.classification  === '' || data.productid  === '' || data.courierid  === '' || data.shippingfee  === '' || data.mopid === ''){
            toastr.error('Oops please fill-up all required fields!');
        }else{
            $http({
                method:"POST",
                url:"app-controller/php-function/function.php",
                data:{
                    'action':'saveCustomerOrder',
                    'customerid': data.customerid,
                    'ordernumber':data.ordernumber,
                    'productid': data.productid,
                    'supplierid': data.supplierid,
                    'mopid': data.mopid,
                    'courierid': data.courierid,
                    'platformid': data.platformid,
                    'quantity': data.quantity,
                    'shippingfee': data.shippingfee,
                    'shippingdate': data.shippingdate,
                    'purchasedate': data.purchasedate,
                    'classification': data.classification,
                    'filter': data.filter,
                    'totalamountdollar': data.totalpricedollars,
                    'totalamountpesos': data.totalpricephp,
                    'exchangerate': data.exchangerate,
                    'remarks': data.remarks,
                    'customerorderid': data.customerorderid ? data.customerorderid : '',

                }
            }).success(function(data){
                // console.log('fdsfsdfsd', $scope.formview)
                if(data.message == 'success'){
                    // $scope.prodinfo = {};
                    var logsdata = {
                        'event' : $scope.formview === 'edit' ? 'Update' : 'Add',
                        'description' : ($scope.formview === "edit" ? "Update" : "Added New ") + 'Customer Order: '+ data.ordernumber,
                        'module' : 'CUSTOMER ORDER'
                    }
                    $scope.saveAuditLogs(logsdata);
                    Swal.fire({
                        position: 'center',
                        type: 'success',
                        title: 'Customer Order has been successfully ' + ($scope.formview == "edit" ? "Updated" : "Placed"),
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(){
                        if($scope.formview == 'edit'){
                            $scope.view = 'list';
                        }
                        _init();
                    })
                }else{
                    console.log(data);
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
    }

    $scope.customerpage = function(type,id){
        console.log('change',type,id)
        if(type == 'addCustomer'){
            // $scope.init();
            $scope.viewadd = type;
            $scope.title = 'Add Customer'
            $scope.dataadd = '';
        }
        if(type == 'edit'){
            // $scope.init();
            $scope.viewadd = type;
            $scope.title = 'Edit Customer'
            $scope.editcustomerdata(id)
        }
    }

    $scope.addcustomerForm = function(resp){
        console.log('bon',resp);
        
        if($scope.viewadd == 'addCustomer'){
            $http({
                method:"POST",
                url:"app-controller/php-function/function.php",
                data:{
                    'customerfirstname':resp.customerfirstname, 
                    'customerlastname':resp.customerlastname, 
                    'customerbname':resp.customerbname, 
                    'cbillingaddress':resp.cbillingaddress, 
                    'cshippingaddress':resp.cshippingaddress, 
                    'cphonenumber':resp.cphonenumber, 
                    'cemailaddress':resp.cemailaddress, 
                    'action':'addCustomer', 
                    
                }
            }).success(function(data){
                if(data.message == 'success'){
                    toastr.success('New Customer has been added!');
                    //$("#addsuppliermodal").modal("hide");
                    //$('.modal-backdrop').remove();
                    //$(document.body).removeClass("modal-open");
                    $http({
                        method:"POST",
                        url:"app-controller/php-function/function.php",
                        data:{
                            'action':'getCustomerlist',
                        }
                    }).success(function(datas){
                        // console.log(datas,'hello')
                        if(datas.message == 'success'){
                            $scope.customerlist = {};
                            $scope.customerlist = datas.data;
                        }else{
                        }
                        
                    });
                    $scope.dataadd='';
                    $scope.errMessage = false;
                    var logsdata = {
                        'event' : 'Add',
                        'description' : 'Added New Customer: '+ resp.customerfirstname,
                        'module' : 'CUSTOMER'
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
                    'customerid' :resp.customerid,
                    'customerfirstname' :resp.customerfirstname,
                    'customerlastname':resp.customerlastname,
                    'customerbname':resp.customerbname,
                    'cbillingaddress' :resp.cbillingaddress,
                    'cshippingaddress' :resp.cshippingaddress,
                    'cphonenumber':resp.cphonenumber,
                    'cemailaddress' :resp.cemailaddress,
                    'action':'updateCustomer', 
                    
                }
            }).success(function(data){
                if(data.message == 'success'){
                    toastr.success('Customer has been updated!');
                    //$("#addbrandmodal").modal("hide");
                    //$('.modal-backdrop').remove();
                    //$(document.body).removeClass("modal-open");
                    $http({
                        method:"POST",
                        url:"app-controller/php-function/function.php",
                        data:{
                            'action':'getCustomerlist',
                        }
                    }).success(function(datas){
                        // console.log(datas,'hello')
                        if(datas.message == 'success'){
                            $scope.customerlist = {};
                            $scope.customerlist = datas.data;
                        }else{
                        }
                        
                    });
                    $scope.dataadd='';
                    $scope.errMessage = false;
                    var logsdata = {
                        'event' : 'Update',
                        'description' : 'Updated Customer: '+ resp.customerfirstname,
                        'module' : 'CUSTOMER'
                    }
                    $scope.saveAuditLogs(logsdata);
                }else{
                    $scope.errMessage = true;
                    toastr.error('An error has been occured!');
                }
            });
        }
		
    };

    return _init();
});