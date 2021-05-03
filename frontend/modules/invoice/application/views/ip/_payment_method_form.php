<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\invoice\application\components\Utilities;
?>
<div class="salesinvoicepaymentmethod-form">
<?php $form = ActiveForm::begin(); ?>   
<div id="headerbar">
        <h1 class="headerbar-title"><?= Utilities::trans('payment_method_form'); ?></h1>
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
    <?= $form->field($model, 'payment_method_name')->begin();
        echo Html::activeLabel($model,'payment_method_name',['label'=>Utilities::trans('payment_method'),'class'=>'control-label','for'=>'payment_method_name']); 
        echo Html::activeTextInput($model, 'payment_method_name',['class'=>'form-control','id'=>'payment_method_name']); 
        echo Html::error($model,'payment_method_name', ['class' => 'help-block','errorSource'=>Utilities::trans('form_validation_required')]);
        $form->field($model, 'payment_method_name')->end();        
    ?>
    <br>
  </div>
 </div>   
<?php ActiveForm::end(); ?>      
</div>
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