<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Cost Subcategory'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="costsubcategory-view">
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
            ['attribute'=>'costcategory_id','header'=>Yii::t('app','Cost code'),'value'=>$model->costcategory->name],
            'name',
            'modifieddate',
        ],
    ]) ?>

</div>
