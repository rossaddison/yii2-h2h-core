<?php
use yii\helpers\Html;
$this->title = 'Update Import file: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Import Houses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="importhouses-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
