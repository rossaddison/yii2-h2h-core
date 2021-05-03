<?php
use yii\helpers\Html;
$this->title = Yii::t('app', 'Update Sales Invoice Setting: {name}', [
    'name' => $model->setting_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sales Invoice Settings'), 'url' => ['list']];
$this->params['breadcrumbs'][] = ['label' => $model->setting_id, 'url' => ['sv', 'id' => $model->setting_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="salesinvoicesetting-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('settingform', [
        'model' => $model,
    ]) ?>
</div>
