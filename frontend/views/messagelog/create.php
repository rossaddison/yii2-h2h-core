<?php
use yii\helpers\Html;
$this->title = Yii::t('app','Create Messagelog');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Message logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="messagelog-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
