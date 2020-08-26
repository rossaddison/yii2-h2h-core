<?php
use yii\helpers\Url;
use yii\helpers\Html;
use \kartik\grid\GridView;
use frontend\models\Costheader;
use yii\helpers\ArrayHelper;
use kartik\icons\FontAwesomeAsset;
FontAwesomeAsset::register($this);
$this->title = Yii::t('app','Daily Costs');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['costheader/index']];
$viewMsg = Yii::t('app','View');
$deleteMsg = Yii::t('app','Delete');
$updateMsg = Yii::t('app','Update');
$yearOnly = date('Y', strtotime(Date('Y-m-d')));
?>
<div class="costheader-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app','Create Daily Cost'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app','Copy Costs to Daily Costs'), ['cost/index'], ['class' => 'btn btn-success']) ?>
       <div class="dropdown">
           <button title=<?php Yii::t('app','Use the checkbox column below to copy complete lists with paid reset to 0 for each item.') ?> id="w125" class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php Yii::t('app','(Ticked) Copy') ?> <span class="caret"></span></button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a onclick="js:getCopycostitbytodaysdate()" class="btn btn-danger dropdown-item" href="#">Using today's date</a>
                <a onclick="js:getCopycostitbyfrequency()" class="btn btn-danger dropdown-item" href="#">+ 1 month</a>
            </div>    
        </div>
         <Hr style = "border-top: 3px double #8c8b8b">
         <div>
        <?= Html::label(Yii::t('app','Cost')); ?> 
        <?= Html::a(($yearOnly-3), ['costheader/totalannualcost/'.($yearOnly-3)], ['class' => 'btn btn-success']) ?>
        <?= Html::a(($yearOnly-2), ['costheader/totalannualcost/'.($yearOnly-2)], ['class' => 'btn btn-success']) ?>
        <?= Html::a(($yearOnly-1), ['costheader/totalannualcost/'.($yearOnly-1)], ['class' => 'btn btn-success']) ?>
        <?= Html::a($yearOnly, ['costheader/totalannualcost/'.$yearOnly], ['class' => 'btn btn-success']) ?>
        <?= Html::a(($yearOnly+1), ['costheader/totalannualcost/'.($yearOnly+1)], ['class' => 'btn btn-success']) ?>
            <Hr style = "border-top: 3px double #8c8b8b">      
        </div>
    
       
    </p>
 
<?php 
use kartik\slider\Slider;
echo Html::label(Yii::t('app','Font Size Adjuster:<br>'));
echo Slider::widget([
    'name' => 'sliderfontcostheader',
    'options' => [
                   'id'=>'w673',
                 ],
    'sliderColor' => Slider::TYPE_INFO,
    'handleColor' => Slider::TYPE_INFO,
    'pluginOptions' => [
        'orientation' => 'horizontal',
        'handle' => 'round',
        'min' => 1,
        'max' => 32,
        'step' => 1,
        'tooltip'=>Yii::t('app','Adjust to change the font size.'),
    ],
]). '<button id="w303" class = "btn btn-info btn-lg" onclick="js:getSlidercostheader()"  title="Double click to adjust font." data-toggle="tooltip">Adjust font</button><br><br>';   
?> 
<?php
   Yii::$app->formatter->nullDisplay = '';
   $gridColumns = [
    ['class' => 'kartik\grid\CheckboxColumn',
            'name'=>'selection',
            'multiple'=>true,
            'checkboxOptions'=>function ($model, $key, $index){
            return ['id'=>$model->cost_header_id,'value' => $model->cost_header_id];
            }
    ],
    ['class'=>'kartik\grid\DataColumn',
     'attribute'=>'cost_header_id',
     'filterInputOptions' => [
                  'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontcostheader'].'px'],
                  'placeholder' => Yii::t('app','Cost Id...')
                ],
    ],
    [
    'class' => 'kartik\grid\ExpandRowColumn',
    'width' => '300px',
    'value' => function ($model, $key, $index, $column) {
        return GridView::ROW_COLLAPSED;
    },
    'detail' => function ($model, $key, $index, $column) {
        
        return Yii::$app->controller->renderPartial('_expandableview', ['model' => $model]);
    },
    'headerOptions' => ['class' => 'kartik-sheet-style'], 
    'expandOneOnly' => true,
    ],   
    [
                    'class' => 'kartik\grid\ActionColumn',
                    'template' => '{link}',
                    'header'=>'Costs',
                    'visible'=> Yii::$app->user->isGuest ? false : true,
                    'buttons' => [
                            'link' => function ($url, $model,$key) {
                                            return Html::tag('span',Html::a('Costs', $url),
                                                                ['title'=>'Costs for the day',
                                                                 'data-toggle'=>'tooltip',
                                                                    ]);
                                                                },
                            
                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'link') {
                                $url =Url::toRoute(['costdetail/index', 'id' => $model->cost_header_id]);
                                Yii::$app->session['cost_header_id'] = $model->cost_header_id;
                                Url::remember();
                                return $url;
                            }
                    }
    ],
    [
            'class'=>'kartik\grid\DataColumn',
            'attribute' => 'status',
            'value' => 'status',
            'filter'=> Html::activeDropDownList($searchModel,'status',ArrayHelper::map(Costheader::find()->orderBy('status')->asArray()->all(),'status','status'),['options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontcostheader'].'px'],'prompt'=>'Cost Code...']),            
    ],
    
    [
    'class' => 'kartik\grid\EditableColumn',
    'header' => Yii::t('app','Cost Date'),
    'attribute' => 'cost_date',
    'filter'=> Html::activeDropDownList($searchModel,'cost_date',ArrayHelper::map(Costheader::find()->orderBy('cost_date')->asArray()->all(),'cost_date','cost_date'),['options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontcostheader'].'px'],'prompt'=>'From Date...']),      
    'hAlign' => 'center',
    'vAlign' => 'middle',
    'width' => '9%',
    'format' => ['date', 'php:Y-m-d'],
    'refreshGrid'=>true,
    'headerOptions' => ['class' => 'kv-sticky-column'],
    'contentOptions' => ['class' => 'kv-sticky-column'],
    'readonly' => false,
    'editableOptions' => [        
        'size' => 'md',
        'inputType' => \kartik\editable\Editable::INPUT_WIDGET,
        'widgetClass' =>  'kartik\datecontrol\DateControl',
        'options' => [
            'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
            'displayFormat' => 'php:Y-m-d',
            'saveFormat' => 'php:Y-m-d',
            'options' => [
                'pluginOptions' => [
                    'autoclose' => true
                ]
            ]
        ]
    ],
    ],
            
    ['class'=>'kartik\grid\DataColumn',
             'header'=>Yii::t('app','Total Due'),
             'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontcostheader'].'px'],
             'hAlign'=>'right',
             'format'=>['decimal', 2],  
             'value'=> function($data){
                $subtotal = 0.00;
                $subtotal = number_format($subtotal,2);
                $array = $data->costdetails;
                foreach ($array as $key => $value)
                {
                   $subtotal += $array[$key]['unit_price']; 
                }
                return $subtotal;
             },
             'pageSummary'=>true,
             'pageSummaryFunc'=>Gridview::F_SUM,
   ],
   ['class'=>'kartik\grid\DataColumn',
             'header'=>Yii::t('app','Paid to date'),
             'hAlign'=>'right',
             'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontcostheader'].'px'],
             'format'=>['decimal', 2], 
             'value'=> function($data){
                $subtotal = 0.00;
                $subtotal = number_format($subtotal,2);
                $array = $data->costdetails;
                foreach ($array as $key => $value)
                {
                   $subtotal += $array[$key]['paid']; 
                }
                return $subtotal;
             },
             'pageSummary'=>true,
             'pageSummaryFunc'=>Gridview::F_SUM,    
   ],
   [
    'class' => 'kartik\grid\ActionColumn',
    'dropdown' => true,
    'dropdownOptions' => ['class' => 'pull-right'],
    'urlCreator' => function($action, $model, $key, $index) {
                        return $action."/".$model->cost_header_id;
                    },
    'viewOptions' => ['title' => $viewMsg, 'data-toggle' => 'tooltip'],
    'updateOptions' => ['title' => $updateMsg, 'data-toggle' => 'tooltip'],
    'deleteOptions' => ['title' => $deleteMsg,'data-toggle' => 'tooltip'],
    'headerOptions' => ['class' => 'kartik-sheet-style'],
    ],    
   ];
                    
   Yii::$app->formatter->nullDisplay = '';
   echo kartik\grid\GridView::widget([
      'dataProvider' => $dataProvider,
      'filterModel' => $searchModel,
      'columns' => $gridColumns,
      'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontcostheader'].'px'],
      'containerOptions' => ['style'=>'overflow: auto'], 
      'pjax' => true,
      'pjaxSettings' =>['neverTimeout'=>false,
                      'options'=>['id'=>'kv-unique-id-0'],                      
                     ], 
      'bordered' => true,
      'striped' => true,
      'condensed' => false,
      'responsive' => true,
      'hover' => true,
      'floatHeader' => false,
      'showPageSummary' => true,
      'panel' => [
      'type' => GridView::TYPE_PRIMARY
    ],
   ]); 
?>  
</div>
