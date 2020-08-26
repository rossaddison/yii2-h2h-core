<?php
use yii\helpers\Html;
use yii\grid\GridView;
use Yii;
$this->title = Yii::t('app','Session Details');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sessiondetail-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\ActionColumn',
              'template'=> '{view}',
            ],
            ['class' => 'yii\grid\SerialColumn'],
            'session_id',
            'session_detail_id',
            'redirect_flow_id',
            'db',
            'product_id',
            'user_id',
    ],
    ]); ?>
</div>
