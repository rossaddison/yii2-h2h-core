<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\invoice\application\models\Salesinvoiceemailtemplate */

$this->title = $model->email_template_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Salesinvoiceemailtemplates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="salesinvoiceemailtemplate-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->email_template_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->email_template_id], [
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
            'email_template_id',
            'email_template_title:ntext',
            [
            'attribute'=>'email_template_type',
                'value'=>function($model){
                    if ($model->email_template_type == 0) {return 'invoice';}else {return 'quote';}        
                }    
            ],
            'email_template_body:ntext',
            'email_template_subject:ntext',
            'email_template_from_name:ntext',
            'email_template_from_email:ntext',
            'email_template_cc:ntext',
            'email_template_bcc:ntext',
            'email_template_pdf_template',
        ],
    ]) ?>

</div>
