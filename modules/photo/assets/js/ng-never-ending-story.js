/* Moduł NeverEndingStory */
var mod = angular.module('never-ending-story',[]);
mod.directive('neverEndingStory', ['$rootScope', '$window', function($rootScope, $window){
    return {
        link: function(scope, element, attrs) {
            var raw = element[0];
            var gap = 50;
            element.bind('scroll', function () {
                if (raw.scrollTop + raw.offsetHeight > raw.scrollHeight - gap) {
                    return scope.$eval(attrs.neverEndingStory);
                }
            });
        }
    };
}]);