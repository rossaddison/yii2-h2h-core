<?php

use frontend\modules\backup\components\SessionHelper;

$config = [
    'id' => 'frontend-backuper',
    'basePath' => dirname(__DIR__),
    'language' => 'en',
    'defaultRoute' => 'backuper/backuper',
    'modules' => [
        'backuper' => [
            'class' => 'frontend\modules\backup\Module',
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
            'cookieValidationKey' => 'BACKUPER_COOKIE',
            'enableCsrfValidation' => false,
        ],
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'linkAssets' => YII_DEBUG && stripos(PHP_OS, 'win')!==0,
        ],
        'sessionHelper' => [
            'class' => SessionHelper::class
        ]

    ],
    'params' => [
        'icon-framework' => 'fa',
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
];

if (YII_CONSOLE) {
    echo "backuper is running in console\n";
    unset($config['components']['request']);
    $config['defaultRoute'] = 'backup/index';
    $config['controllerNamespace'] = 'frontend\modules\backup\commands';
}

return $config;
