<?php
use yii\helpers\Html;
use kartik\grid\GridView;
$this->title = Yii::t('app','Instructions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="instruction-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app','Create Instruction'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['style' => 'font-size:18px;'],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            'code',
            'code_meaning',
            [
              'class' => 'kartik\grid\DataColumn',
              'attribute'=> 'include',
              'format'=>'boolean',
            ],
            'modified_date',
            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>
</div>
