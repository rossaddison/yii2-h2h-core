<?php
use frontend\modules\invoice\application\components\Utilities;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\bootstrap4\Breadcrumbs;
use kartik\icons\Icon;

$this->params['breadcrumbs'][] = ['label' => Utilities::trans('invoice'), 'url' => ['salesinvoice/index']];
$this->params['breadcrumbs'][] = ['label' => Utilities::trans('payment'), 'url' => ['salesinvoicepayment/index']];
$this->params['breadcrumbs'][] = ['label' => Utilities::trans('settings'), 'url' => ['ip/settings']];
$this->params['breadcrumbs'][] = ['label' => Utilities::trans('email_template_form'), 'url' => ['ip/etc']];
?>
<?= Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], 'activeItemTemplate' => "<li class=\"breadcrumb-item active\" aria-current=\"page\">{link}</li>\n"
]);
?>
<div class="salesinvoiceemailtemplate-index">
   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
             'attribute' => 'Update',
                     'format' => 'raw',
                     'value' => function ($model) {
                     //https://fontawesome.com/icons?s=solid  
                      return '<a href="'.Url::toRoute(['etu','email_template_id'=>$model->email_template_id]) .'">'.Icon::show('pencil-alt', ['framework' => Icon::FAS]).'</a>';               
              }
            ],
            [
             'attribute' => 'View',
                     'format' => 'raw',
                     'value' => function ($model) {
                     //https://fontawesome.com/icons?s=solid  
                      return '<a href="'.Url::toRoute(['etv','email_template_id'=>$model->email_template_id]) .'">'.Icon::show('eye', ['framework' => Icon::FAS]).'</a>';               
              }
            ],        
            'email_template_title:ntext',
            'email_template_body:ntext',
            'email_template_subject:ntext',
            'email_template_from_name:ntext',
            'email_template_from_email:email'            
        ],
    ]); ?>


</div>
