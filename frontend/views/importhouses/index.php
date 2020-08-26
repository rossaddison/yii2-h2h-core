<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use frontend\models\Productcategory;
$this->title = Yii::t('app','Import Houses / Street /Postcode').'(Filetype: xls,xlsx,ods)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="importfile-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <div class="btn-group">
        <?= Html::label(Yii::t('app','Step 1: Download template '),['download'],['class' => 'btn btn-danger']); ?>     
        <?= Html::a(Yii::t('app','Compressed file'). 'downloadfile.rar', ['@web/downloadfile/downloadfile.rar'], ['class' => 'btn btn-success','data-toggle'=>'tooltip','title'=>Yii::t('app','Download a Microsoft Spreadsheet xls, Microsoft xlsx file and an Openoffice ods file contained within  a zip file that will be used to import houses within a street. Column 1: Firstname, Column 2: Surname, Column 3: Contactmobile, Column 4: Specialrequest, Column 5: Listprice, Column 6: Frequency, Column 7: Housenumber eg. 001, Column 8: Postcode first half, Column 9: Post code second half, Column 10: Email')]) ?>
        <?= Html::a(Yii::t('app','Get a copy of ').'Winrar', ['https://www.win-rar.com/'], ['class' => 'btn btn-info','data-toggle'=>'tooltip','title'=>Yii::t('app','Download a copy of winrar in order to unzip the rar file to your left.')]) ?>
        </div>
        <br>
        <br>
        <div class="btn-group">
        <?= Html::label(Yii::t('app','Step 2 '),[''],['class' => 'btn btn-danger']); ?>
        <?= Html::a(Yii::t('app','Upload Import File. This will appear in the table below once uploaded.'), ['create'], ['class' => 'btn btn-success','data-toggle'=>'tooltip','title'=>Yii::t('app','Upload the downloaded file that you modified. This file is to be used to import houses within a street. xls, xlsx, and openoffice ods files may be used. Column 1: Firstname, Column 2: Surname, Column 3: Contactmobile, Column 4: Specialrequest, Column 5: Listprice, Column 6: Frequency, Column 7: Housenumber eg. 001, Column 8: Postcodefirsthalf, Column 9: Postcodesecondhalf, Column 10: Email')]) ?>
        </div>
        <br>
        <br>
        <div class="btn-group">
        <?= Html::a(Yii::t('app','Step 3: Select Postcode '),['productcategory/create'],['class' => 'btn btn-danger','data-toggle'=>'tooltip','title'=>Yii::t('app','Create a Postcode')]); ?>
        <?= Html::dropDownList('productcategory_id','', ArrayHelper::map(Productcategory::find()->orderBy('name')->all(),'id','name'),['prompt' => Yii::t('app','--- Postcode ---'),'id'=>'cat_id','class'=> 'btn btn-info']) ?>
        </div>
        <br>
        <br>
        <div class="btn-group">
        <?= Html::a(Yii::t('app','Step 4: Select Street '),['productsubcategory/create'],['class' => 'btn btn-danger','data-toggle'=>'tooltip','title'=>'Create a Street']); ?>
        <?php echo DepDrop::widget([
                    'name' => 'productsubcategory _id',
                    'options'=>['id'=>'subcat_id','class'=> 'btn btn-info'],
                    'pluginOptions'=>[
                        'depends'=>['cat_id'],   
                        'loading'=>true,  
                        'placeholder'=>Yii::t('app','...Street...'),
                        'url'=>Url::to(['/site/subcat'])        
                    ]
        ]); ?>    
        </div>
        <br>
        <br>
        <div class="btn-group">
            <?= Html::label(Yii::t('app','Step 5: '),[''],['class' => 'btn btn-danger']); ?>
            <button id="w71" class = "btn btn-success" data-toggle="tooltip" title = <?php Yii::t('app','Select one of your files below. The list of houses will be copied into the street that you have selected. A successful import will redirect you to your houses list and display the new houses under the street that you selected.  ') ?>. onclick="js:getProcessticked()"><?php Yii::t('app','Import selected File below. (ticked)') ?></button>        
        </div>    
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => 'kartik\grid\CheckboxColumn',
                'name'=>'selection',
                'multiple'=>true,
                'checkboxOptions'=>function ($model, $key, $index){
                        return ['id'=>$model->id,'value' => $model->id];
                }
            ],     
            ['class' => 'kartik\grid\ActionColumn'],
            ['class' => 'kartik\grid\SerialColumn'],
            'id',
            [
                     'attribute' => 'importfile',
                     'format' => 'raw',
                     'value' => function ($model) {   
                          Yii::$app->params['uploadPath'] = Yii::$app->basePath .'\importfile';
                          $path = Yii::$app->params['uploadPath'] .'/'. $model->importfile_web_filename;
                          if ($model->importfile_web_filename!='')
                          return '<br /><p><img src="'.Url::to('@web/importfile/'.$model->importfile_web_filename.'" width=50px" height = "auto"></p>', true); else return Yii::t ('app', 'no filename');
                     },
             ],
            'importfile_source_filename',
            'importfile_web_filename',
        ],
    ]); ?>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
</div>
