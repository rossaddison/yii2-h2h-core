<?php
use yii\helpers\Html;
use Yii;
$this->title = Yii::t('app','Create Messaging');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Messagings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="messaging-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
