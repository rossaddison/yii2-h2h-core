<?php
use yii\helpers\Html;
$this->title = Yii::t('app','Upload Importfile');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Import Houses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="importfile-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
