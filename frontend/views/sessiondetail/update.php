<?php
use yii\helpers\Html;
use Yii;
$this->title = Yii::t('app','Update Session Detail ') . $model->session_detail_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Session Details'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->session_detail_id, 'url' => ['view', 'id' => $model->session_detail_id]];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="sessiondetail-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
