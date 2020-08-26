<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use \kartik\grid\GridView;
use frontend\models\Salesorderheader;
use frontend\models\Productcategory;
use frontend\models\Productsubcategory;
use frontend\models\Company;
use frontend\models\Instruction;
use frontend\models\Messaging;
use yii\db\Query;
use kartik\Editable\Editable;
use kartik\icons\Icon;
use kartik\icons\FontAwesomeAsset;
use Yii;
FontAwesomeAsset::register($this);
$this->title = Yii::t('app','Houses to clean');
$clean_date = DateTime::createFromFormat("Y-m-d", Salesorderheader::findOne($id=Yii::$app->session['sales_order_id'])->clean_date)->format("l, d F Y");
$clean_date_this = Salesorderheader::findOne($id=Yii::$app->session['sales_order_id'])->clean_date;
$status = Salesorderheader::findOne($id=Yii::$app->session['sales_order_id'])->status;
$pdfHeader = [
  'L' => [
    'content' => Company::findOne(1)->name . " - " . Company::findOne(1)->telephone . " - " . DateTime::createFromFormat("Y-m-d", Salesorderheader::findOne($id=Yii::$app->session['sales_order_id'])->clean_date)->format("l, d F Y"),
  ],
  'C' => [
    'content' => Yii::t('app','Daily Cleans'),
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
    'content' => 'Filename: Clean_date-'.$clean_date.'_Printed_'.date('d-M-Y'),
    'font-size' => 10,
    'color' => '#333333',
    'font-family' => 'arial',
  ],
  'C' => [
    'content' => 'Printed: ' .date('d-M-Y'),
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
        'title' => Company::findOne(1)->name . " - " . Company::findOne(1)->telephone . " - " . DateTime::createFromFormat("Y-m-d", Salesorderheader::findOne($id=Yii::$app->session['sales_order_id'])->clean_date)->format("l, d F Y"),
        'subject' => Yii::t('app','Daily Cleans'),
        'keywords' => Yii::t('app','daily, clean, daily clean')
      ],
    ];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Daily Cleans'), 'url' => ['salesorderheader/index']];
$this->params['breadcrumbs'][] = ['label' => $clean_date];
$this->params['breadcrumbs'][] = $this->title;
$viewMsg = Yii::t('app','View');
$arr2 = Arrayhelper::map(Instruction::find()->orderBy('id')->asArray()->all(),'id','code');
$deleteMsg = Yii::t('app','Delete');
$updateMsg = Yii::t('app','Update');
$tooltiptextpaid = Html::tag('span', Yii::t('app','Text Paid'), ['title'=>Yii::t('app','Inform Boss of payment by text'),'data-toggle'=>'tooltip','style'=>'text-decoration: underline: cursor:pointer;']);
$tooltipunitprice = Html::tag('span', Yii::t('app','Unit Price'), ['title'=>Yii::t('app','Price charged per clean'),'data-toggle'=>'tooltip','style'=>'text-decoration: underline: cursor:pointer;']);
$tooltipprepyt = Html::tag('span', 'Past Paid', ['title'=>Yii::t('app','Prepayment from a previous date. This cannot be edited since it is transferred from a previous date.'),'data-toggle'=>'tooltip','style'=>'text-decoration: underline: cursor:pointer;']);
$tooltipadvpyt = Html::tag('span', 'Paid Future', ['title'=>Yii::t('app','Cash received today for future clean date. Transfer to future date using button above.'),'data-toggle'=>'tooltip','style'=>'text-decoration: underline: cursor:pointer;']);
$tooltiptips = Html::tag('span', Yii::t('app','Tips'), ['title'=>Yii::t('app','All tips.'),'data-toggle'=>'tooltip','style'=>'text-decoration: underline: cursor:pointer;']);
$tooltipwhat = Html::tag('span', Yii::t('app','Do'), ['title'=>Yii::t('app','What is to be done. Load your codes under main menu instructions.'),'data-toggle'=>'tooltip','style'=>'text-decoration: underline: cursor:pointer;']);
$tooltiptotalowed = Html::tag('span', Yii::t('app','Debt'), ['title'=>Yii::t('app','Debt from previous cleans not including the current clean.'),'data-toggle'=>'tooltip','style'=>'text-decoration: underline: cursor:pointer;']);
$tooltipaddress = Html::tag('span', '', ['title'=>Yii::t('app','Address'),'data-toggle'=>'tooltip','style'=>'text-decoration: underline: cursor:pointer;']);
$tooltiphousenumbermobile = Html::tag('span', Yii::t('app','House Mobile'), ['title'=>Yii::t('app','Use this number to text your customer.'),'data-toggle'=>'tooltip','style'=>'text-decoration: underline: cursor:pointer;']);
?>
<div class="info">
<?php if(Yii::$app->session->hasFlash('success')){echo Yii::$app->session->getFlash('success');}?>
</div>
<div class="salesorderdetail-index">
<h1><?= Html::encode($this->title) ?></h1>
<p>
    <button id="w13" class = "btn btn-info btn-lg" onclick="js:getCleanedticks()" datatoggle="tooltip" title="<?php echo Yii::t('app','Use the checkbox column to select all the houses that have been cleaned. All houses are assumed cleaned by default.') ?>"><?php echo Yii::t('app','Cleaned (ticked)') ?></button>
    <button id="w14" class = "btn btn-danger btn-lg" onclick="js:getMissedticks()"><?php echo Yii::t('app','Missed (ticked)') ?></button>
    <button id="w15" class = "btn btn-danger btn-lg" onclick="js:getNotcleanedticks()" datatoggle="tooltip" title="<?php echo Yii::t('app','Use the checkbox column to select all the houses that have not been cleaned. All houses are assumed cleaned by default.') ?>"><?php echo Yii::t('app','Not Cleaned (ticked)') ?></button>
    <?php if (Yii::$app->user->can('Update Daily Job Sheet')) { ?>
    <button id="w10" class = "btn btn-success btn-lg" onclick="js:getPaidticks()"><?php echo Yii::t('app','Paid (ticked)') ?></button>
    <button id="w11" class = "btn btn-danger btn-lg" onclick="js:getUnpaidticks()"><?php echo Yii::t('app','Unpaid (ticked)') ?></button>
    <Hr style = "border-top: 3px double #8c8b8b">   
    <button id="w23" class = "btn btn-danger btn-lg" onclick="js:getAddpretopaid()"><?php echo Yii::t('app','Add pre payment (ticked) to Paid') ?></button>  
    <Hr style = "border-top: 3px double #8c8b8b">   
    <button id="w22" class = "btn btn-danger btn-lg" onclick="js:getTransferticks()"><?php echo Yii::t('app','Transfer advance payments (ticked) to future pre-payment') ?></button> 
    <?= Html::dropDownList('transadv','', ArrayHelper::map(Salesorderheader::find()->where(['>','clean_date',$clean_date_this])->andWhere(['status'=>$status])->orderBy('status')->all(),'sales_order_id','clean_date','status'),['prompt' => Yii::t('app','--- select ---'),'id'=>'w61','class'=>'btn btn-danger  btn-lg','style'=>'width: 200px']) ?>
    <?php } ?>
    <button id="w33" class = "btn btn-danger dropdown-toggle btn-lg" type="button" data-toggle="dropdown" ><?php echo Yii::t('app','Create Future Clean') ?><span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><button id="w35" class = "btn btn-danger btn-lg" onclick="js:getCopyitbytodaysdatesalesorderdetail()"><?php echo Yii::t('app','Date Today') ?></button></li>  
                    <li><button id="w36" class = "btn btn-danger btn-lg" onclick="js:getCopyitbyfrequencysalesorderdetail()"><?php echo Yii::t('app',' +1 Month') ?></button></li>    
                </ul>
    <br>
    <div>
    <?php if (Yii::$app->user->can('Use Gocardless')) {?>
    <Hr style = "border-top: 3px double #8c8b8b">   
    <button id="w21" class = "btn btn-danger btn-lg" onclick="js:getGocardlesspayticks()" datatoggle="tooltip" title="<?php echo Yii::t('app','Customers can be sent a direct debit variable mandate to consent to each time you need payment from them.') ?>">Gocardless<?php echo Yii::t('app',' One-off (ticked)') ?></button>
         <?= Html::a(Yii::t('app','Add House'), ['product/index'], ['class' => 'btn btn-warning btn-lg','datatoggle'=>'tooltip', 'title'=> '"This button will take you to Houses to create one. You will then be able to transfer the house through to the list of houses that are part of the daily clean.']) ?>
         <?= Html::a(Yii::t('app','Back'), ['salesorderheader/index'], ['class' => 'btn btn-success btn-lg']) ?>
    <?php } ?>
    <?php if (Yii::$app->user->can('Use Twilio')) {?>
    <Hr style = "border-top: 3px double #8c8b8b">
    <button id="w16" class = "btn btn-success btn-lg" onclick="js:getOwingticks()" datatoggle ="tooltip" title="<?php echo Yii::t('app','Different message types can be sent to your customer using Twilio, a service that requires a subscription') ?>">SMS-(ticked)</button>
        <div>
           <br>
           <?= Html::label(Yii::t('app','Message ')) ?>
            <br>
           <?= Html::dropDownList('sdmessage','', ArrayHelper::map(Messaging::find()->all(),'id','message'),['prompt' => Yii::t('app','Message ...'),'id'=>'w33','class'=>'btn btn-success btn-lg' ,'style'=>'width: 200px']) ?>
        </div>
    <Hr style = "border-top: 3px double #8c8b8b">
    </div>
    <?php } ?>
    </br>
</p>
<?php 
use kartik\slider\Slider;
echo Html::label(Yii::t('app','Font Size Adjuster'). '<br>');
echo Slider::widget([
    'name' => 'sliderfontsalesdetail',
    'value'=> Yii::$app->session['sliderfontsalesdetail'],
    'options' => [
                   'id'=>'w528',
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
]);
?>
<button id="w654" class = "btn btn-info btn-lg" onclick="js:getSlidersalesdetail()" title="<?php echo Yii::t('app','Adjust to the required font.') ?>" data-toggle="tooltip"><?php echo Yii::t('app','Adjust font') ?></button><br><br>';

<?php
    Yii::$app->formatter->nullDisplay = ''; 
    $gridColumns = [
    [
            'class' => 'kartik\grid\CheckboxColumn',
            'name'=>'selection',
            'multiple'=>true,
            'checkboxOptions'=>function ($dataProvider, $key, $index){
            return ['id'=>$dataProvider->sales_order_detail_id,'value' => $dataProvider->sales_order_detail_id];
            }
    ],             
    [
            'class' => 'kartik\grid\DataColumn', 
            'header'=>Yii::t('app','Cleaned'),
            'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontsalesdetail'].'px'],
            'value' => function ($dataProvider) {
                return $dataProvider->cleaned;
            },
    ],
    [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'instruction_id',
            'value' => function ($dataProvider) {
                return $dataProvider->instructioncode->code; 
            },
            'header'=>$tooltipwhat,
            'hAlign' => 'right', 
            'vAlign' => 'middle',
            'width' => '7%',
            'pageSummary' => false,
            'refreshGrid'=>true,
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>Arrayhelper::map(Instruction::find()->orderBy('id')->asArray()->all(),'id','code'),
            'filterWidgetOptions'=>[
                   'pluginOptions'=>['allowClear'=>true],
            ],
            'editableOptions' => function ($dataProvider,$key,$index,$widget)
            {
                    $arr = Arrayhelper::map(Instruction::find()->where(['include'=>1])->orderBy('id')->asArray()->all(),'id','code','code_meaning');
                    return [
                            'header'=>Yii::t('app','Code'),
                            'attribute'=>'instruction_id',
                            'size' => 'sm',
                            'format' =>Editable::FORMAT_BUTTON,
                            'inputType' => Editable::INPUT_DROPDOWN_LIST,
                                'options' => [
                                  'pluginOptions' => 
                                  [
                                    'autoclose' => true,
                                  ],
                                ],
                            'data'=>$arr,
                            'displayValueConfig'=>$arr,
                            ];
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
    'header'=>$tooltipaddress,  
    'expandTitle'=> Yii::t('app','Postcode and Street'),
    'width' => '300px',
    'value' => function ($dataProvider, $key, $index, $column) {
        return GridView::ROW_COLLAPSED;
    },
    'detail' => function ($dataProvider, $key, $index, $column) {
        return Yii::$app->controller->renderPartial('_expandableview', ['postcode_id'=>$dataProvider->productcategory_id,'street_id'=>$dataProvider->productsubcategory_id]);
    },
    'headerOptions' => ['class' => 'kartik-sheet-style'], 
    'expandOneOnly' => true,
    ],      
            [
            'class' => 'kartik\grid\DataColumn', // can be omitted, as it is the default
            'header'=>Yii::t('app','Postcode'),
            'attribute'=>'productcategory_id',
            'value' => function ($dataProvider) {
                return $dataProvider->productcategory->name; // $data['name'] for array data, e.g. using SqlDataProvider.
            },
            'filter'=> Html::activeDropDownList($searchModel,'productcategory_id',ArrayHelper::map(Productcategory::find()->orderBy('name')->asArray()->all(),'id','name'),[ 'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontsalesdetail'].'px'],'class'=>'form-control','prompt'=>'Postcode...']), 
            ],
            [
            'class' => 'kartik\grid\DataColumn', // can be omitted, as it is the default
            'header'=>Yii::t('app','Street'),
            'format'=>'html',
            'attribute'=>'productsubcategory_id',
            'value' => function ($dataProvider) {
                        $url2 = "https://maps.google.com/maps?q=".ltrim($dataProvider->product->productnumber, '0')." ".$dataProvider->productsubcategory->name." ".$dataProvider->productcategory->name;
                       return Html::a($dataProvider->productsubcategory->name,$url2);
            },
            'filter'=> Html::activeDropDownList($searchModel,'productsubcategory_id',ArrayHelper::map(Productsubcategory::find()->where(['productcategory_id'=>$searchModel->productcategory_id])->orderBy('name')->all(),'id','name'),[ 'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontsalesdetail'].'px'],'class'=>'form-control','prompt'=>'Street...']),        
            ],    
            [
            'class' => 'kartik\grid\DataColumn', // can be omitted, as it is the default
            'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontsalesdetail'].'px'],    
            'header'=> Yii::t('app','Firstname'),
            'value' => function ($dataProvider) {
                return $dataProvider->product->name; // $data['name'] for array data, e.g. using SqlDataProvider.
            },
            ],
            [
            'class' => 'kartik\grid\DataColumn',
            'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontsalesdetail'].'px'],     // can be omitted, as it is the default
            'header'=> Yii::t('app','Surname'),
            'value' => function ($dataProvider) {
                return $dataProvider->product->surname; // $data['name'] for array data, e.g. using SqlDataProvider.
            },
            ],    
            [
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{link}',
            'header'=>$tooltiphousenumbermobile,
            'visible'=> !Yii::$app->user->can('Update Daily Job Sheet') ? false : true,
            'buttons' => ['link' => function ($url, $dataProvider,$key) {
                           if (strlen($dataProvider->product->contactmobile)===11){
                           return $dataProvider->product->productnumber." ".Html::a($dataProvider->product->contactmobile,$url);}
                           else return $dataProvider->product->productnumber;
                }
                ],
            'urlCreator' => function ($action, $dataProvider, $key, $index) {
                         if (($action === 'link') ) {
                             $url = "tel:/".$dataProvider->product->contactmobile;
                             return $url;
                         }
                }                
            ],
            [
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{link}',// can be omitted, as it is the default
            'header'=>'<',
            'visible'=> !Yii::$app->user->can('Update Daily Job Sheet') ? false : true,
            'buttons' => ['link' => function ($url, $dataProvider,$key) {
                           return Html::a("<",$url,['class' => 'btn btn-success']);
                }
                ],
            'urlCreator' => function ($action, $dataProvider, $key, $index) {
                         if (($action === 'link') ) {
                             $url = Url::toRoute(['salesorderheader/index']);
                             return $url;
                         }
                }                
            ],
            [
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{link}',// can be omitted, as it is the default
            'header'=> $tooltiptextpaid,
            'visible'=> !Yii::$app->user->can('Update Daily Job Sheet') ? false : true,
            'buttons' => ['link' => function ($url, $dataProvider,$key) {
                           return Html::tag('span',Html::a("SMS",$url),['class' => 'btn btn-warning'],['title'=>$dataProvider->productsubcategory->name." paid ".$dataProvider->paid,'data-toggle'=>'tooltip',
                                                                 'style'=>'text-decoration: underline; cursor:pointer;'
                                                                    ]);
                }
                ],
            'urlCreator' => function ($action, $dataProvider, $key, $index) {
                         if (($action === 'link') ) {
                             $url = "tel:/".preg_replace("/[^0-9]/", "",Company::findOne(1)->telephone);
                             return $url;
                         }
                }             
            ], 
            [
            'class' => 'kartik\grid\DataColumn', // can be omitted, as it is the default
            'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontsalesdetail'].'px'],     
            'header'=>Yii::t('app','Remind'),
            'value' => function ($dataProvider) {
                return $dataProvider->product->specialrequest; // $data['name'] for array data, e.g. using SqlDataProvider.
            },
            ],      
            [
                //refer to additional code in controller
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'unit_price',
                'filterInputOptions' => [
                  'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontsalesdetail'].'px'], 
                  'placeholder' => 'Unit Price...'
                ],
                'header'=>$tooltipunitprice,
                'hAlign' => 'right', 
                'vAlign' => 'middle',
                'width' => '7%',
                'format' => ['decimal', 2],
                'pageSummary' => true,
                'refreshGrid'=>true,
                'editableOptions' => [
                'asPopover' => false, 
                'header' => Yii::t('app','Tip - Reduce to 0 if customer cancels'), 
                'inputType' => kartik\editable\Editable::INPUT_SPIN,
                    'options' => [
                        'pluginOptions' => ['min' => 0.00, 'max' =>10000.00],                        
                    ]
                ],               
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'paid',
                'filterInputOptions' => ['class'=> 'input',
                  'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontsalesdetail'].'px'], 
                  'placeholder' => Yii::t('app','Paid ...')
                ],
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
            [
            'class' => 'kartik\grid\DataColumn', // can be omitted, as it is the default
                'header'=>$tooltipprepyt,
                'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontsalesdetail'].'px'], 
                'hAlign' => 'right', 
                'vAlign' => 'middle',
                'width' => '7%',  
                'value' => function ($dataProvider) {
                     return $dataProvider->pre_payment; // $data['name'] for array data, e.g. using SqlDataProvider.
                },
            ],    
            [
               'class' => 'kartik\grid\ExpandRowColumn',
               'header'=>$tooltiptotalowed,                
               'expandTitle'=> Yii::t('app','Debt that has accumulated from previous cleans not including the current clean.'),
               'expandIcon' => Icon::show('balance-scale', ['framework' => Icon::FAS]),
               'hAlign' => 'right', 
               'vAlign' => 'middle',
               'width' => '300px',
               'value' => function ($dataProvider, $key, $index, $column) {
                   return GridView::ROW_COLLAPSED;
               },
               'detail' => function ($dataProvider, $key, $index, $column) {
                   return Yii::$app->controller->renderPartial('_expandableviewdebtsheet', ['model' => $dataProvider]);
               },
               'disabled'=> function ($dataProvider, $key, $index, $column) {   
                                $q = new Query;
                                $rows = $q->select('unit_price')
                                ->from('works_salesorderdetail')
                                ->where(['and','product_id='.$dataProvider->product_id,'paid=0'])
                                ->andWhere('unit_price>0')
                                ->andWhere('sales_order_detail_id<'.$dataProvider->sales_order_detail_id)
                                ->all(); 
                                $subtotal = 0.00;
                                $i = 0;
                                foreach ($rows as $key => $value)
                                {
                                  $subtotal += $rows[$key]['unit_price']; 
                                  //$subtotal -= $rows[$key]['paid']; 
                                  $i = $i+1;
                                }
                                $subtotal = Yii::$app->formatter->asDecimal($subtotal, 2);; // $dat   
                                if ($subtotal > 0.00) { return false;} else { return true;}
                 },  
                'headerOptions' => ['class' => 'kartik-sheet-style'], 
                'expandOneOnly' => true,
            ], 
            [
               'class'=>'kartik\grid\DataColumn',
               'header'=>$tooltiptotalowed,
               'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontsalesdetail'].'px'], 
               'hAlign' => 'right', 
               'format'=>'raw',
               'vAlign' => 'middle',
               'width' => '7%',  
               'value' => function ($dataProvider) {
                            $q = new Query;
                            $rows = $q->select('unit_price')
                            ->from('works_salesorderdetail')
                            ->where(['and','product_id='.$dataProvider->product_id,'paid=0'])
                            ->andWhere('unit_price>0')
                            ->andWhere('sales_order_detail_id<'.$dataProvider->sales_order_detail_id)
                            ->all(); 
                            $subtotal = 0.00;
                            $i = 0;
                             foreach ($rows as $key => $value)
                             {
                               $subtotal += $rows[$key]['unit_price']; 
                               //$subtotal -= $rows[$key]['paid']; 
                               $i = $i+1;
                             }
                     $subtotal = Yii::$app->formatter->asDecimal($subtotal, 2);; // $data['name'] for array data, e.g. using SqlDataProvider.
                        if ($subtotal > 0.00) return $subtotal ." ". Icon::show('thumbs-down', ['framework' => Icon::FAS]);
                            else  
                                return " ";
                     
                        },
            ],  
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'advance_payment',
                'header'=>$tooltipadvpyt,
                'hAlign' => 'right', 
                'vAlign' => 'middle',
                'width' => '7%',
                'format' => ['decimal', 2],
                'pageSummary' => true,
                'refreshGrid'=>true,
                'editableOptions' => [
                'header' => 'AdvPyt',
                'asPopover' => false,
                'inputType' => kartik\editable\Editable::INPUT_SPIN,
                    'options' => [
                        'pluginOptions' => ['min' => 0.00, 'max' =>10000.00],                        
                    ]
                ],               
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'tip',
                'header'=>$tooltiptips,
                'hAlign' => 'right', 
                'vAlign' => 'middle',
                'width' => '7%',
                'format' => ['decimal', 2],
                'pageSummary' => true,
                'refreshGrid'=> true,
                'editableOptions' => [
                'asPopover' => false,  
                'header' => Yii::t('app','Tips'),  
                'inputType' => kartik\editable\Editable::INPUT_SPIN,
                'options' => ['pluginOptions' => ['min' => 0.00, 'max' =>10000.00],]
                ],               
            ], 
];
if ((empty(Yii::$app->session['sliderfontsalesdetail'])) && (!isset(Yii::$app->session['sliderfontsalesdetail']))){Yii::$app->session['sliderfontsalesdetail'] = 18;}                      
                        
echo kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontsalesdetail'].'px'], 
    'columns' => $gridColumns,
    'containerOptions' => ['style'=>'overflow: auto'], 
    'pjax' => true,
    'pjaxSettings' =>['neverTimeout'=>false,
                      'options'=>['id'=>'kv-unique-id-1'],                      
                     ], 
    'responsiveWrap'=>true,
    'bordered' => true,
    'bootstrap'=>true,
    'striped' => true,
    'condensed' => false,
    'toolbar' => [
          ['content'=>Html::a('<i class="fas fa-redo"></i>',['salesorderdetail/index', 'id' => Yii::$app->session['sales_order_id']],['data-pjax'=>0,'class'=> 'btn btn-danger','title'=>Yii::t('app','Refresh Grid if data entered not displaying.')])
         ],
    ],
    'responsive' => true,
    'export'=>false,
    'hover' => true,
    'floatHeader' => false,
    'showPageSummary' => true,
    'panel' => [
    'type' => GridView::TYPE_PRIMARY,
    'heading'=> Company::findOne(1)->name . " - " . Company::findOne(1)->telephone . " - " . DateTime::createFromFormat("Y-m-d", Salesorderheader::findOne($id=Yii::$app->session['sales_order_id'])->clean_date)->format("l, d F Y"),
    ],
    'exportConfig' => [
                   GridView::CSV => ['label' => Yii::t('app','Export as CSV'),'config' => $config_array, 'filename' => 'Clean_date-'.$clean_date.'_Printed_'.date('d-M-Y')],
                   GridView::HTML => ['label' => Yii::t('app','Export as HTML'),'config' => $config_array, 'filename' => 'Clean_date-'.$clean_date.'_Printed_'.date('d-M-Y')],
                   GridView::PDF => [ 'label' => Yii::t('app','Export as PDF'),'config' => $config_array, 'filename' => 'Clean_date-'.$clean_date.'_Printed_'.date('d-M-Y')], 
                   GridView::EXCEL=> ['label' => Yii::t('app','Export as EXCEL'), 'filename' => 'Clean_date-'.$clean_date.'_Printed_'.date('d-M-Y')],
                   GridView::TEXT=> ['label' => Yii::t('app','Export as TEXT'), 'filename' => 'Clean_date-'.$clean_date.'_Printed_'.date('d-M-Y')],
    ],
]);
?>
</div>