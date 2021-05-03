<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\bootstrap4\BootstrapAsset;
use yii\web\YiiAsset;
use yii\web\JqueryAsset;
/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    
    public $sourcePath = '@app/assets/app';
    public $baseUrl = '@app';
    
    public $css = [        
        'css/site.css',
        '//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css',
        '//use.fontawesome.com/releases/v5.3.1/css/all.css',
        '//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css'
    ];
    
    public $js = [ 'js/scripts2.js',
                   'js/scripts_slider.js',
                   'js/scripts_gocardless.js',
                   'js/ajax-modal-popup.js',
                   '//kit.fontawesome.com/85ba10e8d4.js',
    ];
    
    public $depends = [
        BootstrapAsset::class,        
        YiiAsset::class,        
        JqueryAsset::class,
    ];
}
