<?php

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            'name' => 'advanced-frontend',
        ],

        // Required by the layout's getOrSet() calls.
        // Swap to yii\redis\Cache if Redis is available (composer require yiisoft/yii2-redis).
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@runtime/cache',
            'keyPrefix' => 'fe_',
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                '<language>' => 'site/index',
                '' => 'site/index',
                '<language>/search' => 'site/search',
                '<language>/error' => 'site/error',
                '<language>/language' => 'site/language',
                '<language>/keyword-search' => 'site/keyword-search',
                '<language>/change-session' => 'site/change-session',
                '<language>/service-review' => 'site/service-review',
                '<language>/about-us' => 'site/about',
                '<language>/contact-us' => 'site/contact',
                '<language>/our-doctors' => 'site/our-doctors',
                '<language>/offers' => 'site/offers',
                '<language>/careers' => 'site/careers',
                '<language>/logout' => 'site/logout',
                '<language>/login' => 'site/login',
                '<language>/signup' => 'site/signup',
                '<language>/forgot-password' => 'site/forgot-password',
                '<language>/career-enquiry' => 'site/career-enquiry',
                '<language>/appointment-form' => 'site/appointment-form',
                '<language>/blogs' => 'site/blogs',
                '<language>/faq' => 'site/faq',
                '<language>/gallery' => 'site/gallery',
                '<language>/insurance' => 'site/insurance',
                '<language>/testimonials' => 'site/testimonials',
                '<language>/privacy-policy' => 'site/privacy-policy',
                '<language>/terms-and-conditions' => 'site/terms-and-conditions',
                '<language>/media-library' => 'site/media-library',
                '<language>/departments' => 'site/departments',
                '<language>/booking-success' => 'site/booking-success',
                '<language>/service/<service>/<slug>' => 'site/subservice-details',
                '<language>/department/<department>/<slug>' => 'site/service-details',
                '<language>/department/<slug>' => 'site/department-details',
                '<language>/product/<slug>' => 'site/product-details',
                '<language>/doctor/<slug>' => 'site/doctor-details',
                '<language>/blog/<slug>' => 'site/blog-details',
                '<language>/cart' => 'cart/index',
                '<language>/checkout' => 'checkout/index',
                '<language>/payment' => 'checkout/payment',
                '<language>/order-success' => 'checkout/order-success',
                '<language>/order-failed' => 'checkout/order-failed',
                '<language>/payment/<id>' => 'checkout/payment-gateway',
                '<language>/payment-success/<order_id>' => 'checkout/payment-success',
                '<language>/payment-failed/<order_id>' => 'checkout/payment-failed',
                '<language>/ajax/add-to-cart' => 'ajax/add-to-cart',
                '<language>/ajax/cart-remove' => 'ajax/cart-remove',
                // Generic slug rule stays last
                '<language>/<slug>' => 'site/landing-page',
            ],
        ],
        'assetManager' => [
            'appendTimestamp' => true,
            'bundles' => [
                // The layout <head> already loads jQuery 3.7 from cdnjs synchronously.
                // Yii's copy was only deferred before — it was still a second 90KB download.
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'js' => [],
                ],
                // jQuery UI: not used (only its CSS was linked, JS was commented out)
                'yii\jui\JuiAsset' => [
                    'sourcePath' => null,
                    'js' => [],
                    'css' => [],
                ],
                // Bootstrap 5 CSS + bundle JS are in the layout <head> from jsdelivr
                'yii\bootstrap5\BootstrapAsset' => [
                    'sourcePath' => null,
                    'css' => [],
                ],
                'yii\bootstrap5\BootstrapPluginAsset' => [
                    'sourcePath' => null,
                    'js' => [],
                ],
                // Legacy bootstrap4 keys kept harmless in case any old widget still depends on them
                'yii\bootstrap4\BootstrapAsset' => [
                    'sourcePath' => null,
                    'css' => [],
                ],
                'yii\bootstrap4\BootstrapPluginAsset' => [
                    'sourcePath' => null,
                    'js' => [],
                ],
            ],
        ],
    ],
    'params' => $params,
];