<?php
use yii\helpers\Html;
use yii\widgets\ListView;
$this->title = Yii::t('app','Cost Subcategory');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="costsubcategory-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a(Yii::t('app','Create Cost Subcategory'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'layout'=>"\n{items}{summary}\n{pager}",
        'pager' => [
            'firstPageLabel' => '<span class="page-link"><i class ="fa fa-chevron-left"></i></span>',
            'lastPageLabel' => '<span class="page-link"><i class ="fa fa-chevron-right"></i></span>',
            'prevPageLabel' => '<span class="page-link">Previous</span>',
            'nextPageLabel' => '<span class="page-link">Next</span>',
            'pageCssClass'=>'btn btn-light',
            'activePageCssClass' => 'active',  
            'maxButtonCount'=> 5,
            'options'=> ['class'=> 'pagination'], 
        ],
        'itemOptions' => ['class' => 'page-item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
        },
    ]) ?>
</div>
