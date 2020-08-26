<?php
use yii\helpers\Html;
use Yii;
$this->title = Yii::t('app','Update Quicknote ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Quick Notes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="quicknote-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
