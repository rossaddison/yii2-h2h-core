<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="instruction-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'code_meaning')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'include')->checkbox() ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
