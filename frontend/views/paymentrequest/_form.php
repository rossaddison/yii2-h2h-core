<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="paymentrequest-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'id')->textInput() ?>
    <?= $form->field($model, 'sales_order_detail_id')->textInput() ?>
    <?= $form->field($model, 'gc_payment_request_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'modified_date')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
