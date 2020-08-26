<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use Yii;
$this->title = Yii::t('app','Quick Notes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Quick Notes'), 'url' => ['quicknote/index']];
$this->params['breadcrumbs'][] = $this->title;
$viewMsg = Yii::t('app','View');
$updateMsg = Yii::t('app','Update');
?>
<div class="quicknote-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app','Create Quicknote'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['style' => 'font-size:18px;'],
        'columns' => [
            'id',
            ['class' => 'kartik\grid\ActionColumn',
            'dropdown' => false,
            'header'=>Yii::t('app','View'),
            'vAlign'=>'middle',
            'viewOptions'=>['title'=>$viewMsg, 'data-toggle'=>'tooltip'],
            'template'=> '{view}',
           ],
           ['class' => 'kartik\grid\ActionColumn',
            'dropdown' => false,
            'header'=>Yii::t('app','Update'),
            'vAlign'=>'middle',
            'updateOptions'=>['title'=>$updateMsg, 'data-toggle'=>'tooltip'],
            'template'=> '{update}',
           ],
           [ 
                'class' => '\kartik\grid\EditableColumn',
                'attribute' =>'note',
                'hAlign' => 'left', 
                'vAlign' => 'middle',
                'width' => '95%',
                'refreshGrid'=>true,
                'format'=> 'raw',
                'headerOptions' => ['class' => 'kv-sticky-column'],
                'contentOptions' => [
                              'class' => 'kv-sticky-column',
                              'style'=>'max-width: 200px; overflow: auto; word-wrap: break-word;'
                ],
                'readonly' => true,
            ], 
            'modified_at',
        ],
    ]); ?>
</div>
