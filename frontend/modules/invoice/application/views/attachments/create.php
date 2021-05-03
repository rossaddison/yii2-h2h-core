<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var frontend\modules\invoice\application\models\SalesinvoiceUploads $model
 */

$this->title = 'Create Salesinvoice Uploads';
$this->params['breadcrumbs'][] = ['label' => 'Salesinvoice Uploads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salesinvoice-uploads-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
