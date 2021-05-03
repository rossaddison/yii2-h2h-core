<?php
use frontend\modules\invoice\application\components\Utilities;
use frontend\modules\invoice\application\models\SalesinvoiceMerchantResponse;
use kartik\grid\GridView;
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$this->params['breadcrumbs'][] = ['label' => Utilities::trans('invoice'), 'url' => ['salesinvoice/index']];
$this->params['breadcrumbs'][] = ['label' => Utilities::trans('payment'), 'url' => ['salesinvoicepayment/index']];
$this->params['breadcrumbs'][] = ['label' => Utilities::trans('settings'), 'url' => ['ip/settings']];
?>
<?= Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], 'activeItemTemplate' => "<li class=\"breadcrumb-item active\" aria-current=\"page\">{link}</li>\n"
]);
?>
<div class="salesinvoicemerchantresponse-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'merchant_response_date',
            'invoice_id',
            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute'=>'merchant_response_successful',
                'value' => function ($dataProvider) {
                               return $dataProvider->merchant_response_successful;
                       },                            
            ],
            'merchant_response_driver',
            'merchant_response',
            'merchant_response_reference'            
        ],
    ]); ?>
</div>
