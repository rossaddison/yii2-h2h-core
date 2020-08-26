<?php
use yii\helpers\Html;
$this->title = Yii::t('app','Create Costcodes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Costcodes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="costcategory-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
