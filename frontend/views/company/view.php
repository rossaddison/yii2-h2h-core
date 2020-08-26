<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Company'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app','Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app','Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app','Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'address_street',
            'address_area1',
            'address_area2',
            'address_areacode',
            'twilio_telephone',
            'telephone',
            'external_website_url',
            'email',
            'fax',
            'finyear_start_date',
            'finyear_end_date',
            'corp_tax_duedate',
            'company_regno',
            'vat_no',
            'alt_reg_name',
            'alt_reg_no',
            'alt_expiry_date',
            'alt2_reg_name',
            'alt2_reg_no',
            'alt2_expiry_date',
            'sic_name',
            'sic_code',
            'sic2_name',
            'sic2_code',
            'salesorderheader_excludefullypaid',            
            'homepage',            
            'gc_accesstoken',
            'gc_live_or_sandbox',
            'smtp_transport_host',
            'smtp_transport_username',
            'smtp_transport_password',
            'smtp_transport_encryption',
            'smtp_transport_port',
            'google_translate_json_filename_and_path',
            'language',
            'currency_prefix',
            'currency_suffix',
        ],
    ]) ?>
</div>
