<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Stylesheets and scripts are printed directly by views/layouts/main.php (critical CSS order matters there).
 *
 * This bundle used to list 'css/site.css' and 'css/app.min.css':
 *  - css/site.css does not exist. Every page view requested it, Apache handed the miss to index.php,
 *    and Yii booted, ran the layout queries and rendered a full error page — a second PHP request per visit.
 *  - css/app.min.css was already loaded by the layout, so it was requested twice.
 * The bundle is kept (empty) because the layout registers it and Yii's own bundles depend on the asset system.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [];
    public $js = [];
}
