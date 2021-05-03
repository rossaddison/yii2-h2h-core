<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\invoice\application\models\Salesinvoicemethodpay */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="salesinvoicemethodpay-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'payment_method_name')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
