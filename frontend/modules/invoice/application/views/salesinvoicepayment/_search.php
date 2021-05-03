<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\model2\SalesinvoicePaymentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="salesinvoicepayment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'payment_id') ?>

    <?= $form->field($model, 'invoice_id') ?>

    <?= $form->field($model, 'payment_method_id') ?>

    <?= $form->field($model, 'payment_date') ?>

    <?= $form->field($model, 'payment_amount') ?>

    <?php // echo $form->field($model, 'payment_note') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
