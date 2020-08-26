<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Employee;
use frontend\models\Carousal;
?>
<div class="salesorderheader-form">
    <?php $form = ActiveForm::begin([
                'options' => [
                    //id for modal used in salesorderheader/create action
                    //essential for bootstrap modal to work.
                    'id' => 'create-salesorderheader-form'
                ]
    ]); ?>
    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'employee_id')->dropDownList(ArrayHelper::map(Employee::find()->all(),'id','title')) ?>
    <?= $form->field($model, 'clean_date')->widget(\kartik\datecontrol\DateControl::classname(),['displayFormat' => 'php:Y-m-d',
                                'saveFormat' => 'php:Y-m-d',
                                'options' => [
                                    'pluginOptions' => ['autoclose' => true],
                                    'convertFormat'=>true 
                                ]]) ?> 
    <?= $form->field($model, 'hoursworked')->dropDownList([0=>0,1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12]) ?>
    <?= $form->field($model, 'carousal_id')->dropDownList(ArrayHelper::map(Carousal::find()->all(),'id','image_source_filename'),['prompt'=>'Please Select a File']) ?>
    <?php // $form->field($model, 'sub_total')->hiddenInput(['maxlength' => true])->label(false) ?>
    <?php // $form->field($model, 'sub_total')->textInput(['maxlength' => true]) ?>
    <?php //$form->field($model, 'tax_amt')->hiddenInput(['maxlength' => true])->label(false) ?>
    <?php // $form->field($model, 'total_due')->textInput(['maxlength' => true]) ?>
    <?php //= $form->field($model, 'modified_date')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
