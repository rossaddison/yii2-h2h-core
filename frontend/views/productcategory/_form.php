<?php
use yii\helpers\ArrayHelper;
use frontend\models\Tax;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use Yii;
?>
<div class="productcategory-form">
    <?php $form = ActiveForm::begin([
                'options' => [
                    //id for modal used in productcategory/create action
                    //essential for bootstrap modal to work.
                    'id' => 'create-productcategory-form'
                ]
    ]); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'tax_id')->dropDownList(ArrayHelper::map(Tax::find()->all(),'tax_id','tax_name'),['prompt'=>Yii::t('app','Tax Type')]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
