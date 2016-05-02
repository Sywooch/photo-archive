<?php
namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;
use Yii;

class AngularAnimateAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/scripts/angular-animate/';
    public $js = [
        'angular-animate.min.js',
    ];
    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];
    
    public function init()
    {
        parent::init();
        $this->publishOptions['forceCopy'] = Yii::$app->params['assetsForceCopy'];
    }
}