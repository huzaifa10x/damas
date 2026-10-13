<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $css = [
        'css/site.css',
        'css/app.min.css',
    ];

    // CSS ko 'preload' karne ke liye
    public $cssOptions = [
        'rel' => 'preload',
        'as' => 'style',
        'onload' => "this.onload=null;this.rel='stylesheet'"
    ];

    public $js = [];

    public $jsOptions = [
        'position' => View::POS_END,
        'defer' => true, // Boolean true use karna zyada sahi hai
    ];
}