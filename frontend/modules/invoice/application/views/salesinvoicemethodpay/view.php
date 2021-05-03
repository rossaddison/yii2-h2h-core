<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\invoice\application\models\Salesinvoicemethodpay */

$this->title = $model->payment_method_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Customer Debt'), 'url' => Yii::getAlias('@web').'/product/index'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Daily Cleans'), 'url' => Yii::getAlias('@web').'/salesorderheader/index'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Sales Invoice'), 'url' => ['salesinvoice/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Sales Invoice Payment'), 'url' => ['salesinvoicepayment/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Sales Invoice Settings'), 'url' => ['ip/settings']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sales Invoice Payment Methods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="salesinvoicemethodpay-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->payment_method_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->payment_method_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'payment_method_id',
            'payment_method_name:ntext',
        ],
    ]) ?>

</div>
