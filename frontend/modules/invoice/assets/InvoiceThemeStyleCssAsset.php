<?php

namespace frontend\modules\invoice\assets;

use yii\web\AssetBundle;

class InvoiceThemeStyleCssAsset extends AssetBundle
{
    public $sourcePath = '@frontend/modules/invoice/assets';

    public $css = [
       'invoice/css/style.css',
    ];
}
