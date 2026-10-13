<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/core.css',
        'css/jquery.steps.css',
        'css/flatpickr.min.css',
        'css/iconfont.css',
        'css/flag-icon.min.css',
        'css/style.css',
        'css/custom_new.css',
    ];
    public $js = [
        'js/core.js',
        'js/flatpickr.min.js',
        'js/apexcharts.min.js',
        'js/feather.min.js',
        'js/template.js',
        'js/dashboard-light.js',
        'js/custom.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];

}
