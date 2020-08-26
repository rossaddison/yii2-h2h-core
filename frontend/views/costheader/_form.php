<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Employee;
?>
<div class="salesorderheader-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'statusfile')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'employee_id')->dropDownList(ArrayHelper::map(Employee::find()->all(),'id','title')) ?>
    <?= $form->field($model, 'cost_date')->widget(\yii\jui\DatePicker::classname(),[ 'dateFormat' => 'yyyy-MM-dd','inline'=>'true',]) ?> 
    <?= $form->field($model, 'sub_total')->hiddenInput(['maxlength' => true])->label(false) ?>
    <?= $form->field($model, 'tax_amt')->hiddenInput(['maxlength' => true])->label(false) ?>
    <?= $form->field($model, 'total_due')->hiddenInput(['maxlength' => true])->label(false) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
