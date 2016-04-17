/* Moduł NeverEndingStory */
var mod = angular.module('never-ending-story',[]);
mod.directive('neverEndingStory', ['$rootScope', '$window', function($rootScope, $window){
    return {
        link: function(scope, element, attrs) {
            var raw = element[0];
            var gap = 0;
            var canScroll = true;
            var handler = function () {
//                var body = document.body,
//                    html = document.documentElement;
//
//                var siteHeight = Math.max( body.scrollHeight, body.offsetHeight, 
//                                       html.clientHeight, html.scrollHeight, html.offsetHeight );
                gap = window.outerHeight;//siteHeight - raw.offsetHeight;
                if(window.scrollY>=raw.offsetHeight-gap) {
//                if (raw.scrollTop + raw.offsetHeight > raw.scrollHeight - gap) {
                    if (canScroll) {
                        canScroll = false;
                        setTimeout(function(){
                            canScroll = true;
                        },2000);
                        return scope.$eval(attrs.neverEndingStory);
                    }
                }
            };
            angular.element($window).bind('scroll', handler);
        }
    };
}]);