<?php
use yii\helpers\Html;
use Yii;
$this->title = Yii::t('app','Update Tax ') . $model->tax_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Taxes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tax_id, 'url' => ['view', 'id' => $model->tax_id]];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="tax-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
