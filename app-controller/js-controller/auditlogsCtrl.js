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

app.controller('auditlogsController', function($scope, $http, $timeout){
    $scope.success = false;
    $scope.error = false;

    $scope.view = 'list';


    $scope.init = function(){
        console.log('LOAD INIT');
        $scope.loadauditlogslist();
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

    $scope.loadauditlogslist = function(){
        
        $http.get('app-controller/php-function/auditlogs.php').success(function(user_data) {
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



    $scope.init();

});