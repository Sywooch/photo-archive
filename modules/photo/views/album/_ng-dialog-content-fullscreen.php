<div class="photo-container">
    <div ng-click="goToPrevious(photo.id)" class="normallyHidden navi-button navi-button-left"><span class="glyphicon glyphicon-chevron-left"> </span></div>
    <div ng-click="goToNext(photo.id)" class="normallyHidden navi-button navi-button-right"><span class="glyphicon glyphicon-chevron-right"> </span></div>
    <div class="fullscreenmode normallyHidden" ng-click="ngToggleFullScreen()"><span class="glyphicon glyphicon-resize-small"> </span></div>
    <div class="loader-in-dialog" ng-if="!visiblePhoto">
        <img src="/images/cubeloader.gif"/>
    </div>  
    <img class="dialog-image" ng-src="/photo/img{{ photo.id }}_axa" src="" imageonload="showPhoto()"/>
</div>