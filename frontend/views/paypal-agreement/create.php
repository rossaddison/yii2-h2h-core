<?php
use yii\helpers\Html;
use Yii;
$this->title = Yii::t('app','Create Paypal Agreement');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Paypal Agreements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paypalagreement-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
