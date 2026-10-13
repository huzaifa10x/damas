<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAssetLogin extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/core.css',
        'css/iconfont.css',
        'css/flag-icon.min.css',
        'css/style.css',
    ];
    public $js = [
        'js/core.js',
        'js/feather.min.js',
        'js/template.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap5\BootstrapAsset',
    ];
}
