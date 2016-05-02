<div class="photo-container">
    <div class="fullscreenmode normallyHidden" ng-click="ngToggleFullScreen()"><span class="glyphicon glyphicon-fullscreen"> </span></div>
    <div class="loader-in-dialog" ng-if="!visiblePhoto">
        <img src="/images/cubeloader.gif"/>
    </div>  
    <img class="dialog-image" ng-src="/photo/img{{ photo.id }}_axa" src="" imageonload="showPhoto()"/>
</div>