<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use Yii;
$this->title = Yii::t('app','Taxes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tax-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app','Create Tax'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->tax_id."} T".$model->tax_type." ".$model->tax_name." ".$model->tax_percentage), ['view', 'id' => $model->tax_id]);
        },
    ]) ?>
</div>
