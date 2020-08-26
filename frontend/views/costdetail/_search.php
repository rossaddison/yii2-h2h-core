<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="salesorderdetail-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index','id'=>Yii::$app->session['sales_order_id']],
        'method' => 'get',
    ]); ?>
    <?php //$form->field($model, 'sales_order_id')->hiddenInput(['maxlength' => true])->label(false) ?>
    <?php //$form->field($model, 'sales_order_detail_id')->hiddenInput(['maxlength' => true])->label(false) ?>
    <?php //$form->field($model, 'nextclean_date') ?>
    <?php //$form->field($model, 'product_id') ?>
    <?php //$form->field($model, 'unit_price') ?>
    <?php // echo $form->field($model, 'paid') ?>
    <?php // echo $form->field($model, 'modified_date') ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app','Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app','Reset'), ['class' => 'btn btn-default']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
