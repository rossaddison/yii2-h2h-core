<?php
use yii\helpers\Html;

$this->title = Yii::t('app','Create Carousal');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Carousals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carousal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
