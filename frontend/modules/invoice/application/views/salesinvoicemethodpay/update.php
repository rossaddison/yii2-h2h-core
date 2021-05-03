<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\invoice\application\models\Salesinvoicemethodpay */

$this->title = Yii::t('app', 'Update SalesinvoiceMethodPay: {name}', [
    'name' => $model->payment_method_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Customer Debt'), 'url' => Yii::getAlias('@web').'/product/index'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Daily Cleans'), 'url' => Yii::getAlias('@web').'/salesorderheader/index'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Sales Invoice'), 'url' => ['salesinvoice/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Sales Invoice Payment'), 'url' => ['salesinvoicepayment/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Sales Invoice Settings'), 'url' => ['ip/settings']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sales Invoice Payment Methods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->payment_method_id, 'url' => ['view', 'id' => $model->payment_method_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="salesinvoicemethodpay-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
