<?php
  use frontend\modules\invoice\application\components\Utilities;
  use frontend\modules\invoice\application\models\Salesinvoicemethodpay;
  use yii\helpers\Html;
  use yii\helpers\Url;
  use yii\widgets\LinkPager;
  use frontend\widgets\Alert;  
?>
<div id="headerbar">
    <h1 class="headerbar-title"><?= Utilities::trans('payments'); ?></h1>
    <div class="headerbar-item pull-right">
      <?php   
          echo LinkPager::widget([
          'pagination' => $pages,
          ]);
      ?>
    </div>
</div>

<div id="content" class="table-content">
    <div class="info">
        <?php          
           echo Alert::widget()
        ?>
    </div>
    <div id="filter_results">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th><?= Utilities::trans('date'); ?></th>
                    <th><?= Utilities::trans('invoice'); ?></th>
                    <th><?= Utilities::trans('amount'); ?></th>
                    <th><?= Utilities::trans('payment_method'); ?></th>
                    <th><?= Utilities::trans('note'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($payments as $payment) { ?>
                    <tr>
                        <td><?= $this->context->dateHelper->date_from_mysql($payment['payment_date']); ?></td>
                        <td>
                            <a href="<?= Url::toRoute(['@web/invoice/invoices/view' ,'invoice_id' => $payment['invoice_id']]); ?>">
                                <?= $payment['invoice_id']; ?>
                            </a>
                        </td>
                        <td><?= $this->context->numberHelper->format_currency($payment['payment_amount']); ?></td>
                        <td><?php $name = SalesinvoiceMethodPay::find()->where(['=','payment_method_id',$payment['payment_method_id']])->one();
                                echo $name->payment_method_name; 
                        ?></td>
                        <td><?= Html::encode($payment['payment_note']); ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
