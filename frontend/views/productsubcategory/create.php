<?php
use yii\helpers\Html;
use Yii;
$this->title = Yii::t('app','Create Street');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Street'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productsubcategory-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
