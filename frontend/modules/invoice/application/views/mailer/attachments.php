<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\icons\Icon;
use yii\data\ArrayDataProvider;
?>

<?php
$data = $dataProvider;
$provider = new ArrayDataProvider([
        'allModels' => $data,
        'key'=> 'upload_id',
        'pagination' => [
            'pageSize' => 10,
        ],
        'sort' => [
            'attributes' => ['url_key'],
        ],
    ]);
 ?>
<div class="salesinvoiceuploads-index">
    <?php Pjax::begin(); echo GridView::widget([
                'dataProvider' => $provider,
                'columns' => [
                    'file_name_original:ntext',
                    ['attribute' => 'uploaded_date','format' => ['date',(isset(Yii::$app->modules['datecontrol']['displaySettings']['date'])) ? Yii::$app->modules['datecontrol']['displaySettings']['date'] : 'd-m-Y']], 
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'template' => '{link}',// can be omitted, as it is the default
                        'header'=>'View',
                        'visible'=> Yii::$app->user->can('Manage Admin') ? true : false,
                        'buttons' => ['link' => function ($url, $dataProvider,$key) {
                                       return Html::a(Icon::show('eye', ['framework' => Icon::FAS]),$url);
                            }
                         ],
                        'urlCreator' => function ($action, $dataProvider, $key, $index) {
                                     if (($action === 'link') ) {
                                         $url = Url::toRoute(['@web/invoice/salesinvoiceuploads/view','id'=>$dataProvider->upload_id]);
                                         return $url;
                                     }
                         }                
                    ],
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'template' => '{link}',// can be omitted, as it is the default
                        'header'=>'Delete',
                        'visible'=> Yii::$app->user->can('Manage Admin') ? true : false,
                        'buttons' => ['link' => function ($url, $dataProvider,$key) {
                                       return Html::a(Icon::show('trash-alt', ['framework' => Icon::FAS]),$url);
                            }
                         ],
                        'urlCreator' => function ($action, $dataProvider, $key, $index) {
                                     if (($action === 'link') ) {
                                         $url = Url::toRoute(['@web/invoice/salesinvoiceuploads/delete','id'=>$dataProvider->upload_id]);
                                         return $url;
                                     }
                         }                
                    ],             
                ],
                'responsive' => true,
                'hover' => false,
                'condensed' => true,
                'floatHeader' => false,
    ]); Pjax::end(); ?>
</div>
