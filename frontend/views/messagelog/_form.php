<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="messagelog-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'message')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'date')->textInput() ?>
    <?= $form->field($model, 'phoneto')->textInput() ?>
    <?= $form->field($model, 'salesorderdetail_id')->textInput() ?>
    <?= $form->field($model, 'product_id')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app','Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
