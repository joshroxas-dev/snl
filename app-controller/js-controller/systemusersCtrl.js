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

app.controller('manageuserController', function($scope, $http, $timeout, $sce){
    $scope.success = false;
    $scope.error = false;
    $scope.errpassword = false;
    $scope.newpass = '';

    $scope.view = 'list';

    $scope.userpage = function(type,id){
        console.log('change',type,id)
        if(type == 'adduser'){
            $scope.init();
            $scope.view = type;
            $scope.title = 'Add User'
            $scope.data = '';
        }
        if(type == 'edit'){
            $scope.init();
            $scope.view = type;
            $scope.title = 'Edit User'
            $scope.edituserdata(id);
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
    $scope.init = function(){
        console.log('LOAD INIT')
        $scope.loaduserlist();
        $scope.getCurrentRate();
        // $scope.data = {};
        // $scope.data.customerorder = 'true';
    }

    $scope.loaduserlist = function(){
        // $http({
		// 	method:"POST",
        //     url:"app-controller/php-function/function.php",
        //     data:{
        //         'action':'fetchlist',
        //     }
		// }).success(function(data){
        //     console.log(data,'hello')
        //     if(data.message == 'success'){
        //         $scope.userlist = data.data;
        //         $timeout( function(){
        //             $scope.preloader = false;
        //         }, 100 );
        //     }else{
        //         $scope.errMessage = true;
        //     }
            
        // });
        $http.get('app-controller/php-function/systemuser.php').success(function(user_data) {
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

    $scope.edituserdata = function(res){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : res,
                'action':'edituser',
            }
        }).success(function(datas){
            console.log(datas,'hello')
            if(datas.data){
                if(datas.message == 'success'){
                    $scope.data = {};
                    $scope.data = datas.data;
                }else{
                    
                }
            }else{
                toastr.error('An error has been occured!');
                // $("#viewuserinfo").modal("hide");
                $scope.view = 'list';
            }
            
        });
    }

    $scope.viewData = function(res){
        $scope.viewdata = '';
        console.log('test')
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : res,
                'action':'viewData',
            }
        }).success(function(datas){
            console.log(datas,'hello')
            if(datas.message == 'success'){
                if(datas.data){
                    $scope.viewdata = {};
                    $scope.viewdata = datas.data;

                    var roles = [
                        $scope.viewdata.customerorder == 'true' ? 'Customer Order' : '',
                        $scope.viewdata.supplierorder == 'true' ? 'Supplier Order' : '',
                        $scope.viewdata.stockmanagement == 'true' ? 'Stock Management' : '',
                        $scope.viewdata.addstock == 'true' ? 'Add Stock' : '',
                        $scope.viewdata.deletestock == 'true' ? 'Delete Stock' : '',
                        $scope.viewdata.productmanagement == 'true' ? 'Product Management' : '',
                        $scope.viewdata.categoriesmanagement == 'true' ? 'Categories Management' : '',
                        $scope.viewdata.addcategories == 'true' ? 'Add Categories' : '',
                        $scope.viewdata.deletecategories == 'true' ? 'Delete Categories' : '',
                        $scope.viewdata.brandsmanagement == 'true' ? 'Brands Management' : '',
                        $scope.viewdata.addbrands == 'true' ? 'Add Brands' : '',
                        $scope.viewdata.deletebrands == 'true' ? 'Delete Brands' : '',
                        $scope.viewdata.suppliersmanagement == 'true' ? 'Suppliers Management' : '',
                        $scope.viewdata.addsuppliers == 'true' ? 'Add Suppliers' : '',
                        $scope.viewdata.deletesuppliers == 'true' ? 'Delete Suppliers' : '',
                        $scope.viewdata.couriersmanagement == 'true' ? 'Couriers Management' : '',
                        $scope.viewdata.addcouriers == 'true' ? 'Add Couriers' : '',
                        $scope.viewdata.deletecouriers == 'true' ? 'Delete Couriers' : '',
                        $scope.viewdata.customermanagement == 'true' ? 'Customers Management' : '',
                        $scope.viewdata.addcustomer == 'true' ? 'Add Customer' : '',
                        $scope.viewdata.deletecustomer == 'true' ? 'Delete Customer' : '',
                        $scope.viewdata.systemusers == 'true' ? 'System Users' : '',
                        $scope.viewdata.report == 'true' ? 'Report' : '',
                        $scope.viewdata.dashboard == 'true' ? 'Dashboard' : '',
                        $scope.viewdata.auditlogs == 'true' ? 'Audit Logs' : '',
                        $scope.viewdata.accessdrafts == 'true' ? 'Access Drafts' : '',
                        $scope.viewdata.settings == 'true' ? 'Access Settings' : '',
                        $scope.viewdata.platform == 'true' ? 'Access Platform' : '',
                        $scope.viewdata.modeofpayment == 'true' ? 'Access Mode of Payment' : '',
                        $scope.viewdata.editvatvalue == 'true' ? 'Access Vat Value' : '',
                        $scope.viewdata.creditcard == 'true' ? 'Access Credit Card' : '',
                        $scope.viewdata.expenses == 'true' ? 'Access Expense' : '',
                        $scope.viewdata.expensecategory == 'true' ? 'Access Expense Category' : '',
                        $scope.viewdata.expensecategory == 'true' ? 'Access Manage Sizes' : ''
                    ]

                    arr = roles.filter(Boolean);

                    // $scope.viewdata.roles = arr.join(', ');
                    $scope.rolelist = arr;



                    console.log(arr,'hhehh');
                }else{
                    toastr.error('An error has been occured!');
                    $("#viewuserinfo").modal("hide");
                }
            }else{
            }
            
        });
    }

    $scope.saveChangePass = function(pass){
       // console.log($scope.viewdata.user_id, pass)
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'id'    : $scope.viewdata.user_id,
                'action':'saveChangePass',
                'password': pass
            }
        }).success(function(res){
            console.log(res,'hello')
            if(res.result){
                $scope.newpass = '';
                toastr.success('User password has been successfully updated!');
            }else{
                toastr.error('An error has been occured!');
            }
            
        });
    }

    $scope.getCurrentRate = function(){
        var proxy = "//cors-anywhere.herokuapp.com";
        var url = "https://www.freeforexapi.com/api/live?pairs=USDPHP";
        $http.get(proxy +'/'+ url)
        .then(function(response) {
            console.log(response.data.rates.USDPHP.rate)
        }).catch(function(response) {
            console.log(response)
            
        })  
    }

    $scope.deleteuser = function(user_id, username){
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
                        'id'    : user_id,
                        'action':'deleteuser',
                    }
                }).success(function(datas){
                    if(datas.message == 'success'){
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        $scope.init();
                        var logsdata = {
                            'event' : 'Delete',
                            'description' : 'Deleted User: '+ username,
                            'module' : 'SYSTEM USER'
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
    
    $scope.adduserForm = function(resp, mode){
        console.log('bon',$scope.view, resp);

        
        if($scope.view == 'adduser'){
            $http({
                method:"POST",
                url:"app-controller/php-function/function.php",
                data:{
                    'firstname':resp.firstname, 
                    'lastname':resp.lastname, 
                    'username':resp.username,
                    'password':resp.password,
                    'password2':resp.password2,
                    'address':resp.address,
                    'contactnumber':resp.contactnumber,
                    'email':resp.email,
                    'action':'Adduser', 
    
                    // ROLE DATA
                    'customerorder':resp.customerorder ? resp.customerorder : 'false',
                    'supplierorder':resp.supplierorder ? resp.supplierorder : 'false',
                    'stockmanagement':resp.stockmanagement ? resp.stockmanagement : 'false',
                    'addstock':resp.addstock ? resp.addstock : 'false',
                    'deletestock':resp.deletestock ? resp.deletestock : 'false',
                    'productmanagement':resp.productmanagement ? resp.productmanagement : 'false',
                    'addcategories':resp.addcategories ? resp.addcategories : 'false',
                    'deletecategories':resp.deletecategories ? resp.deletecategories : 'false',
                    'addbrands':resp.addbrands ? resp.addbrands : 'false',
                    'deletebrands':resp.deletebrands ? resp.deletebrands : 'false',
                    'addsuppliers':resp.addsuppliers ? resp.addsuppliers : 'false',
                    'deletesuppliers':resp.deletesuppliers ? resp.deletesuppliers : 'false',
                    'addcouriers':resp.addcouriers ? resp.addcouriers : 'false',
                    'deletecouriers':resp.deletecouriers ? resp.deletecouriers : 'false',
                    'systemusers':resp.systemusers ? resp.systemusers : 'false',
                    'report':resp.report ? resp.report : 'false',
                    'dashboard':resp.dashboard ? resp.dashboard : 'false',
                    'categoriesmanagement':resp.categoriesmanagement ? resp.categoriesmanagement : 'false',
                    'brandsmanagement':resp.brandsmanagement ? resp.brandsmanagement : 'false',
                    'suppliersmanagement':resp.suppliersmanagement ? resp.suppliersmanagement : 'false',
                    'couriersmanagement':resp.couriersmanagement ? resp.couriersmanagement : 'false',
                    'auditlogs':resp.auditlogs ? resp.auditlogs : 'false',
                    'customermanagement':resp.customermanagement ? resp.customermanagement : 'false',
                    'addcustomer':resp.addcustomer ? resp.addcustomer : 'false',
                    'deletecustomer':resp.deletecustomer ? resp.deletecustomer : 'false',
                    'accessdrafts':resp.accessdrafts ? resp.accessdrafts : 'false',
                    'settings':resp.settings ? resp.settings : 'false',
                    'platform':resp.platform ? resp.platform : 'false',
                    'modeofpayment':resp.modeofpayment ? resp.modeofpayment : 'false',
                    'editvatvalue':resp.editvatvalue ? resp.editvatvalue : 'false',
                    'creditcard':resp.creditcard ? resp.creditcard : 'false',
                    'expenses':resp.expenses ? resp.expenses : 'false',
                    'expensecategory':resp.expensecategory ? resp.expensecategory : 'false',
                    'sizes':resp.sizes ? resp.sizes : 'false'

                }
            }).success(function(data){
                console.log(data, 'ggggggg')
                if(data.message == 'success'){
                    $scope.data = '';
                    Swal.fire({
                        position: 'center',
                        type: 'success',
                        title: 'User has been successfully saved!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(){
                        $scope.view = 'list';
                        $scope.init();
                        var logsdata = {
                            'event' : 'Add',
                            'description' : 'Added New User: '+ resp.username,
                            'module' : 'SYSTEM USER'
                        }
                        $scope.saveAuditLogs(logsdata);
                    })
                }else if(data.message == 'password'){
                    // TEMPORARY VALIDATION
                    $scope.errpassword = true;
                    var logsdata = {
                        'event' : 'Updated',
                        'description' : 'Updated User: '+ resp.username,
                        'module' : 'SYSTEM USER'
                    }
                    $scope.saveAuditLogs(logsdata);
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
        }else{
            $http({
                method:"POST",
                url:"app-controller/php-function/function.php",
                data:{
                    'user_id':resp.user_id, 
                    'firstname':resp.firstname, 
                    'lastname':resp.lastname, 
                    'username':resp.username,
                    'address':resp.address,
                    'contactnumber':resp.contactnumber,
                    'email':resp.email,
                    'action':'updateuser', 
    
                    // ROLE DATA
                    'customerorder':resp.customerorder ? resp.customerorder : 'false',
                    'supplierorder':resp.supplierorder ? resp.supplierorder : 'false',
                    'stockmanagement':resp.stockmanagement ? resp.stockmanagement : 'false',
                    'addstock':resp.addstock ? resp.addstock : 'false',
                    'deletestock':resp.deletestock ? resp.deletestock : 'false',
                    'productmanagement':resp.productmanagement ? resp.productmanagement : 'false',
                    'addcategories':resp.addcategories ? resp.addcategories : 'false',
                    'deletecategories':resp.deletecategories ? resp.deletecategories : 'false',
                    'addbrands':resp.addbrands ? resp.addbrands : 'false',
                    'deletebrands':resp.deletebrands ? resp.deletebrands : 'false',
                    'addsuppliers':resp.addsuppliers ? resp.addsuppliers : 'false',
                    'deletesuppliers':resp.deletesuppliers ? resp.deletesuppliers : 'false',
                    'addcouriers':resp.addcouriers ? resp.addcouriers : 'false',
                    'deletecouriers':resp.deletecouriers ? resp.deletecouriers : 'false',
                    'systemusers':resp.systemusers ? resp.systemusers : 'false',
                    'report':resp.report ? resp.report : 'false',
                    'dashboard':resp.dashboard ? resp.dashboard : 'false',
                    'categoriesmanagement':resp.categoriesmanagement ? resp.categoriesmanagement : 'false',
                    'brandsmanagement':resp.brandsmanagement ? resp.brandsmanagement : 'false',
                    'suppliersmanagement':resp.suppliersmanagement ? resp.suppliersmanagement : 'false',
                    'couriersmanagement':resp.couriersmanagement ? resp.couriersmanagement : 'false',
                    'auditlogs':resp.auditlogs ? resp.auditlogs : 'false',
                    'customermanagement':resp.customermanagement ? resp.customermanagement : 'false',
                    'addcustomer':resp.addcustomer ? resp.addcustomer : 'false',
                    'deletecustomer':resp.deletecustomer ? resp.deletecustomer : 'false',
                    'accessdrafts':resp.accessdrafts ? resp.accessdrafts : 'false',
                    'settings':resp.settings ? resp.settings : 'false',
                    'platform':resp.platform ? resp.platform : 'false',
                    'modeofpayment':resp.modeofpayment ? resp.modeofpayment : 'false',
                    'editvatvalue':resp.editvatvalue ? resp.editvatvalue : 'false',
                    'creditcard':resp.creditcard ? resp.creditcard : 'false',
                    'expenses':resp.expenses ? resp.expenses : 'false',
                    'expensecategory':resp.expensecategory ? resp.expensecategory : 'false',
                    'sizes':resp.sizes ? resp.sizes : 'false'
                }
            }).success(function(data){
                if(data.message == 'success'){
                    Swal.fire({
                        // title: 'Are you sure?',
                        text: "User has been successfully updated!",
                        type: 'success',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Go back'
                      }).then((result) => {
                        if (result.value) {
                            $scope.view = 'list';
                            $scope.init(); 
                             var logsdata = {
                                'event' : 'Updated',
                                'description' : 'Updated User: '+ resp.username,
                                'module' : 'SYSTEM USER'
                            }
                            $scope.saveAuditLogs(logsdata);
                        }
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
		
    };

    $scope.init();

});

// app.directive("userCard", function () {
//     return {
//         restrict: "E",
//         template:
//         "<md-card>" +
//             "<md-card-title layout=\"column\" layout-align=\"center center\">"+
//                 "<md-card-title-media layout=\"column\" layout-align=\"center center\">"+
//                         "<md-button class=\"md-fab\" ng-style=\"{'background-color': obj.color }\""+
//                             "<span class=\"letter\">{{obj.name[0]}}</span>"+
//                         "</md-button>"+
//                         "{{obj.color}}"+
//                     "<span>{{obj.name}}</span>"+
//                 "</md-card-title-media>"+
//             "</md-card-title>"+
//         "</md-card>",
//         scope: {
//             obj: "="
//         },
//        controller: function ($scope) {
//             var alphabetColors = ["#5A8770", "#B2B7BB", "#6FA9AB", "#F5AF29", "#0088B9", "#F18636",
//                 "#D93A37", "#A6B12E", "#5C9BBC", "#F5888D", "#9A89B5", "#407887", "#9A89B5",
//                 "#5A8770", "#D33F33", "#A2B01F", "#F0B126", "#0087BF", "#F18636", "#0087BF",
//                 "#B2B7BB", "#72ACAE", "#9C8AB4", "#5A8770", "#EEB424", "#407887"];
            
            
//             var colorIndex = Math.floor(($scope.obj.name.charCodeAt(0) - 65) % alphabetColors.length);
//             $scope.obj.color = alphabetColors[colorIndex];
//         }
//     }
// });