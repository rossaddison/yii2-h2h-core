<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
?>
<div class="importhouses-form">
    <?php $form = ActiveForm::begin([
            'enableAjaxValidation' => false,
            'options' => ['enctype' => 'multipart/form-data'],
    ]);
    ?> 
    <?= $form->field($model, 'importfile')->widget(FileInput::classname(), 
            [
                'options'=>['accept'=>'file/*'],
                'pluginOptions'=>['allowedFileExtensions'=>['xlsx','xls','ods'],
                  'showUpload'=>false,
                  'showRemove'=>true,
                  'multiple'=>false,
                  'resizeimages'=>false,
                  'browseClass' => 'btn btn-success',
                  'uploadClass' => 'btn btn-info',
                  'removeClass' => 'btn btn-danger',
                  'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> '
                  ],
            ]); ?>
    
   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Upload' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
