<?php
use yii\helpers\Html;
use Yii;
$this->title = Yii::t('app','Create Legal');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Legals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="legal-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
