<?php

namespace frontend\modules\invoice\assets;

use yii\web\AssetBundle;

class InvoiceBlueThemeMonospaceAsset extends AssetBundle
{
    //modify your sourcepath to change your theme
    public $sourcePath = '@frontend/modules/invoice/assets';

    public $css = [
        'invoice_blue/css/monospace.css',        
    ];
}
