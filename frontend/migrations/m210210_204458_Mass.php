<?php
Namespace frontend\migrations;

use yii\db\Migration;

class m210210_204458_Mass extends Migration
{

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable('{{%works_salesinvoice}}',[
            'invoice_id'=> $this->primaryKey(11),
            'invoice_status_id'=> $this->tinyInteger(2)->notNull()->defaultValue(1),
            'product_id'=> $this->integer(11)->notNull(),
            'user_id'=> $this->integer(11)->notNull(),
            'is_read_only'=> $this->tinyInteger(1)->null()->defaultValue(null),
            'invoice_date_created'=> $this->date()->notNull(),
            'invoice_time_created'=> $this->time()->notNull()->defaultValue('00:00:00'),
            'invoice_date_modified'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
            'invoice_date_due'=> $this->date()->notNull(),
            'invoice_url_key'=> $this->string(255)->notNull(),
            'invoice_terms'=>$this->string(1000)->notNull(),
            'payment_method_id'=> $this->integer(11)->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex('invoice_date_created','{{%works_salesinvoice}}',['invoice_date_created'],false);
        $this->createIndex('invoice_date_due','{{%works_salesinvoice}}',['invoice_date_due'],false);
        $this->createIndex('invoice_url_key','{{%works_salesinvoice}}',['invoice_url_key'],false);
        $this->createIndex('invoice_status_id','{{%works_salesinvoice}}',['invoice_status_id'],false);

        $this->createTable('{{%works_salesinvoiceamount}}',[
            'invoice_amount_id'=> $this->primaryKey(11),
            'invoice_id'=> $this->integer(11)->notNull(),
            'invoice_sign'=> "enum('1', '-1') NOT NULL DEFAULT '1'",
            'invoice_total'=> $this->decimal(20, 2)->null()->defaultValue(null),
            'invoice_paid'=> $this->decimal(20, 2)->null()->defaultValue(null),
            'invoice_balance'=> $this->decimal(20, 2)->null()->defaultValue(null),
        ], $tableOptions);

        $this->createIndex('invoice_id','{{%works_salesinvoiceamount}}',['invoice_id'],false);

        $this->createTable('{{%works_salesinvoiceemailtemplate}}',[
            'email_template_id'=> $this->primaryKey(11),
            'email_template_title'=> $this->text()->null()->defaultValue(null),
            'email_template_type'=> $this->string(255)->null()->defaultValue(null),
            'email_template_body'=> $this->text()->notNull(),
            'email_template_subject'=> $this->text()->null()->defaultValue(null),
            'email_template_from_name'=> $this->text()->null()->defaultValue(null),
            'email_template_from_email'=> $this->text()->null()->defaultValue(null),
            'email_template_cc'=> $this->text()->null()->defaultValue(null),
            'email_template_bcc'=> $this->text()->null()->defaultValue(null),
            'email_template_pdf_template'=> $this->string(255)->null()->defaultValue(null),
        ], $tableOptions);


        $this->createTable('{{%works_salesinvoicesetting}}',[
            'setting_id'=> $this->primaryKey(11),
            'setting_key'=> $this->string(50)->notNull(),
            'setting_value'=> $this->text()->notNull(),
        ], $tableOptions);

        $this->createIndex('setting_key','{{%works_salesinvoicesetting}}',['setting_key'],false);

        $this->createTable('{{%works_salesinvoicemethodpay}}',[
            'payment_method_id'=> $this->primaryKey(11),
            'payment_method_name'=> $this->text()->null()->defaultValue(null),
        ], $tableOptions);


        $this->createTable('{{%works_salesinvoicepayment}}',[
            'payment_id'=> $this->primaryKey(11),
            'invoice_id'=> $this->integer(11)->notNull(),
            'payment_method_id'=> $this->integer(11)->notNull(),
            'payment_date'=> $this->date()->notNull(),
            'payment_amount'=> $this->decimal(20, 2)->notNull()->defaultValue('0.00'),
            'payment_note'=> $this->text()->null()->defaultValue(null),
        ], $tableOptions);

        $this->createIndex('invoice_id','{{%works_salesinvoicepayment}}',['invoice_id'],false);
        $this->createIndex('payment_method_id','{{%works_salesinvoicepayment}}',['payment_method_id'],false);

        $this->createTable('{{%works_salesinvoicestatus}}',[
            'id'=> $this->primaryKey(11),
            'const'=> $this->integer(2)->notNull(),
            'code'=> $this->string(10)->notNull()->defaultValue('E'),
            'code_meaning'=> $this->string(100)->notNull(),
            'include'=> $this->tinyInteger(1)->notNull()->defaultValue(1),
            'modified_date'=> $this->timestamp()->null()->defaultExpression("CURRENT_TIMESTAMP"),
        ], $tableOptions);


        $this->createTable('{{%works_salesinvoicemerchantresponse}}',[
            'merchant_response_id'=> $this->primaryKey(11),
            'invoice_id'=> $this->integer(11)->notNull(),
            'merchant_response_successful'=> $this->tinyInteger(1)->null()->defaultValue(1),
            'merchant_response_date'=> $this->date()->notNull(),
            'merchant_response_driver'=> $this->string(35)->notNull(),
            'merchant_response'=> $this->string(255)->notNull(),
            'merchant_response_reference'=> $this->string(255)->notNull(),
        ], $tableOptions);


        $this->createTable('{{%works_salesinvoiceuploads}}',[
            'upload_id'=> $this->primaryKey(11),
            'product_id'=> $this->integer(11)->notNull(),
            'url_key'=> $this->char(32)->notNull(),
            'file_name_original'=> $this->text()->notNull(),
            'file_name_new'=> $this->text()->notNull(),
            'uploaded_date'=> $this->date()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk_works_salesinvoiceamount_invoice_id',
            '{{%works_salesinvoiceamount}}', 'invoice_id',
            '{{%works_salesinvoice}}', 'invoice_id',
            'NO ACTION', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_works_salesinvoicepayment_invoice_id',
            '{{%works_salesinvoicepayment}}', 'invoice_id',
            '{{%works_salesinvoice}}', 'invoice_id',
            'NO ACTION', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_works_salesinvoicepayment_payment_method_id',
            '{{%works_salesinvoicepayment}}', 'payment_method_id',
            '{{%works_salesinvoicemethodpay}}', 'payment_method_id',
            'NO ACTION', 'NO ACTION'
        );
    }

    public function safeDown()
    {
            $this->dropForeignKey('fk_works_salesinvoiceamount_invoice_id', '{{%works_salesinvoiceamount}}');
            $this->dropForeignKey('fk_works_salesinvoicepayment_invoice_id', '{{%works_salesinvoicepayment}}');
            $this->dropForeignKey('fk_works_salesinvoicepayment_payment_method_id', '{{%works_salesinvoicepayment}}');
            $this->dropTable('{{%works_salesinvoice}}');
            $this->dropTable('{{%works_salesinvoiceamount}}');
            $this->dropTable('{{%works_salesinvoiceemailtemplate}}');
            $this->dropTable('{{%works_salesinvoicesetting}}');
            $this->dropTable('{{%works_salesinvoicemethodpay}}');
            $this->dropTable('{{%works_salesinvoicepayment}}');
            $this->dropTable('{{%works_salesinvoicestatus}}');
            $this->dropTable('{{%works_salesinvoicemerchantresponse}}');
            $this->dropTable('{{%works_salesinvoiceuploads}}');
    }
}
