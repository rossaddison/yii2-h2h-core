<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use Yii;
//here you set the alias. NOT in bootstrap.

//these are the view settings under the frontend/config/main.php

// 'view' => [
//            'theme' => [
//                  'pathMap' => ['@app/views'=>'@webroot/frontend/web/themes/cerulean'],
                //'pathMap' => ['@app/views' => '@webroot/themes/cerulean',],
                //@web is the topmost directory concatenated with the web url
//                   'baseUrl'=> '@web/frontend/web/themes/cerulean',
                //'baseUrl' => '@web/themes/cerulean',                
//            ],//theme
//        ],//view


Yii::setAlias('@themes', Yii::$app->view->theme->baseUrl);
/**
 * Main frontend application asset bundle.
 */
class ThemeAsset extends AssetBundle
{
    //trying to integrate dotplant2
    //public $sourcePath = '@app/assets/app';
    //$sourcePath and $basePath mutually exclude each other
    //remove the basepath and this will effect the theme 
    //@webroot is the root directory
    //@webroot is the root url with the @web combined.
    
    //the themes folder is located here.
    public $basePath = '@webroot/frontend/web';
    //public $basePath = '@frontend/web';
    
    //public $baseUrl = '@web/frontend/web';
    
    //@themes alias located at common/config/bootstrap.php
    //@themes points to the themes folder
    //frontend/config/main.php .... 'baseUrl'=> '@web/frontend/web/themes/cerulean',
    public $baseUrl = '@themes';
    
    public $css = [
        'css/bootstrap.css',
        'css/bootstrap.min.css',
        'css/site.css',
    ];
    
    public $js = [];
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
