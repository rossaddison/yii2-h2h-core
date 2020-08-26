<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="employee-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'nationalinsnumber')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'contact_telno')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'birthdate')->widget(\kartik\datecontrol\DateControl::classname(),['displayFormat' => 'php:Y-m-d',
                                'saveFormat' => 'php:Y-m-d',
                                'options' => [
                                    'pluginOptions' => ['autoclose' => true],
                                    'convertFormat'=>true 
                                ]]) ?> 
    <?= $form->field($model, 'maritalstatus')->dropDownList([Yii::t('app','Single')=>Yii::t('app','Single'),Yii::t('app','Divorced')=>Yii::t('app','Divorced'),Yii::t('app','Married')=>Yii::t('app','Married')],['prompt'=>Yii::t('app','Marital Status')]) ?>
    <?= $form->field($model, 'gender')->dropDownList([Yii::t('app','Male')=>Yii::t('app','Male'),Yii::t('app','Female')=>Yii::t('app','Female')],['prompt'=>Yii::t('app','Gender')]) ?>
   <?= $form->field($model, 'hiredate')->widget(\kartik\datecontrol\DateControl::classname(),['displayFormat' => 'php:Y-m-d',
                                'saveFormat' => 'php:Y-m-d',
                                'options' => [
                                    'pluginOptions' => ['autoclose' => true],
                                    'convertFormat'=>true 
                                ]]) ?> 
    <?= $form->field($model, 'salariedflag')->dropDownList([Yii::t('app','Paid per hour - Not Salaried')=>Yii::t('app','Paid per hour - Not Salaried'),Yii::t('app','Not paid per hour - Salaried')=>Yii::t('app','Not paid per hour - Salaried')],['prompt'=>Yii::t('app','Salaried Flag')])?>
    <?= $form->field($model, 'vacationhours')->textInput() ?>
    <?= $form->field($model, 'sickleavehours')->textInput() ?>
    <?= $form->field($model, 'currentflag')->dropDownList([Yii::t('app','Not current')=>Yii::t('app','Not current'),Yii::t('app','Current')=>Yii::t('app','Current')],['prompt'=>Yii::t('app','Current Flag')]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>


