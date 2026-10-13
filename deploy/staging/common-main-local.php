<?php
// STAGING (bk.damasmc.com) — common/config/main-local.php
// Fill in the 3 database values after uploading (cPanel → File Manager → Edit).
return [
    'components' => [
        'db' => [
            'class' => \yii\db\Connection::class,
            'dsn' => 'mysql:host=localhost;dbname=CPANELUSER_bkdamas',   // ← your new staging database
            'username' => 'CPANELUSER_bkdamas',                          // ← its MySQL user
            'password' => 'PUT-THE-PASSWORD-HERE',                       // ← its password
            'charset' => 'utf8mb4',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@common/mail',
            // Staging must NOT email the clinic: booking/contact emails are saved as files in
            // frontend/runtime/mail/ instead of being sent.
            'useFileTransport' => true,
        ],
    ],
];
