<?php

namespace frontend\modules\invoice\assets;

use yii\web\AssetBundle;

class InvoiceThemeMonospaceAsset extends AssetBundle
{
    //modify your sourcepath to change your theme
    public $sourcePath = '@frontend/modules/invoice/assets';

    public $css = [
        'invoice/css/monospace.css',
        'invoice/scss/monospace.scss',
    ];
}
