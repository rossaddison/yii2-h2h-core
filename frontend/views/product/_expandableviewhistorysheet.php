<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\db\Query;
use yii\data\ArrayDataProvider;
use kartik\grid\GridView;
use frontend\models\Salesorderheader;
use Yii;
$tooltipview = Html::tag('span', Yii::t('app','View'), ['title'=>Yii::t('app','View or Update or Delete'),'data-toggle'=>'tooltip','style'=>'text-decoration: underline: cursor:pointer;']);
$tooltippayoff = Html::tag('span', Yii::t('app','Unpaid'), ['title'=>Yii::t('app','Record as paid.'),'data-toggle'=>'tooltip','style'=>'text-decoration: underline: cursor:pointer;']);
$tooltipdailycleandate  = Html::tag('span', Yii::t('app','Date'), ['title'=>Yii::t('app','Clean Date of Daily Clean'),'data-toggle'=>'tooltip','style'=>'text-decoration: underline: cursor:pointer;']);
$tooltipsalesorderheader = Html::tag('span', 'SOH', ['title'=>Yii::t('app','Sales Order Header'),'data-toggle'=>'tooltip','style'=>'text-decoration: underline: cursor:pointer;']);
$tooltipsalesorderdetail = Html::tag('span', 'SOD', ['title'=>Yii::t('app','Sales Order Detail'),'data-toggle'=>'tooltip','style'=>'text-decoration: underline: cursor:pointer;']);
?>
<div class="product-expandable-viewhistorysheet">
    <?php
        $db=\frontend\components\Utilities::userdb();
        $q = new Query;
        $rows = $q->select('*')
        ->from('works_salesorderdetail')
        ->andWhere('product_id='.$model->id)
        ->all($db);
    ?>  
<?php
$data = $rows;
$provider = new ArrayDataProvider([
        'allModels' => $data,
        'key'=> 'sales_order_detail_id',
        'pagination' => [
            'pageSize' => 100,
        ],
        'sort' => [
            'attributes' => ['sales_order_id', 'sales_order_detail_id'],
        ],
    ]);
 ?>
<?php echo GridView::widget([
    'dataProvider' => $provider,
    ///'containerOptions' => [
    ///     'style'=>'overflow: auto',
    ///     'options'=>['id'=>'w334'],
    ///  ], 
    ///'options'=>['id'=>'w334'],
    'pjax' => true,
    'pjaxSettings' =>['neverTimeout'=>true,
                      'options'=>['id'=>'kv-unique-id-9'],                      
                     ],
    'responsiveWrap'=>true,
    'bordered' => true,
    'bootstrap'=>true,
    'striped' => true,
    'condensed' => false,
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],
        [
          'class'=>'kartik\grid\DataColumn',
          'header'=>$tooltipdailycleandate,
                'hAlign' => 'right', 
                'vAlign' => 'middle',
                'width' => '7%',  
                'value' => function ($provider) {
                     $getdate_id = $provider['sales_order_id']; 
                     $getdate = Salesorderheader::find()->where(['sales_order_id'=>$getdate_id])->one();
                     return $getdate['clean_date']; // $data['name'] for array data, e.g. using SqlDataProvider.
                },
        ],
        [
                    'class' => 'kartik\grid\ActionColumn',
                    'template' => '{link}',
                    'header'=>$tooltipsalesorderheader,
                    'visible'=> Yii::$app->user->can('Update Daily Job Sheet') ? true : false,
                    'buttons' => [
                            'link' => function ($url, $provider,$key) {
                            $id = $provider['sales_order_id']; 
                            return Html::a($id,  $url,['class' => 'btn btn-success']);
                            },
                    ],
                    'urlCreator' => function ($action, $provider, $key, $index) {
                         if ($action === 'link') {
                            $url=Url::toRoute(['salesorderheader/view', 'id'=>$provider['sales_order_id']]);
                            Url::remember();
                            return $url;
                        }
                    }
         ],  
        [
                    'class' => 'kartik\grid\ActionColumn',
                    'template' => '{link}',
                    'header'=>$tooltipsalesorderdetail,
                    'visible'=> Yii::$app->user->can('Update Daily Job Sheet') ? true : false,
                    'buttons' => [
                            'link' => function ($url, $provider,$key) {
                            $id = $provider['sales_order_detail_id']; 
                            return Html::a($id,  $url,['class' => 'btn btn-success']);
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
                            return Html::a(Yii::t('app','Unpaid'), $url,['class' => 'btn btn-danger']);
                            }
                            if  ($provider['paid'] == $provider['unit_price']){
                            return Html::a(Yii::t('app','Paid'), $url,['class' => 'btn btn-success']);
                            }
                            },
                    ],
                    'urlCreator' => function ($action, $provider, $key, $index) {
                         if ($action === 'link') {
                            $url=Url::toRoute(['salesorderdetail/pay', 'id'=>$provider['sales_order_detail_id']]);
                            Url::remember();
                            return $url;
                        }
                    }
         ],
        'unit_price',       
    ],
]); 
?>
</div>



