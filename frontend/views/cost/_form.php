<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use frontend\models\Costcategory;
use kartik\depdrop\DepDrop;
?>
<div class="cost-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'costcategory_id')->dropDownList(ArrayHelper::map(Costcategory::find()->all(),'id','name'),['prompt'=>Yii::t('app','Select...'),'id'=>'cat_id']) ?>
    <?= $form->field($model, 'costsubcategory_id')->widget(DepDrop::classname(), [
        'options'=>['id'=>'subcat_id'],
        'pluginOptions'=>[
        'depends'=>['cat_id'], 
        'url'=>Url::to(['/cost/subcatcost'])        
    ]
    ]); ?>
    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'costnumber')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'costcodefirsthalf')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'costcodesecondhalf')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'frequency')->dropDownList([Yii::t('app','Daily') =>Yii::t('app','Daily'),Yii::t('app','Weekly') =>Yii::t('app','Weekly'),Yii::t('app','Fortnightly')=>Yii::t('app','Fortnightly'),Yii::t('app','Monthly')=>Yii::t('app','Monthly'),Yii::t('app','Every two months')=>Yii::t('app','Every two months'),Yii::t('app','Other')=>Yii::t('app','Other')], ['prompt' => Yii::t('app','Select')]) ?>
    <?= $form->field($model, 'listprice')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'coststartdate')->widget(\yii\jui\DatePicker::classname(),[ 'dateFormat' => 'yyyy-MM-dd','inline'=>'true']) ?>
    <?= $form->field($model, 'discontinueddate')->widget(\yii\jui\DatePicker::classname(),[ 'dateFormat' => 'yyyy-MM-dd','inline'=>'true',]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

