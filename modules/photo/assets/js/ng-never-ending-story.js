/* Moduł NeverEndingStory */
var mod = angular.module('never-ending-story',[]);
mod.directive('neverEndingStory', ['$rootScope', '$window', function($rootScope, $window){
    return {
        link: function(scope, element, attrs) {
            var raw = element[0];
            var gap = 50;
            var canScroll = true;
            var handler = function () {
                if (raw.scrollTop + raw.offsetHeight > raw.scrollHeight - gap) {
                    if (canScroll) {
                        canScroll = false;
                        setTimeout(function(){
                            canScroll = true;
                        },2000);
                        return scope.$eval(attrs.neverEndingStory);
                    }
                }
            };
            element.bind('scroll', handler);
            
        }
    };
}]);