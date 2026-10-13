<?php

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        // ONE cache shared by frontend, backend and console (same directory, same key prefix),
        // so an admin save in the backend can invalidate what the frontend has cached
        // (see common\components\ContentCache and backend/config/bootstrap.php).
        // If the host offers Redis: composer require yiisoft/yii2-redis and use yii\redis\Cache here.
        'cache' => [
            'class' => \yii\caching\FileCache::class,
            'cachePath' => '@frontend/runtime/cache',
            'keyPrefix' => 'damas_',
            // Remove expired cache files on ~1 in 1,000 writes (Yii's default is 1 in 100,000, so the folder only grows)
            'gcProbability' => 1000,
            'dirMode' => 0775,
            'fileMode' => 0664,
        ],
        // Merged into the 'db' defined in common/config/main-local.php (dsn/user/password stay there).
        // Without the schema cache every ActiveRecord class runs SHOW FULL COLUMNS + SHOW CREATE TABLE
        // on every request (≈15 tables on the homepage = ~30 extra queries).
        'db' => [
            'enableSchemaCache' => !YII_DEBUG,
            'schemaCacheDuration' => 86400,
            'schemaCache' => 'cache',
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
