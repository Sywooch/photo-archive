<?php
/* ładuję skrypty Angular */
use app\assets\AngularAsset;
AngularAsset::register($this);
?>
<div ng-app="myApp" ng-controller="photosCtrl">
    <div class="col-lg-12 custom-scroll-content" never-ending-story="nextPhotos()" style="height: 500px; overflow: scroll">
        <div class="row" ng-repeat="photo in photos" >
            <div class="col-md-6"><img src="/photo/img{{ photo[0][1].id }}_ax400"></div>
            <div class="col-md-6">
                <img src="/photo/img{{ photo[0][2].id }}_ax200">
                <img src="/photo/img{{ photo[0][3].id }}_ax200">
            </div>
        </div>
    </div>
    <div ng-show="end">Koniec</div>
</div>

<script type="text/javascript">
//    (function($){
//        $(window).load(function(){
//            jQuery(".custom-scroll-content").mCustomScrollbar();
//            alert('2');
//        });
//    })(jQuery);
</script>
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