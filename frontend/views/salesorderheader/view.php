<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use Yii;
$this->title = $model->sales_order_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Daily Cleans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salesorderheader-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app','Update'), ['update', 'id' => $model->sales_order_id], ['class' => 'btn btn-primary btn-lg']) ?>
        <?= Html::a(Yii::t('app','Delete'), ['delete', 'id' => $model->sales_order_id], [
            'class' => 'btn btn-danger btn-lg',
            'data' => [
                'confirm' => Yii::t('app','Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
   <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
        'sales_order_id',
        'status',
        'statusfile',
        ['attribute'=>'employee_id','header'=>'Employee','value'=>$model->employee->title],
        //'carousal_id',
        [
            'attribute'=>'carousal_id','header'=>'Image/File','value'=>function($model)
            {if (!empty($model->carousalimage->image_source_filename)) {
                return $model->carousalimage->image_source_filename;                
            }
            else {return "Not linked";}
        }],
        'clean_date',
        //auto filled from sales order details
        //'sub_total',
        //'tax_amt',
        //'total_due',
        'modified_date',
        ],
    ]) ?>
</div>

