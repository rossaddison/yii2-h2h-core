<?php
    use yii\helpers\ArrayHelper;
    use yii\helpers\Html;
    use frontend\models\Productcategory;
    use yii\widgets\ActiveForm;
    use dosamigos\ckeditor\CKEditor;
    use Yii;
?>
<div class="productsubcategory-form">
    <?php $form = ActiveForm::begin([
                'options' => [
                    //id for modal used in productsubcategory/create action
                    //essential for bootstrap modal to work.
                    'id' => 'create-productsubcategory-form'
                ]
    ]); ?>
    <?= $form->field($model, 'productcategory_id')->dropDownList(ArrayHelper::map(Productcategory::find()->orderBy('name')->all(),'id','name'),['prompt'=>Yii::t('app','Postcodes')]) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'lat_start')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'lng_start')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'lat_finish')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'lng_finish')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'sort_order')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'directions_to_next_productsubcategory')->widget(CKEditor::className(),['options' => ['rows' => 20],'preset' => 'full']) ?>
    <?= $form->field($model, 'isactive')->checkbox() ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
