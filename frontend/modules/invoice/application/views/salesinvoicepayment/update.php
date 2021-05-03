<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\SalesinvoicePayment */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'SalesinvoicePayments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->payment_id, 'url' => ['view', 'id' => $model->payment_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="salesinvoicepayment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'view_invoice_id'=>$view_invoice_id,'view_payment_expected'=>$view_payment_expected
    ]) ?>

</div>
