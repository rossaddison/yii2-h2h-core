<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use Yii;
?>
<div class="paymentrequest-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <?= $form->field($model, 'id') ?>
    <?= $form->field($model, 'sales_order_detail_id') ?>
    <?= $form->field($model, 'gc_payment_request_id') ?>
    <?= $form->field($model, 'status') ?>
    <?= $form->field($model, 'modified_date') ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app','Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app','Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
