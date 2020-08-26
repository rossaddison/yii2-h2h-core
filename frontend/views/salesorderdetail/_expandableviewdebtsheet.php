<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\db\Query;
use yii\data\ArrayDataProvider;
use kartik\grid\GridView;
use frontend\models\Salesorderheader;
use Yii;
$tooltipview = Html::tag('span', Yii::t('app','View'), ['title'=>Yii::t('app','View or Update or Delete'),'data-toggle'=>'tooltip','style'=>'text-decoration: underline: cursor:pointer;']);
$tooltippayoff = Html::tag('span', Yii::t('app','Unpaid'), ['title'=>'Record as paid.','data-toggle'=>'tooltip','style'=>'text-decoration: underline: cursor:pointer;']);
$tooltipdailycleandate  = Html::tag('span', Yii::t('app','Date'), ['title'=>Yii::t('app','Clean Date of Daily Clean'),'data-toggle'=>'tooltip','style'=>'text-decoration: underline: cursor:pointer;']);
?>
<div class="salesorderdetail-expandable-viewdebtsheet">
<button id="w47" class = "btn btn-success btn-lg" onclick="js:getPaidall()"><?php echo Yii::t('app','Pay off all (ticked)') ?></button>    
    <?php
        $q = new Query;
        $rows = $q->select('*')
        ->from('works_salesorderdetail')
        ->andWhere('product_id='.$model->product_id)
        ->andWhere('unit_price>0.00')
        ->andWhere('paid=0.00')    
        ->andWhere('sales_order_detail_id<'.$model->sales_order_detail_id)
        ->all(); 
    ?>  
<?php
$data = $rows;
$provider = new ArrayDataProvider([
        'allModels' => $data,
        'key'=> 'sales_order_detail_id',
        'pagination' => [
            'pageSize' => 10,
        ],
        'sort' => [
            'attributes' => ['sales_order_id', 'sales_order_detail_id'],
        ],
    ]);
?>
<?php echo GridView::widget([
    'dataProvider' => $provider,
    'containerOptions' => [
         'style'=>'overflow: auto',
         'options'=>['id'=>'w333'],
      ], 
    'options'=>['id'=>'w333'],
    'pjax' => true,
    'pjaxSettings' =>['neverTimeout'=>true,
                      'options'=>['id'=>'kv-unique-id-5'],                      
                     ],
    'responsiveWrap'=>true,
    'bordered' => true,
    'bootstrap'=>true,
    'striped' => true,
    'condensed' => false,
    'columns' => [
        [
            'class'=>'kartik\grid\CheckBoxColumn',
            'multiple'=>false,
        ],
        [
          'class'=>'kartik\grid\DataColumn',
          'header'=>$tooltipdailycleandate,
                'hAlign' => 'right', 
                'vAlign' => 'middle',
                'width' => '7%',  
                'value' => function ($provider) {
                     $getdate_id = $provider['sales_order_id']; 
                     $getdate = Salesorderheader::find()->where(['sales_order_id'=>$getdate_id])->one();
                     return $getdate['clean_date']; 
                },
        ],
        'sales_order_id',
        'sales_order_detail_id',
        ['class' => 'kartik\grid\SerialColumn'],
        [
                    'class' => 'kartik\grid\ActionColumn',
                    'template' => '{link}',
                    'header'=>$tooltipview,
                    'visible'=> Yii::$app->user->can('Update Daily Job Sheet') ? true : false,
                    'buttons' => [
                            'link' => function ($url, $provider,$key) {
                            $getdate_id = $provider['sales_order_id'];  
                            $getdate = Salesorderheader::find()->where(['sales_order_id'=>$getdate_id])->one();
                            return Html::a(Yii::t('app','View ').$getdate['clean_date'],  $url,['class' => 'btn btn-success btn-lg']);
                            },
                    ],
                    'urlCreator' => function ($action, $provider, $key, $index) {
                         if ($action === 'link') {
                            $url=Url::toRoute(['salesorderdetail/view', 'id'=>$provider['sales_order_detail_id']]);
                            Url::remember();
                            return $url;
                        }
                    }
         ],
        [
                    'class' => 'kartik\grid\ActionColumn',
                    'template' => '{link}',
                    'header'=>$tooltippayoff,
                    'visible'=> Yii::$app->user->can('Update Daily Job Sheet') ? true : false,
                    'buttons' => [
                            'link' => function ($url, $provider,$key) {
                            if  ($provider['paid'] < $provider['unit_price']){
                            return Html::a(Yii::t('app','Unpaid'), $url,['class' => 'btn btn-danger btn-lg']);
                            }
                            },
                    ],
                    'urlCreator' => function ($action, $provider, $key, $index) {
                         if ($action === 'link') {
                          if ($provider['paid'] < $provider['unit_price']){
                            $url=Url::toRoute(['salesorderdetail/pay', 'id'=>$provider['sales_order_detail_id']]);
                            Url::remember();
                            return $url;
                          }
                        }
                    }
         ],
        'unit_price',       
    ],
]); 
?>
</div>



