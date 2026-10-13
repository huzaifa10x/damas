<?php

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'SetValues' => [
            'class' => 'common\components\SetValues'
        ],
        'CartFunctionality' => [
            'class' => 'common\components\CartFunctionality'
        ],
        'EncryptDecrypt' => [
            'class' => 'common\components\EncryptDecrypt'
        ],
        'SetLanguage' => [
            'class' => 'common\components\SetLanguage'
        ],
       'ProductListIingWidget' => [
            'class' => 'common\components\ProductListIingWidget'
        ],
        'AppointmentForm' => [
            'class' => 'common\components\AppointmentForm'
        ],
        'AppointmentModelHelper' => [
            'class' => 'common\components\AppointmentModelHelper'
        ],
    ],
];
