<!--<div class="modal-header">
    
</div>-->
<div id="dialog-close-button" ng-click="close()" class="glyphicon glyphicon-remove-sign"></div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-9">
            <div class="photo-container">
                <div ng-click="goToPrevious(photo.id)" class="normallyHidden navi-button navi-button-left"><span class="glyphicon glyphicon-chevron-left"> </span></div>
                <div ng-click="goToNext(photo.id)" class="normallyHidden navi-button navi-button-right"><span class="glyphicon glyphicon-chevron-right"> </span></div>
                <div class="fullscreenmode normallyHidden" ng-click="ngToggleFullScreen()"><span class="glyphicon glyphicon-resize-full"> </span></div>
                <div class="loader-in-dialog" ng-if="!visiblePhoto">
                    <img src="/images/cubeloader.gif"/>
                </div>    
                <img class="dialog-image" ng-src="/photo/img{{ photo.id }}_ax800" src="" imageonload="showPhoto()"/>
            </div>
        </div>    
        <div class="col-md-3" style="padding: 0px;">
            <div class="col-md-12 dialog-title">
                <b class="modal-title">{{photo.title}}</b>
            </div>
            <ul class="nav nav-tabs">
                <li ng-click="openTab(1)" role="presentation" ng-class="{'active': tab==1}"><a href="#"><span class="glyphicon glyphicon-info-sign"></span></a></li>
                <li ng-click="openTab(2)" role="presentation" ng-class="{'active': tab==2}"><a href="#"><span class="glyphicon glyphicon-comment"></span></a></li>
                <li ng-click="openTab(3)" role="presentation" ng-class="{'active': tab==3}"><a href="#"><span class="glyphicon glyphicon-tags"></span></a></li>
            </ul>
            <div class="col-md-12 dialog-tab-content">
                <div ng-if="tab==1" class="row">{{ photo.description }}</div>
                <div ng-if="tab==2" class="row">tab2</div>
                <div ng-if="tab==3" class="row">tab3</div>
            </div>    
        </div>
    </div>    
</div>
<!--<div class="modal-footer">
    
</div>-->