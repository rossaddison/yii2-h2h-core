<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\invoice\application\components\Utilities;

/* @var $this yii\web\View */
/* @var $model frontend\models\Salesinvoiceemailtemplate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="salesinvoiceemailtemplate-form">
<div class="row">
    <div class="col-xs-12 col-md-8 col-md-offset-2">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email_template_title')->begin();
        echo Html::activeLabel($model,'email_template_title',['label'=>Utilities::trans('title'),'class'=>'control-label']); //label
        echo Html::activeTextInput($model, 'email_template_title',['class'=>'form-control']); //Field
        echo Html::error($model,'email_template_title', ['class' => 'help-block']);
        //->textarea(['rows' => 6]) 
        $form->field($model, 'email_template_title')->end();        
    ?>

    <?= $form->field($model, 'email_template_type',['label'=>Utilities::trans('type'),'class'=>'control-label'])->begin();
        echo Html::activeRadio($model, 'email_template_type',['label'=>Utilities::trans('invoice'),'id'=>'email_template_type_invoice', 'value'=>'invoice', 'checked' => true]); //Field
        echo Html::activeRadio($model, 'email_template_type',['label'=>Utilities::trans('quote'),'id'=>'email_template_type_quote', 'value'=>'quote', 'checked' => false]); 
        $form->field($model, 'email_template_type')->end(); 
    ?>
        
    <?= $form->field($model, 'email_template_from_name')->begin();
        echo Html::activeLabel($model,'email_template_from_name',['label'=>Utilities::trans('from_name'),'class'=>'control-label']); //label
        echo Html::activeTextInput($model, 'email_template_from_name',['label'=>Utilities::trans('from_name'),'class'=>'form-control taggable','id'=>'email_template_from_name']); 
        $form->field($model, 'email_template_from_name')->end();      
    ?>

    <?= $form->field($model, 'email_template_from_email')->begin();
        echo Html::activeLabel($model,'email_template_from_email',['label'=>Utilities::trans('from_email'),'class'=>'control-label']); //label
        echo Html::activeTextInput($model, 'email_template_from_email',['label'=>Utilities::trans('from_email'),'class'=>'form-control taggable','id'=>'email_template_from_email']); 
        $form->field($model, 'email_template_from_email')->end();      
    ?>

    <?= $form->field($model, 'email_template_cc')->begin();
        echo Html::activeLabel($model, 'email_template_cc',['label'=>Utilities::trans('cc'),'class'=>'control-label','id'=>'email_template_cc']); //Field
        echo Html::activeTextInput($model, 'email_template_cc',['label'=>Utilities::trans('cc'),'class'=>'form-control taggable','id'=>'email_template_cc']); 
        $form->field($model, 'email_template_cc')->end();  
    ?>

    <?= $form->field($model, 'email_template_bcc')->begin();
        echo Html::activeLabel($model, 'email_template_bcc',['label'=>Utilities::trans('bcc'),'class'=>'control-label','id'=>'email_template_bcc']); //Field
        echo Html::activeTextInput($model, 'email_template_bcc',['label'=>Utilities::trans('bcc'),'class'=>'form-control taggable','id'=>'email_template_bcc']); 
        $form->field($model, 'email_template_bcc')->end();      
    ?>
          
    <?= $form->field($model, 'email_template_subject')->begin();
        echo Html::activeLabel($model, 'email_template_subject',['label'=>Utilities::trans('subject'),'class'=>'control-label','id'=>'email_template_subject']); //Field
        echo Html::activeTextInput($model, 'email_template_subject',['label'=>Utilities::trans('subject'),'class'=>'form-control taggable','id'=>'email_template_subject']);     //->textarea(['rows' => 6]) 
        $form->field($model, 'email_template_subject')->end();      
    ?>

    <?= $form->field($model, 'email_template_pdf_template')->begin();
        echo Html::activeLabel($model, 'email_template_pdf_template',['label'=>Utilities::trans('pdf_template'),'class'=>'control-label','id'=>'email_template_pdf_template']); //Field
        echo Html::activeDropDownList($model, 'email_template_pdf_template',
                //items
                [
                    
                ],
                //options
                [
                 'options'=>[],  
                 'label'=>Utilities::trans('pdf_template'),
                 'class'=>'form-control',
                 'id'=>'email_template_pdf_template',
                 'prompt'=>['text' => 'Please select', 'options' => ['value' => 'none', 'class' => 'prompt', 'label' => 'Select']],
                 'groups'=>[Utilities::trans('invoices')=>[]]
                ]);     //->textInput(['maxlength' => true])
        $form->field($model, 'email_template_pdf_template')->end();      
    ?>
<div class="row">
    <div class="col-xs-12 col-md-6">    
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
    <?php
      echo Html::activeLabel($model,'email_template_body',['label'=>Utilities::trans('body'),'class'=>'control-label']).'<br>';
      echo Html::activeTextArea($model, 'email_template_body',['class'=>'email-template-body form-control taggable','id'=>'email_template_body','rows'=>8]); //Field 
      echo Html::error($model,'email_template_body', ['class' => 'help-block']); 
      $form->field($model, 'email_template_body')->end(); 
    ?> 
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
 </div>    
    <?php ActiveForm::end(); ?>
</div>
<div class="col-xs-12 col-md-6">
    <?php echo Yii::$app->controller->renderPartial('template-tags',['languages'=>$languages]); ?>
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