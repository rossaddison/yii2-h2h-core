<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
?>
<div class="company-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'address_street')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'address_area1')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'address_area2')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'address_areacode')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'telephone')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'twilio_telephone')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'external_website_url')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'finyear_start_date')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'finyear_end_date')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'corp_tax_duedate')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'company_regno')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'vat_no')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'alt_reg_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'alt_reg_no')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'alt_expiry_date')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'alt2_reg_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'alt2_reg_no')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'alt2_expiry_date')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'sic_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'sic_code')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'sic2_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'sic2_code')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'salesorderheader_excludefullypaid')->checkbox() ?>
    <?= $form->field($model, 'homepage')->widget(CKEditor::className(),['options' => ['rows' => 20],'preset' => 'full']) ?>
    <?= $form->field($model, 'gc_accesstoken')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'gc_live_or_sandbox')->dropDownList(['SANDBOX' =>'SANDBOX','LIVE'=>'LIVE'], ['prompt' => 'Select']) ?>
    <?= $form->field($model, 'smtp_transport_host')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'smtp_transport_username')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'smtp_transport_password')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'smtp_transport_encryption')->dropDownList(['' =>'','tls'=>'tls','ssl'=>'ssl','tls/ssl'=>'tls/ssl'], ['prompt' => 'Select']) ?>
    <?= $form->field($model, 'smtp_transport_port')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'google_translate_json_filename_and_path')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'language')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'currency_prefix')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'currency_suffix')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
