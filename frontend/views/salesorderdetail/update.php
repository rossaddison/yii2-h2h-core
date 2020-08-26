<?php
use yii\helpers\Html;
use Yii;
$this->title = Yii::t('app','Update Houses to Clean ID') . $model->sales_order_detail_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Daily Cleans '), 'url' => ['salesorderheader/index','id'=>$model->sales_order_id]];
$this->params['breadcrumbs'][] = ['label' => $model->salesOrder->clean_date];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Houses to Clean '), 'url' => ['index','id'=>$model->sales_order_id]];
$this->params['breadcrumbs'][] = ['label' => $model->productcategory->name. Yii::t('app',' in ').$model->productcategory->description];
$this->params['breadcrumbs'][] = ['label' => $model->productsubcategory->name];
$this->params['breadcrumbs'][] = ['label' => $model->product->productnumber];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="salesorderdetail-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
