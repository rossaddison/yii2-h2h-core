<?php
use yii\helpers\Html;
use Yii;
$this->title = Yii::t('app','Create Quicknote');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Quicknotes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quicknote-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
