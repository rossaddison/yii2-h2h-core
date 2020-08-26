<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use Yii;
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Paypal Agreements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="paypalagreement-view">
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
            'id',
            'user_id',
            'name',
            'agreement_id',
            'agreementplan_id',
            'quantity',
            'end_at',
            'created_at',
            'executed_at',
            'updated_at',
            'terminated_at',
            'reactivated_at',
        ],
    ]) ?>
</div>
