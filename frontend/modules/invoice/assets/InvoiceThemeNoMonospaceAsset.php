<?php

namespace frontend\modules\invoice\assets;

use yii\web\AssetBundle;

class InvoiceThemeNoMonospaceAsset extends AssetBundle
{
    //modify your sourcepath to change your theme
    public $sourcePath = '@frontend/modules/invoice/assets';

    public $css = [
        //'invoice/css/monospace.css',
        'invoice/css/reports.css',
        'invoice/css/style.css',
        //templates.css causes screen width problems
        //'invoice/css/templates.css',
        'invoice/css/welcome.css',
    ];
    
    public $scss = [
        'invoice/scss/_custom_styles.scss',
        'invoice/scss/_ip_variables.scss',
        'invoice/scss/_variables.scss',
        //'invoice/scss/monospace.scss',
        'invoice/scss/reports.scss',
        'invoice/scss/style.scss',
        'invoice/scss/templates.scss',
        'invoice/scss/welcome.scss',
        'invoice/scss/includes/_bootstrap-welcome.scss',
        'invoice/scss/incluedes/_select2.scss',
        'invoice/scss/includes/_select2_bootstrap.scss',
    ];
}
