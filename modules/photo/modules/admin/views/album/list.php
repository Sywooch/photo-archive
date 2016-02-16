<?php
use yii\helpers\Html;

$this->title = Yii::t('app', $title);
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    //'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
		'name',
		'description',
		[
			'class'=>'yii\grid\DataColumn',
			'attribute'=>'is_published',
			'value'=>function($model, $key, $index, $column){
				return $model->getIsPublishedStatus();
			}
		],
        [
			'class' => 'yii\grid\ActionColumn',
			'template' => '{edit} {add_photo} {photos}',
			'buttons' => [
				'edit' => function ($url, $model, $key) {
					return Html::a('<span class="glyphicon glyphicon-pencil" title="Edytuj"></span>', $url);
				},
				'add_photo' => function ($url, $model, $key) {
					return Html::a('<span class="glyphicon glyphicon-plus" title="Dodaj zdjęcia do albumu"></span>', ['/photo/admin/photo/add','album_id'=>$model->id]);
				},
				'photos' => function ($url, $model, $key) {
					return Html::a('<span class="glyphicon glyphicon-list" title="Lista zdjęć w albumie"></span>', ['/photo/admin/photo/list','album_id'=>$model->id]);
				},
			],
		],
    ],
]); ?>