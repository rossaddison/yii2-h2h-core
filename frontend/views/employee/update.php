<?php
use yii\helpers\Html;
$this->title = Yii::t('app','Update Employee ') . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Employees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="employee-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
