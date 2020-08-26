<?php
use yii\helpers\Html;
$this->title = Yii::t('app','Update Cost Codes ') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Cost Codes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="costcategory-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
