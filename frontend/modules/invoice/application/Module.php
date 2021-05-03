<?php
namespace frontend\modules\invoice\application;
use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\invoice\application\controllers';
    
    public function init()
    {
        Yii::setAlias('@invoice',__DIR__);
        parent::init();
        \Yii::configure($this, require __DIR__ . '/config/params.php');        
    }
}