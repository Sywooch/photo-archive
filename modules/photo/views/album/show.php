<?php
/* ładuję skrypty Angular */
use app\assets\AngularAsset;
AngularAsset::register($this);
/* ładuję Angular UI Bootstrap */
use app\assets\AngularUiBootstrapAsset;
AngularUiBootstrapAsset::register($this);
/* ładuję skrypty JqueryScroll */
use app\assets\JqueryScrollAsset;
JqueryScrollAsset::register($this);
/* ładuję tiles galery */
$this->registerCssFile($assetsPath.'/css/tiles-galery.css');
$this->registerJsFile($assetsPath.'/js/tiles-galery.js');
/* łąduję moduł never-ending-story */
$this->registerJsFile($assetsPath.'/js/ng-never-ending-story.js');
/* ładuję moduł tiles-gallery */
$this->registerJsFile($assetsPath.'/js/ng-tiles-gallery.js');
?>
<div ng-app="myApp" ng-controller="photosCtrl">
    <div id="tiles-galery" class="col-lg-12 tiles-galery scrollbar-light" never-ending-story="nextPhotos()" jquery-scrollbar="jqueryScrollbarOptions">
        <div class="row tiles" ng-repeat="photo in photos" ng-include="'tile'"></div>
    </div>
    <div ng-if="end">Koniec</div>
    <script type="text/ng-template" id="tile">
        <?=$this->render('_ng-tile');?>
    </script>
    <script type="text/ng-template" id="myModalContent.html">
        <div class="modal-header">
            <h3 class="modal-title">I'm a modal!</h3>
        </div>
        <div class="modal-body">
            <ul>
                <li ng-repeat="item in items">
                    <a href="#" ng-click="$event.preventDefault(); selected.item = item">{{ item }}</a>
                </li>
            </ul>
            Selected: <b>{{ selected.item }}</b>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="button" ng-click="ok()">OK</button>
            <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
        </div>
    </script>
</div>

<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.scrollbar-light').scrollbar();
    });
</script>

<script type="text/javascript">
    var album_id = <?=$id?>;
    
    /* Główny kontroler */
    var app = angular.module('myApp',['never-ending-story','tiles-gallery','ui.bootstrap']);
    app.controller('photosCtrl', function($scope, $http, $uibModal){
        $scope.page = 1;
        $scope.loadingPage = false;
        $scope.photos = [];
        var end = false;
        
        $scope.gallery_width = document.getElementById('tiles-galery').clientWidth;
        
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
                    //$scope.nextPhotos();
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
        
        /* DIALOG */
        $scope.open = function (size, photo) {
            alert(photo.id);
        var modalInstance = $uibModal.open({
          animation: true,
          templateUrl: 'myModalContent.html',
          controller: 'photosCtrl',
          size: size,
          resolve: {
            items: function () {
              return $scope.items;
            }
          }
        });

        modalInstance.result.then(function (selectedItem) {
          $scope.selected = selectedItem;
        }, function () {
          $log.info('Modal dismissed at: ' + new Date());
        });
      };
        
    });
    
    angular.module('myApp').controller('ModalInstanceCtrl', function ($scope, $uibModalInstance, items) {

        $scope.items = items;
        $scope.selected = {
          item: $scope.items[0]
        };

        $scope.ok = function () {
          $uibModalInstance.close($scope.selected.item);
        };

        $scope.cancel = function () {
          $uibModalInstance.dismiss('cancel');
        };
      });
</script>