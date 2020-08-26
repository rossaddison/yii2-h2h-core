<?php
use yii\helpers\Html;
$this->title = Yii::t('app','Create Instruction');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Instructions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="instruction-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
