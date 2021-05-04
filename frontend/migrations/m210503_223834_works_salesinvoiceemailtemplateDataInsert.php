<?php

Namespace frontend\migrations;

use yii\db\Migration;

class m210503_223834_works_salesinvoiceemailtemplateDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%works_salesinvoiceemailtemplate}}',
                           ["email_template_id", "email_template_title", "email_template_type", "email_template_body", "email_template_subject", "email_template_from_name", "email_template_from_email", "email_template_cc", "email_template_bcc", "email_template_pdf_template"],
                            [
    [
        'email_template_id' => '1',
        'email_template_title' => 'Email Template Online Payer',
        'email_template_type' => 'invoice',
        'email_template_body' => 'Hi {{{name}}} {{{surname}}},
Your windows were cleaned. Please can you pay the 
following invoice:

Invoice {{{ID}}} for an amount of {{{invoice_total}}}.

You can pay online by clicking on the following link:

{{{invoice_guest_url}}}
 ',
        'email_template_subject' => 'Subject',
        'email_template_from_name' => 'fromame',
        'email_template_from_email' => null,
        'email_template_cc' => '',
        'email_template_bcc' => '',
        'email_template_pdf_template' => '0',
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%works_salesinvoiceemailtemplate}} CASCADE');
    }
}
