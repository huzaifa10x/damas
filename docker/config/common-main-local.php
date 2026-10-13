<?php
// Local copy of common/config/main-local.php (copied there by docker/setup.sh).
// Production keeps its own main-local.php with the real credentials — never upload this one.
return [
    'components' => [
        'db' => [
            'class' => \yii\db\Connection::class,
            'dsn' => 'mysql:host=' . (getenv('DB_HOST') ?: '127.0.0.1') . ';dbname=' . (getenv('DB_NAME') ?: 'damas'),
            'username' => getenv('DB_USER') ?: 'root',
            'password' => getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : '',
            'charset' => 'utf8mb4',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@common/mail',
            // Emails are written to frontend/runtime/mail and backend/runtime/mail instead of being sent
            'useFileTransport' => true,
        ],
    ],
];
