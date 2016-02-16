<?php
use yii\helpers\Html;

$this->title = Yii::t('app', $title);
$this->params['breadcrumbs'][] = ['label'=>'Lista moich albumów','url'=>['/photo/admin/album/mylist']];
$this->params['breadcrumbs'][] = $album->id;
$this->params['breadcrumbs'][] = ['label'=>'Album','url'=>['/photo/admin/album/edit','id'=>$album->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<?= yii\widgets\ListView::widget( [
    'dataProvider' => $dataProvider,
	'itemView' => '_photo',
] ); ?>