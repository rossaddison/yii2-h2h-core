<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Carousal;
?>
<div class="costdetail-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'cost_header_id')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'nextcost_date')->widget(\yii\jui\DatePicker::classname(),[ 'dateFormat' => 'yyyy-MM-dd','inline'=>'true',]) ?> 
    <?= $form->field($model, 'paymenttype')->dropDownList([Yii::t('app','Cash') =>Yii::t('app','Cash'),Yii::t('app','Cheque')=>Yii::t('app','Cheque'),Yii::t('app','Paypal')=>Yii::t('app','Paypal'),Yii::t('app','Debitcard')=>Yii::t('app','Debitcard'),Yii::t('app','Creditcard')=>Yii::t('app','Creditcard'),Yii::t('app','Other')=>Yii::t('app','Other')], ['prompt' => Yii::t('app','Select')]) ?>
    <?= $form->field($model, 'cost_id')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'carousal_id')->dropDownList(ArrayHelper::map(Carousal::find()->all(),'id','image_source_filename'),['prompt' => '']) ?>
    <?= $form->field($model, 'order_qty')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'unit_price')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'line_total')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'paid')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
