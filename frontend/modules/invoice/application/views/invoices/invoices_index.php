<?php
   use frontend\modules\invoice\application\components\Utilities;
   use yii\helpers\Url;
   use yii\widgets\LinkPager;
?>
<div id="headerbar">
    <h1 class="headerbar-title"><?= Utilities::trans('invoices'); ?></h1>
    <div class="headerbar-item pull-right">
      <?php   
          echo LinkPager::widget([
          'pagination' => $pages,
          ]);
      ?>
    </div>
    <div class="headerbar-item pull-right">
        <div class="btn-group btn-group-sm index-options">
            <a href="<?= Url::to(['open']); ?>"
               class="btn <?= $status == 'open' ? 'btn-primary' : 'btn-default' ?>">
                <?= Utilities::trans('open'); ?>
            </a>
            <a href="<?= Url::to(['paid']); ?>"
               class="btn  <?= $status == 'paid' ? 'btn-primary' : 'btn-default' ?>">
                <?= Utilities::trans('paid'); ?>
            </a>
        </div>
    </div>
</div>

<div id="content" class="table-content">
    <?php // echo $this->layout->load_view('layout/alerts'); ?>
    <div id="filter_results">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
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
                            <?=  Yii::$app->formatter->asDate($invoice->invoice_date_created,'php:d mm Y'); ?>
                        </td>
                        <td>
                            <?=  Yii::$app->formatter->asDate($invoice->invoice_date_due,'php:d mm Y'); ?>
                        </td>
                        <td>
                            <?= $invoice->customerdetails->name.str_repeat("&nbsp;", 2).$invoice->customerdetails->surname; ?>
                        </td>
                        <td>
                            <?= $this->context->numberHelper->format_currency($invoice->salesinvoiceamount->invoice_total); ?>
                        </td>
                        <td>
                            <?= $this->context->numberHelper->format_currency($invoice->salesinvoiceamount->invoice_balance); ?>
                        </td>
                        <td>
                            <div class="options btn-group btn-group-sm">
                                <?php if ($invoice->invoice_status_id != 4 && $this->context->mdl_settings->setting('enable_online_payments') == 1) : ?>
                                    <a href="<?= Url::toRoute(['/invoice/paymenthandler/makepayment', 'invoice_url_key' => $invoice->invoice_url_key]); ?>"
                                       class="btn btn-primary">
                                        <i class="fa fa-credit-card"></i>
                                        <?= Utilities::trans('pay_now'); ?>
                                    </a>
                                <?php endif; ?>
                                <a href="<?= Url::toRoute(['/invoice/invoices/view','invoice_id' => $invoice->invoice_id]); ?>"
                                   class="btn btn-default">
                                    <i class="fa fa-eye"></i>
                                    <?= Utilities::trans('view'); ?>
                                </a>
                                <a href="<?= Url::toRoute(['/invoice/invoices/pdf', 'invoice_id'=> $invoice->invoice_id]); ?>"
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
    </div>
</div>
