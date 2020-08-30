<?php
use yii\helpers\Html;
use \kartik\grid\GridView;
use common\widgets\Alert;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use frontend\models\Company;
use frontend\models\Product;
use frontend\models\Productcategory;
use frontend\models\Productsubcategory;
use frontend\models\Salesorderheader;
use kartik\icons\Icon;
use kartik\icons\FontAwesomeAsset;
use Yii;
FontAwesomeAsset::register($this);
$trueLabel=GridView::ICON_ACTIVE_BS4;
$falseLabel=GridView::ICON_INACTIVE_BS4;
$this->title = Yii::t('app','Houses');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Houses'), 'url' => ['product/index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Goto the Daily Cleans Page'), 'url' => ['salesorderheader/index']];
if (Company::find()->count() == 0) {$comptel = Yii::t('app','Company Name and Mobile Number');} else {$comptel = Company::findOne(1)->name . " - " . Company::findOne(1)->telephone;};
$pdfHeader = [
  'L' => [
    'content' => $comptel ,
  ],
  'C' => [
    'content' => Yii::t('app','House'),
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
    'content' => Yii::t('app','Filename'). '_Houses_Printed_'.date('d-M-Y-h-s'),
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
        'title' => $comptel,
        'subject' => Yii::t('app','Houses'),
        'keywords' => Yii::t('app','Houses'),
      ],
    ];
$viewMsg = Yii::t('app','View');
$deleteMsg = Yii::t('app','Delete');
$updateMsg = Yii::t('app','Update');
$tooltipfrequency = Html::tag('span', Yii::t('app','Frequency'), ['title'=>Yii::t('app','If empty ... Create House and set frequency eg. monthly, weekly of the individual house.'),'data-toggle'=>'tooltip','style'=>'text-decoration: underline: cursor:pointer;']);
$tooltipgocardlesscustomer = Html::tag('span', 'Gocardless'. Yii::t('app','Mandate Approved Customers'), ['title'=>Yii::t('app','This customer number appears on'). 'Gocardless'. Yii::t('app','and indicates that the customer has approved the mandate that you sent to them.'),'data-toggle'=>'tooltip','style'=>'text-decoration: underline: cursor:pointer;']);
?>

<div class="product-index">
<h1><?= Html::encode($this->title) ?></h1>
<?= 
   //Modal link frontend/layouts/main.php and frontend/assets/AppAsset.php
   Html::button(Yii::t('app','Create House'), ['value' => Url::to(['product/create']), 'title' => Yii::t('app','Creating New House'), 'class' => 'showModalButton btn btn-success btn-lg','title'=>Yii::t('app','Have you setup your Postcode and street?'),'data-toggle'=>'tooltip']); 
?>
<?php 
   //Html::a(Yii::t('app','Create House'), ['create'], ['class' => 'btn btn-success btn-lg','title'=>Yii::t('app','Have you setup your Postcode and street?'),'data-toggle'=>'tooltip']) 
?>
   <Hr style = "border-top: 3px double #8c8b8b">   
   <button id="w5" class = "btn btn-success btn-lg" onclick="js:getKeys()" title="<?php Yii::t('app','Have you created your Daily Clean?') ?>" data-toggle="tooltip"><?php echo Yii::t('app','Copy Ticked to: ') ?></button>
   <?= Html::label(Yii::t('app','Daily Cleans Date: ')) ?>
   <?= Html::dropDownList('sorder','', ArrayHelper::map(Salesorderheader::find()->orderBy(['clean_date'=>SORT_DESC])->all(),'sales_order_id','status','clean_date'),['prompt' => '--- select ---','id'=>'w9']) ?>
   <Hr style = "border-top: 3px double #8c8b8b">
   <?= Html::a(Yii::t('app','Back'), Url::previous(), ['class' => 'btn btn-success btn-lg']) ?>    
        <Hr style = "border-top: 3px double #8c8b8b">
     
       <div class="info">
        <?=          
           Alert::widget()
        ?>
       </div>
<?php 
use kartik\slider\Slider;
echo Html::label('Font Size Adjuster:<br>');
echo Slider::widget([
    'name' => 'sliderfontproduct',
    'value'=> 16,
    'options' => [
                   'id'=>'w128',
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
]). '<button id="w154" class = "btn btn-info btn-lg" onclick="js:getSliderproduct()" title="Adjust to the required font." data-toggle="tooltip">Adjust font</button><br><br>';
   
?> 
<?php
    $gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
      'class' => 'kartik\grid\CheckboxColumn',
            'name'=>'selection',
            'multiple'=>true,
            'checkboxOptions'=>function ($dataProvider, $key, $index){
            return ['id'=>$dataProvider->id,'value' => $dataProvider->id];
            }
    ],
    [
     'class' => 'kartik\grid\ActionColumn',
     'dropdown' => false,
     'header'=>'View',
     'vAlign'=>'middle',
     'viewOptions'=>['title'=>$viewMsg, 'data-toggle'=>'tooltip'],
     'template'=> '{view}',
    ],
    [
     'class' => 'kartik\grid\BooleanColumn',
     'attribute'=>'isactive',
     'value' => function ($dataProvider) {
                    return $dataProvider->isactive; 
            },
     'filter'=>Html::activeCheckbox($searchModel,'isactive',ArrayHelper::map(Product::find()->indexBy('isactive')->asArray()->all(),'isactive','isactive'),[ 'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontproduct'].'px']]),
     'filterType'=>GridView::FILTER_CHECKBOX,
     'filterInputOptions' => [
                  'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontproduct'].'px'],
                  'label'=>'',
     ],
     'filterWidgetOptions'=>[
                  'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontproduct'].'px'],
                  'type'=>\kartik\switchinput\SwitchInput::CHECKBOX
     ],               
    ],        
    ['class' => '\kartik\grid\EditableColumn',
                'attribute' =>'productnumber',
                'filterInputOptions' => [
                  'class'=> 'form-control',
                  'style'=> 'font-size:'.Yii::$app->session['sliderfontproduct'].'px',
                  'placeholder' => 'No...'
                ],
                'hAlign' => 'right', 
                'vAlign' => 'middle',
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
                'format'=>'html',
                'value'=>function ($dataProvider){
                   return "<span class = 'badge badge-pill badge-success '> $dataProvider->productnumber </span>";
                }
    ], 
    ['class' => '\kartik\grid\EditableColumn',
                'attribute' =>'contactmobile',
                'filterInputOptions' => [
                  'class'=> 'form-control',
                  'style'=> 'font-size:'.Yii::$app->session['sliderfontproduct'].'px',
                  'placeholder' => 'Mobile ...'
                ],
                'hAlign' => 'right', 
                'vAlign' => 'middle',
                'width' => '7%',
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
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{link}',// can be omitted, as it is the default
            'header'=>'Call',
            'visible'=> Yii::$app->user->isGuest ? false : true,
            'buttons' => ['link' => function ($url, $dataProvider,$key) {
                           if (strlen($dataProvider->contactmobile)===11){
                           return Html::a($dataProvider->contactmobile,$url);}
                           else return '';
                }
             ],
            'urlCreator' => function ($action, $dataProvider, $key, $index) {
                         if (($action === 'link') ) {
                             $url = "tel:/".$dataProvider->contactmobile;
                             return $url;
                         }
             }                
     ],
     [  'class' => '\kartik\grid\EditableColumn',
        'attribute' =>'specialrequest', 
        'value'=> function ($dataProvider){if (empty($dataProvider->specialrequest)) return '?????';},
        'hAlign' => 'left', 
        'vAlign' => 'middle',
        'filterInputOptions' => [
                  'class'=> 'form-control',
                  'style'=> 'font-size:'.Yii::$app->session['sliderfontproduct'].'px',
                  'placeholder' => Yii::t('app','Special request...'),
                ],
        'refreshGrid'=>true,
        'headerOptions' => ['class' => 'kv-sticky-column'],
        'contentOptions' => [
                      'class' => 'kv-sticky-column',
                      'style'=>'overflow: auto; word-wrap: break-word;'
        ],
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
            'class'=>'kartik\grid\DataColumn',
            'header'=>$tooltipfrequency,
            'attribute'=>'frequency',
            'value' => function ($dataProvider) {
                    return $dataProvider->frequency; 
            },
             'filter'=> Html::activeDropDownList($searchModel,'frequency',ArrayHelper::map(Product::find()->orderBy('frequency')->asArray()->all(),'frequency','frequency'),[ 'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontproduct'].'px'],'class'=>'form-control','prompt'=>'Monthly...']), 
    ],     
    [
            'class'=>'kartik\grid\DataColumn',
            'header'=>Yii::t('app','Post Code'),
            'attribute'=>'productcategory_id',
            'value' => function ($dataProvider) {
                    return $dataProvider->productcategory->name; 
            },
            'filter'=> Html::activeDropDownList($searchModel,'productcategory_id',ArrayHelper::map(Productcategory::find()->orderBy('name')->asArray()->all(),'id','name'),[ 'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontproduct'].'px'],'class'=>'form-control','prompt'=>'Postcode...']), 
    ],
    [
            'class'=>'kartik\grid\DataColumn',
            'header'=>Yii::t('app','Street'), 
            'format'=>'html',
            'attribute'=>'productsubcategory_id', 
            'value' => function ($dataProvider) {
                        $url2 = "https://maps.google.com/maps?q=".ltrim($dataProvider->productnumber, '0')." ".$dataProvider->productsubcategory->name." ".$dataProvider->productcategory->name;
                       return Html::a($dataProvider->productsubcategory->name,$url2);
             },
            'filter'=> Html::activeDropDownList($searchModel,'productsubcategory_id',ArrayHelper::map(Productsubcategory::find()->where(['id'=>$searchModel->productcategory_id])->orderBy('name')->asArray()->all(),'id','name'),[ 'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontproduct'].'px'],'class'=>'form-control','prompt'=>'Street...']),
    ],
    [
    'class' => 'kartik\grid\EditableColumn',
    'header' => Yii::t('app','First Clean Date'),
    'attribute' =>  'sellstartdate',
    'filter'=> Html::activeDropDownList($searchModel,'sellstartdate',ArrayHelper::map(Product::find()->orderBy('sellstartdate')->asArray()->all(),'sellstartdate','sellstartdate'),[ 'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontproduct'].'px'],'class'=>'form-control','prompt'=>'From...']),      
    'hAlign' => 'right',
    'vAlign' => 'middle',
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
    ['class'=>'kartik\grid\DataColumn',
     'attribute'=>'name',
     'filterInputOptions' => [
                  'class'=> 'form-control',
                  'style'=> 'font-size:'.Yii::$app->session['sliderfontproduct'].'px',
                  'placeholder' => 'Firstname...'
                ],
    ],
    ['class'=>'kartik\grid\DataColumn',
     'attribute'=>'surname',
     'filterInputOptions' => [
                  'class'=> 'form-control',
                  'style'=> 'font-size:'.Yii::$app->session['sliderfontproduct'].'px',
                  'placeholder' => 'Surname...'
                ],
    ],
    [
                'class' => '\kartik\grid\EditableColumn',
                'attribute' => 'listprice',
                'filterInputOptions' => [
                  'class'=> 'form-control',  
                  'style'=> 'font-size:'.Yii::$app->session['sliderfontproduct'].'px',
                  'placeholder' => 'Price...',
                ],
                'vAlign' => 'middle',
                'hAlign'=>'right',
                'format' => ['decimal', 2],
                'pageSummary' => true,
                'refreshGrid'=>true,
                 'editableOptions' => [
                    'asPopover' => false,
                    'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                        'options' => [
                        'pluginOptions' => ['autoclose' => true],                        
                        ]
                ],     
                'format'=>'html',
                'value' => function ($dataProvider, $key, $index, $column) { 
                    $prepare = Yii::$app->formatter->asDecimal($dataProvider->listprice, 2);
                    $mystyle = Yii::$app->session['sliderfontproduct'].'px';
                    return  "<span class = 'badge badge-pill badge-info style = 'font-size:{$mystyle}'>$prepare</span>";
                },
                
     ], 
     [
    'class' => 'kartik\grid\ExpandRowColumn',
    'header'=>'Debt',
    'expandTitle'=> 'Debt',
    'expandIcon' => Icon::show('balance-scale', ['framework' => Icon::FAS]),
    'value' => function ($dataProvider, $key, $index, $column) {
         return GridView::ROW_COLLAPSED;
    },
    'disabled'=> function ($dataProvider, $key, $index, $column) {
                    $rows  = $dataProvider->salesorderdetails;
                    $subtotal = 0.00;
                    foreach ($rows as $key => $value)
                             {
                               if ($rows[$key]['paid'] < $rows[$key]['unit_price'])
                               {
                                   $subtotal += $rows[$key]['unit_price']; 
                                   //$subtotal -= $rows[$key]['paid']; 
                               }
                             }
                    $subtotal = Yii::$app->formatter->asDecimal($subtotal, 2); 
                    if ($subtotal > 0.00) { return false;} else { return true;}
    },
    'detail' => function ($dataProvider, $key, $index, $column) {
        return Yii::$app->controller->renderPartial('_expandableviewdebtsheet', ['model' => $dataProvider]);
    },
    'headerOptions' => ['class' => 'kv-sticky-column'],
    'contentOptions' => ['class' => 'kv-sticky-column'],
    'expandOneOnly' => true,
    ],
    [
    'class' => 'kartik\grid\ExpandRowColumn',
    'header'=>Yii::t('app','History'),
    'expandTitle'=> 'History',
    'expandIcon' => Icon::show('book', ['framework' => Icon::FAS]), 
    'value' => function ($dataProvider, $key, $index, $column) {
         return GridView::ROW_COLLAPSED;
    },
    'disabled'=> function ($dataProvider, $key, $index, $column) {
                    $rows  = $dataProvider->salesorderdetails;
                    $subtotal = 0.00;
                    foreach ($rows as $key => $value)
                             {
                               $subtotal += $rows[$key]['unit_price']; 
                             }
                    $subtotal = Yii::$app->formatter->asDecimal($subtotal, 2); 
                    if ($subtotal > 0.00) { return false;} else { return true;}
    },
    'detail' => function ($dataProvider, $key, $index, $column) {
        return Yii::$app->controller->renderPartial('_expandableviewhistorysheet', ['model' => $dataProvider]);
    },
    'headerOptions' => ['class' => 'kartik-sheet-style'], 
    'expandOneOnly' => true,
    ],
    [
    'class' => 'kartik\grid\DataColumn', 
    'format'=>'raw',
    'headerOptions' => ['class' => 'kv-sticky-column'],
    'contentOptions' => ['class' => 'kv-sticky-column'],
    'hAlign'=>'right',    
    'value' => function ($dataProvider, $key, $index, $column) {
                    $rows  = $dataProvider->salesorderdetails;
                    $subtotal = 0.00;
                    foreach ($rows as $key => $value)
                             {
                               if ($rows[$key]['paid'] < $rows[$key]['unit_price'])
                               {
                                   $subtotal += $rows[$key]['unit_price']; 
                                   //customers do not always pay full amount $subtotal -= $rows[$key]['paid'];
                               }
                             }
                    $subtotal = Yii::$app->formatter->asDecimal($subtotal, 2); 
                    if ($subtotal > 0.00){return $subtotal;}
                    else {return '';}
     }
     ],
     [
            'class'=>'kartik\grid\DataColumn',
            'visible'=>false,
            'header'=>$tooltipgocardlesscustomer,
            'attribute'=>'gc_number',
            'value'=> function ($dataProvider){if (empty($dataProvider->gc_number)){return '';}
                  else  {return $dataProvider->gc_number;} 
            },
            'filter'=> Html::activeDropDownList($searchModel,'gc_number',ArrayHelper::map(Product::find()->orderBy('gc_number')->asArray()->all(),'gc_number','gc_number'),['options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontproduct'].'px'],'class'=>'form-control','prompt'=>'Gocardless Number...']), 
     ],
];

if ((empty(Yii::$app->session['sliderfontproduct'])) && (!isset(Yii::$app->session['sliderfontproduct']))){Yii::$app->session['sliderfontproduct'] = 18;}

echo kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
    'bootstrap'=>true,
    'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontproduct'].'px'],
    'containerOptions' => ['style'=>'overflow: auto'], 
    'pjax' => true,
    'pjaxSettings' =>[
                      'neverTimeout'=>true,
                      'options'=>['id'=>'kv-unique-id-7'],                      
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
    'heading'=> $comptel,
    ],
    'exportConfig' => [
                   GridView::CSV => ['label' => Yii::t('app','Export as CSV'),'config' => $config_array, 'filename' => 'Houses_Printed_'.date('d-M-Y')],
                   GridView::HTML => ['label' => Yii::t('app','Export as HTML'),'config' => $config_array, 'filename' => 'Houses_Printed_'.date('d-M-Y')],
                   GridView::PDF => [ 'label' => Yii::t('app','Export as PDF'),'config' => $config_array, 'filename' => 'Houses_Printed_'.date('d-M-Y')], 
                   GridView::EXCEL=> ['label' => Yii::t('app','Export as EXCEL'), 'filename' => 'Houses_Printed_'.date('d-M-Y')],
                   GridView::TEXT=> ['label' => Yii::t('app','Export as TEXT'), 'filename' => 'Houses_Printed_'.date('d-M-Y')],
                ],
]);
?>
</div>

