<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\invoice\application\models\SalesinvoicemethodpaySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="salesinvoiceuploads-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'upload_id') ?>

    <?= $form->field($model, 'product_id') ?>

    <?= $form->field($model, 'url_key') ?>

    <?= $form->field($model, 'file_name_original') ?>

    <?= $form->field($model, 'file_name_new') ?>

    <?php // echo $form->field($model, 'uploaded_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
