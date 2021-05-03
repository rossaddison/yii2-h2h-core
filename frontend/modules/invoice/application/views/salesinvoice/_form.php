<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\modules\invoice\application\models\SalesinvoiceStatus;
use frontend\modules\invoice\application\models\Salesinvoicemethodpay;

/* @var $this yii\web\View */
/* @var $model frontend\models\Salesinvoice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="salesinvoice-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'invoice_status_id')->dropDownList(ArrayHelper::map(SalesinvoiceStatus::find()->orderBy('id')->all(),'id','code_meaning'),['prompt'=>'Select...']) ?>

    <?= $form->field($model, 'is_read_only')->checkbox() ?>
    
    <?= $form->field($model, 'reference')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'invoice_time_created')->textInput() ?>

    <?= $form->field($model, 'invoice_date_created')->widget(\kartik\datecontrol\DateControl::classname(),['displayFormat' => 'php:Y-m-d',
                                'saveFormat' => 'php:Y-m-d',
                                'options' => [
                                    'pluginOptions' => ['autoclose' => true],
                                    'convertFormat'=>true 
                                ]]) ?> 

    <?= $form->field($model, 'invoice_time_created')->textInput() ?>

    <?= $form->field($model, 'invoice_date_modified')->textInput() ?>

    <?= $form->field($model, 'invoice_date_due')->widget(\kartik\datecontrol\DateControl::classname(),['displayFormat' => 'php:Y-m-d',
                                'saveFormat' => 'php:Y-m-d',
                                'options' => [
                                    'pluginOptions' => ['autoclose' => true],
                                    'convertFormat'=>true 
                                ]]) ?> 

    <?= $form->field($model, 'invoice_url_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_method_id')->dropDownList(ArrayHelper::map(SalesinvoiceMethodPay::find()->orderBy('payment_method_id')->all(),'payment_method_id','payment_method_name'),['prompt'=>'Select...']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
