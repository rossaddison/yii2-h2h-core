 <?php
   use frontend\modules\invoice\application\components\Utilities;
?>

<div class="panel panel-default">
    <div class="panel-heading"><?= Utilities::trans('email_template_tags'); ?></div>
    <div class="panel-body">
        <p class="small"><?= Utilities::trans('email_template_tags_instructions'); ?></p>
        <div class="form-group">
            <label for="tags_client"><?= Utilities::trans('client'); ?></label>
            <select id="tags_client" class="tag-select form-control">
                <option value="{{{name}}}">
                    <?= Utilities::trans('client_name'); ?>
                </option>
                <option value="{{{surname}}}">
                    <?= Utilities::trans('client_surname'); ?>
                </option>
                <optgroup label="<?= Utilities::trans('contact_information'); ?>">
                    <option value="{{{contactmobile}}}">
                        <?= Utilities::trans('mobile'); ?>
                    </option>
                    <option value="{{{email}}}">
                        <?= Utilities::trans('email'); ?>
                    </option>
                </optgroup>                
            </select>
        </div>
        
        <div class="form-group">
            <label for="tags_invoice"><?= Utilities::trans('invoices'); ?></label>
            <select id="tags_invoice" class="tag-select form-control">
                <option value="{{{invoice_id}}}">
                    <?= Utilities::trans('id'); ?>
                </option>
                <option value="{{{invoice_status_id}}}">
                    <?= Utilities::trans('status'); ?>
                </option>
                <optgroup label="<?= Utilities::trans('invoice_dates'); ?>">
                    <option value="{{{invoice_date_due}}}">
                        <?= Utilities::trans('due_date'); ?>
                    </option>
                    <option value="{{{invoice_date_created}}}">
                        <?= Utilities::trans('invoice_date'); ?>
                    </option>
                </optgroup>
                <optgroup label="<?= Utilities::trans('invoice_amounts'); ?>">
                    <option value="{{{invoice_total}}}">
                        <?= Utilities::trans('total'); ?>
                    </option>
                    <option value="{{{invoice_paid}}}">
                        <?= Utilities::trans('total_paid'); ?>
                    </option>
                    <option value="{{{invoice_balance}}}">
                        <?= Utilities::trans('balance'); ?>
                    </option>
                </optgroup>
                <optgroup label="<?= Utilities::trans('extra_information'); ?>">
                    <option value="{{{invoice_terms}}}">
                        <?= Utilities::trans('invoice_terms'); ?>
                    </option>
                <option value="{{{invoice_guest_url}}}">
                    <?= Utilities::trans('guest_url'); ?>
                </option>
                <option value="{{{payment_method}}}"> 
                     <?= Utilities::trans('payment_method'); ?> 
                </option> -->
                </optgroup>
               
            </select>
        </div>
    </div>
</div>
