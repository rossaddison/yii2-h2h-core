<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use Yii;
/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    
    public $sourcePath = '@app/assets/app';
    public $baseUrl = '@app';
    
    public $css = [
        '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',        
        'css/site.css'
    ];
    
    public $js = [ 'js/scripts2.js',
                   'js/scripts_slider.js',
                   'js/scripts_gocardless.js',
                   'js/ajax-modal-popup.js',
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
        'yii\web\JqueryAsset',
    ];
}
