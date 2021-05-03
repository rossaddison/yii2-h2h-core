<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\invoice\application\components\Utilities;
?>
<div class="salesinvoiceemailtemplate-form">
<?php $form = ActiveForm::begin(); ?>   
<div id="headerbar">
        <h1 class="headerbar-title"><?= Utilities::trans('email_template_form'); ?></h1>
        <div class="headerbar-item pull-right">
            <div class="btn-group btn-group-sm">
               <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success ajax-loader' : 'btn btn-primary ajax-loader']) ?> 
            </div>    
        </div>
</div>
<div id="content"> 
 <div class="row">
  <div class="col-xs-12 col-md-8 col-md-offset-2">
    <br>
    <?= $form->field($model, 'email_template_title')->begin();
        echo Html::activeLabel($model,'email_template_title',['label'=>Utilities::trans('title'),'class'=>'control-label','for'=>'email_template_title']); 
        echo Html::activeTextInput($model, 'email_template_title',['class'=>'form-control']); 
        echo Html::error($model,'email_template_title', ['class' => 'help-block','errorSource'=>Utilities::trans('form_validation_required')]);
        $form->field($model, 'email_template_title')->end();        
    ?>
    <br>
    <?= $form->field($model, 'email_template_type')->begin();
        echo Html::activeLabel($model,'email_template_type',['label'=>Utilities::trans('type'),'class'=>'control-label']); //label
        echo '<br>';
        echo '<br>';
        echo Html::activeRadio($model, 'email_template_type',['label'=>null,'id'=>'email_template_type_invoice', 'value'=>'invoice', 'checked' => true]);
        echo str_repeat("&nbsp;", 3);
        echo Utilities::trans('invoice');
        echo '<br>';
        echo Html::activeRadio($model, 'email_template_type',['label'=>null,'id'=>'email_template_type_quote', 'value'=>'quote', 'disabled'=>true, 'checked' => false]); 
        echo str_repeat("&nbsp;", 3);
        echo Utilities::trans('quote');
        $form->field($model, 'email_template_type')->end(); 
    ?>
    <br>
    <br>   
    <?= $form->field($model, 'email_template_from_name')->begin();
        echo Html::activeLabel($model,'email_template_from_name',['label'=>Utilities::trans('from_name'),'class'=>'control-label']); //label
        echo Html::activeTextInput($model, 'email_template_from_name',['label'=>null,'class'=>'form-control taggable','id'=>'email_template_from_name']); 
        echo Html::error($model,'email_template_from_name', ['class' => 'help-block','errorSource'=>Utilities::trans('form_validation_required')]);
        $form->field($model, 'email_template_from_name')->end();      
    ?>
    <br>
    <?= $form->field($model, 'email_template_cc')->begin();
        echo Html::activeLabel($model,'email_template_cc',['label'=>Utilities::trans('cc'),'class'=>'control-label']); //label
        echo Html::activeTextInput($model, 'email_template_cc',['label'=>null,'class'=>'form-control taggable','id'=>'email_template_cc']); 
        $form->field($model, 'email_template_cc')->end();  
    ?>
    <br>
    <?= $form->field($model, 'email_template_bcc')->begin();
       echo Html::activeLabel($model,'email_template_bcc',['label'=>Utilities::trans('bcc'),'class'=>'control-label']); //label
        echo Html::activeTextInput($model, 'email_template_bcc',['label'=>null,'class'=>'form-control taggable','id'=>'email_template_bcc']); 
         echo Html::error($model,'email_template_bcc', ['class' => 'help-block','errorSource'=>Utilities::trans('form_validation_valid_email')]);
        $form->field($model, 'email_template_bcc')->end();      
    ?>
    <br>      
    <?= $form->field($model, 'email_template_subject')->begin();
        echo Html::activeLabel($model,'email_template_subject',['label'=>Utilities::trans('subject'),'class'=>'control-label']); //label
        echo Html::activeTextInput($model, 'email_template_subject',['label'=>null,'class'=>'form-control taggable','id'=>'email_template_subject']);     //->textarea(['rows' => 6]) 
         echo Html::error($model,'email_template_subject', ['class' => 'help-block','errorSource'=>Utilities::trans('form_validation_required')]);
        $form->field($model, 'email_template_subject')->end();      
    ?>
    <br>
    <?= $form->field($model, 'email_template_pdf_template')->begin();
        echo Html::activeLabel($model,'email_template_pdf_template',['label'=>Utilities::trans('pdf_template'),'class'=>'control-label']); 
        echo Html::activeDropDownList($model, 'email_template_pdf_template',
                [Utilities::trans('pdf_template')=>$mdl_pdf_templates], 
                ['label'=>Utilities::trans('pdf_template'),
                 'class'=>'form-control',
                 'id'=>'email_template_pdf_template',
                 'prompt'=>['text' => 'Please select','options' => ['value' => 'none', 'class' => 'prompt', 'label' => 'Select']],
                ]);     //->textInput(['maxlength' => true])
        $form->field($model, 'email_template_pdf_template')->end();      
    ?>
    <br>
  
  <div class="row">
    <div class="col-xs-12 col-md-6">
       <div class="form-group">  
         <?php echo Yii::$app->controller->renderPartial('/mailer/template-tags',['languages'=>$languages]); ?>
       </div>    
    </div>      
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <?= $form->field($model, 'email_template_body')->begin();?>
            <div class="html-tags btn-group btn-group-sm">
                <span class="html-tag btn btn-default" data-tag-type="text-paragraph">
                    <i class="fa fa-fw fa-paragraph"></i>
                </span>
                <span class="html-tag btn btn-default" data-tag-type="text-linebreak">
                    &lt;br&gt;
                </span>
                <span class="html-tag btn btn-default" data-tag-type="text-bold">
                    <i class="fa fa-fw fa-bold"></i>
                </span>
                <span class="html-tag btn btn-default" data-tag-type="text-italic">
                    <i class="fa fa-fw fa-italic"></i>
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
                    <i class="fa fa-fw fa-code"></i>
                </span>
                <span class="html-tag btn btn-default" data-tag-type="text-hr">
                    &lt;hr/&gt;
                </span>
                <span class="html-tag btn btn-default" data-tag-type="text-css">
                    CSS
                </span>
            </div>
            <div>
                <?php
                  echo Html::activeLabel($model,'email_template_body',['label'=>Utilities::trans('body'),'class'=>'control-label']).'<br>';
                  echo Html::activeTextArea($model, 'email_template_body',['class'=>'email-template-body form-control taggable','id'=>'email_template_body','rows'=>8]); //Field 
                  echo Html::error($model,'email_template_body', ['class' => 'help-block','errorSource'=>Utilities::trans('form_validation_required')]); 
                  $form->field($model, 'email_template_body')->end(); 
                ?>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= Utilities::trans('preview'); ?>
                    <span id="email-template-preview-reload" class="pull-right cursor-pointer">
                        <i class="fa fa-refresh"></i>
                    </span>
                </div>
                <div class="panel-body">
                    <iframe id="email-template-preview"></iframe>
                </div>
            </div>
        </div>        
   </div>    
 </div>  
 </div>     
</div>
</div>
<?php ActiveForm::end(); ?>      
</div>
<?php
$js = <<< 'SCRIPT'
    $(function () {
        var email_template_type = "<?php echo $model->email_template_type); ?>";
        var $email_template_type_options = $("[name=email_template_type]");

        $email_template_type_options.click(function () {
            // remove class "show" and deselect any selected elements.
            $(".show").removeClass("show").parent("select").each(function () {
                this.options.selectedIndex = 0;
            });
            // add show class to corresponding class
            $(".hidden-" + $(this).val()).addClass("show");
        });
        if (email_template_type === "") {
            $email_template_type_options.first().click();
        } else {
            $email_template_type_options.each(function () {
                if ($(this).val() === email_template_type) {
                    $(this).click();
                }
            });
        }
    });

    $(document).ready(function() {
    	// find the type of template that has been loaded and enable/disable
        // the invoice and quote selects as required
        var inputValue = $('input[type="radio"]:checked').attr("value");

        if (inputValue === 'quote') {
            $('#tags_invoice').prop('disabled', 'disabled');
            $('#tags_quote').prop('disabled', false);
        } else {
            // inputValue === 'invoice'
            $('#tags_invoice').prop('disabled', false);
            $('#tags_quote').prop('disabled', 'disabled');
        }

        // if the radio input for 'type of template' gets clicked, check the
        // new value and enable/disable the invoice and quote selects as required.
    	$('input[type="radio"]').click(function() {
            var inputValue = $(this).attr("value");

            if (inputValue === 'quote') {
            	$('#tags_invoice').prop('disabled', 'disabled');
            	$('#tags_quote').prop('disabled', false);
            } else {
                // inputValue === 'invoice'
            	$('#tags_invoice').prop('disabled', false);
            	$('#tags_quote').prop('disabled', 'disabled');
            }
        });
    });
    SCRIPT;
    $this->registerJs($js);
?>
