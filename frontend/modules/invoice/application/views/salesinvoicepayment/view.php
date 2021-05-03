<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;
use frontend\modules\invoice\application\models\Salesinvoicemethodpay;

/* @var $this yii\web\View */
/* @var $model frontend\models\SalesinvoicePayment */

$this->title = $model->payment_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sales invoice Payment'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "Invoice Id: ".$model->invoice->invoice_id,'url' => ['salesinvoice/index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="salesinvoicepayment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->payment_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->payment_id], [
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
            'payment_id',
            'invoice_id',
             [
                'attribute'=>'payment_method_id',
                'type'=>  DetailView::INPUT_DROPDOWN_LIST,
                'items'=>ArrayHelper::map(SalesinvoiceMethodPay::find()->orderBy('payment_method_id')->all(),'payment_method_id','payment_method_name'), 
                'value'=>$model->paymentmethod->payment_method_name, 

             ],
            'payment_date',
            'payment_amount',
            'payment_note:ntext',
        ],
    ]) ?>

</div>


