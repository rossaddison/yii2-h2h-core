<?php
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\widgets\Alert;
use kartik\icons\Icon;
use frontend\modules\invoice\application\components\Utilities;
use Yii;
use frontend\modules\invoice\assets\InvoiceThemeNoMonospaceAsset;
use frontend\modules\invoice\assets\CoreCustomCssJsAsset;
use frontend\models\Company;
CoreCustomCssJsAsset::register($this);
if ($mdl_settings->get_setting('monospace_amounts') == 1) { 
        //use the invoice theme with monospace.css
           InvoiceThemeMonospaceAsset::register($this);
      }
      else {            
           InvoiceThemeNoMonospaceAsset::register($this);  
}
?>
<div>
<form method="post" action="<?= Url::to(['mailer/sendinvoice','invoice_id' => $invoice->invoice_id]); ?>" enctype="multipart/form-data">
   <input type="hidden" name="<?=Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken(); ?>">
    <div id="headerbar">
        <h1 class="headerbar-title"><?=  Utilities::trans('email_invoice'); ?></h1>
        <div class="headerbar-item pull-right">
            <div class="btn-group btn-group-sm">
                <button id="btn-send" class="btn btn-primary ajax-loader" name="btn_send" value="1">
                    <?= Html::a(Icon::show('envelope', ['framework' => Icon::FAS])); ?>
                    <?= Utilities::trans('send'); ?>
                </button>
                <button class="btn btn-danger" name="btn_cancel" value="1">
                    <i class="fa fa-times"></i>
                    <?=  Utilities::trans('cancel'); ?>
                </button>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div id="main-content">
        <div class="row">
            <div class="col-xs-12 col-md-8 col-md-offset-2">
                <div class="info">
                    <?=          
                       Alert::widget();
                    ?>
                </div>
                <div class="form-group">
                    <label for="to_email"><?=  Utilities::trans('to_email'); ?></label>
                    <input type="email" multiple name="to_email" id="to_email" class="form-control" required
                           value="<?php 
                                    if ((!empty($invoice->user->email))) {
                                      //include the Online Payer email assigned as the payer for the householder
                                      echo $invoice->user->email;  
                                    } //include the householder email
                                    elseif (!empty($invoice->product->email)) {
                                      echo $invoice->product->email;  
                                    } else {echo Yii::t('app','No email account available - either Householder or Online Payer.');}
                                  ?>"> 
                </div>
                <hr>
                <div class="form-group">
                    <label for="email_template"><?=  Utilities::trans('email_template'); ?></label>
                    <select name="email_template" id="email_template" class="form-control simple-select" onchange="js:getTemplate()">
                        <option value=""><?=  Utilities::trans('none'); ?></option>
                        <?php foreach ($email_templates as $email_template): ?>
                            <option value="<?php echo $email_template->email_template_id; ?>"
                                <?php $mdl_settings->check_select($selected_email_template, $email_template->email_template_id); ?>>
                                <?= Html::encode($email_template->email_template_title); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="from_name"><?=  Utilities::trans('from_name'); ?></label>
                    <input type="text" name="from_name" id="from_name" class="form-control"
                           value="<?php
                               if (!empty($selected_email_template)) {   
                                   echo $current_email_template->email_template_from_name;                                           
                               }
                            ?>">
                </div>
                <div class="form-group">
                    <label for="from_email"><?=  Utilities::trans('from_email').str_repeat("&nbsp;", 2).Html::label(Icon::show('info-circle', ['framework' => Icon::FAS]),'',['data-toggle'=>'tooltip','title'=>Yii::t('app','Adjust your from email account in Other..Company.')])?></label>
                    <input type="email" name="from_email" id="from_email" class="form-control"
                           value="<?php echo Company::findOne(1)->email;?>">
                </div>
                <div class="form-group">
                    <label for="cc"><?= Utilities::trans('cc').str_repeat("&nbsp;", 2).Html::label(Icon::show('info-circle', ['framework' => Icon::FAS]),'',['data-toggle'=>'tooltip','title'=>Yii::t('app','Separate your email addresses with a comma.')])?></label>
                    <input type="text" name="cc" id="cc" 
                           value="<?php if (!empty($selected_email_template)) {echo $current_email_template->email_template_cc;}?>" class="form-control">
                </div>

                <div class="form-group">
                    <label for="bcc"><?=  Utilities::trans('bcc').str_repeat("&nbsp;", 2).Html::label(Icon::show('info-circle', ['framework' => Icon::FAS]),'',['data-toggle'=>'tooltip','title'=>Yii::t('app','Separate your email addresses with a comma.')])?></label>
                    <input type="text" name="bcc" id="bcc" 
                           value="<?php if (!empty($selected_email_template)) {echo $current_email_template->email_template_bcc;}?>" class="form-control">
                </div>

                <div class="form-group">
                    <label for="subject"><?= Utilities::trans('subject'); ?></label>
                    <input type="text" name="subject" id="subject" class="form-control"
                           value="<?php if (!empty($selected_email_template)) {echo Utilities::trans('invoice').'#'.$invoice->invoice_id;                                    
                               } else {
                                   echo $current_email_template->email_template_subject;                                           
                               }
                            ?>">
                </div>

                <div class="form-group">
                    <label for="pdf_template"><?= Utilities::trans('pdf_template').str_repeat("&nbsp;", 2). Html::label(Icon::show('info-circle', ['framework' => Icon::FAS]),'',['data-toggle'=>'tooltip','title'=>Yii::t('app','Depending on whether the invoice is normal, overdue, or paid, a pdf will automatically be generated and archived. No pdf is attached to this email automatically. Attach one manually using the attach button below. Use the email template to provide a summary to the customer.')])?></label>
                    <select name="pdf_template" id="pdf_template" class="form-control simple-select">
                        <option value=""><?= Utilities::trans('none'); ?></option>
                        <?php foreach ($pdf_templates as $pdf_template): ?>
                            <option value="<?php echo $pdf_template; ?>"
                                <?php $mdl_settings->check_select($selected_pdf_template, $pdf_template); ?>>
                                <?php echo $pdf_template; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                            <label for="body"><?= Utilities::trans('body'); ?></label>
                           <br>

                            <div class="html-tags btn-group btn-group-sm">
                                <span class="html-tag btn btn-default" data-tag-type="text-paragraph">
                                    <i class="fa fa-paragraph"></i>
                                </span>
                                <span class="html-tag btn btn-default" data-tag-type="text-linebreak">
                                    &lt;br&gt;
                                </span>
                                <span class="html-tag btn btn-default" data-tag-type="text-bold">
                                    <i class="fa fa-bold"></i>
                                </span>
                                <span class="html-tag btn btn-default" data-tag-type="text-italic">
                                    <i class="fa fa-italic"></i>
                                </span>
                            </div>
                            <div class="html-tags btn-group btn-group-sm">
                                <span class="html-tag btn btn-default" data-tag-type="text-h1">H1</span>
                                <span class="html-tag btn btn-default" data-tag-type="text-h2">H2</span>
                                <span class="html-tag btn btn-default" data-tag-type="text-h3">H3</span>
                                <span class="html-tag btn btn-default" data-tag-type="text-h4">H4</span>
                            </div>
                            <div class="html-tags btn-group btn-group-sm">
                                <span class="html-tag btn btn-default" data-tag-type="text-code">
                                    <i class="fa fa-code"></i>
                                </span>
                                <span class="html-tag btn btn-default" data-tag-type="text-hr">
                                    &lt;hr/&gt;
                                </span>
                                <span class="html-tag btn btn-default" data-tag-type="text-css">
                                    CSS
                                </span>
                            </div>
                            <?php
                              if (!empty($selected_email_template)) {   
                                  $btext = rtrim(ltrim($current_email_template->email_template_body));                                           
                              }
                              echo  Html::textarea('body',$btext,['id'=>'body','rows'=>8,'class'=>'email-template-body form-control taggable'])
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <?= Utilities::trans('preview'); ?>
                                    <div id="email-template-preview-reload" class="pull-right cursor-pointer">
                                        <i class="fa fa-refresh"></i>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <iframe id="email-template-preview"></iframe>
                                </div>
                            </div>
                            <br>                                                 
                </div>
                <div class="form-group">
                    <label for="<?= Utilities::trans('attachments'); ?>"><?= Utilities::trans('attachments'); ?></label>
                    <?=
                        Yii::$app->controller->renderPartial('attachments', ['dataProvider'=>$invoice->uploads]); 
                    ?>   
                </div>
                <div class="form-group">
                    <label for="filetoupload"><?= Utilities::trans('add_files').str_repeat("&nbsp;", 2). Html::label(Icon::show('info-circle', ['framework' => Icon::FAS]),'',['data-toggle'=>'tooltip','title'=>Yii::t('app','To add multiple files leave the body blank and click send.')])?></label>
                    <br>
                    <div>
                       <input type="file" name="filetoupload" id="filetoupload">
                    </div>
                </div>
                <div class="form-group"><label for="invoice-guest-url"><?= Utilities::trans('guest_url').str_repeat("&nbsp;", 2). Html::label(Icon::show('info-circle', ['framework' => Icon::FAS]),'',['data-toggle'=>'tooltip','title'=>Yii::t('app','Paste the Guest Url into the body if you have signed up a customer for online payment via this site. ')])?></label>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        <input type="text" id="invoice-guest-url" readonly class="form-control"
                               value="<?= Url::to(['view/invoice/','invoice_url_key'=> $invoice->invoice_url_key],true) ?>">
                        <div class="input-group-addon to-clipboard cursor-pointer"
                             data-clipboard-target="#invoice-guest-url">
                            <i class="fa fa-clipboard fa-fw"></i>
                        </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>    
</form>
</div>