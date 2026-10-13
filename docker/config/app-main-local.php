<?php
// Local copy of frontend/config/main-local.php and backend/config/main-local.php (copied by docker/setup.sh).

// The root .htaccess / .user.ini / php.ini force the cPanel session folder (/var/cpanel/php/sessions/ea-php82),
// which does not exist outside cPanel. Store sessions in this app's runtime folder instead.
// (__DIR__ is frontend/config or backend/config once copied, so this is frontend/runtime/sessions etc.)
$sessionDir = dirname(__DIR__) . '/runtime/sessions';
if (!is_dir($sessionDir)) {
    @mkdir($sessionDir, 0777, true);
}

$config = [
    'components' => [
        'request' => [
            'cookieValidationKey' => 'local-dev-only-key-change-me',
        ],
        'session' => [
            'savePath' => $sessionDir,
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
