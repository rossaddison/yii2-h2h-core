<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Salesinvoice */

$this->title = Yii::t('app', 'Update Salesinvoice: {name}', [
    'name' => $model->invoice_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Salesinvoices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->invoice_id, 'url' => ['view', 'id' => $model->invoice_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="salesinvoice-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
