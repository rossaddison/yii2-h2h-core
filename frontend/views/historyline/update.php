<?php
use yii\helpers\Html;
$this->title = Yii::t('app','Update Event ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Event'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="Event-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
