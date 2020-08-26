<?php
use yii\helpers\Html;
$this->title = Yii::t('app','Create Cost Subcategory');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Cost Subcategory'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="costsubcategory-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
