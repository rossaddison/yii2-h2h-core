<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Translated */

$this->title = Yii::t('app', 'Create a Translation');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="translated-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
