<?php

namespace frontend\modules\invoice\assets;

use yii\web\AssetBundle;

class InvoiceBlueThemeNoMonospaceAsset extends AssetBundle
{
    //modify your sourcepath to change your theme
    public $sourcePath = '@frontend/modules/invoice/assets';

    public $css = [
        //'invoice/css/monospace.css',
        'invoice_blue/css/reports.css',
        'invoice_blue/css/style.css',
        //templates.css causes screen width problems
        //'invoice/css/templates.css',
        'invoice_blue/css/welcome.css',
        ];
    
    public $scss = [
        'invoice_blue/scss/_custom_styles.scss',
        'invoice_blue/scss/_ip_variables.scss',
        'invoice_blue/scss/_variables.scss',
        //'invoice/scss/monospace.scss',
        'invoice_blue/scss/reports.scss',
        'invoice_blue/scss/style.scss',
        'invoice_blue/scss/templates.scss',
        'invoice_blue/scss/welcome.scss',
        'invoice_blue/scss/includes/_bootstrap-welcome.scss',
        'invoice_blue/scss/incluedes/_select2.scss',
        'invoice_blue/scss/includes/_select2_bootstrap.scss',
    ]; 
}
