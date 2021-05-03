<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\icons\Icon;
use frontend\modules\invoice\application\models\Salesinvoicemethodpay;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sales Invoice Payment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Customer Debt'), 'url' => ['/product/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Daily Cleans'), 'url' => ['/salesorderheader/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Sales Invoice'), 'url' => ['/invoice/salesinvoice/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Sales Invoice Payment'), 'url' => ['/invoice/salesinvoicepayment/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Sales Invoice Settings'), 'url' => ['/invoice/ip/settings']];
?>
<div class="salesinvoicepayment-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'=> $searchModel,
        'columns' => [
            'payment_id',
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{link}',// can be omitted, as it is the default
                'header'=>'Invoice No.',
                'visible'=> Yii::$app->user->isGuest ? false : true,
                'buttons' => ['link' => function ($url, $dataProvider,$key) {
                               return Html::a($dataProvider->invoice_id,$url);
                    }
                 ],
                'urlCreator' => function ($action, $dataProvider, $key, $index) {
                             if (($action === 'link') ) {
                                 $url = Url::toRoute(['salesinvoice/view','id'=>$dataProvider->invoice_id]);
                                 return $url;
                             }
                 }                
            ],            
            [
                'class'=>'kartik\grid\DataColumn',
                'header'=>'Paid with:',
                'attribute'=>'payment_method_id',
                'value' => function ($dataProvider) {
                        return $dataProvider->paymentmethod->payment_method_name; 
                },        
                'filter'=> Html::activeDropDownList($searchModel,'payment_method_id',ArrayHelper::map(SalesinvoiceMethodPay::find()->orderBy('payment_method_id')->asArray()->all(),'payment_method_id','payment_method_name'),[ 'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontsalesinvoicemethodpay'].'px'],'class'=>'form-control','prompt'=>'Method...']), 
            ],  
            'payment_date',
            'payment_amount',
            'payment_note:ntext',
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{link}',// can be omitted, as it is the default
                'header'=>'View',
                'visible'=> Yii::$app->user->isGuest ? false : true,
                'buttons' => ['link' => function ($url, $dataProvider,$key) {
                               return Html::a(Icon::show('file-invoice', ['framework' => Icon::FAS]),$url);
                    }
                 ],
                'urlCreator' => function ($action, $dataProvider, $key, $index) {
                             if (($action === 'link') ) {
                                 $url = Url::toRoute(['salesinvoicepayment/view','id'=>$dataProvider->payment_id]);
                                 return $url;
                             }
                 }                
            ],                      
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{link}',// can be omitted, as it is the default
                'header'=>'Update',
                'visible'=> Yii::$app->user->isGuest ? false : true,
                'buttons' => ['link' => function ($url, $dataProvider,$key) {
                               return Html::a(Icon::show('pencil-alt', ['framework' => Icon::FAS]),$url);
                    }
                 ],
                'urlCreator' => function ($action, $dataProvider, $key, $index) {
                             if (($action === 'link') ) {
                                 $url = Url::toRoute(['salesinvoicepayment/update','id'=>$dataProvider->payment_id]);
                                 return $url;
                             }
                 }                
            ],
        ],
    ]); ?>


</div>
