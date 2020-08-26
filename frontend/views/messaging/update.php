<?php
use yii\helpers\Html;
use Yii;
$this->title = Yii::t('app','Update Messaging '). '{nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Messaging'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="messaging-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
