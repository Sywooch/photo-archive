<div class="modal-header">
    <button style="float:right" class="btn btn-warning" type="button" ng-click="close()">Zamknij</button>
    <h3 class="modal-title">{{photo.title}}</h3>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-9">
            <table class="photo-main-container">
                <tr>
                    <td class="photo-button-container photo-button-container-left">
                        <button ng-click="goToPrevious(photo.id)"> < </button>
                    </td>
                    <td class="photo-container">
                        <div class="loader-in-dialog" ng-if="!visiblePhoto">
                            <img src="/images/cubeloader.gif"/>
                        </div>    
                        <img ng-src="/photo/img{{ photo.id }}_ax800" src="" style="max-height: 75vh" imageonload="showPhoto()"/>
                    </td>
                    <td class="photo-button-container photo-button-container-right">
                        <button ng-click="goToNext(photo.id)"> > </button>
                    </td>
                </tr>
            </table>
        </div>    
        <div class="col-md-3">
            <ul class="nav nav-tabs">
                <li ng-click="openTab(1)" role="presentation" ng-class="{'active': tab==1}"><a href="#">Informacje</a></li>
                <li ng-click="openTab(2)" role="presentation" ng-class="{'active': tab==2}"><a href="#">Dyskusja</a></li>
            </ul>
            <div ng-if="tab==1" class="row">{{ photo.description }}</div>
            <div ng-if="tab==2" class="row">tab2</div>
        </div>
    </div>    
</div>
<div class="modal-footer">
    
</div>