<?php
namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

class JqueryScrollAsset extends AssetBundle
{
    /* http://gromo.github.io/jquery.scrollbar/ */
    public $sourcePath = '@app/assets/scripts/jquery-scrollbar/';
    public $js = [
        'jquery.scrollbar.min.js',
    ];
    public $css = [
        'jquery.scrollbar.css',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];
}