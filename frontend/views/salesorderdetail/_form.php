<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Instruction;
use Yii;
?>
<div class="salesorderdetail-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'sales_order_id')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'nextclean_date')->widget(\yii\jui\DatePicker::classname(),[ 'dateFormat' => 'yyyy-MM-dd','inline'=>'true',]) ?> 
    <?= $form->field($model, 'cleaned')->dropDownList([ Yii::t('app','Cleaned') => Yii::t('app','Cleaned'), Yii::t('app','Missed') => Yii::t('app','Missed'),Yii::t('app','Next Month Please') => Yii::t('app','Next Month Please'),Yii::t('app','Fronts Done Only') => Yii::t('app','Fronts Done Only'),Yii::t('app','Backs Done Only') => Yii::t('app','Backs Done Only')], ['prompt' => '']) ?>
    <?= $form->field($model, 'productcategory_id')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'productsubcategory_id')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'product_id')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'unit_price')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'advance_payment')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'paid')->textInput() ?>
    <?= $form->field($model, 'instruction_id')->dropDownList(Arrayhelper::map(Instruction::find()->orderBy('id')->asArray()->all(),'id','code'), ['prompt' => '']) ?>
    <?= $form->field($model, 'tip')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
