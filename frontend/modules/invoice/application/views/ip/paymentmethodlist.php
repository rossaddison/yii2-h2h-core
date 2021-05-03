<?php
use frontend\modules\invoice\application\components\Utilities;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\bootstrap4\Breadcrumbs;
use kartik\icons\Icon;

$this->params['breadcrumbs'][] = ['label' => Utilities::trans('invoice'), 'url' => ['salesinvoice/index']];
$this->params['breadcrumbs'][] = ['label' => Utilities::trans('payment'), 'url' => ['salesinvoicepayment/index']];
$this->params['breadcrumbs'][] = ['label' => Utilities::trans('settings'), 'url' => ['ip/settings']];
$this->params['breadcrumbs'][] = ['label' => Utilities::trans('payment_method_form'), 'url' => ['ip/pmc']];
?>
<?= Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], 'activeItemTemplate' => "<li class=\"breadcrumb-item active\" aria-current=\"page\">{link}</li>\n"
]);
?>
<div class="salesinvoicepaymentmethod-index">
   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
             'attribute' => 'Update',
                     'format' => 'raw',
                     'value' => function ($model) {
                     //https://fontawesome.com/icons?s=solid  
                      return '<a href="'.Url::toRoute(['pmu','payment_method_id'=>$model->payment_method_id]) .'">'.Icon::show('pencil-alt', ['framework' => Icon::FAS]).'</a>';               
              }
            ],
            [
             'attribute' => 'View',
                     'format' => 'raw',
                     'value' => function ($model) {
                     //https://fontawesome.com/icons?s=solid  
                      return '<a href="'.Url::toRoute(['pmv','payment_method_id'=>$model->payment_method_id]) .'">'.Icon::show('eye', ['framework' => Icon::FAS]).'</a>';               
              }
            ],
            //'payment_method_id',        
            'payment_method_name:ntext',            
        ],
    ]); ?>


</div>
