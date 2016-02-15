<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Album');
$this->params['breadcrumbs'][] = ['label'=>'Lista moich albumów','url'=>['/photo/admin/album/mylist']];
if ($id>0) {
	$this->params['breadcrumbs'][] = $id;
}
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php
echo \app\helpers\Html::errorSummary($model);

$form = ActiveForm::begin([
    'id' => 'album-form',
    'options' => ['class' => 'form-horizontal'],
]) ?>
    
	<div class="col-lg-12">
		<?= $form->field($model, 'name') ?>
		<?= $form->field($model, 'description')->textarea() ?>
		<?= $form->field($model, 'is_published')->checkbox() ?>
	</div>
	

    <div class="form-group">
        <div class="col-lg-12">
			<?= \app\helpers\Html::submitButton('Zapisz', ['class' => 'btn btn-primary']) ?>
			<?php if ($id > 0) : ?>
				<?= \app\helpers\Html::a('Dodaj zdjęcia', ['/photo/admin/photo/add','album_id'=>$id], ['class' => 'btn btn-default']); ?>
				<?= \app\helpers\Html::a('Przeglądaj zdjęcia', ['/photo/admin/photo/list','album_id'=>$id], ['class' => 'btn btn-default']); ?>
			<?php endif; ?>
        </div>
    </div>
<?php ActiveForm::end() ?>