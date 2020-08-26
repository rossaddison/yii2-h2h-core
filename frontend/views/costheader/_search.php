<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="costheader-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <?= $form->field($model, 'cost_header_id')->hiddenInput(['maxlength' => true])->label(false) ?>
    <?= $form->field($model, 'status')->hiddenInput(['maxlength' => true])->label(false) ?>
    <?= $form->field($model, 'statusfile')->hiddenInput(['maxlength' => true])->label(false) ?>
    <?= $form->field($model, 'employee_id')->hiddenInput(['maxlength' => true])->label(false) ?>
    <?= $form->field($model, 'cost_date')->hiddenInput(['maxlength' => true])->label(false) ?>
    <?= $form->field($model, 'total_due') ?>
    <?= $form->field($model, 'sub_total') ?>
    <?php // echo $form->field($model, 'sub_total') ?>
    <?php // echo $form->field($model, 'tax_amt') ?>
    <?php // echo $form->field($model, 'total_due') ?>
    <?php // echo $form->field($model, 'modified_date') ?>
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
