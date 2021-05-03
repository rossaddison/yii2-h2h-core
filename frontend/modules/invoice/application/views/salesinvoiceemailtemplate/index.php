<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Salesinvoiceemailtemplates');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salesinvoiceemailtemplate-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Salesinvoiceemailtemplate'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'email_template_id:email',
            'email_template_title:ntext',
            'email_template_type:email',
            'email_template_body:ntext',
            'email_template_subject:ntext',
            //'email_template_from_name:ntext',
            //'email_template_from_email:ntext',
            //'email_template_cc:ntext',
            //'email_template_bcc:ntext',
            //'email_template_pdf_template:email',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
