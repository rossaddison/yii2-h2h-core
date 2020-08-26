<?php
use sjaakp\dateline\Dateline;
$this->title = Yii::t('app','Events');
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Create Event'), 'url' => ['create']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Grid'), 'url' => ['grid']];
?>
<div class ="container">
<br>
 <?php  $dl = Dateline::begin([
    'dataProvider' => $dataProvider,
    'attributes' => [
            //id is used to create a url to go to on clicking on the event. Refer to options url
            'id'=> function($model){return "$model->controller_name/$model->controller_action/$model->controller_action_id";},
            'start' => function($model){return $model->start;},
            'stop' => function($model){return $model->stop;},
            'post_start' => function($model){return $model->post_start;},
            'pre_stop' => function($model){return $model->pre_stop;},
            'class'=>function($model){return $model->class;},
            'text'=>function($model){return $model->text;},        
    ],
    'htmlOptions'=> ['id'=>'w84','style'=>'<font-size: 12px; height: 320px;', 'class'=>'d-dateline col-red col2-red', 'tabindex'=>0],                
    'options' => [
        //one year before today's date
        'begin' => date('Y-m-d', strtotime(date('Y-m-d'). ' - 1000 days')),
        //end one year from today's date
        'end' => date('Y-m-d', strtotime(date('Y-m-d'). ' + 1000 days')),
        //center timeline on today's date
        'cursor' => date('Y-m-d'),
        'size' => '500px',
        //redirects to historyline controller. Insert your redirects there
        'url'=>'/',
        'redirect'=>false,
    ],
    ]);
        $dl->band([
        'size' => '80%',
        //'layout'=>'overview',
        'scale' => Dateline::MONTH,
        'interval'=>  1000,
    ])->band([
        'size' => '10%',
        'layout' => 'overview',
        'scale' => Dateline::YEAR,
        'interval'=> 100
    ])->end();
    //remove decade band
            
?>
<br>
</div>
    
   