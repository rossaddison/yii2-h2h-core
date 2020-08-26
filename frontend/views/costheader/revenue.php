<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
$this->params['breadcrumbs'][] = ['label' =>Yii::t('app','Monthly Revenue')];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salesorderheader-view">
    <h1><?= Html::encode($this->title) ?></h1>
   <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
        'sales_order_id',
        'status',
        'statusfile',
        'clean_date',
        'sub_total',
        'tax_amt',
        'total_due',
        'modified_date',
        ],
    ]) ?>
</div>
