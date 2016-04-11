/* Moduł TilesGallery */
var modTilesGallery = angular.module('tiles-gallery',[]);
modTilesGallery.directive('tilesGallery', ['$rootScope', '$window', function($rootScope, $window){
        
    var newSize = function (size,metaWidth,metaHeight) {
        var min = 0;
        var xy = 'x';
        if (metaWidth<=metaHeight) {
            min = metaWidth;
            xy = 'x';
        } else {
            min = metaHeight;
            xy = 'y';
        }

        var newWidth = metaWidth;
        var newHeight = metaHeight;
        if (min<size) {
            var param = 1;
            if (xy==='x') {
                param = size/metaWidth;
                newWidth = size;
                newHeight = metaHeight*param;
            } else {
                param = size/metaHeight;
                newWidth = metaWidth*param;
                newHeight = size;
            }
        }
        
        return [newWidth,newHeight];
    }    
        
    return {
        link: function(scope, element, attrs) {
            
            var raw = element[0];
            var src = attrs.tileSrc;
            
            var metaWidth;
            var metaHeight;
            
            var getMeta = function(url){
                var img = new Image();
                img.onload = function(){
                    /* wielkość wczytywanego pliku */
                    metaWidth = this.width;
                    metaHeight = this.height;
                    
                    var tileGalleryWidth = attrs.tileGalleryWidth;
                    var size = tileGalleryWidth*(attrs.tileSize/100);
                    
                    /* obliczanie nowych szerokości boków */
                    var meta = newSize(size,metaWidth,metaHeight);
                    
                    /* style */
                    angular.element(raw).css('height',size+'px');
                    angular.element(raw).css('width',size+'px');
                    angular.element(raw).css('background-image','url('+src+')');
                    angular.element(raw).css('background-position','center');
                    angular.element(raw).css('background-repeat','no-repeat');
                    angular.element(raw).css('background-size',meta[0]+'px '+meta[1]+'px');
                };
                img.src = url;
            };
            getMeta(src);
        }
    };
}]);