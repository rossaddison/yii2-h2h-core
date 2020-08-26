<?php
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;
use frontend\models\Productcategory;
use yii\helpers\Url;
use Yii;
$this->title=Yii::t('app','View House'); 
$this->params['breadcrumbs'][]=['label'=>Yii::t('app','Houses'), 'url'=>['index']];
$this->params['breadcrumbs'][]=['label'=>Yii::t('app','Create House'), 'url'=>['create']];
$this->params['breadcrumbs'][]=$this->title;
Yii::$app->formatter->nullDisplay = ''; 
$attributes=[
    [
        'attribute'=>'id', 
        'format'=>'raw', 
        'value'=>'<kbd>'.$model->id.'</kbd>', 
        'displayOnly'=>true
    ],
    'name',
    'surname',
    'email:email',
    'productnumber',
    'postcodefirsthalf',
    'postcodesecondhalf',
    [
     'attribute'=>'productcategory_id',
     'type'=>  DetailView::INPUT_DROPDOWN_LIST,
     'items'=>ArrayHelper::map(Productcategory::find()->orderBy('name')->all(),'id','name'), 
     'options'=> ['id'=>'cat_id'],
     'value'=>$model->productcategory->name, 
      
    ],
    [ 
      'attribute'=>'productsubcategory_id',
      'type'=>  DetailView::INPUT_DEPDROP,
      'value'=>$model->productsubcategory->name, 
      'widgetOptions'=>[
            'options'=>['id'=>'subcat_id'],
            'pluginOptions'=>[
                    'depends'=>['cat_id'],  
                    'url'=> Url::to(['/product/subcat']),
            ],
      ],
    ],
    'contactmobile',
    'specialrequest',
    [
       'attribute'=>'frequency',
       'type' => DetailView::INPUT_DROPDOWN_LIST,
       'items'=> [Yii::t('app','Weekly')=>Yii::t('app','Weekly'),Yii::t('app','Fortnightly')=>Yii::t('app','Fortnightly'),Yii::t('app','Monthly')=>Yii::t('app','Monthly'),Yii::t('app','Every two months')=>Yii::t('app','Every two months'),Yii::t('app','Not applicable')=>Yii::t('app','Not applicable')],
       'value'=>$model->frequency, 
       'inputWidth'=>'40%'
    ],
    'listprice',
    [
        'attribute'=>'sellstartdate', 
        'type'=>DetailView::INPUT_DATE,
        'format'=>'date',
        'widgetOptions'=>[
            'pluginOptions'=>['format'=>'yyyy-mm-dd']
        ],
        'inputWidth'=>'40%'
    ],
    [
        'attribute'=>'sellenddate', 
        'type'=>DetailView::INPUT_DATE,
        'format'=>'date',
        'widgetOptions'=>[
            'pluginOptions'=>['format'=>'yyyy-mm-dd']
        ],
        'inputWidth'=>'40%'
    ],
    [
        'attribute'=>'isactive', 
        'type'=>DetailView::INPUT_CHECKBOX,
        'format'=>'boolean',
        'inputWidth'=>'40%'
    ],
    'jobcode',
    'mandate',
    'gc_number',
];

    echo DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'attributes'=>$attributes,
    'hover'=>true,    
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=>Yii::t('app','House No ') . $model->id,
        'type'=>DetailView::TYPE_INFO,
    ],
    'deleteOptions'=>['params' => ['id' => $model->id, 'housedelete' => true],'url'=>['delete', 'id' => $model->id],],
    
]);?>
