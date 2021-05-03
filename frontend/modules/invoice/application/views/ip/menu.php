<?php
  use frontend\modules\invoice\application\components\Utilities;
  use frontend\modules\invoice\application\components\Currency;
  use frontend\modules\invoice\assets\CoreCustomCssJsAsset;
  use frontend\modules\invoice\assets\InvoiceThemeNoMonospaceAsset;
  CoreCustomCssJsAsset::register($this);
  InvoiceThemeNoMonospaceAsset::register($this);
?>
<div id="nav-extra" class="nav">
    <?php //echo Yii::$app->controller->renderPartial('/layouts/includes/navbar',['mdl_settings'=>$mdl_settings_render_menu,'mylang'=>$dictionary_render_menu]);?> 
</div>
<div id="main-area">       
<?php //echo Yii::$app->controller->renderPartial('side_bar', ['languages'=>$dictionary_render_menu]); ?>  
<div id="main-content">   
<div id="headerbar">
    <h1 class="headerbar-title"><?= Utilities::trans('settings'); ?></h1>
    <div class="headerbar-item pull-right">
        <div class="btn-group btn-group-sm">
             <?= Yii::$app->controller->renderPartial('header_buttons', ['hide_cancel_button' => true,'hide_submit_button'=>false,'languages'=>$dictionary_render_menu]); ?>   
        </div>
    </div>
</div>

<ul id="settings-tabs" class="nav nav-tabs nav-tabs-noborder">
    <li class="active">
        <a data-toggle="tab" href="#settings-general"><?= Utilities::trans('general'); ?></a>
    </li>
    <li>
        <a data-toggle="tab" href="#settings-invoices"><?= Utilities::trans('invoices'); ?></a>
    </li>
    <!--li>
        <a data-toggle="tab" href="#settings-email"><?php // Utilities::trans('email'); ?></a>
    </li-->
    <li>
        <a data-toggle="tab" href="#settings-online-payment"><?= Utilities::trans('online_payment'); ?></a>
    </li>
</ul>
<form method="post" id="form-settings" enctype="multipart/form-data">
   <input type="hidden" name="<?=Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken(); ?>">
    <div class="tabbable tabs-below">
        <div class="tab-content">
            <div id="settings-general" class="tab-pane active">
                <?php                      
                       echo Yii::$app->controller->renderPartial('partial_settings_general',[
                       'company'=>$company_render_menu,
                       'mdl_settings'=>$mdl_settings_render_menu,
                       'languages'=>$dictionary_render_menu,
                       'default_languages'=>$default_dictionary_render_menu,
                       'gateway_currency_codes' =>Currency::all()    
                ]);?>
            </div>
            <div id="settings-invoices" class="tab-pane">
                <?php                      
                       echo Yii::$app->controller->renderPartial('partial_settings_invoices',[
                       'mdl_settings'=>$mdl_settings_render_menu,
                       'languages'=>$dictionary_render_menu,
                       'payment_methods'=>$payment_methods_render_menu, 
                       'pdf_invoice_templates'=>$pdf_invoice_templates_render_menu,                      
                       'public_invoice_templates' => $public_invoice_templates_render_menu,  
                       'all_email_invoice_templates'=>$all_email_invoice_templates_render_menu
                ]);?>
            </div>        
            <div id="settings-email" class="tab-pane">
                <?php echo Yii::$app->controller->renderPartial('partial_settings_email',[
                       'mdl_settings'=>$mdl_settings_render_menu,
                       'languages'=>$dictionary_render_menu,
                       'crypt'=>$crypt_render_menu,    
                ]);?>
            </div>
            <div id="settings-online-payment" class="tab-pane">
                <?php echo Yii::$app->controller->renderPartial('partial_settings_payment_provider',[
                       'mdl_settings'=>$mdl_settings_render_menu,
                       'payment_methods'=>$payment_methods_render_menu,
                       'gateway_drivers' =>$gateway_drivers_render_menu,
                       'languages'=>$dictionary_render_menu,
                       'crypt'=>$crypt_render_menu,
                       'gateway_currency_codes' =>Currency::all()  
                ]);?>
            </div>
            <div id="settings-projects-tasks" class="tab-pane">
                <?php ; ?>
            </div>
            <div id="settings-updates" class="tab-pane">
                <?php ; ?>
            </div>
        </div>
    </div>
</form>
</div>    
</div>
