<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var frontend\modules\invoice\application\models\SalesinvoiceUploads $model
 */

$this->title = 'Update Salesinvoice Uploads: ' . ' ' . $model->upload_id;
$this->params['breadcrumbs'][] = ['label' => 'Salesinvoice Uploads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->upload_id, 'url' => ['view', 'id' => $model->upload_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="salesinvoice-uploads-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
