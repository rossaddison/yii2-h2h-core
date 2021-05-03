<?php
$config = [
    'id' => 'frontend-invoice',
    'basePath' => dirname(__DIR__),
    'components' => [
        'cache' => [
            'class' => 'yii\caching\DummyCache',
        ],
        'log' => [
            'class' => 'yii\log\FileTarget',
            'traceLevel' => YII_DEBUG ? 6 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'request' => [
            'class'=>'yii\web\request',
            'cookieValidationKey' => 'INVOICE_COOKIE',
            'enableCsrfValidation' => true,
        ],
        'urlManager' => [
            'class'=>'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'baseUrl'=> '/invoice/',
            'rules' => [
            ],
        ],
        'formatter' => [
                'class' => 'yii\i18n\Formatter',
                'locale' => 'en-GB', 
                'thousandSeparator' => ',',
                'decimalSeparator' => '.',
                'currencyCode' => 'GBP',
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

