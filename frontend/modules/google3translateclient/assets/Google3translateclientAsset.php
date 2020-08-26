<?php
namespace frontend\modules\google3translateclient\assets;

use yii\web\AssetBundle;
use Yii;
/**
 * Main frontend application asset bundle.
 */
class Google3translateclientAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/google3translateclient/assets/google3translateclient';
    public $baseUrl = '@app';
    public $css = [
        '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
        '//stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"',
        'css/site.css',
    ];
    public $js = [ 'js/scripts_google3translateclient.js'];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
        'yii\web\JqueryAsset',
    ];
}
