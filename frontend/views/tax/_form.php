<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="tax-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'tax_type')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'tax_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'tax_percentage')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
