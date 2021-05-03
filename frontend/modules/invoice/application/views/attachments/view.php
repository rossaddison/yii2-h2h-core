<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var frontend\modules\invoice\application\models\SalesinvoiceUploads $model
 */

$this->title = $model->upload_id;
$this->params['breadcrumbs'][] = ['label' => 'Salesinvoice Uploads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salesinvoice-uploads-view">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>


    <?= DetailView::widget([
        'model' => $model,
        'condensed' => false,
        'hover' => true,
        'mode' => Yii::$app->request->get('edit') == 't' ? DetailView::MODE_EDIT : DetailView::MODE_VIEW,
        'panel' => [
            'heading' => $this->title,
            'type' => DetailView::TYPE_INFO,
        ],
        'attributes' => [
            'upload_id',
            'product_id',
            'url_key:url',
            'file_name_original:ntext',
            'file_name_new:ntext',
            [
                'attribute' => 'uploaded_date',
                'format' => [
                    'date', (isset(Yii::$app->modules['datecontrol']['displaySettings']['date']))
                        ? Yii::$app->modules['datecontrol']['displaySettings']['date']
                        : 'd-m-Y'
                ],
                'type' => DetailView::INPUT_WIDGET,
                'widgetOptions' => [
                    'class' => DateControl::classname(),
                    'type' => DateControl::FORMAT_DATE
                ]
            ],
        ],
        'deleteOptions' => [
            'url' => ['delete', 'id' => $model->upload_id],
        ],
        'enableEditMode' => true,
    ]) ?>

</div>
