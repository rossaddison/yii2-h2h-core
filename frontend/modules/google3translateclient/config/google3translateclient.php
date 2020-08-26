<?php
$config = [
    'id' => 'frontend-google3translateclient',
    'basePath' => dirname(__DIR__),
    'language' => 'en',
    'defaultRoute' => 'google3/google3',
    'modules' => [
        'google3translateclient' => [
            'class' => 'frontend\modules\google3translateclient\Module',
        ],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\DummyCache',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 6 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'request' => [
            'cookieValidationKey' => 'GOOGLE3TRANSLATE_COOKIE',
            'enableCsrfValidation' => false,
        ],
    ],
    'params' => [
        'icon-framework' => 'fa',
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
];

return $config;
