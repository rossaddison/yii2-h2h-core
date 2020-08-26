<?php

namespace frontend\modules\backup\assets;

use yii\web\AssetBundle;

class BackuperAsset extends AssetBundle
{

    public $sourcePath = '@frontend/modules/backup/assets/backuper';
    public $css = [
        'css/backuper.css'
    ];
    public $js = [
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\web\JqueryAsset',
        'yii\validators\ValidationAsset',
        'yii\widgets\ActiveFormAsset',
        'yii\jui\JuiAsset',
        '\kartik\icons\FontAwesomeAsset',
        'frontend\modules\backup\assets\LaddaAsset',
    ];
}
