<?php
use yii\helpers\Html;
use Yii;
$this->title = Yii::t('app','Update Paypal Agreement ') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Paypal Agreements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="paypalagreement-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
