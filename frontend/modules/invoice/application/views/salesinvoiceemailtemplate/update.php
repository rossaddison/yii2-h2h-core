<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\invoice\application\models\Salesinvoiceemailtemplate */

$this->title = Yii::t('app', 'Update Salesinvoiceemailtemplate: {name}', [
    'name' => $model->email_template_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Salesinvoiceemailtemplates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->email_template_id, 'url' => ['view', 'id' => $model->email_template_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="salesinvoiceemailtemplate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
