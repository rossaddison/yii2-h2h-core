<?php
use yii\helpers\Url;
use yii\helpers\Html;
use \kartik\grid\GridView;
use frontend\models\Costheader;
use frontend\models\Company;
use kartik\icons\FontAwesomeAsset;
use Yii;
FontAwesomeAsset::register($this);
$this->title = Yii::t('app','app','Costs to include');
$cost_date = DateTime::createFromFormat("Y-m-d", Costheader::findOne($id=Yii::$app->session['cost_header_id'])->cost_date)->format("l, d F Y");
$pdfHeader = [
  'L' => [
    'content' => Company::findOne(1)->name . " - " . Company::findOne(1)->telephone . " - " . DateTime::createFromFormat("Y-m-d", Costheader::findOne($id=Yii::$app->session['cost_header_id'])->cost_date)->format("l, d F Y"),
  ],
  'C' => [
    'content' => Yii::t('app','Daily Costs'),
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
    'content' => Yii::t('app','Filename: Clean_date-').$cost_date.'_Printed_'.date('d-M-Y'),
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
        'title' => Company::findOne(1)->name . " - " . Company::findOne(1)->telephone . " - " . DateTime::createFromFormat("Y-m-d", Costheader::findOne($id=Yii::$app->session['cost_header_id'])->cost_date)->format("l, d F Y"),
        'subject' => Yii::t('app','Daily Costs'),
        'keywords' => Yii::t('app','daily, cost, daily cost')
      ],
    ];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Daily Costs'), 'url' => ['costheader/index']];
$this->params['breadcrumbs'][] = ['label' => $cost_date];
$this->params['breadcrumbs'][] = $this->title;
$viewMsg = Yii::t('app','View');
$deleteMsg = Yii::t('app','Delete');
$updateMsg = Yii::t('app','Update');
$tooltipcatandsubcat = Html::tag('span', '', ['title'=>Yii::t('app','Cost category and subcategory'),'data-toggle'=>'tooltip','style'=>'text-decoration: underline: cursor:pointer;']);
?>
<div class="info">
<?php if(Yii::$app->session->hasFlash('success')){echo Yii::$app->session->getFlash('success');}?>
</div>
<div class="costdetail-index">
<h1><?= Html::encode($this->title) ?></h1>

<?php 
    $this->render('_search', ['model' => $searchModel]); 
?>
<p>
    <button id="w110" class = "btn btn-success" onclick="js:getPaidcostticks()">Paid (ticked)</button>
    <button id="w111" class = "btn btn-danger" onclick="js:getUnpaidcostticks()">Unpaid (ticked)</button>
    
    <?= Html::a(Yii::t('app','Add Cost'), ['cost/index'], ['class' => 'btn btn-warning']) ?>
    <?= Html::a(Yii::t('app','Back'), ['costheader/index'], ['class' => 'btn btn-success']) ?>
    <br>
    </br>
</p>

<?php 
use kartik\slider\Slider;
echo Html::label(Yii::t('app','Font Size Adjuster:<br>'));
echo Slider::widget([
    'name' => 'sliderfontcostdetail',
    'value'=> Yii::$app->session['sliderfontcostdetail'],
    'options' => [
                   'id'=>'w701',
                 ],
    'sliderColor' => Slider::TYPE_INFO,
    'handleColor' => Slider::TYPE_INFO,
    'pluginOptions' => [
        'orientation' => 'horizontal',
        'handle' => 'round',
        'min' => 1,
        'max' => 32,
        'step' => 1,
        'tooltip'=>Yii::t('app','app','Adjust to change the font size.'),
    ],
]). '<button id="w991" class = "btn btn-info btn-lg" onclick="js:getSlidercostdetail()" title='.Yii::t('app','Adjust to the required font.').' data-toggle="tooltip">Adjust font</button><br><br>';
   
?> 
<?php
    Yii::$app->formatter->nullDisplay = '';
    $gridColumns = [
    ['class' => 'kartik\grid\SerialColumn',      
    ],
    ['class' => 'kartik\grid\CheckboxColumn',
            'name'=>'selection',
            'multiple'=>true,
            'checkboxOptions'=>function ($model, $key, $index){
            return ['id'=>$model->cost_detail_id,'value' => $model->cost_detail_id];
            }
    ],
    ['class' => 'kartik\grid\ActionColumn',
     'dropdown' => false,
     'header'=>'Vw',
     'vAlign'=>'middle',
     'viewOptions'=>['title'=>$viewMsg, 'data-toggle'=>'tooltip'],
     'template'=> '{view}',
    ],
    [
    'class' => 'kartik\grid\ExpandRowColumn',
    'header'=>$tooltipcatandsubcat,  
    'expandTitle'=> Yii::t('app','Cost category and Subcategory'),
    'width' => '300px',
    'value' => function ($model, $key, $index, $column) {
        return GridView::ROW_COLLAPSED;
    },
    'detail' => function ($model, $key, $index, $column) {
        return Yii::$app->controller->renderPartial('_expandableview', ['costcode_id'=>$model->costcategory_id,'costsubcode_id'=>$model->costsubcategory_id]);
    },
    'headerOptions' => ['class' => 'kartik-sheet-style'], 
    'expandOneOnly' => true,
    ],       
    [
    'class' => 'kartik\grid\DataColumn', // can be omitted, as it is the default
    'header'=> Yii::t('app','Description'),
    'value' => function ($data) {
        return $data->cost->description; // $data['name'] for array data, e.g. using SqlDataProvider.
    },
    ],
    [
            'class' => 'kartik\grid\EditableColumn', 
            'header'=>Yii::t('app','Payment Type'),
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>[Yii::t('app','Cash') =>Yii::t('app','Cash'),Yii::t('app','Cheque')=>Yii::t('app','Cheque'),Yii::t('app','Paypal')=>Yii::t('app','Paypal'),Yii::t('app','Debitcard')=>Yii::t('app','Debitcard'),Yii::t('app','Creditcard')=>Yii::t('app','Creditcard'),Yii::t('app','Other')=>Yii::t('app','Other')],
            'attribute'=>'paymenttype',
            'filterInputOptions' => [
                  'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontcostdetail'].'px'],
                  'placeholder' => Yii::t('app','Payment Type...')
             ],
              'filterWidgetOptions'=>[
                   'pluginOptions'=>['allowClear'=>true],
                ],
                 'editableOptions' => function ($data,$key,$index,$widget)
                {
                    $arr = [Yii::t('app','Cash') =>Yii::t('app','Cash'),Yii::t('app','Cheque')=>Yii::t('app','Cheque'),Yii::t('app','Paypal')=>Yii::t('app','Paypal'),Yii::t('app','Debitcard')=>Yii::t('app','Debitcard'),Yii::t('app','Creditcard')=>Yii::t('app','Creditcard'),Yii::t('app','Other')=>Yii::t('app','Other')];
                    return ['header'=>Yii::t('app','Payment Type'),
                            'attribute'=>'paymenttype',
                            'size' => 'sm',
                            'format' =>kartik\Editable\Editable::FORMAT_BUTTON,
                            'inputType' => kartik\Editable\Editable::INPUT_DROPDOWN_LIST,
                                'options' => [
                                  'pluginOptions' => 
                                  [
                                    'autoclose' => true,
                                    'style'=> 'font-size:'.Yii::$app->session['sliderfontcostdetail'].'px',  
                                  ],
                                ],
                            'data'=>$arr,
                            'displayValueConfig'=>$arr,
                            ];
                },
             'hAlign' => 'right', 
             'vAlign' => 'middle',
             'width' => '7%',
             'refreshGrid'=>true,
             'readonly' => false,               
   ],                    
   ['class' => '\kartik\grid\EditableColumn',
                'attribute' =>'paymentreference',
                'filterInputOptions' => [
                  'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontcostdetail'].'px'],
                  'placeholder' => Yii::t('app','Reference...')
                ],
                'hAlign' => 'right', 
                'vAlign' => 'middle',
                'width' => '7%',
                'refreshGrid'=>true,
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
    'header'=>Yii::t('app','Carousal File'),
    'visible'=> Yii::$app->user->isGuest ? false : true,
    'buttons' => ['link' => function ($url, $data,$key) {
                   if (!empty($data->carousal->image_source_filename)){  
                   return Html::a($data->carousal->image_source_filename,$url,['class' => 'btn btn-success']);}
        }
        ],
    'urlCreator' => function ($action, $data, $key, $index) {
                 if (($action === 'link')&& !empty($data->carousal->id)) {
                     $url = Url::toRoute(['carousal/view/'.$data->carousal->id]);
                     return $url;
                 }
                 else {return ' '; }
        }                
    ],  
    [
    'class' => 'kartik\grid\ActionColumn',
    'template' => '{link}',// can be omitted, as it is the default
    'header'=>'<',
    'visible'=> Yii::$app->user->isGuest ? false : true,
    'buttons' => ['link' => function ($url, $model,$key) {
                   return Html::a("<",$url,['class' => 'btn btn-success']);
        }
        ],
    'urlCreator' => function ($action, $model, $key, $index) {
                 if (($action === 'link') ) {
                     $url = Url::toRoute(['costheader/index']);
                     return $url;
                 }
        }                
    ],  
    [
        //refer to additional code in controller
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'unit_price',
        'hAlign' => 'right', 
        'vAlign' => 'middle',
        'width' => '7%',
        'format' => ['decimal', 2],
        'pageSummary' => true,
        'refreshGrid'=>true,
        'editableOptions' => [
        'asPopover' => false,      
        'header' => Yii::t('app','Unit Price'), 
        'inputType' => kartik\editable\Editable::INPUT_SPIN,
            'options' => [
                'pluginOptions' => ['min' => 0.00, 'max' =>10000.00],                        
            ]
        ],               
    ],
     [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'paid',
        'hAlign' => 'right', 
        'vAlign' => 'middle',
        'width' => '7%',
        'format' => ['decimal', 2],
        'pageSummary' => true,
        'refreshGrid'=>true,
        'editableOptions' => [
        'asPopover' => false, 
        'header' => Yii::t('app','Paid'), 
        'inputType' => kartik\editable\Editable::INPUT_SPIN,
            'options' => [
                'pluginOptions' => ['min' => 0.00, 'max' =>10000.00],                        
            ]
        ],               
    ], 
                  
];
 if ((empty(Yii::$app->session['sliderfontcostdetail'])) && (!isset(Yii::$app->session['sliderfontcostdetail']))){Yii::$app->session['sliderfontcostdetail'] = 18;}                      
            
echo kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
    'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontcostdetail'].'px'],
     // the id for the container ie. W1 is autogenerated. Refer to vendor/kartik-v/yii2-grid\gridview
    'containerOptions' => ['style'=>'overflow: auto'], 
    'pjax' => true,
    'pjaxSettings' =>['neverTimeout'=>false,
                      'options'=>['id'=>'kv-unique-id-1'],                      
                     ], 
    'bordered' => true,
    'striped' => true,
    'condensed' => false,
    'toolbar' => [
          ['content'=>Html::a('<i class="glyphicon glyphicon-repeat"></i>',['salesorderdetail/index', 'id' => Yii::$app->session['sales_order_id']],['data-pjax'=>0,'class'=> 'btn-default','title'=>'Reset Grid'])
          ],
          
    ],
    'responsive' => true,
    'hover' => true,
    'floatHeader' => false,
    'showPageSummary' => true,
    'panel' => [
    'type' => GridView::TYPE_PRIMARY,
    'heading'=> Company::findOne(1)->name . " - " . Company::findOne(1)->telephone . " - " . DateTime::createFromFormat("Y-m-d", Costheader::findOne($id=Yii::$app->session['cost_header_id'])->cost_date)->format("l, d F Y"),
    ],
    'exportConfig' => [
                   GridView::CSV => ['label' => Yii::t('app','Export as CSV'),'config' => $config_array, 'filename' => 'Cost_date-'.$cost_date.'_Printed_'.date('d-M-Y')],
                   GridView::HTML => ['label' => Yii::t('app','Export as HTML'),'config' => $config_array, 'filename' => 'Cost_date-'.$cost_date.'_Printed_'.date('d-M-Y')],
                   GridView::PDF => [ 'label' => Yii::t('app','Export as PDF'),'config' => $config_array, 'filename' => 'Cost_date-'.$cost_date.'_Printed_'.date('d-M-Y')], 
                   GridView::EXCEL=> ['label' => Yii::t('app','Export as EXCEL'), 'filename' => 'Cost_date-'.$cost_date.'_Printed_'.date('d-M-Y')],
                   GridView::TEXT=> ['label' => Yii::t('app','Export as TEXT'), 'filename' => 'Cost_date-'.$cost_date.'_Printed_'.date('d-M-Y')],
                ],
  ]);
?>
</div>  
