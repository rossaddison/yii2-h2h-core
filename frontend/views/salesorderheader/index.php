<?php
use yii\helpers\Url;
use yii\helpers\Html;
use \kartik\grid\GridView;
use frontend\models\Salesorderheader;
use yii\helpers\ArrayHelper;
use kartik\icons\FontAwesomeAsset;
use Yii;
FontAwesomeAsset::register($this);
$this->title = Yii::t('app','Daily Cleans');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['salesorderheader/index'], ];
$viewMsg = Yii::t('app','View');
$deleteMsg = Yii::t('app','Delete');
$updateMsg = Yii::t('app','Update');
$yearOnly = date('Y', strtotime(Date('Y-m-d')));
?>
<div class="salesorderheader-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p> 
    <?php if (Yii::$app->user->can('Manage Admin')){ ?> 
        <?php 
            //Modal link frontend/layouts/main.php and frontend/assets/AppAsset.php
            //Html::button(Yii::t('app','Create Daily Clean'), ['value' => Url::to(['salesorderheader/create']), 'title' => Yii::t('app','Creating Daily Clean'), 'class' => 'showModalButton btn btn-success btn-lg']); 
        ?>
        <?php 
            echo Html::a(Yii::t('app','Create Daily Clean'), ['create'], ['class' => 'btn btn-success btn-lg','data-toggle'=>'tooltip','title'=>Yii::t('app','Click here to create a shell consisting of the clean date and a job code which is the name of your run. Copy houses from House to this clean date. To replicate this clean date in the future use the Ticked copy button. More than one job code or clean date can be ticked and copied into a new clean date if you are planning to do more than one run on the same day. ')]) 
        ?>
        <?= Html::a(Yii::t('app','Copy Houses to Daily Clean'), ['product/index'], ['class' => 'btn btn-success btn-lg','data-toggle'=>'tooltip','title'=>Yii::t('app','This will take you to House. Once you have entered your details for the householder you can copy the house across to your clean date.')]) ?>
        <div class="dropdown">
            <button id="w25" class = "btn btn-danger dropdown-toggle btn-lg" type="button" data-toggle="dropdown" ><?php echo Yii::t('app','(Ticked) Copy') ?><span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li class = "btn btn-danger btn-lg" onclick="js:getCopyitbybimonthly()" data-toggle="tooltip" title="<?php echo Yii::t('app','If you tick one of the previous cleans, the detail will be copied to a date roughly two months ahead of its date. Adjust the date once copied to get a more realistic date.')?>"><?php echo Yii::t('app',' + 2 month') ?></li>    
                    <li class = "btn btn-danger btn-lg" onclick="js:getCopyitbyfrequency()" data-toggle="tooltip" title="<?php echo Yii::t('app','If you tick one of the previous cleans, the detail will be copied to a date roughly one month ahead of its date. Adjust the date once copied to get a more realistic date.')?>"><?php echo Yii::t('app','  + 1 month') ?></li>    
                    <li class = "btn btn-danger btn-lg" onclick="js:getCopyitbyfortnight()" data-toggle="tooltip" title="<?php echo Yii::t('app','If you tick one of the previous cleans, the detail will be copied to a date roughly two weeks ahead of its date. Adjust the date once copied to get a more realistic date.')?>"><?php echo Yii::t('app',' + fortnight / + 2 weeks') ?></li> 
                    <li class = "btn btn-danger btn-lg" onclick="js:getCopyitbyweek()" data-toggle="tooltip" title="<?php echo Yii::t('app','If you tick one of the previous cleans, the detail will be copied to a date roughly one week ahead of its date. Adjust the date once copied to get a more realistic date.')?>"><?php echo Yii::t('app',' + 1 week') ?></li> 
                    <li class = "btn btn-danger btn-lg" onclick="js:getCopyitbytodaysdate()" data-toggle="tooltip" title="<?php echo Yii::t('app','If you tick one of the previous cleans, the detail will be copied to a date identical to todays date.') ?>"><?php echo Yii::t('app','Using todays date')?></li>
                </ul>
        </div>
        <Hr style = "border-top: 3px double #8c8b8b">
        <div>
        <?= Html::label(Yii::t('app','Revenue'));?> 
        <?= Html::a(($yearOnly-3), ['salesorderheader/totalannualrevenue/'.($yearOnly-3)], ['class' => 'btn btn-success btn-lg']) ?>
        <?= Html::a(($yearOnly-2), ['salesorderheader/totalannualrevenue/'.($yearOnly-2)], ['class' => 'btn btn-success btn-lg']) ?>
        <?= Html::a(($yearOnly-1), ['salesorderheader/totalannualrevenue/'.($yearOnly-1)], ['class' => 'btn btn-success btn-lg']) ?>
        <?= Html::a($yearOnly, ['salesorderheader/totalannualrevenue/'.$yearOnly], ['class' => 'btn btn-success btn-lg']) ?>
        <?= Html::a(($yearOnly+1), ['salesorderheader/totalannualrevenue/'.($yearOnly+1)], ['class' => 'btn btn-success btn-lg']) ?>
        <Hr style = "border-top: 3px double #8c8b8b">      
        </div>
    <?php } ?>    
    
<?php 
use kartik\slider\Slider;
echo Html::label('Font Size Adjuster:<br>');
echo Slider::widget([
    'name' => 'sliderfont',
    'value'=>Yii::$app->session['sliderfont'],
    'options' => [
                   'id'=>'w88',
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
<button id="w54" class = "btn btn-info btn-lg" onclick="js:getSlider()" title="<?php echo Yii::t('app','Adjust to the required font.')?>" data-toggle="tooltip"><?php echo Yii::t('app','Adjust font') ?></button><br><br>
<?php
   $gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    ['class' => 'kartik\grid\CheckboxColumn',
            'name'=>'selection',
            'multiple'=>true,
            'checkboxOptions'=>function ($model, $key, $index){
            return ['id'=>$model->sales_order_id,'value' => $model->sales_order_id];
            }
    ], 
    ['class' => 'kartik\grid\DataColumn',
     'attribute'=> 'sales_order_id',
     'filterInputOptions' => [
                  'class'       => 'form-control',
                  'placeholder' => Yii::t('app','Id ...'),
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
    'disabled'=> function ($data, $key, $index, $column) {
                    $rows  = $data->salesorderdetails;
                    if (!empty($rows)) { return false;} else { return true;}
    },    
    'headerOptions' => ['class' => 'kartik-sheet-style'], 
    'expandOneOnly' => true,
    ],
    [
                    'class' => 'kartik\grid\ActionColumn',
                    'template' => '{link}',
                    'header'=>Yii::t('app','Cleans'),
                    'visible'=> Yii::$app->user->can('Manage Admin'),
                    'buttons' => [
                            'link' => function ($url, $model,$key) {
                                            return Html::a(Yii::t('app','Cleans'), $url);
                                },
                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'link') {
                                $url =Url::toRoute(['/salesorderdetail/index', 'id' => $model->sales_order_id]);
                                Yii::$app->session['sales_order_id'] = $model->sales_order_id;
                                Url::remember();
                                return $url;
                            }
                    }
    ],
    [
            'class'=>'kartik\grid\DataColumn',
            'attribute' => 'status',
            'value' => 'status',
            'options' => [ 'class'=> 'form-control'],
            'filter'=> Html::activeDropDownList($searchModel,'status',ArrayHelper::map(Salesorderheader::find()->orderBy('status')->asArray()->all(),'status','status'),[ 'class'=> 'form-control','prompt'=>Yii::t('app','Job Code ...')]),
    ],
    [
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{link}',// can be omitted, as it is the default
            'header'=>Yii::t('app','Employee'),
            'visible'=> !Yii::$app->user->can('Manage Admin') ? false : true,
            'buttons' => ['link' => function ($url, $data,$key) {
                           if (strlen($data->employee->contact_telno)===11){
                           return $data->employee->title." ".Html::a($data->employee->contact_telno,$url);}
                           else return $data->employee->contact_telno;
                }
             ],
            'urlCreator' => function ($action, $data, $key, $index) {
                         if (($action === 'link') ) {
                             $url = "tel:/".$data->employee->contact_telno;
                             return $url;
                         }
             }                
    ],
    [
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{link}',// can be omitted, as it is the default
            'header'=>Yii::t('app','File/image'),
            'visible'=> !Yii::$app->user->can('Manage Admin') ? false : true,
            'buttons' => ['link' => function ($url, $data,$key) {
                           if (!empty($data->carousal_id)){
                           return Html::a('File/Image',$url);}
                           else return "None";
                }
             ],
            'urlCreator' => function ($action, $data, $key, $index) {
                         if (($action === 'link') ) {
                             $url = "/carousal/".$data->carousal_id;
                             return $url;
                         }
             }                
    ],           
    [
    'class' => 'kartik\grid\EditableColumn',
    'header' => Yii::t('app','Clean Date'),
    'attribute' =>  'clean_date',
    'filter'=> Html::activeDropDownList($searchModel,'clean_date',ArrayHelper::map(Salesorderheader::find()->orderBy(['clean_date'=>SORT_DESC])->asArray()->all(),'clean_date','clean_date'),
    [
        'class'=> 'form-control',
        'prompt'=>Yii::t('app','From Date ...'),
    ]),
    'hAlign' => 'center',
    'vAlign' => 'middle',
    'width' => '9%',
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
             'header'=>Yii::t('app','Total Due'),
             'hAlign'=>'right',
             'visible' => Yii::$app->user->can('See Prices'),
             'format'=>['decimal', 2],  
             'value'=> function($data){
                $subtotal = 0.00;
                $subtotal = number_format($subtotal,2);
                $array = $data->salesorderdetails;
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
             'visible' => Yii::$app->user->can('See Prices'),
             'format'=>['decimal', 2], 
             'value'=> function($data){
                $subtotal = 0.00;
                $subtotal =  number_format($subtotal,2);
                $array = $data->salesorderdetails;
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
    'visible' => Yii::$app->user->can('Create Daily Clean'),
    'dropdownOptions' => ['class' => 'pull-right'],
    'template'=> '{view} {update}',
    'viewOptions' => ['title' => $viewMsg, 'data-toggle' => 'tooltip'],
    'updateOptions' => ['title' => $updateMsg, 'data-toggle' => 'tooltip'],
    'headerOptions' => ['class' => 'kartik-sheet-style'],
    ], 
   ];
   if ((empty(Yii::$app->session['sliderfont'])) && (!isset(Yii::$app->session['sliderfont']))){Yii::$app->session['sliderfont'] = 18;}
   echo kartik\grid\GridView::widget([
      'dataProvider' => $dataProvider,
      'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfont'].'px'],
      'rowOptions'=>function($model){
            if($model->clean_date == date('Y-m-d')){
               return ['style'=>'background-color: #ffffff;'];
            }
            if($model->clean_date == date('Y-m-d',strtotime("-1 day"))){
               return ['style'=>'background-color: #ffcccc;'];
            }
            if($model->clean_date == date('Y-m-d',strtotime("-2 day"))){
               return ['style'=>'background-color:  #ffb3b3;'];
            }
            if($model->clean_date == date('Y-m-d',strtotime("-3 day"))){
               return ['style'=>'background-color:   #ff9999;'];
            }
            if($model->clean_date == date('Y-m-d',strtotime("-4 day"))){
               return ['style'=>'background-color:   #ff8080;'];
            }
            if($model->clean_date == date('Y-m-d',strtotime("+1 day"))){
               return ['style'=>'background-color:    #e6ffe6;'];
            }
            if($model->clean_date == date('Y-m-d',strtotime("+2 day"))){
               return ['style'=>'background-color:  #ccffcc;'];
            }
            if($model->clean_date == date('Y-m-d',strtotime("+3 day"))){
               return ['style'=>'background-color:   #b3ffb3;'];
            }
            if($model->clean_date == date('Y-m-d',strtotime("+4 day"))){
               return ['style'=>'background-color:   #99ff99;'];
            }
       },
      'filterModel' => $searchModel,
      'columns' => $gridColumns,
      'bootstrap'=>'true',
      'containerOptions' => ['style'=>'overflow: auto'], 
      'pjax' => true,
      'pjaxSettings' =>['neverTimeout'=>true,
                         'options'=>['id'=>'kv-unique-id-0','linkSelector' => '#w25 button'],                      
      ], 
      'responsiveWrap'=>true,
      'bordered' => true,
      'striped' => true,
      'condensed' => false,
      'toolbar' => [
          ['content'=>Html::a('<i class="fas fa-redo"></i>',['salesorderheader/index',
          ],
          ['data-pjax'=>0,'class'=> 'btn btn-danger btn-lg',
          'title'=>Yii::t('app','Refresh Grid if data entered not displaying.')])
         ],
       ],
      'responsive' => true,
      'hover' => true,
      'floatHeader' => false,
      'showPageSummary' => true,
      'export'=>false,
      'panel' => [
        'type' => GridView::TYPE_PRIMARY
      ],
]); 
?>
</div>
