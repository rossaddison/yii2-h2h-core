<?php
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;
use frontend\models\Costcategory;
use yii\helpers\Url;
$this->title=Yii::t('app','View Cost'); 
$this->params['breadcrumbs'][]=['label'=>Yii::t('app','Costs'), 'url'=>['index']];
$this->params['breadcrumbs'][]=$this->title;
$attributes=[
    [
        'attribute'=>'id', 
        'format'=>'raw', 
        'value'=>'<kbd>'.$model->id.'</kbd>', 
        'displayOnly'=>true
    ],
    'description',
    'costnumber',
    'costcodefirsthalf',
    'costcodesecondhalf',
    [
     'attribute'=>'costcategory_id',
     'type'=>  DetailView::INPUT_DROPDOWN_LIST,
      'items'=>ArrayHelper::map(Costcategory::find()->orderBy('name')->asArray()->all(),'id','name'), 
      'options'=> ['id'=>'cat_id'],
      'value'=>$model->costcategory->name, 
    ],
    [ 
      'attribute'=>'costsubcategory_id',
      'type'=>  DetailView::INPUT_DEPDROP,
      'value'=>$model->costsubcategory->name, 
      'widgetOptions'=>[
            'options'=>['id'=>'subcat_id'],
            'pluginOptions'=>[
                    'depends'=>['cat_id'],  
                    'url'=>Url::to(['/site/subcatcost']),
              
            ],
      ],
     
    ],
    [
       'attribute'=>'frequency',
       'type' => DetailView::INPUT_DROPDOWN_LIST,
       'items'=> [Yii::t('app','Daily')=>Yii::t('app','Daily'),Yii::t('app','Weekly')=>Yii::t('app','Weekly'),Yii::t('app','Fortnightly')=>Yii::t('app','Fortnightly'),Yii::t('app','Monthly')=>Yii::t('app','Monthly'),Yii::t('app','Every two months')=>Yii::t('app','Every two months'),Yii::t('app','Other')=>Yii::t('app','Other')],
       'value'=>$model->frequency, 
       'inputWidth'=>'40%'
    ],
    'listprice',
    [
        'attribute'=>'coststartdate', 
        'type'=>DetailView::INPUT_DATE,
        'format'=>'date',
        'widgetOptions'=>[
            'pluginOptions'=>['format'=>'yyyy-mm-dd']
        ],
        'inputWidth'=>'40%'
    ],
    [
        'attribute'=>'costenddate', 
        'type'=>DetailView::INPUT_DATE,
        'format'=>'date',
        'widgetOptions'=>[
            'pluginOptions'=>['format'=>'yyyy-mm-dd']
        ],
        'inputWidth'=>'40%'
    ],
    [
        'attribute'=>'discontinueddate', 
        'type'=>DetailView::INPUT_DATE,
        'format'=>'date',
        'type'=>DetailView::INPUT_DATE,
        'widgetOptions'=>[
            'pluginOptions'=>['format'=>'yyyy-mm-dd']
        ],
        'inputWidth'=>'40%'
    ],
   
   
];

echo DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'attributes'=>$attributes,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=>'Cost # ' . $model->id,
        'type'=>DetailView::TYPE_INFO,
    ],
    'deleteOptions'=>['params' => ['id' => $model->id, 'costdelete' => true],'url'=>['delete', 'id' => $model->id],],
    
]);?>
