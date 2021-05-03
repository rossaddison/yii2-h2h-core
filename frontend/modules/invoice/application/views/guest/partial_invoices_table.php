<?php
  use frontend\modules\invoice\application\components\Utilities;
  use yii\helpers\Url;
  use yii\helpers\Html;
?>   

<div class="table-responsive">
    <table class="table table-hover table-striped no-margin">

        <thead>
        <tr>
            <th><?= Utilities::trans('invoice'); ?></th>
            <th><?= Utilities::trans('created'); ?></th>
            <th><?= Utilities::trans('due_date'); ?></th>
            <th><?= Utilities::trans('client_name'); ?></th>
            <th><?= Utilities::trans('amount'); ?></th>
            <th><?= Utilities::trans('balance'); ?></th>
            <th><?= Utilities::trans('options'); ?></th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($invoices as $invoice) { ?>
            <tr>
                <td>
                    <a href="<?= Url::toRoute(['@web/invoice/invoices/view/','invoice_id'=>$invoice->invoice_id]); ?>"><?php echo $invoice->invoice_id?></a>                          
                </td>
                <td>
                    <?= $dateHelper->date_from_mysql($invoice->invoice_date_created); ?>
                </td>
                <td>
                    <?php if ($invoice->invoice_date_due < date('Y-m-d')) : ?>
                        <span class="font-overdue">
                            <?php echo Yii::$app->formatter->asDate($invoice->invoice_date_due,'php:d mm Y'); ?>
                        </span>
                    <?php else : ?>
                        <?php echo Yii::$app->formatter->asDate($invoice->invoice_date_due,'php:d mm Y'); ?>
                    <?php endif; ?>
                </td>
                <td>
                    <?= Html::encode($invoice->customerdetails->name); ?><?= str_repeat("&nbsp;", 3); ?><?= Html::encode($invoice->customerdetails->surname); ?>
                </td>
                <td>
                    <?= $numberHelper->format_currency($invoice->salesinvoiceamount->invoice_total); ?>
                </td>
                <td>
                    <?= $numberHelper->format_currency($invoice->salesinvoiceamount->invoice_balance); ?>
                </td>
                <td>
                    <div class="options btn-group btn-group-sm">
                        <?php if ($invoice->invoice_status_id != 4 && $this->context->mdl_settings->setting('enable_online_payments') == 1) : ?>
                            <a href="<?= Url::toRoute(['@web/invoice/paymentinformation/form', 'invoice_url_key' => $invoice->invoice_url_key]); ?>"
                               class="btn btn-primary">
                                <i class="fa fa-credit-card"></i>
                                <?= Utilities::trans('pay_now'); ?>
                            </a>
                        <?php endif; ?>
                        <a href="<?= Url::toRoute(['@web/invoice/invoices/view','invoice_id' => $invoice->invoice_id]); ?>"
                           class="btn btn-default">
                            <i class="fa fa-eye"></i>
                            <?= Utilities::trans('view'); ?>
                        </a>
                        <a href="<?= Url::toRoute(['@web/invoice/invoices/pdf','invoice_id'=>$invoice->invoice_id]); ?>"
                           class="btn btn-default">
                            <i class="fa fa-print"></i>
                            <?= Utilities::trans('pdf'); ?>
                        </a>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>