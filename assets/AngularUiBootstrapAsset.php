<?php
namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;
use Yii;

class AngularUiBootstrapAsset extends AssetBundle
{
    /* http://gromo.github.io/jquery.scrollbar/ */
    public $sourcePath = '@app/assets/scripts/angular-ui-bootstrap/';
    public $js = [
        'ui-bootstrap-tpls-1.3.1.min.js',
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