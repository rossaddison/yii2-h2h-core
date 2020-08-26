<?php
use yii\helpers\Html;
$this->title = Yii::t('app','Update Costs: ID: ') . $model->cost_detail_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Daily Costs '), 'url' => ['costheader/index','id'=>$model->cost_header_id]];
$this->params['breadcrumbs'][] = ['label' => $model->costHeader->cost_date];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Costs on this day '), 'url' => ['index','id'=>$model->cost_header_id]];
$this->params['breadcrumbs'][] = ['label' => $model->costcategory->name. " in ".$model->costcategory->description];
$this->params['breadcrumbs'][] = ['label' => $model->costsubcategory->name];
$this->params['breadcrumbs'][] = ['label' => $model->cost->costnumber];
//$this->params['breadcrumbs'][] = ['label' => $model->sales_order_detail_id, 'url' => ['view', 'id' => $model->sales_order_detail_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="costdetail-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
