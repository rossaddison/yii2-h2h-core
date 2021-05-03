<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Salesinvoicesetting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="salesinvoicesetting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'setting_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'setting_value')->textarea(['rows' => 1]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
