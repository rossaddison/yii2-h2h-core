<?php
use yii\helpers\Html;
$this->title = Yii::t('app','Create Daily Cost');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Daily Cost'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="costheader-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
