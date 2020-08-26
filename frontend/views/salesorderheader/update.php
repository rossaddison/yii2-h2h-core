<?php
use yii\helpers\Html;
use Yii;
$this->title = Yii::t('app','Update Daily Clean ') . $model->sales_order_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Daily Cleans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sales_order_id, 'url' => ['view', 'id' => $model->sales_order_id]];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="salesorderheader-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
