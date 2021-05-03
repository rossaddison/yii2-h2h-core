<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\invoice\application\models\Salesinvoiceuploads */

$this->title = 'Create Salesinvoiceuploads';
$this->params['breadcrumbs'][] = ['label' => 'Salesinvoiceuploads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salesinvoiceuploads-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
