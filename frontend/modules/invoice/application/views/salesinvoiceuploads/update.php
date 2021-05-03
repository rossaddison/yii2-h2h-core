<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\invoice\application\models\Salesinvoiceuploads */

$this->title = 'Update Salesinvoiceuploads: ' . $model->upload_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Customer Debt'), 'url' => ['/product/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Daily Cleans'), 'url' => ['/salesorderheader/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Sales Invoice'), 'url' => ['/invoice/salesinvoice/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Sales Invoice Payment'), 'url' => ['/invoice/salesinvoicepayment/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Sales Invoice Settings'), 'url' => ['/invoice/ip/settings']];
$this->params['breadcrumbs'][] = ['label' => 'Salesinvoiceuploads', 'url' => ['/invoice/salesinvoiceuploads/index']];
$this->params['breadcrumbs'][] = ['label' => $model->upload_id, 'url' => ['/invoice/salesinvoiceuploads/view', 'id' => $model->upload_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="salesinvoiceuploads-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
