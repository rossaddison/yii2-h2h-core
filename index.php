<?php

//if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
    //if(!headers_sent()) {
        //header("Status: 301 Moved Permanently");
       // header(sprintf(
            //'Location: https://%s%s',
            //$_SERVER['HTTP_HOST'],
            //$_SERVER['REQUEST_URI']
        //));
        //exit();
    //}
//}


defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
defined('YII_CONSOLE') or define('YII_CONSOLE', false);

//vendors from composer.json
require (__DIR__ . '/vendor/autoload.php');

//yii framework
require(__DIR__  . '/vendor/yiisoft/yii2/Yii.php');

//aliases
require(__DIR__ . '/common/config/bootstrap.php');

//empty
require(__DIR__ . '/frontend/config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    //filecache and dbmanager
    require(__DIR__ . '/common/config/main.php'),
    
    //db component
    require(__DIR__ . '/common/config/main-local.php'),
    
    //etc... UrlManager ,  swiftmailer
    require(__DIR__ . '/frontend/config/main.php'),
    
    //cookie validation key
    require(__DIR__ . '/frontend/config/main-local.php')
);
(new yii\web\Application($config));

//https://github.com/sjaakp/yii2-pluto/issues/18  Closed.
Yii::$container->set('yii\widgets\LinkPager', 'yii\bootstrap4\LinkPager');

Yii::$app->run(); 
