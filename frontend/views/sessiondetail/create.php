<?php
use yii\helpers\Html;
use Yii;
$this->title = Yii::t('app','Create Sessiondetail');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Session Details'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sessiondetail-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
