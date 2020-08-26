<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use frontend\models\Productcategory;
use Yii;
$this->title = Yii::t('app','Street');
$this->params['breadcrumbs'][] = $this->title;
$viewMsg = Yii::t('app','View');
$deleteMsg = Yii::t('app','Delete');
$updateMsg = Yii::t('app','Update');
$tooltipsortorder = Html::tag('span', 'Order', ['title'=>Yii::t('app','This is the order in which jobs will be completed. View to set to 500 for Quick Build.'),'data-toggle'=>'tooltip','style'=>'text-decoration: underline: cursor:pointer;']);
?>
<div class="productsubcategory-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= 
            //Modal link frontend/layouts/main.php and frontend/assets/AppAsset.php
            Html::button(Yii::t('app','Create Street'), ['value' => Url::to(['productsubcategory/create']), 'title' => Yii::t('app','Creating New Postcode'), 'class' => 'showModalButton btn btn-success btn-lg']); 
        ?>
        <?php
           //Html::a(Yii::t('app','Create Street'), ['create'], ['class' => 'btn btn-success btn-lg']) 
        ?>
        <?= Html::a(Yii::t('app','Postcode Finder'), "http://pcf.raggedred.net/", ['class' => 'btn btn-success btn-lg']) ?>
    </p>
    <?php
    $gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    ['class' => 'kartik\grid\ActionColumn',
     'dropdown' => false,
     'header'=>Yii::t('app','View'),
     'vAlign'=>'middle',
     'viewOptions'=>['title'=>$viewMsg, 'data-toggle'=>'tooltip'],
     'template'=> '{view}',
    ], 
    ['class' => 'kartik\grid\ActionColumn',
     'dropdown' => false,
     'header'=>Yii::t('app','Update'),
     'vAlign'=>'middle',
     'updateOptions'=>['title'=>$updateMsg, 'data-toggle'=>'tooltip'],
     'template'=> '{update}',
    ],   
    [
            'class'=>'kartik\grid\DataColumn',
            'header'=>Yii::t('app','Area Code'),
            'attribute'=>'productcategory_id',
            'value' => function ($dataProvider) {
                    return $dataProvider->productcategory->name; 
            },
            'filter'=> Html::activeDropDownList($searchModel,'productcategory_id',ArrayHelper::map(Productcategory::find()->orderBy('name')->asArray()->all(),'id','name'),['class'=>'form-control','prompt'=>'Post Code...']), 
    ],  
    [
     'class'=>'kartik\grid\DataColumn',
     'attribute'=>'name',
     'filterInputOptions' => [
                  'class'       => 'form-control',
                  'placeholder' => Yii::t('app','Street Name '). '...',
                ],
    ],
    [
    'class' => 'kartik\grid\ExpandRowColumn',
    'header'=>Yii::t('app','Map'),  
    'expandTitle'=> 'Postcode and Street',
    'width' => '300px',
    'value' => function ($dataProvider, $key, $index, $column) {
        return GridView::ROW_COLLAPSED;
    },
    'detail' => function ($dataProvider, $key, $index, $column) {
        return Yii::$app->controller->renderPartial('_expandableview', ['postcode_id'=>$dataProvider->productcategory_id,'street_id'=>$dataProvider->id,'street_name'=>$dataProvider->name]);
    },
    'disabled'=> function ($dataProvider, $key, $index, $column) {
                    if (!empty($dataProvider->id)) { return false;} else { return true;}
    },      
    'headerOptions' => ['class' => 'kartik-sheet-style'], 
    'expandOneOnly' => true,
    ], 
    [
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{link}',// can be omitted, as it is the default
            'header'=>'Google',
            'visible'=> Yii::$app->user->isGuest ? false : true,
            'buttons' => ['link' => function ($url, $dataProvider,$key) {
               $url3 = $dataProvider->name." ".$dataProvider->productcategory->name;   
               return Html::a($url3,$url,['class' => 'btn btn-success','data-toggle'=>'tooltip','title'=>Yii::t('app','Goto Google maps using this address.')]);
             }
             ],
            'urlCreator' => function ($action, $dataProvider, $key, $index) {
                         if (($action === 'link') ) {
                             $url = "https://maps.google.com/maps?q=".$dataProvider->name." ".$dataProvider->productcategory->name;
                             return $url;
                         }
             }                
     ],      
    ['class' => '\kartik\grid\EditableColumn',
               // 'filter'=> Html::activeDropDownList($searchModel,'sort_order',ArrayHelper::map(Productsubcategory::find()->orderBy('sort_order')->asArray()->all(),'sort_order','sort_order'),['class'=>'form-control','prompt'=>'From']),      
                'header'=>$tooltipsortorder,
                'attribute' => 'sort_order',
                'hAlign' => 'right', 
                'vAlign' => 'middle',
                'width' => '7%',
                'format' => 'raw',
                'refreshGrid'=>true,
                'headerOptions' => ['class' => 'kv-sticky-column'],
                'contentOptions' => ['class' => 'kv-sticky-column'],
                'readonly' => false,
                'editableOptions' => [
                    'asPopover' => false,
                    'header' => 'Sequence', 
                    'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                    'options' => [
                        'pluginOptions' => ['autoclose' => true],                        
                     ]
                ],                    
     ],  
     'lat_start',
     'lat_finish',
     'lng_start',
     'lng_finish',   
     [
    'class' => 'kartik\grid\ExpandRowColumn',
    'header'=>'Directions to next clean',  
    'expandTitle'=> 'Directions to next clean',
    'width' => '300px',
    'value' => function ($dataProvider, $key, $index, $column) {
        return GridView::ROW_COLLAPSED;
    },
    'detail' => function ($dataProvider, $key, $index, $column) {
        return Yii::$app->controller->renderPartial('_expandableview_directions', ['directions'=>$dataProvider->directions_to_next_productsubcategory]);
    },
    'disabled'=> function ($dataProvider, $key, $index, $column) {
                    $rows  = $dataProvider->directions_to_next_productsubcategory;
                    if (!empty($dataProvider->directions_to_next_productsubcategory)) { return false;} else { return true;}
    },        
    'headerOptions' => ['class' => 'kartik-sheet-style'], 
    'expandOneOnly' => true,
    ],     
    ['class' => '\kartik\grid\EditableColumn',
                'attribute' => 'isactive',
                'hAlign' => 'right', 
                'vAlign' => 'middle',
                'width' => '7%',
                'refreshGrid'=>true,
                'headerOptions' => ['class' => 'kv-sticky-column'],
                'contentOptions' => ['class' => 'kv-sticky-column'],
                'readonly' => false,
                'editableOptions' => [
                    'asPopover' => false,
                    'header' => 'Active',                    
                    'displayValueConfig' => [0 => 'Inactive', 1 => 'Active'],
                    'inputType' => \kartik\editable\Editable::INPUT_CHECKBOX,
                    'options' => [
                        'pluginOptions' => ['autoclose' => true],                        
                     ]
                ],                    
     ],    
];
echo kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'options' => ['style' => 'font-size:18px;'],
    'columns' => $gridColumns,
    'containerOptions' => ['style'=>'overflow: auto'], 
    'pjax' => true,
    'pjaxSettings' =>['neverTimeout'=>false,
                      'options'=>['id'=>'kv-unique-id-8'],                      
                     ], 
    'responsiveWrap'=>true,
    'bordered' => true,
    'striped' => true,
    'condensed' => true,
    'responsive' => true,
    'hover' => true,
    'floatHeader' => false,
    'showPageSummary' => true,
    'panel' => [
    'type' => GridView::TYPE_PRIMARY,
    'heading'=> '' ,
    ],
]);
?> 
</div>
