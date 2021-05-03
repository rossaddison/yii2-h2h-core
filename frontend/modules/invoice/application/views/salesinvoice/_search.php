<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\SalesinvoiceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="salesinvoice-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'invoice_id') ?>

    <?= $form->field($model, 'invoice_status_id') ?>

    <?= $form->field($model, 'is_read_only') ?>
    
    <?= $form->field($model, 'reference') ?>

    <?= $form->field($model, 'invoice_date_created') ?>

    <?= $form->field($model, 'invoice_time_created') ?>

    <?php // echo $form->field($model, 'invoice_date_modified') ?>

    <?php // echo $form->field($model, 'invoice_date_due') ?>

    <?php // echo $form->field($model, 'invoice_url_key') ?>

    <?php // echo $form->field($model, 'payment_method_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
