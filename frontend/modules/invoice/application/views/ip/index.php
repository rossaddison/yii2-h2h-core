<?php
use yii\helpers\ArrayHelper;
use frontend\modules\invoice\application\models\Settings;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sales Invoice Settings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salesinvoicesetting-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Sales Invoice Setting'), ['sc'], ['class' => 'btn btn-success']) ?>
    </p>
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>   

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'containerOptions' => ['style'=>'overflow: auto'], 
        'pjax' => true,
        'pjaxSettings' =>[
                          'neverTimeout'=>false,
                          'options'=>['id'=>'kv-unique-id-23'],                      
                         ],
        'responsiveWrap'=>true,
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'floatHeader' => false,
        'showPageSummary' => false,
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading'=> Yii::t('app','Settings'),
        ],
        'exportConfig' => [
                       GridView::CSV => ['label' => Yii::t('app','Export as CSV'),'filename' => 'Houses_Printed_'.date('d-M-Y')],
                       GridView::HTML => ['label' => Yii::t('app','Export as HTML'),'filename' => 'Houses_Printed_'.date('d-M-Y')],
                       GridView::PDF => [ 'label' => Yii::t('app','Export as PDF'),'filename' => 'Houses_Printed_'.date('d-M-Y')], 
                       GridView::EXCEL=> ['label' => Yii::t('app','Export as EXCEL'), 'filename' => 'Houses_Printed_'.date('d-M-Y')],
                       GridView::TEXT=> ['label' => Yii::t('app','Export as TEXT'), 'filename' => 'Houses_Printed_'.date('d-M-Y')],
        ],
        'columns' => [
            [
                'class' => 'kartik\grid\SerialColumn'
            ],
            [
                'class'=>'kartik\grid\DataColumn',
                'attribute'=>'setting_id',
                'value' => function ($dataProvider) {
                    return $dataProvider->setting_id; 
                },
                'filter'=> Html::activeDropDownList($searchModel,'setting_id',ArrayHelper::map(Settings::find()->orderBy('setting_id')->asArray()->all(),'setting_id','setting_id'),[ 'class'=>'form-control','prompt'=>'Select...']), 
            ],
            [
                'class'=>'kartik\grid\DataColumn',
                'attribute'=>'setting_key',
                'value' => function ($dataProvider) {
                    return $dataProvider->setting_key; 
                },
                'filter'=> Html::activeDropDownList($searchModel,'setting_key',ArrayHelper::map(Settings::find()->orderBy('setting_key')->asArray()->all(),'setting_key','setting_key'),[ 'class'=>'form-control','prompt'=>'Key...']), 
            ],
            [
                'class'=>'kartik\grid\DataColumn',
                'attribute'=>'setting_value',
                'value' => function ($dataProvider) {
                    return $dataProvider->setting_value; 
                },
                'filter'=> Html::activeDropDownList($searchModel,'setting_value',ArrayHelper::map(Settings::find()->orderBy('setting_value')->asArray()->all(),'setting_value','setting_value'),[ 'class'=>'form-control','prompt'=>'Value...']), 
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{link}',// can be omitted, as it is the default
                'header'=>'View',
                'visible'=> Yii::$app->user->isGuest ? false : true,
                'buttons' => ['link' => function ($url, $dataProvider,$key) {
                               return Html::a(Icon::show('file-invoice', ['framework' => Icon::FAS]),$url);
                    }
                 ],
                'urlCreator' => function ($action, $dataProvider, $key, $index) {
                             if (($action === 'link') ) {
                                 $url = Url::toRoute(['ip/sv','id'=>$dataProvider->setting_id]);
                                 return $url;
                             }
                 }                
            ],                      
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{link}',// can be omitted, as it is the default
                'header'=>'Update',
                'visible'=> Yii::$app->user->isGuest ? false : true,
                'buttons' => ['link' => function ($url, $dataProvider,$key) {
                               return Html::a(Icon::show('pencil-alt', ['framework' => Icon::FAS]),$url);
                    }
                 ],
                'urlCreator' => function ($action, $dataProvider, $key, $index) {
                             if (($action === 'link') ) {
                                 $url = Url::toRoute(['ip/su','id'=>$dataProvider->setting_id]);
                                 return $url;
                             }
                 }                
            ],
        ],
    ]); ?>
</div>
