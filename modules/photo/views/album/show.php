<?php
/* ładuję skrypty Angular */
use app\assets\AngularAsset;
AngularAsset::register($this);
?>
<div ng-app="myApp" ng-controller="photosCtrl">
    <ul never-ending-story="nextPhotos()" style="height: 500px; overflow: scroll">
        <li ng-repeat="photo in photos">
            <img src="/photo/img{{ photo.id }}_ax400">
        </li>
    </ul>
    <div ng-show="{{loadingPage}}">Wczytywanie strony {{page}}</div>
</div>

<script type="text/javascript">
    var album_id = <?=$id?>;
    
    var mod = angular.module('never-ending-story',[]);
    mod.directive('neverEndingStory', ['$rootScope', '$window', function($rootScope, $window){
        return {
            link: function(scope, element, attrs) {
                var raw = element[0];
                element.bind('scroll', function () {
                    if (raw.scrollTop + raw.offsetHeight > raw.scrollHeight) {
                        return scope.$eval(attrs.neverEndingStory);
                    }
                });
            }
        }
    }]);
    
    var app = angular.module('myApp',['never-ending-story']);
    app.controller('photosCtrl', function($scope, $http){
        $scope.page = 1;
        var end = false;
        
        $http.get('/photo/json/photos?album_id='+album_id+'&page='+$scope.page).then(function(response){
            $scope.photos = response.data;
        });
        $scope.loadingPage = false;
        $scope.nextPhotos = function() {
            if (end) return;
            $scope.loadingPage = true;
            $scope.page++;
            $http.get('/photo/json/photos?album_id='+album_id+'&page='+$scope.page).then(function(response){
                if (response.data=='') {
                    alert('Koniec');
                    end = true;
                    return;
                }
                angular.forEach(response.data, function(value, key){
                    $scope.photos.push(value);
                    $scope.loadingPage = false;
                });
            });
        }
    });

    
    
</script>