<?php
namespace frontend\migrations;

use yii\db\Migration;

class m200414_125047_works_companyDataInsert extends Migration
{

    public function safeUp()
    {
        $this->batchInsert('{{%works_company}}',
                           ["id", "name", "address_street", "address_area1", "address_area2", "address_areacode", "telephone", "external_website_url", "email", "twilio_telephone", "fax", "finyear_start_date", "finyear_end_date", "corp_tax_duedate", "company_regno", "vat_no", "alt_reg_name", "alt_reg_no", "alt_expiry_date", "alt2_reg_name", "alt2_reg_no", "alt2_expiry_date", "sic_name", "sic_code", "sic2_name", "sic2_code", "salesorderheader_excludefullypaid", "costheader_excludefullypaid", "homepage", "gc_accesstoken", "gc_live_or_sandbox", "smtp_transport_host", "smtp_transport_username", "smtp_transport_password", "smtp_transport_port", "smtp_transport_encryption", "google_translate_json_filename_and_path", "language", "currency_prefix", "currency_suffix"],
                            [
    [
        'id' => '1',
        'name' => 'Your Company Name',
        'address_street' => '',
        'address_area1' => '',
        'address_area2' => '',
        'address_areacode' => '',
        'telephone' => '',
        'external_website_url' => '',
        'email' => '',
        'twilio_telephone' => '',
        'fax' => '',
        'finyear_start_date' => '',
        'finyear_end_date' => '',
        'corp_tax_duedate' => '',
        'company_regno' => '',
        'vat_no' => '',
        'alt_reg_name' => '',
        'alt_reg_no' => '',
        'alt_expiry_date' => '',
        'alt2_reg_name' => '',
        'alt2_reg_no' => '',
        'alt2_expiry_date' => '',
        'sic_name' => '',
        'sic_code' => '',
        'sic2_name' => '',
        'sic2_code' => '',
        'salesorderheader_excludefullypaid' => '0',
        'costheader_excludefullypaid' => '0',
        'homepage' => '',
        'gc_accesstoken' => '',
        'gc_live_or_sandbox' => 'SANDBOX',
        'smtp_transport_host' => '',
        'smtp_transport_username' => '',
        'smtp_transport_password' => '',
        'smtp_transport_port' => null,
        'smtp_transport_encryption' => 'tls',
        'google_translate_json_filename_and_path' => '',
        'language' => '',
        'currency_prefix' => '',
        'currency_suffix' => '',
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%works_company}} CASCADE');
    }
}
