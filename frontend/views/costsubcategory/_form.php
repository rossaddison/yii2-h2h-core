<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use frontend\models\Costcategory;
use yii\widgets\ActiveForm;
?>
<div class="costsubcategory-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'costcategory_id')->dropDownList(ArrayHelper::map(Costcategory::find()->all(),'id','name'),['prompt'=>Yii::t('app','Cost codes')]) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
