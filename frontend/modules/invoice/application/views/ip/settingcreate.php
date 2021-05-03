<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Salesinvoicesetting */

$this->title = Yii::t('app', 'Create Salesinvoicesetting');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sales Invoice Settings'), 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salesinvoicesetting-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('settingform', [
        'model' => $model,
    ]) ?>

</div>
