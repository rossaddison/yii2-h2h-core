<?php
use yii\helpers\Html;
use \kartik\form\ActiveForm;
use \kartik\grid\GridView;
use frontend\modules\google3translateclient\assets\Google3translateclientAsset;
use frontend\models\Company;
use kartik\icons\FontAwesomeAsset;
use Yii;
FontAwesomeAsset::register($this);
Google3translateclientAsset::register($this);
$this->title = 'Google Version 3 Translate Client';
$this->params['breadcrumbs'][] = $this->title;
$clean_date = DateTime::createFromFormat("Y-m-d", time());
?>
<?php
$form = ActiveForm::begin([
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'formConfig' => ['labelSpan' => 2, 'deviceSize' => ActiveForm::SIZE_LARGE]
]);   
?>
<?= \frontend\modules\backup\widgets\Alert::widget() ?>
<?php if ($curlcertificate === false): ?>
    <div class="alert alert-danger">
        <strong><?= Yii::t('app', 'Your SSL certificate for this version of PHP {0} does not exist under the php directory at ...bin/php/', [PHP_VERSION]) ?></strong>
        <strong><?= Html::a('Download here and insert into bin/php/'.[PHP_VERSION],['url'=>'http://curl.haxx.se/ca/cacert.pem']); ?></strong>
    </div>
<?php endif; ?>
<?php if ($curlcertificate === true): ?>
    <div class="alert alert-success">
        <strong><?= Yii::t('app', 'Your SSL certificate for this version of PHP {0} exists under the php directory  ...bin/php/{0}', [PHP_VERSION]) ?></strong>
   </div>
<?php endif; ?>   
<?php if ($minPhpVersion === false): ?>
    <div class="alert alert-danger">
        <strong><?= Yii::t('app', 'Your PHP version {0} is lower than the required 7.1', [PHP_VERSION]) ?></strong>
    </div>
<?php endif; ?>
<?php if ($minPhpVersion === true): ?>
    <div class="alert alert-success">
        <strong><?= Yii::t('app', 'Your PHP version {0} is higher than the minimum of 7.1', [PHP_VERSION]) ?></strong>
    </div>
<?php endif; ?>
<?php if (!empty($google_credential_file) && file_exists($google_credential_file)): ?>
    <div class="alert alert-success">
        <strong><?= Yii::t('app', 'Your google translate JSON file is set under Other...Company and exists at '. $google_credential_file); ?></strong>
        <br>
        <strong><?= Yii::t('app', 'GOOGLE APPLICATION CREDENTIALS ' . getenv('GOOGLE_APPLICATION_CREDENTIALS')) ?></strong>
    </div>
<?php endif; ?>
<?php if (empty($google_credential_file)): ?>
    <div class="alert alert-danger">
        <strong><?= Yii::t('app', 'Your Google Credential setting under Other...Company has not been set.') ?><?= Html::a('Further reading: ',['url'=>'https://cloud.google.com/docs/authentication/production#windows']) ?></strong>
    </div>
<?php endif; ?>

<?php if (!file_exists($google_credential_file) && !empty($google_credential_file)): ?>
    <div class="alert alert-danger">
        <strong><?= Yii::t('app', 'Your Google Credential Filename and path has been set under Other...Company  but the file itself does not exist. Include quotes and forward slashes.') ?></strong>
    </div>
<?php endif; ?> 
<?php
   $pdfHeader = [
  'L' => [
   'content' => Company::findOne(1)->name . " - " . Company::findOne(1)->telephone . " - " . DateTime::createFromFormat("Y-m-d", time()),
  ],
  'C' => [
    'content' => Yii::t('app','Translated'),
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
    'content' => 'Filename: Translated_date-'.$clean_date.'_Printed_'.date('d-M-Y'),
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
        'title' => Company::findOne(1)->name . " - " . Company::findOne(1)->telephone . " - " . DateTime::createFromFormat("Y-m-d", time()),
        'subject' => Yii::t('app','Daily Cleans'),
        'keywords' => Yii::t('app','daily, clean, daily clean')
      ],
    ];
?>
<div class="translated-index">
<button id="w131" class = "btn btn-info btn-lg" onclick="js:getGoogle3translateclientticks()" datatoggle="tooltip" title="<?php echo Yii::t('app','Do not select more than 50 messages to translate.') ?>"><?php echo Yii::t('app','Translate through Google (ticked)') ?></button>
<br>
<br>
<?php 
    //echo $this->render('_search', ['model' => $searchModel]); 
?>
<?php
   Yii::$app->formatter->nullDisplay = ''; 
   $gridColumns = [
    [
      'class' => 'kartik\grid\CheckboxColumn',
            'name'=>'selection',
            'multiple'=>true,
            'checkboxOptions'=>function ($dataProvider, $key, $index){
            return ['id'=>$dataProvider->id,'value' => $dataProvider->id];
            }
    ], 
    'id',
    ['class' => 'kartik\grid\SerialColumn'],   
    [
     'class' => 'kartik\grid\ActionColumn',
     'dropdown' => false,
     'header'=>'View',
     'vAlign'=>'middle',
     'viewOptions'=>['title'=>'View the record', 'data-toggle'=>'tooltip'],
     'template'=> '{view}',
    ],
    'message_table_filter',
    [
       'class' => 'kartik\grid\DataColumn',
       'attribute'=> 'language',
       'width'=>'5%', 
    ],      
    [            
        'class' => 'kartik\grid\ExpandRowColumn',
        'hAlign' => 'right', 
        'vAlign' => 'middle',
        'width' => '10px',
        'value' => function ($dataProvider, $key, $index, $column) {
            return GridView::ROW_COLLAPSED;
        },
        'detail' => function ($dataProvider, $key, $index, $column) {
            return $dataProvider->extracted->message; 
        },
    ],
    [ 
                'class' => '\kartik\grid\EditableColumn',
                'attribute' =>'translation',
                'hAlign' => 'left', 
                'vAlign' => 'middle',
                'width' => '45%',
                'refreshGrid'=>true,
                'readonly' => false,
                    'editableOptions' => [
                        'asPopover' => false,
                        'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                        'valueIfNull' => '??????',
                        'options' => [
                            'pluginOptions' => ['autoclose' => true],                        
                ]
        ],               
    ],               
];           

echo kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    // 'options' => ['id'=>'w1'],
    //'options' => ['style'=> 'font-size:'.Yii::$app->session['sliderfontsalesdetail'].'px'], 
    'columns' => $gridColumns,
    'containerOptions' => ['style'=>'overflow: auto'], 
    'pjax' => true,
    'pjaxSettings' =>['neverTimeout'=>false,
                      'options'=>['id'=>'kv-unique-id-43'],                      
                     ], 
    'responsiveWrap'=>true,
    'bordered' => true,
    'bootstrap'=>true,
    'striped' => true,
    'condensed' => false,
    'responsive' => true,
    'export'=>false,
    'hover' => true,
    'floatHeader' => false,
    'showPageSummary' => true,
    'persistResize' => false,
    'panel' => [
    'type' => GridView::TYPE_PRIMARY,
   'heading'=> Company::findOne(1)->name . " - " . Company::findOne(1)->telephone . " - " . DateTime::createFromFormat("Y-m-d", time()),
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


