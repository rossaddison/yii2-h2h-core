<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use Yii;
?>
<div class="paypalagreement-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'user_id')->textInput() ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'agreement_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'agreementplan_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'quantity')->textInput() ?>
    <?= $form->field($model, 'end_at')->textInput() ?>
    <?= $form->field($model, 'created_at')->textInput() ?>
    <?= $form->field($model, 'executed_at')->textInput() ?>
    <?= $form->field($model, 'updated_at')->textInput() ?>
    <?= $form->field($model, 'terminated_at')->textInput() ?>
    <?= $form->field($model, 'reactivated_at')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app','Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
