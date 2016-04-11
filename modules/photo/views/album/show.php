<?php
/* ładuję skrypty Angular */
use app\assets\AngularAsset;
AngularAsset::register($this);
/* ładuję skrypty JqueryScroll */
use app\assets\JqueryScrollAsset;
JqueryScrollAsset::register($this);
/* ładuję tiles galery */
$this->registerCssFile($assetsPath.'/css/tiles-galery.css');
$this->registerJsFile($assetsPath.'/js/tiles-galery.js');
/* łąduję moduł never-ending-story */
$this->registerJsFile($assetsPath.'/js/ng-never-ending-story.js');
?>
<div ng-app="myApp" ng-controller="photosCtrl">
    <div class="col-lg-12 tiles-galery scrollbar-dynamic" never-ending-story="nextPhotos()" jquery-scrollbar="jqueryScrollbarOptions">
        <div class="row tiles" ng-repeat="photo in photos" ng-include="'tile'"></div>
    </div>
    <div ng-show="end">Koniec</div>
    <script type="text/ng-template" id="tile">
        <?=$this->render('_ng-tile');?>
    </script>
</div>

<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.scrollbar-dynamic').scrollbar();
    });
</script>

<script type="text/javascript">
    var album_id = <?=$id?>;
    
    /* Główny kontroler */
    var app = angular.module('myApp',['never-ending-story']);
    app.controller('photosCtrl', function($scope, $http){
        $scope.page = 1;
        $scope.loadingPage = false;
        $scope.photos = [];
        var end = false;
        
        $scope.loadPhotos = function(next) {
            $http.get('/photo/json/photos?album_id='+album_id+'&page='+$scope.page).then(function(response){
                if (response.data==='') {
                    end = true;
                    return;
                }
                var temp = [];
                var temp2 = [];
                var i = 0;
                angular.forEach(response.data, function(value, key){
                    i++;
                    temp[i] = value;
                    temp2[0] = temp;
                });
                if (next) {
                    $scope.photos.push(temp2);
                } else {
                    $scope.photos.push(temp2);
                    $scope.nextPhotos();
                }
                $scope.loadingPage = false;
            });
        };
        
        $scope.nextPhotos = function() {
            if (end) return;
            $scope.loadingPage = true;
            $scope.page++;
            $scope.loadPhotos(1);
        };
        
        $scope.loadPhotos(0);
        
    });
</script>