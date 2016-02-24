<ul>
<?php foreach ($albums as $album) : ?>
    <li><?=  yii\helpers\Html::a($album->name,['/photo/album/show','id'=>$album->id])?></li>
<?php endforeach; ?>
</ul>
