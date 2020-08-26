 <?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
$this->title = Yii::t('app','View Costs to Include: ID ') . $model->cost_detail_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Daily Costs '), 'url' => ['costheader/index']];
$this->params['breadcrumbs'][] = ['label' => $model->costHeader->cost_date];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Costs to Include '), 'url' => ['index','id'=>$model->cost_header_id]];
$this->params['breadcrumbs'][] = ['label' => $model->costcategory->name];
$this->params['breadcrumbs'][] = ['label' => $model->costsubcategory->name];
$this->params['breadcrumbs'][] = ['label' => $model->cost->costnumber];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="costdetail-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app','Update'), ['update', 'id' => $model->cost_detail_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app','Delete'), ['delete', 'id' => $model->cost_detail_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app','Are you sure you want to delete id? '). $model->cost_detail_id,
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app','Paid in Full'), ['pay','id' => $model->cost_detail_id], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app','Unpaid in Full'), ['unpay','id' => $model->cost_detail_id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a(Yii::t('app','Back'), Url::previous(), ['class' => 'btn btn-success']) ?>
        <?php // Html::a('Back', ['index', 'id' => $model->sales_order_id], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nextcost_date',
            ['attribute'=>'cost_id.description','header'=>'Description','value'=>$model->cost->description],
            ['attribute'=>'cost_id.costnumber','header'=>'Costnumber','value'=>$model->cost->costnumber],
            ['attribute'=>'costcategory_id','header'=>'Cost Code','value'=>$model->costcategory->name],
            ['attribute'=>'costsubcategory_id','header'=>'Cost Subcode','value'=>$model->costsubcategory->name],
            ['attribute'=>'paymenttype','header'=>'Payment Type','value'=>$model->paymenttype],
            ['attribute'=>'paymentreference','header'=>'Payment Reference','value'=>$model->paymentreference],
            'unit_price',
            'paid',
            'modified_date',
        ],
    ]) ?>
</div>
