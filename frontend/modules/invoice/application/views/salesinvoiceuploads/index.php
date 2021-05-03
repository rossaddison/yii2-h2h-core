<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\invoice\application\models\SalesinvoicemethodpaySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Salesinvoice Uploads';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Customer Debt'), 'url' => ['/product/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Daily Cleans'), 'url' => ['/salesorderheader/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Sales Invoice'), 'url' => ['/invoice/salesinvoice/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Sales Invoice Payment'), 'url' => ['/invoice/salesinvoicepayment/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Sales Invoice Settings'), 'url' => ['/invoice/ip/settings']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salesinvoiceuploads-index">

    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <p>
        <?= Html::a('Create Sales Invoice Upload', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'upload_id',
            'product_id',
            'url_key',
            'file_name_original:ntext',
            'file_name_new:ntext',
             ['attribute' => 'uploaded_date','format' => ['date',(isset(Yii::$app->modules['datecontrol']['displaySettings']['date'])) ? Yii::$app->modules['datecontrol']['displaySettings']['date'] : 'd-m-Y']], 

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
