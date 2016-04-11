<?php
namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

class JqueryCustomScrollAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/scripts/jquery-custom-scrollbar/';
    public $js = [
        'jquery.custom-scrollbar.min.js',
    ];
    public $css = [
        'jquery.custom-scrollbar.css',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];
}