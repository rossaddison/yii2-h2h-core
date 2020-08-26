<?php
use yii\helpers\Html;
use yii\grid\GridView;
use Yii;
$this->title = Yii::t('app','Paymentrequests');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paymentrequest-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app','Create Paymentrequest'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'sales_order_detail_id',
            'gc_payment_request_id',
            'status',
            'modified_date',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
