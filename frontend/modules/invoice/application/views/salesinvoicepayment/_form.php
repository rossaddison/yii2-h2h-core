<?php
use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\modules\invoice\application\models\Salesinvoicemethodpay;

/* @var $this yii\web\View */
/* @var $model frontend\models\SalesinvoicePayment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="salesinvoicepayment-form">
    
    <h2>Payment towards invoice: <?php echo $view_invoice_id ?></h2>

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'payment_method_id')->dropDownList(ArrayHelper::map(SalesinvoiceMethodPay::find()->orderBy('payment_method_name')->all(),'payment_method_id','payment_method_name'),['prompt'=>'Select...']) ?>
    
    <?= $form->field($model, 'payment_date')->widget(\kartik\datecontrol\DateControl::classname(),['displayFormat' => 'php:Y-m-d',
                                'saveFormat' => 'php:Y-m-d',
                                'options' => [
                                    'pluginOptions' => ['autoclose' => true],
                                    'convertFormat'=>true 
                                ]]) ?> 
   
    <h5>Payment expected: <?php echo $view_payment_expected ?></h5>
    
    <?= $form->field($model, 'payment_amount')->dropDownList([0 =>0,$view_payment_expected => $view_payment_expected],['prompt'=>'Select...']) ?>
    
    <?= $form->field($model, 'payment_note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
