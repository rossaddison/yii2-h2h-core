<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use Yii;
$this->title = Yii::t('app','Postcode') . '(eg. N19 - Islington)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productcategory-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app','Postcode Finder'), "http://pcf.raggedred.net/", ['class' => 'btn btn-success btn-lg']) ?>
        <?= 
            //Modal link frontend/layouts/main.php and frontend/assets/AppAsset.php
            Html::button(Yii::t('app','Create Postcode').' eg. N19 - Islington', ['value' => Url::to(['productcategory/create']), 'title' => Yii::t('app','Creating New Postcode'), 'class' => 'showModalButton btn btn-success btn-lg']); 
        ?>
        <?php 
            //Html::a(Yii::t('app','Create Postcode').' eg. N19 - Islington', ['create'], ['class' => 'btn btn-success btn-lg']) 
        ?>
    </p>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['style' => 'font-size:18px;'],
        'layout'=>"\n{items}{summary}\n{pager}",
        'pager' => [
            'firstPageLabel' => '<span class="page-link"><i class ="fa fa-chevron-left"></i></span>',
            'lastPageLabel' => '<span class="page-link"><i class ="fa fa-chevron-right"></i></span>',
            'prevPageLabel' => '<span class="page-link">'.Yii::t('app','Previous').'</span>',
            'nextPageLabel' => '<span class="page-link">'.Yii::t('app','Next').'</span>',
            'pageCssClass'=>'btn btn-light btn-lg',
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