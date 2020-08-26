<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\grid\GridView;
$this->title = Yii::t('app','Legals');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="legal-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app','Create Legal'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\SerialColumn'],
            'privacy_policy',
            'terms_conditions',
            'last_updated',
        ],
    ]); ?>    
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
        },
    ]) ?>
</div>
