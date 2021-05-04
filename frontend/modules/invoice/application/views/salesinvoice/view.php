<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\widgets\Alert;

/* @var $this yii\web\View */
/* @var $model frontend\models\Salesinvoice */

$this->title = $model->invoice_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Customer Debt'), 'url' => Yii::getAlias('@web').'/product/index'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Daily Cleans'), 'url' => Yii::getAlias('@web').'/salesorderheader/index'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Sales Invoice'), 'url' => ['salesinvoice/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Sales Invoice Payment'), 'url' => ['salesinvoicepayment/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Sales Invoice Settings'), 'url' => ['ip/settings']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sales Invoices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Html::encode($this->title);
?>
<div class="salesinvoice-view">

    <h1><?= Html::encode($this->title) ?></h1>
   
    <?php
        if (!empty($widgetmessage)) {
            echo Alert::widget([
                'type' => Alert::TYPE_SUCCESS,
                'title' => 'Pdf file generated and archived.',            
                'body' => $widgetmessage,
                'showSeparator' => true,
                'delay' => false,
            ]);
        }
    ?>
    <?php
        if (!empty($settingmessage)) {
            echo Alert::widget([
                'type' => Alert::TYPE_INFO,
                'title' => '<b>Mark invoices as sent</b> setting.',       
                'body' => $settingmessage,
                'showSeparator' => true,
                'delay' => false,
            ]);
        }
    ?>   
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'invoice_id',
            ['attribute'=> 'invoice_status_id','header'=>'Status','value'=>$model->status->code_meaning],
            ['attribute'=>  'is_read_only','header'=>'Read Only',
             'value'=>function($model){
                                                   if (($model->is_read_only) === 1)
                                                   {
                                                       return "Read Only";                                                       
                                                   }
                                                   else
                                                   {
                                                       return "Not Read Only";
                                                   }                                                   
                                      }],
            'invoice_date_created',
            'invoice_time_created',
            'invoice_date_modified',
            'invoice_date_due',
            'invoice_url_key:url',
            ['attribute'=> 'payment_method_id','header'=>'Pay by:','value'=>$model->paymentmethod->payment_method_name],
        ],
    ]) ?>

</div>
