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
                <option value="{{{client_name}}}">
                    <?= Utilities::trans('client_name'); ?>
                </option>
                <option value="{{{client_surname}}}">
                    <?= Utilities::trans('client_surname'); ?>
                </option>
                <optgroup label="<?= Utilities::trans('address'); ?>">
                    <option value="{{{client_address_1}}}">
                        <?= Utilities::trans('street_address'); ?>
                    </option>
                    <option value="{{{client_address_2}}}">
                        <?= Utilities::trans('street_address_2'); ?>
                    </option>
                    <option value="{{{client_city}}}">
                        <?= Utilities::trans('city'); ?>
                    </option>
                    <option value="{{{client_state}}}">
                        <?= Utilities::trans('state'); ?>
                    </option>
                    <option value="{{{client_zip}}}">
                        <?= Utilities::trans('zip'); ?>
                    </option>
                    <option value="{{{client_country}}}">
                        <?= Utilities::trans('country'); ?>
                    </option>
                </optgroup>
                <optgroup label="<?= Utilities::trans('contact_information'); ?>">
                    <option value="{{{client_phone}}}">
                        <?= Utilities::trans('phone'); ?>
                    </option>
                    <option value="{{{client_fax}}}">
                        <?= Utilities::trans('fax'); ?>
                    </option>
                    <option value="{{{client_mobile}}}">
                        <?= Utilities::trans('mobile'); ?>
                    </option>
                    <option value="{{{client_email}}}">
                        <?= Utilities::trans('email'); ?>
                    </option>
                    <option value="{{{client_web}}}">
                        <?= Utilities::trans('web_address'); ?>
                    </option>
                </optgroup>
                <optgroup label="<?= Utilities::trans('tax_information'); ?>">
                    <option value="{{{client_vat_id}}}">
                        <?= Utilities::trans('vat_id'); ?>
                    </option>
                    <option value="{{{client_tax_code}}}">
                        <?= Utilities::trans('tax_code'); ?>
                    </option>
                    <option value="{{{client_avs}}}">
                        <?= Utilities::trans('sumex_ssn'); ?>
                    </option>
                    <option value="{{{client_insurednumber}}}">
                        <?= Utilities::trans('sumex_insurednumber'); ?>
                    </option>
                    <option value="{{{client_weka}}}">
                        <?= Utilities::trans('sumex_veka'); ?>
                    </option>
                </optgroup>
                <optgroup label="<?= Utilities::trans('custom_fields'); ?>">
                    <?php ///foreach ($custom_fields['ip_client_custom'] as $custom) { ?>
                        <option value="{{{<?php ///echo 'ip_cf_' . $custom->custom_field_id; ?>}}}">
                            <?php ///echo $custom->custom_field_label . ' (ID ' . $custom->custom_field_id . ')'; ?>
                        </option>
                    <?php ///} ?>
                </optgroup>
            </select>
        </div>

        <div class="form-group">
            <label for="tags_user"><?= Utilities::trans('user'); ?></label>
            <select id="tags_user" class="tag-select form-control">
                <option value="{{{user_name}}}">
                    <?= Utilities::trans('name'); ?>
                </option>
                <option value="{{{user_company}}}">
                    <?= Utilities::trans('company'); ?>
                </option>
                <optgroup label="<?= Utilities::trans('address'); ?>">
                    <option value="{{{user_address_1}}}">
                        <?= Utilities::trans('street_address'); ?>
                    </option>
                    <option value="{{{user_address_2}}}">
                        <?= Utilities::trans('street_address_2'); ?>
                    </option>
                    <option value="{{{user_city}}}">
                        <?= Utilities::trans('city'); ?>
                    </option>
                    <option value="{{{user_state}}}">
                        <?= Utilities::trans('state'); ?>
                    </option>
                    <option value="{{{user_zip}}}">
                        <?= Utilities::trans('zip'); ?>
                    </option>
                    <option value="{{{user_country}}}">
                        <?= Utilities::trans('country'); ?>
                    </option>
                </optgroup>
                <optgroup label="<?= Utilities::trans('contact_information'); ?>">
                    <option value="{{{user_phone}}}">
                        <?= Utilities::trans('phone'); ?>
                    </option>
                    <option value="{{{user_fax}}}">
                        <?= Utilities::trans('fax'); ?>
                    </option>
                    <option value="{{{user_mobile}}}">
                        <?= Utilities::trans('mobile'); ?>
                    </option>
                    <option value="{{{user_email}}}">
                        <?= Utilities::trans('email'); ?>
                    </option>
                    <option value="{{{user_web}}}">
                        <?= Utilities::trans('web_address'); ?>
                    </option>
                </optgroup>
                <optgroup label="<?= Utilities::trans('sumex_information'); ?>">
                    <option value="{{{user_subscribernumber}}}">
                        <?= Utilities::trans('user_subscriber_number'); ?>
                    </option>
                    <option value="{{{user_iban}}}">
                        <?= Utilities::trans('user_iban'); ?>
                    </option>
                    <option value="{{{user_gln}}}">
                        <?= Utilities::trans('gln'); ?>
                    </option>
                    <option value="{{{user_rcc}}}">
                        <?= Utilities::trans('sumex_rcc'); ?>
                    </option>
                </optgroup>
                <optgroup label="<?= Utilities::trans('custom_fields'); ?>">
                    <?php ///foreach ($custom_fields['ip_user_custom'] as $custom) { ?>
                        <option value="{{{<?php ///echo 'ip_cf_' . $custom->custom_field_id; ?>}}}">
                            <?php ///echo $custom->custom_field_label . ' (ID ' . $custom->custom_field_id . ')'; ?>
                        </option>
                    <?php ///} ?>
                </optgroup>
            </select>
        </div>

        <div class="form-group">
            <label for="tags_invoice"><?= Utilities::trans('invoices'); ?></label>
            <select id="tags_invoice" class="tag-select form-control">
                <option value="{{{invoice_number}}}">
                    <?= Utilities::trans('id'); ?>
                </option>
                <option value="{{{invoice_status}}}">
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
                    <option value="{{{invoice_item_subtotal}}}">
                        <?= Utilities::trans('subtotal'); ?>
                    </option>
                    <option value="{{{invoice_item_tax_total}}}">
                        <?= Utilities::trans('invoice_tax'); ?>
                    </option>
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
<!--                 <option value="{{{payment_method}}}"> -->
<!--                     <?= Utilities::trans('payment_method'); ?> -->
<!--                 </option> -->
                </optgroup>

                <optgroup label="<?= Utilities::trans('custom_fields'); ?>">
                    <?php ///foreach ($custom_fields['ip_invoice_custom'] as $custom) { ?>
                        <option value="{{{<?php ///echo 'ip_cf_' . $custom->custom_field_id; ?>}}}">
                            <?php ///echo $custom->custom_field_label . ' (ID ' . $custom->custom_field_id . ')'; ?>
                        </option>
                    <?php ///} ?>
                </optgroup>
            </select>
        </div>

        <div class="form-group">
            <label for="tags_quote"><?= Utilities::trans('quotes'); ?></label>
            <select id="tags_quote" class="tag-select form-control">
                <option value="{{{quote_number}}}">
                    <?= Utilities::trans('id'); ?>
                </option>
                <optgroup label="<?= Utilities::trans('quote_dates'); ?>">
                    <option value="{{{quote_date_created}}}">
                        <?= Utilities::trans('quote_date'); ?>
                    </option>
                    <option value="{{{quote_date_expires}}}">
                        <?= Utilities::trans('expires'); ?>
                    </option>
                </optgroup>
                <optgroup label="<?= Utilities::trans('quote_amounts'); ?>">
                    <option value="{{{quote_item_subtotal}}}">
                        <?= Utilities::trans('subtot al'); ?>
                    </option>
                    <option value="{{{quote_tax_total}}}">
                        <?= Utilities::trans('quote_tax'); ?>
                    </option>
                    <option value="{{{quote_item_discount}}}">
                        <?= Utilities::trans('discount'); ?>
                    </option>
                    <option value="{{{quote_total}}}">
                        <?= Utilities::trans('total'); ?>
                    </option>
                </optgroup>

                <optgroup label="<?= Utilities::trans('extra_information'); ?>">
                    <option value="{{{quote_guest_url}}}">
                        <?= Utilities::trans('guest_url'); ?>
                    </option>
                </optgroup>

                <optgroup label="<?= Utilities::trans('custom_fields'); ?>">
                    <?php ////foreach ($custom_fields['ip_quote_custom'] as $custom) { ?>
                        <option value="{{{<?php ///echo 'ip_cf_' . $custom->custom_field_id; ?>}}}">
                            <?php ///echo $custom->custom_field_label . ' (ID ' . $custom->custom_field_id . ')'; ?>
                        </option>
                    <?php ///} ?>
                </optgroup>
            </select>
        </div>

        <div class="form-group">
            <label for="tags_sumex"><?= Utilities::trans('invoice_sumex'); ?></label>
            <select id="tags_sumex" class="tag-select form-control">
                <option value="{{{sumex_reason}}}">
                    <?= Utilities::trans('reason'); ?>
                </option>
                <option value="{{{sumex_diagnosis}}}">
                    <?= Utilities::trans('invoice_sumex_diagnosis'); ?>
                </option>
                <option value="{{{sumex_observations}}}">
                    <?= Utilities::trans('sumex_observations'); ?>
                </option>
                <option value="{{{sumex_treatmentstart}}}">
                    <?= Utilities::trans('treatment_start'); ?>
                </option>
                <option value="{{{sumex_treatmentend}}}">
                    <?= Utilities::trans('treatment_end'); ?>
                </option>
                <option value="{{{sumex_casedate}}}">
                    <?= Utilities::trans('case_date'); ?>
                </option>
                <option value="{{{sumex_casenumber}}}">
                    <?= Utilities::trans('case_number'); ?>
                </option>
            </select>
        </div>

    </div>
</div>
