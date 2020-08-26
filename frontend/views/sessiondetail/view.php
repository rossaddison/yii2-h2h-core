<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use Yii;
$this->title = $model->session_detail_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Session'), 'url' => ['session/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Session Details'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sessiondetail-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app','Update'), ['update', 'id' => $model->session_detail_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app','Delete'), ['delete', 'id' => $model->session_detail_id], [
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
            'session_detail_id',
            'session_id',
            'redirect_flow_id',
            'db',
            'product_id',
            'user_id'
        ],
    ]) ?>
</div>
