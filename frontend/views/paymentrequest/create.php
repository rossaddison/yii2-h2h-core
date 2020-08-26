<?php
use yii\helpers\Html;
use Yii;
$this->title = Yii::t('app','Create Paymentrequest');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Payment requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paymentrequest-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
