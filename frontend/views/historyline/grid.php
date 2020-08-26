<?php
use yii\helpers\Html;
use \kartik\grid\GridView;
use common\widgets\Alert;
use frontend\models\Historyline;
use kartik\icons\FontAwesomeAsset;
use yii\helpers\ArrayHelper;
use Yii;
FontAwesomeAsset::register($this);
$this->title = Yii::t('app','Event');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Event'), 'url' => ['historyline/index']];
$this->params['breadcrumbs'][] = $this->title;
$pdfHeader = [
  'L' => [
    'content' => '' ,
  ],
  'C' => [
    'content' => Yii::t('app','Event'),
    'font-size' => 10,
    'font-style' => 'B',
    'font-family' => 'arial',
    'color' => '#333333'
  ],
  'R' => [
    'content' => '',
  ],
  'line' => true,
];
$pdfFooter = [
  'L' => [
    'content' => Yii::t('app','Filename'). '_Event_Printed_'.date('d-M-Y-h-s'),
    'font-size' => 10,
    'color' => '#333333',
    'font-family' => 'arial',
  ],
  'C' => [
    'content' => Yii::t('app','Printed ') .date('d-M-Y'),
  ],
  'R' => [
    'content' => '',
    'font-size' => 10,
    'color' => '#333333',
    'font-family' => 'arial',
  ],
  'line' => true,
];
$config_array = [
      'methods' => [
        'SetHeader' => [
          ['odd' => $pdfHeader, 'even' => $pdfHeader]
        ],
        'SetFooter' => [
          ['odd' => $pdfFooter, 'even' => $pdfFooter]
        ],
      ],
      'options' => [
        'title' => 'Event',
        'subject' => Yii::t('app','Event'),
        'keywords' => Yii::t('app','Event'),
      ],
    ];
$viewMsg = Yii::t('app','View');
$deleteMsg = Yii::t('app','Delete');
$updateMsg = Yii::t('app','Update');
?>

<div class="historyline-index">
<h1><?= Html::encode($this->title) ?></h1>
<?= Html::a(Yii::t('app','Create Event'), ['create'], ['class' => 'btn btn-success btn-lg','title'=>Yii::t('app','Did you know your history line can be linked to a url ie. controller/action/id. '),'data-toggle'=>'tooltip']) ?>
       <div class="info">
        <?=          
           Alert::widget()
        ?>
       </div>
<?php 
use kartik\slider\Slider;
echo Html::label('Font Size Adjuster:<br>');
echo Slider::widget([
    'name' => 'sliderfonthistoryline',
    'value'=> 16,
    'options' => [
                   'id'=>'w328',
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
]). '<button id="w494" class = "btn btn-info btn-lg" onclick="js:getSliderhistoryline()" title="Adjust to the required font." data-toggle="tooltip">Adjust font</button><br><br>';
   
?> 
<?php
    $gridColumns = [
    [
     'class'=> 'kartik\grid\DataColumn',
      'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfonthistoryline'].'px'],
      'attribute'=>'id',
      'hAlign' => 'left', 
        'vAlign' => 'middle',
        'filterInputOptions' => [
                  'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfonthistoryline'].'px'],
                  'placeholder' => Yii::t('app','Id ...')
                ],
    ],
    [
     'class' => 'kartik\grid\ActionColumn',
     'dropdown' => false,
     'header'=>'View',
     'vAlign'=>'middle',
     'viewOptions'=>['title'=>$viewMsg, 'data-toggle'=>'tooltip'],
     'template'=> '{view}',
    ],
    ['class' => '\kartik\grid\EditableColumn',
                'attribute' =>'text',
                'filterInputOptions' => [
                  'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfonthistoryline'].'px'],
                  'placeholder' => 'Text...',
                ],
                'hAlign' => 'left', 
                'vAlign' => 'middle',
                'width' => '70%',
                'refreshGrid'=>true,
                'headerOptions' => ['class' => 'kv-sticky-column'],
                'contentOptions' => ['class' => 'kv-sticky-column'],
                'readonly' => false,
                'editableOptions' => [
                    'asPopover' => false,
                    'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                    'options' => [
                        'pluginOptions' => ['autoclose' => true],                        
                     ]
                ],                    
    ], 
    [
    'class' => 'kartik\grid\EditableColumn',
    'header' => Yii::t('app','Start'),
    'attribute' =>  'start',
    'filter'=> Html::activeDropDownList($searchModel,'start',ArrayHelper::map(Historyline::find()->orderBy(['start'=>SORT_DESC])->asArray()->all(),'start','start'),[ 'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfonthistoryline'].'px'],'prompt'=>'Start...']),     
    'hAlign' => 'left',
    'vAlign' => 'middle',
    'width' => '10%',
    'format' => ['date', 'php:Y-m-d'],
    'refreshGrid'=>true,
    'headerOptions' => ['class' => 'kv-sticky-column'],
    'contentOptions' => ['class' => 'kv-sticky-column'],
    'readonly' => false,
    'editableOptions' => [
        'asPopover' => false,
        'size' => 'sm',
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
    [
    'class' => 'kartik\grid\EditableColumn',
    'header' => Yii::t('app','Stop'),
    'attribute' =>  'stop',
    'filter'=> Html::activeDropDownList($searchModel,'stop',ArrayHelper::map(Historyline::find()->orderBy(['stop'=>SORT_DESC])->asArray()->all(),'stop','stop'),[ 'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfonthistoryline'].'px'],'prompt'=>'Stop...']),     
    'hAlign' => 'left',
    'vAlign' => 'middle',
    'width' => '10%',
    'format' => ['date', 'php:Y-m-d'],
    'refreshGrid'=>true,
    'headerOptions' => ['class' => 'kv-sticky-column'],
    'contentOptions' => ['class' => 'kv-sticky-column'],
    'readonly' => false,
    'editableOptions' => [
        'asPopover' => false,
        'size' => 'sm',
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
];

if ((empty(Yii::$app->session['sliderfonthistoryline'])) && (!isset(Yii::$app->session['sliderfonthistoryline']))){Yii::$app->session['sliderfonthistoryline'] = 18;}

echo kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'filterModel' => $searchModel,
    'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfonthistoryline'].'px'],
    'containerOptions' => ['style'=>'overflow: auto'], 
    'pjax' => true,
    'pjaxSettings' =>[
                      'neverTimeout'=>true,
                      'options'=>['id'=>'kv-unique-id-75'],                      
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
    ],
    'exportConfig' => [
                   GridView::CSV => ['label' => Yii::t('app','Export as CSV'),'config' => $config_array, 'filename' => 'Event_Printed_'.date('d-M-Y')],
                   GridView::HTML => ['label' => Yii::t('app','Export as HTML'),'config' => $config_array, 'filename' => 'Event_Printed_'.date('d-M-Y')],
                   GridView::PDF => [ 'label' => Yii::t('app','Export as PDF'),'config' => $config_array, 'filename' => 'Event_Printed_'.date('d-M-Y')], 
                   GridView::EXCEL=> ['label' => Yii::t('app','Export as EXCEL'), 'filename' => 'Event_Printed_'.date('d-M-Y')],
                   GridView::TEXT=> ['label' => Yii::t('app','Export as TEXT'), 'filename' => 'Event_Printed_'.date('d-M-Y')],
                ],
]);
?>
</div>





