var app = angular.module('appCon', []);

app.controller('manageuserController', function($scope, $http, $timeout){
    $scope.success = false;
    $scope.error = false;
    $scope.preloader = true;

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
            $scope.edituserdata(id)
        }
        if(type == 'list'){
            $scope.view = type;
            $scope.init();
            $scope.loaduserlist();
        }
        
    }

    $scope.init = function(){
        console.log('LOAD INIT')
        // $scope.loaduserlist();
        // $scope.data = {};
        // $scope.data.customerorder = 'true';
    }

    $scope.edituserdata = function(res){
        $http({
                method:"POST",
                url:"function.php",
                data:{
                    'id'    : res,
                    'action':'edituser',
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

    $scope.loaduserlist = function(){
        $http({
			method:"POST",
            url:"function.php",
            data:{
                'action':'fetchlist',
            }
		}).success(function(data){
            console.log(data,'hello')
            if(data.message == 'success'){
                $scope.userlist = data.data;
                $timeout( function(){
                    $scope.preloader = false;
                }, 100 );
            }else{
                $scope.errMessage = true;
            }
            
		});
    }
    
    $scope.adduserForm = function(resp){
        console.log('bon',resp);
        
		$http({
			method:"POST",
			url:"function.php",
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
                'suppliersmanagement':resp.suppiersmanagement ? resp.suppiersmanagement : 'false',
                'couriersmanagement':resp.couriersmanagement ? resp.couriersmanagement : 'false',
                'auditlogs':resp.auditlogs ? resp.auditlogs : 'false',
                'customermanagement':resp.customermanagement ? resp.customermanagement : 'false',
                'addcustomer':resp.addcustomer ? resp.addcustomer : 'false',
                'deletecustomer':resp.deletecustomer ? resp.deletecustomer : 'false'
            }
		}).success(function(data){
            if(data.message == 'success'){
                $scope.data = '';
                Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: 'User has been successfully saved!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function(){
                    window.location="system-users.php";
                })
            }else{
                console.log('test',data.validation.matchpass);
                
                Swal.fire({
                    position: 'center',
                    type: 'error',
                    title: 'Saving error!',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
			// if(data.error != '')
			// {
			// 	$scope.success = false;
			// 	$scope.error = true;
			// 	$scope.errorMessage = data.error;
			// }
			// else
			// {
			// 	$scope.success = true;
			// 	$scope.error = false;
			// 	$scope.successMessage = data.message;
			// 	$scope.form_data = {};
			// 	$scope.closeModal();
			// 	$scope.fetchData();
			// }
		});
    };

    $scope.init();

});

// LOGIN CONTROLLER
app.controller('loginController', function($scope, $http){
    $scope.errMessage = false;
    $scope.loginForm = function(resp){
        console.log('bon',resp);
        
		$http({
			method:"POST",
			url:"function.php",
			data:{
                'username':resp.username, 
                'password':resp.password,
                'action':'login',
            }
		}).success(function(data){
            console.log(data,'hello')
            if(data.message == 'success'){
                $scope.errMessage = false;
                window.location="index.php";
            }else{
                $scope.errMessage = true;
            }
            
		});
    };
});


// app.controller('fileuploadController', function($scope, $http){

//     $scope.uploadFile = function(files) {
//         var fd = new FormData();
//         var uploadUrl = '/assets';
//         //Take the first selected file
//         fd.append("file", files[0]);
    
//         $http.post(uploadUrl, fd, {
//             withCredentials: true,
//             headers: {'Content-Type': undefined },
//             transformRequest: angular.identity
//         }).success().error();
    
//     };
// });



