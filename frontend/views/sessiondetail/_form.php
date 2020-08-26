<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use Yii;
?>
<div class="sessiondetail-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'session_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'redirect_flow_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'db')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'product_id')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app','Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
