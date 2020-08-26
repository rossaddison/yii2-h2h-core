<?php
use yii\helpers\Html;
use kartik\detail\DetailView;
use Yii;
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Street'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Create House'), 'url' => ['product/create']];
?>
<div class="productsubcategory-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app','Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app','Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app','Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['attribute'=>'productcategory_id','header'=>'Postcode','value'=>$model->productcategory->name],
            'name',
            'lat_start',
            'lng_start',
            'lat_finish',
            'lng_finish',
            'directions_to_next_productsubcategory',
            'sort_order',
             [
                'attribute'=>'isactive',
                'format'=>'raw',
                'value'=>$model->isactive ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-danger">No</span>',
                'type'=>DetailView::INPUT_SWITCH,
                'widgetOptions' => [
                    'pluginOptions' => [
                        'onText' => Yii::t('app','Yes'),
                        'offText' => Yii::t('app','No'),
                    ]
                ],
                'valueColOptions'=>['style'=>'width:30%']
            ],
            'modifieddate'            
        ],
    ]) ?>
</div>
