<?php
use yii\helpers\Html;
use Yii;
$this->title = Yii::t('app','Create Daily Clean');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Daily Clean'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salesorderheader-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
