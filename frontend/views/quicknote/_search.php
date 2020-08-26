<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use Yii;
?>
<div class="quicknote-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <?= $form->field($model, 'id') ?>
    <?= $form->field($model, 'note') ?>
    <?= $form->field($model, 'created_at') ?>
    <?= $form->field($model, 'modified_at') ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app','Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app','Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
