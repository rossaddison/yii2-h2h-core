<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Salesinvoice */

$this->title = Yii::t('app', 'Create Salesinvoice');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Salesinvoices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salesinvoice-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
