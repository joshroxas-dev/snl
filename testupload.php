<!DOCTYPE html>
<html>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<body ng-app="myApp" ng-controller="myCtrl">
<div class="file-upload">
        <input type="text" ng-model="name" placeholder="Enter Name here">
        <input type="file" multiple file-model="myFile"/>
        <button ng-click="uploadFile()">upload me</button>
    </div>
    <div id="result"></div>
<script type="text/javascript" src="app-controller\js-controller\testuploadCtrl.js"></script>
</body>
</html>