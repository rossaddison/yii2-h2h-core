<?php
use yii\helpers\Html;
$this->title = Yii::t('app','Update Messagelog: {nameAttribute}');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Messagelogs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="messagelog-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
