<?php
use \Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerJsFile($assetsPath.'/js/dropzone.js');
$this->registerCssFile($assetsPath.'/css/dropzone.css');

$this->title = Yii::t('app', 'Dodaj zdjęcia do albumu "'.$album->name.'"');
$this->params['breadcrumbs'][] = ['label'=>'Lista moich albumów','url'=>['/photo/admin/album/mylist']];
$this->params['breadcrumbs'][] = $album->id;
$this->params['breadcrumbs'][] = ['label'=>'Album','url'=>['/photo/admin/album/edit','id'=>$album->id]];
$this->params['breadcrumbs'][] = 'Dodaj zdjęcia';
?>

<h1><?= Html::encode($this->title) ?></h1>


<?php $form = ActiveForm::begin(['action'=>"/photo/admin/photo/target", 'options' => ['class'=>'dropzone', 'enctype' => 'multipart/form-data']]) ?>
	<?= Html::hiddenInput('album_id',$album->id)?>
<?php ActiveForm::end() ?>

<div class="form-group" style="margin-top: 10px;">
	<?= \app\helpers\Html::a('Edytuj album', ['/photo/admin/album/edit','id'=>$album->id], ['class' => 'btn btn-default']); ?>
	<?= \app\helpers\Html::a('Przeglądaj zdjęcia', ['/photo/admin/photo/list','album_id'=>$album->id], ['class' => 'btn btn-default']); ?>
</div>