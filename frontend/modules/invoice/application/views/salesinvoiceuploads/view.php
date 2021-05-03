<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\invoice\application\models\Salesinvoiceuploads */

$this->title = $model->upload_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Customer Debt'), 'url' => ['/product/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Daily Cleans'), 'url' => ['/salesorderheader/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Sales Invoice'), 'url' => ['/invoice/salesinvoice/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Sales Invoice Payment'), 'url' => ['/invoice/salesinvoicepayment/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Sales Invoice Settings'), 'url' => ['/invoice/ip/settings']];
$this->params['breadcrumbs'][] = ['label' => 'Salesinvoiceuploads', 'url' => ['/invoice/salesinvoiceuploads/index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="salesinvoiceuploads-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->upload_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->upload_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'upload_id',
            'product_id',
            'url_key:url',
            'file_name_original:ntext',
            'file_name_new:ntext',
            'uploaded_date',
        ],
    ]) ?>

</div>
