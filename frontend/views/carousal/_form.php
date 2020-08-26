<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
?>
<div class="carousal-form">
    <?php $form = ActiveForm::begin([
            'enableAjaxValidation' => false,
            'options' => ['enctype' => 'multipart/form-data'],
    ]);
    ?>
   <?= $form->field($model, 'image')->widget(FileInput::classname(), 
            [
                'options'=>['accept'=>'image/*'],
                 'pluginOptions'=>['allowedFileExtensions'=>['jpg', 'jpeg', 'gif','png','pdf','xls','xlsx','ods','odt','docx','doc'],
                  'showUpload'=>false,
                  'showRemove'=>false,
                  'multiple'=>false,
                  'resizeimages'=>true,
                  'browseClass' => 'btn btn-success btn-lg',
                  'uploadClass' => 'btn btn-info btn-lg',
                  'removeClass' => 'btn btn-danger btn-lg',
                  'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> '
                  ],
            ]); ?>
    <?= $form->field($model, 'content_alt')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'content_title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'content_caption')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'fontcolor')->dropDownList([Yii::t('app','black')=>Yii::t('app','black'),Yii::t('app','white')=>Yii::t('app','white'),Yii::t('app','red')=>Yii::t('app','red')],['prompt'=>Yii::t('app','Colour')]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
