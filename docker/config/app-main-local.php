<?php
// Local copy of frontend/config/main-local.php and backend/config/main-local.php (copied by docker/setup.sh).
$config = [
    'components' => [
        'request' => [
            'cookieValidationKey' => 'local-dev-only-key-change-me',
        ],
    ],
];

// Yii debug toolbar locally (only when the dev packages are installed)
if (YII_ENV_DEV && class_exists(\yii\debug\Module::class)) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => \yii\debug\Module::class,
        'allowedIPs' => ['*'],
    ];
}

return $config;
