<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = Yii::t('app','Slider/Carousal Images');
$this->params['breadcrumbs'][] = $this->title;
$viewMsg = Yii::t('app','View');
$deleteMsg = Yii::t('app','Delete');
$updateMsg = Yii::t('app','Update');
?>
<div class="carousal-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app','Create Carousal'), ['create'], ['class' => 'btn btn-success btn-lg']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                    'class' => 'kartik\grid\ActionColumn',
                    'dropdown' => true,
                    'visible' => Yii::$app->user->can('Manage Admin'),
                    'dropdownOptions' => ['class' => 'pull-right'],
                    'template'=> '{view} {update} {delete}',
                    'viewOptions' => ['title' => $viewMsg, 'data-toggle' => 'tooltip'],
                    'updateOptions' => ['title' => $updateMsg, 'data-toggle' => 'tooltip'],
                    'headerOptions' => ['class' => 'kartik-sheet-style'],
            ], 
            [
                'class' => 'yii\grid\SerialColumn'
            ],
            'id',
            [
                     'attribute' => 'Image',
                     'format' => 'raw',
                     'value' => function ($model) {
                          if (Yii::$app->user->identity->attributes['name'] === 'demo') {
                              if ($model->image_web_filename!='') {
                                    return '<img src="'.Url::to('@web/images/demo/'.Yii::$app->session['demo_image_timestamp_directory'].'/'.$model->image_web_filename.'" width=50px">', true); } else 
                               {
                                   return Yii::t('app','no image');
                               }           
                          } else
                          {
                              if ($model->image_web_filename!='') {
                                    return '<img src="'.Url::to('@web/images/'.$model->image_web_filename.'" width=50px">', true); 
                              } else 
                              { 
                                 return Yii::t('app','no image');
                              }         
                          }
              }
             ],
            'image_source_filename',
            'image_web_filename',
            'content_alt',
            'content_title',
            'content_caption',
            'fontcolor',
        ],
    ]); ?>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
</div>
