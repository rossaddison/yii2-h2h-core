<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="messagelog-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <?= $form->field($model, 'id') ?>
    <?= $form->field($model, 'message') ?>
    <?= $form->field($model, 'date') ?>
    <?= $form->field($model, 'phoneto') ?>
    <?= $form->field($model, 'salesorderdetail_id') ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app','Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app','Reset'), ['class' => 'btn btn-default']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
