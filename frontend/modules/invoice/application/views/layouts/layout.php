`<?php   
   use frontend\modules\invoice\assets\InvoiceThemeNoMonospaceAsset;
   use frontend\modules\invoice\assets\CoreCustomCssJsAsset;
   use frontend\assets\AppAsset;
   use frontend\modules\invoice\application\helpers\EchoHelper;
   use frontend\modules\invoice\application\helpers\DateHelper;
   use frontend\modules\invoice\application\models\ci\Mdl_settings;
   use frontend\modules\invoice\application\libraries\Lang;
   use frontend\modules\invoice\application\components\Utilities;
   use Yii;
   use frontend\widgets\Alert;
   InvoiceThemeNoMonospaceAsset::register($this);
   CoreCustomCssJsAsset::register($this);
   AppAsset::register($this);
?>
<?php $this->beginPage(); ?>  
<!DOCTYPE html>
<html class="no-js" lang="<?= Utilities::trans('cldr'); ?>">

<?php 
   $echohelper = new EchoHelper();
   $datehelper = new DateHelper();
   $mdl_settings = new Mdl_settings();
   $mdl_settings->load_settings();
   $language = $mdl_settings->get_setting('default_language');
   //load the current languages lines for the settings and the gateway for each individual folder
   $lang =[];
   $thislang=[];
   $lang = new Lang();
   $lang->load('ip', $language);
   $thislang = $lang->_language;
?>
<head>
<?php 
   $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => '/favicon.png']); 
   $this->registerCsrfMetaTags();    
   $this->head();
?> 
</head>
<body class="<?php echo $mdl_settings->get_setting('disable_sidebar') ? 'hidden-sidebar' : ''; ?>">
<?php $this->beginBody()?>
<div class="wrap">
    <noscript>
        <div class="alert alert-danger no-margin"><?php //$echohelper->_trans('please_enable_js'); ?></div>
    </noscript>
    <div>
    <?php echo Yii::$app->controller->renderPartial('/layouts/includes/navbar',['mdl_settings'=>$mdl_settings,'mylang'=>$thislang]);?> 
    </div>
    <div id="main-area">
        <?php
        // Display the sidebar if enabled
        if ($mdl_settings->get_setting('disable_sidebar') != 1) {
            echo Yii::$app->controller->renderPartial('/layouts/includes/sidebar',['mdl_settings'=>$mdl_settings,'datehelper'=>$datehelper,'echohelper'=>$echohelper,'mylang'=>$thislang]);
        }
        else echo '';
        ?>
        <div id="main-content">
            <?= Alert::widget() ?>
            <?= $content; ?>
        </div>
    </div>
    <div id="modal-placeholder"></div>
    <?php echo Yii::$app->controller->renderPartial('/layouts/includes/fullpage-loader',['echohelper'=>$echohelper]); ?>
    <?php $this->endBody() ?>
</div>
</body>
</html>
<?php $this->endPage() ?>
