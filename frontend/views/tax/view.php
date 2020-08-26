<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use Yii;
$this->title = $model->tax_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Taxes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tax-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app','Update'), ['update', 'id' => $model->tax_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app','Delete'), ['delete', 'id' => $model->tax_id], [
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
            'tax_id',
            'tax_type',
            'tax_name',
            'tax_percentage',
        ],
    ]) ?>
</div>
