<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap4\Breadcrumbs;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Customer Debt'), 'url' => Yii::getAlias('@web').'/product/index'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Daily Cleans'), 'url' => Yii::getAlias('@web').'/salesorderheader/index'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Invoice'), 'url' => ['salesinvoice/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Invoice Payment'), 'url' => ['salesinvoicepayment/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Invoice Settings'), 'url' => ['ip/settings']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Email Template Create'), 'url' => ['ip/etc']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Email Template List'), 'url' => ['ip/formlist']];
?>
<?= Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], 'activeItemTemplate' => "<li class=\"breadcrumb-item active\" aria-current=\"page\">{link}</li>\n"
]);
?>
<div class="salesinvoiceemailtemplate-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['etu', 'email_template_id' => $model->email_template_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['etd', 'email_template_id' => $model->email_template_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'email_template_title:ntext',
            'email_template_subject:ntext',
            'email_template_from_name:ntext',
            'email_template_from_email:email',
            'email_template_body:ntext',
        ],
    ]) ?>

</div>
