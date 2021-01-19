var app = angular.module('appCon', []);

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

app.controller('dashboardController', function($scope, $http) {
    $scope.store = [];
    $scope.old = [];
    _init = function(){
        // $scope.allChart();
        $scope.dashboardCheck();
        $scope.loadIncomeComparison();
        
    }
    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();
    
        if (month.length < 2) 
            month = '0' + month;
        if (day.length < 2) 
            day = '0' + day;
    
        return [year, month, day].join('-');
    }

    $scope.dashboardCheck = function(){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'dashboardCheck',
            }
        }).success(function(res){
            console.log(res,'expenseCheck')
            $scope.dashboardid = res.dashboardid;
            $scope.loadDashboard($scope.dashboardid);
        });
    }

    $scope.loadDashboard = function(id){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'loadDashboard',
                'dashboardid':id
            }
        }).success(function(res){
            console.log(res, 'dasboard')
            $scope.set = [];
            $scope.old = angular.copy(res.data);
            $scope.set.myincomedatefrom = res.data.myincomedatefrom == '0000-00-00' ? '' : new Date(res.data.myincomedatefrom);
            $scope.set.myincomedateto = res.data.myincomedateto == '0000-00-00' ? '' : new Date(res.data.myincomedateto);
            $scope.set.myexpensefrom = res.data.myexpensefrom == '0000-00-00' ? '' : new Date(res.data.myexpensefrom);
            $scope.set.myexpenseto = res.data.myexpenseto == '0000-00-00' ? '' : new Date(res.data.myexpenseto);
            $scope.set.incomecomparison = res.data.incomecomparison;

            $scope.dataIncome($scope.set.myincomedatefrom, $scope.set.myincomedateto);
            $scope.dataExpense($scope.set.myexpensefrom, $scope.set.myexpenseto);
            $scope.setcomparison($scope.set.incomecomparison);
        });
    }

    $scope.setcomparison = function(type){
        if(type == 'Monthly'){
            $scope.datacategory = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            $scope.loadDataMonthly();
        }
        if(type == 'Quarterly'){
            $scope.datacategory = ['Jan - Apr','May - Aug','Sep - Dec'];
            $scope.loadDataQuarterly();
        }
        if(type == 'Annually'){
            $scope.datacategory = ['Annual'];
            $scope.loadDataAnnually();
        }
        $scope.saveDashboard();  
    }

    $scope.loadDataMonthly = function(){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'loadDataMonthly'
            }
        }).success(function(res){
            $scope.dataseries = res.data;
            $scope.loadIncomeComparison();
        });
    }

    $scope.loadDataQuarterly = function(){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'loadDataQuarterly'
            }
        }).success(function(res){
            $scope.dataseries = res.data;
            $scope.loadIncomeComparison();
        });
    }

    $scope.loadDataAnnually = function(){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'loadDataAnnually'
            }
        }).success(function(res){
            console.log(res,'HUHUHUHU')
            $scope.dataseries = res.data;
            // $scope.datacategory = res.year;
            $scope.loadIncomeComparison();
        });
    }

    $scope.dataIncome = function(datefrom, dateto){  
        console.log(datefrom, dateto,'yey')
        if(formatDate(datefrom) > formatDate(dateto)){
            toastr.error('Date from should not be greater than date to!');
            $scope.set.myincomedatefrom = new Date($scope.old.myincomedatefrom);
            $scope.set.myincomedateto = new Date($scope.old.myincomedateto);

            console.log($scope.old);
        }else{   
            $http({
                method:"POST",
                url:"app-controller/php-function/function.php",
                data:{
                    'action':'getIncome',
                    'datefrom': (datefrom ? formatDate(datefrom) : ''),
                    'dateto': (datefrom ? formatDate(dateto) : ''),
                }
            }).success(function(res){
                $scope.store.myincome = res.data;
                $scope.myincometotal = res.total;
                $scope.loadChartIncome();
    
                $scope.saveDashboard();
            });
        }
    }

    $scope.dataExpense = function(datefrom, dateto){  
        console.log(datefrom, dateto,'yeyexpense')
        if(formatDate(datefrom) > formatDate(dateto)){
            toastr.error('Date from should not be greater than date to!');
            $scope.set.myexpensefrom = new Date($scope.old.myexpensefrom);
            $scope.set.myexpenseto = new Date($scope.old.myexpenseto);

            console.log($scope.old);
        }else{   
            $http({
                method:"POST",
                url:"app-controller/php-function/function.php",
                data:{
                    'action':'getchartexpense',
                    'datefrom': (datefrom ? formatDate(datefrom) : ''),
                    'dateto': (datefrom ? formatDate(dateto) : ''),
                }
            }).success(function(res){
                console.log(res,'JJIJIJI')
                $scope.store.myexpense = res.data;
                $scope.myexpensetotal = res.total;
                $scope.loadChartExpense();
    
                $scope.saveDashboard();
            });
        }
    }

    $scope.saveDashboard = function(){
        $http({
            method:"POST",
            url:"app-controller/php-function/function.php",
            data:{
                'action':'saveDashboard',
                'id': $scope.dashboardid,
                'myincomedatefrom': $scope.set.myincomedatefrom,
                'myincomedateto': $scope.set.myincomedateto,
                'myexpensefrom': $scope.set.myexpensefrom,
                'myexpenseto': $scope.set.myexpenseto,
                'incomecomparison': $scope.set.incomecomparison,
            }
        }).success(function(res){
            console.log(res,'save');
            $scope.old = angular.copy(res.data);
        });
    }

    $scope.loadChartIncome = function(){
        var datamyIncome = $scope.store.myincome;
        Highcharts.chart('myincome', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Profit and loss'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b> <br> Total: {point.y:,.2f}'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} % <br><b>Total</b>: {point.y:,.2f}'
                    }
                }
            },
            series: [{
                name: 'Brand',
                colorByPoint: true,
                data: datamyIncome
            }]
        });
    }

    $scope.loadChartExpense = function(){
        var datamyExpense = $scope.store.myexpense;
        Highcharts.chart('myexpenses', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Profit and loss'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b> <br> Total: {point.y}'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} % <br><b>Total</b>: {point.y}'
                    }
                }
            },
            series: [{
                name: 'Brand',
                colorByPoint: true,
                data: datamyExpense,
            }]
        });
    }

    $scope.loadIncomeComparison = function(){
        var datacategory = $scope.datacategory;
        var dataseries = $scope.dataseries;

        console.log(dataseries,'jjjjujuj')

        Highcharts.chart('incomecomparison', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Income Comparison'
            },
            // subtitle: {
            //     text: 'Source: WorldClimate.com'
            // },
            xAxis: {
                categories: datacategory,
                crosshair: true
            },
            yAxis: {
                min: 0,
                // title: {
                //     text: 'Rainfall (mm)'
                // }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b> &#8369;{point.y:,.2f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: dataseries
        });
    }

    return _init();
});
