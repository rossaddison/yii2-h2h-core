<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'SalesinvoicePayments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "Invoice Id: ".$model->invoice->invoice_id,'url' => ['salesinvoice/index']];
?>
<div class="salesinvoicepayment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,  'view_invoice_id'=>$model->invoice->invoice_id,'view_payment_expected'=>$view_payment_expected
    ]) ?>

</div>

<?php //echo $view_invoice_id; ?><br>
<?php //echo $view_payment_expected; ?><br>
<?php //echo $sodid; ?><br> 
<?php //var_dump($zeropaid); ?><br>
<?php //echo $safe; ?><br> 
