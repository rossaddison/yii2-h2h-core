<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use Yii;
$this->title = Yii::t('app','Message');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="messaging-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app','Create Message'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            [
              'header'=>Yii::t('app','Message'),
              'value'=>function($model, $key, $index,$widget)
              {
                 return strip_tags($model->message);
              }
            ],
            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>
</div>
