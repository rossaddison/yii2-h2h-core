<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var frontend\modules\invoice\application\models\SalesinvoiceUploads $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="salesinvoiceuploads-form">

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]); echo Form::widget([

        'model' => $model,
        'form' => $form,
        'columns' => 1,
        'attributes' => [

            'product_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Product ID...']],

            'url_key' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Url Key...', 'maxlength' => 32]],

            'file_name_original' => ['type' => Form::INPUT_TEXTAREA, 'options' => ['placeholder' => 'Enter Original Filename...','rows' => 6]],

            'file_name_new' => ['type' => Form::INPUT_TEXTAREA, 'options' => ['placeholder' => 'Enter New Filename...','rows' => 6]],

            'uploaded_date' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => DateControl::classname(),'options' => ['type' => DateControl::FORMAT_DATE]],

        ]

    ]);

    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
        ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
    );
    ActiveForm::end(); ?>

</div>
