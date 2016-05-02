<div ng-include="getDialogView()"></div>
<script type="text/ng-template" id="normal">
    <?=$this->render('_ng-dialog-content-normal');?>
</script>
<script type="text/ng-template" id="fullscreen">
    <?=$this->render('_ng-dialog-content-fullscreen');?>
</script>