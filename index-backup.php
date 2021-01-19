<?php
include 'config.php';
include 'includes/header.php';
include 'includes/side-bar.php';

?>
<div class="page-wrapper">
    <?php include 'includes/top-bar.php' ?>
    <!-- content -->
    <div class="page-content">
        <h3>Index</h3>
      <br>
      <div class="col-sm-12">
        <div class="col-sm-6 p-l-0">
          <div class="card">
            <h6 class="card-title mb-0" style="padding: 10px" >My Income</h6>
            <div class="p-l-0">
              <div class="col-sm-12" style="width: 200px;">
                <select name="" class="form-control" id="" ng-model="data.filter" ng-change="data.filter=data.filter">
                    <option value="">Date</option>
                    <option value="">datess</option>
                </select>
              </div>
              <div style="text-align: right; padding-right: 15px;">
                Total: PHP 1,231,123
              </div>
            </div>
            <div class="card-body">
            <div id="container" style="height: 400px; max-width: 100%;"></div>
            </div>
            </div>
          </div>

          <div class="col-sm-6 p-r-0">
            <div class="card">
              <h6 class="card-title mb-0" style="padding: 10px">My Expenses</h6>
                <div class="p-l-0">
                  <div class="col-sm-12" style="width: 200px;">
                    <select name="" class="form-control" id="" ng-model="data.filter" ng-change="data.filter=data.filter">
                        <option value="">Date</option>
                        <option value="">datess</option>
                    </select>
                  </div>
                  <div  style="text-align: right; padding-right: 15px;">
                    Total: PHP 1,231,123
                  </div>
                </div>
                <div class="card-body">
                <div id="container2" style=" height: 400px; max-width: 100%;"></div>
              </div>
            </div>
          </div>
      </div>
        




        <div class="col-sm-6 grid-margin stretch-card m-t-20">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline mb-2">
                <h6 class="card-title mb-0">Previous Year Income Comparison</h6>
                <div class="dropdown mb-2">
                  <button class="btn p-0" type="button" id="dropdownMenuButton4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-lg text-muted pb-3px"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                    <a class="dropdown-item d-flex align-items-center" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye icon-sm mr-2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg> <span class="">View</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 icon-sm mr-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg> <span class="">Edit</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash icon-sm mr-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> <span class="">Delete</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer icon-sm mr-2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg> <span class="">Print</span></a>
                    <a class="dropdown-item d-flex align-items-center" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download icon-sm mr-2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> <span class="">Download</span></a>
                  </div>
                </div>
              </div>
              <div class="p-l-0">
                <div class="col-sm-12 p-l-0" style="width: 200px;">
                  <select name="" class="form-control" id="" ng-model="data.filter" ng-change="data.filter=data.filter">
                      <option value="">Date</option>
                      <option value="">datess</option>
                  </select>
                </div>
                <div  class="p-r-0"  style="text-align: right; padding-right: 15px;">
                  Total: PHP 1,231,123
                </div>
              </div>
             <br>
             <br>
              <div class="monthly-sales-chart-wrapper"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                <canvas id="monthly-sales-chart" style="display: block; width: 1017px; height: 270px;" width="1017" height="270" class="chartjs-render-monitor"></canvas>
              </div>
            </div> 
          </div>
        </div>

        





        <!-- <div>
            <img width="60" height="60" avatar="Andy Dandy">
            <img class="round" width="60" height="60" avatar="Andy Dandy">
            <img width="30" height="30" avatar="Andy">
            <img class="round" width="30" height="30" avatar="Andy">
        </div> -->
    </div>
    <!-- <div class="page-content" ng-app="appCon" ng-controller="fileuploadController">
    <h3>Index</h3>
    <input type="file" name="file" onchange="angular.element(this).scope().uploadFile(this.files)"/>
</div>
    <!-- content -->
    <script src="app.js"></script>
    
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>


<!-- ----------------------------------------------------------------------------------- -->
<!-- ----------------------------------------------------------------------------------- -->
<!-- ----------------------------------------------------------------------------------- -->
<!-- ---------------------------------- HIGH CHART ------------------------------------- -->
<!-- ----------------------------------------------------------------------------------- -->
<!-- ----------------------------------------------------------------------------------- -->
<!-- ----------------------------------------------------------------------------------- -->
<!-- ----------------------------------------------------------------------------------- -->
    <script>
    Highcharts.chart('container', {
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
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
    pie: {
    allowPointSelect: true,
    cursor: 'pointer',
    dataLabels: {
    enabled: true,
    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
    }
    }
    },
    series: [{
    name: 'Brands',
    colorByPoint: true,
    data: [{
    name: 'Chrome',
    y: 61.41,
    sliced: true,
    selected: true
    }, {
    name: 'Internet Explorer',
    y: 11.84
    }, {
    name: 'Firefox',
    y: 10.85
    }, {
    name: 'Edge',
    y: 4.67
    }, {
    name: 'Safari',
    y: 4.18
    }, {
    name: 'Sogou Explorer',
    y: 1.64
    }, {
    name: 'Opera',
    y: 1.6
    }, {
    name: 'QQ',
    y: 1.2
    }, {
    name: 'Other',
    y: 2.61
    }]
    }]
    });


    Highcharts.chart('container2', {
    chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
    },
    title: {
    text: 'Browser market shares in January, 2018'
    },
    tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
    pie: {
    allowPointSelect: true,
    cursor: 'pointer',
    dataLabels: {
    enabled: true,
    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
    }
    }
    },
    series: [{
    name: 'Brands',
    colorByPoint: true,
    data: [{
    name: 'Chrome',
    y: 61.41,
    sliced: true,
    selected: true
    }, {
    name: 'Internet Explorer',
    y: 11.84
    }, {
    name: 'Firefox',
    y: 10.85
    }, {
    name: 'Edge',
    y: 4.67
    }, {
    name: 'Safari',
    y: 4.18
    }, {
    name: 'Sogou Explorer',
    y: 1.64
    }, {
    name: 'Opera',
    y: 1.6
    }, {
    name: 'QQ',
    y: 1.2
    }, {
    name: 'Other',
    y: 2.61
    }]
    }]
    });
    </script>
    
<!-- ----------------------------------------------------------------------------------- -->
<!-- ----------------------------------------------------------------------------------- -->
<!-- ----------------------------------------------------------------------------------- -->
<!-- --------------------------------- HIGH CHART END----------------------------------- -->
<!-- ----------------------------------------------------------------------------------- -->
<!-- ----------------------------------------------------------------------------------- -->
<!-- ----------------------------------------------------------------------------------- -->
<!-- ----------------------------------------------------------------------------------- -->










<!-- ----------------------------------------------------------------------------------- -->
<!-- ----------------------------------------------------------------------------------- -->
<!-- ----------------------------------------------------------------------------------- -->
<!-- ----------------------------------- AVATAR ---------------------------------------- -->
<!-- ----------------------------------------------------------------------------------- -->
<!-- ----------------------------------------------------------------------------------- -->
<!-- ----------------------------------------------------------------------------------- -->
<!-- ----------------------------------------------------------------------------------- -->



    <script>
        /*
            * LetterAvatar
            * 
            * Artur Heinze
            * Create Letter avatar based on Initials
            * based on https://gist.github.com/leecrossley/6027780
            */
        (function (w, d) {

            function LetterAvatar(name, size) {

                name = name || '';
                size = size || 60;

                var colours = [
                    "#1abc9c", "#2ecc71", "#3498db", "#9b59b6", "#34495e", "#16a085", "#27ae60", "#2980b9", "#8e44ad", "#2c3e50",
                    "#f1c40f", "#e67e22", "#e74c3c", "#ecf0f1", "#95a5a6", "#f39c12", "#d35400", "#c0392b", "#bdc3c7", "#7f8c8d"
                ],

                    nameSplit = String(name).toUpperCase().split(' '),
                    initials, charIndex, colourIndex, canvas, context, dataURI;


                if (nameSplit.length == 1) {
                    initials = nameSplit[0] ? nameSplit[0].charAt(0) : '?';
                } else {
                    initials = nameSplit[0].charAt(0) + nameSplit[1].charAt(0);
                }

                if (w.devicePixelRatio) {
                    size = (size * w.devicePixelRatio);
                }

                charIndex = (initials == '?' ? 72 : initials.charCodeAt(0)) - 64;
                colourIndex = charIndex % 20;
                canvas = d.createElement('canvas');
                canvas.width = size;
                canvas.height = size;
                context = canvas.getContext("2d");

                context.fillStyle = colours[colourIndex - 1];
                context.fillRect(0, 0, canvas.width, canvas.height);
                context.font = Math.round(canvas.width / 2) + "px Arial";
                context.textAlign = "center";
                context.fillStyle = "#FFF";
                context.fillText(initials, size / 2, size / 1.5);

                dataURI = canvas.toDataURL();
                canvas = null;

                return dataURI;
            }

            LetterAvatar.transform = function () {

                Array.prototype.forEach.call(d.querySelectorAll('img[avatar]'), function (img, name) {
                    name = img.getAttribute('avatar');
                    img.src = LetterAvatar(name, img.getAttribute('width'));
                    img.removeAttribute('avatar');
                    img.setAttribute('alt', name);
                });
            };


            // AMD support
            if (typeof define === 'function' && define.amd) {

                define(function () { return LetterAvatar; });

                // CommonJS and Node.js module support.
            } else if (typeof exports !== 'undefined') {

                // Support Node.js specific `module.exports` (which can be a function)
                if (typeof module != 'undefined' && module.exports) {
                    exports = module.exports = LetterAvatar;
                }

                // But always support CommonJS module 1.1.1 spec (`exports` cannot be a function)
                exports.LetterAvatar = LetterAvatar;

            } else {

                window.LetterAvatar = LetterAvatar;

                d.addEventListener('DOMContentLoaded', function (event) {
                    LetterAvatar.transform();
                });
            }

        })(window, document);
    </script>



<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

    <?php include "includes/footer.php"; ?>