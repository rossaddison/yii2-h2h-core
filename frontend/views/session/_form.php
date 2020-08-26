<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use Yii;
?>
<div class="session-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'expire')->textInput() ?>
    <?= $form->field($model, 'data')->textInput() ?>
    <?= $form->field($model, 'user_id')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app','Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
