<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use Yii;
?>
<div class="session-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <?= $form->field($model, 'id') ?>
    <?= $form->field($model, 'expire') ?>
    <?= $form->field($model, 'data') ?>
    <?= $form->field($model, 'user_id') ?>
    <?= $form->field($model, 'db') ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app','Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app','Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
