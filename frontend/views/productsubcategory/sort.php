<?php
use yii\helpers\Html;
use sjaakp\sortable\SortableGridView;
use Yii;
$this->title = Yii::t('app','Street - Drag and drop rows to Sort then Refresh Grid');
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Refresh Grid'), 'url' => ['productsubcategory/dragdrop']];
?>
<div class="productsubcategory-sort">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    $gridColumns = [
     [
      'class'=>'yii\grid\DataColumn',
      'attribute'=>'sort_order',
      'label'=>Yii::t('app','Sort Order (Drag-Drop-Refresh Grid)'),
     ],
     [
            'class'=>'yii\grid\DataColumn',
            'header'=>Yii::t('app','Postcode'),
            'format'=>'html',
            'attribute'=>'productcategory_id', 
            'value' => function ($dataProvider) {
                        $url2 = "https://maps.google.com/maps?q=".$dataProvider->productcategory->name;
                       return Html::a($dataProvider->productcategory->name,$url2);
             },
     ],    
     [
            'class'=>'yii\grid\DataColumn',
            'header'=>Yii::t('app','Street'),
            'format'=>'html',
            'attribute'=>'productsubcategory_id', 
            'value' => function ($dataProvider) {
                        $url2 = "https://maps.google.com/maps?q=".$dataProvider->name." ".$dataProvider->productcategory->name;
                       return Html::a($dataProvider->name,$url2);
             },
    ], 
     ];
    
    echo SortableGridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'orderUrl'=> ['order'],
    ]);
?> 
</div>