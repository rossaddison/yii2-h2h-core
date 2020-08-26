<?php
Namespace frontend\migrations;

use yii\db\Migration;

class m191110_221831_Mass extends Migration
{

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable('{{%works_carousal}}',[
            'id'=> $this->primaryKey(11),
            'image_source_filename'=> $this->string(255)->notNull(),
            'image_web_filename'=> $this->string(255)->notNull(),
            'content_alt'=> $this->string(255)->notNull(),
            'content_title'=> $this->string(255)->notNull(),
            'content_caption'=> $this->string(255)->notNull(),
            'fontcolor'=> $this->string(20)->notNull(),
        ], $tableOptions);


        $this->createTable('{{%works_company}}',[
                'id'=> $this->primaryKey(11),
                'name'=> $this->string(100)->notNull(),
                'address_street'=> $this->string(50)->null()->defaultValue(null),
                'address_area1'=> $this->string(50)->null()->defaultValue(null),
                'address_area2'=> $this->string(50)->null()->defaultValue(null),
                'address_areacode'=> $this->string(9)->null()->defaultValue(null),
                'telephone'=> $this->string(15)->null()->defaultValue(null),
                'external_website_url'=> $this->string(100)->null()->defaultValue(null),
                'email'=> $this->string(128)->null()->defaultValue(null),
                'twilio_telephone'=> $this->string(15)->null()->defaultValue(null),
                'fax'=> $this->string(11)->null()->defaultValue(null),
                'finyear_start_date'=> $this->string(20)->null()->defaultValue(null),
                'finyear_end_date'=> $this->string(20)->null()->defaultValue(null),
                'corp_tax_duedate'=> $this->string(11)->null()->defaultValue(null),
                'company_regno'=> $this->string(8)->null()->defaultValue(null),
                'vat_no'=> $this->string(10)->null()->defaultValue(null),
                'alt_reg_name'=> $this->string(25)->null()->defaultValue(null),
                'alt_reg_no'=> $this->string(10)->null()->defaultValue(null),
                'alt_expiry_date'=> $this->string(20)->null()->defaultValue(null),
                'alt2_reg_name'=> $this->string(25)->null()->defaultValue(null),
                'alt2_reg_no'=> $this->string(10)->null()->defaultValue(null),
                'alt2_expiry_date'=> $this->string(20)->null()->defaultValue(null),
                'sic_name'=> $this->string(100)->null()->defaultValue(null),
                'sic_code'=> $this->string(10)->null()->defaultValue(null),
                'sic2_name'=> $this->string(100)->null()->defaultValue(null),
                'sic2_code'=> $this->string(10)->null()->defaultValue(null),
                'salesorderheader_excludefullypaid'=> $this->tinyInteger(1)->notNull()->defaultValue(0),
                'costheader_excludefullypaid'=> $this->tinyInteger(1)->notNull()->defaultValue(0),
                'homepage'=> $this->string(10000)->null()->defaultValue(null),
                'gc_accesstoken'=> $this->string(50)->null()->defaultValue(null),
                'gc_live_or_sandbox'=> "enum('SANDBOX', 'LIVE') NULL DEFAULT 'SANDBOX'",
                'smtp_transport_host'=> $this->string(50)->null()->defaultValue(null),
                'smtp_transport_username'=> $this->string(50)->null()->defaultValue(null),
                'smtp_transport_password'=> $this->string(50)->null()->defaultValue(null),
                'smtp_transport_port'=> $this->integer(11)->null()->defaultValue(null),
                'smtp_transport_encryption'=> "enum('', 'null', 'tls', 'ssl') NOT NULL DEFAULT 'tls'",
                'google_translate_json_filename_and_path'=> $this->string(200)->null()->defaultValue(null),
                'language'=> $this->string(16)->null()->defaultValue(null),
                'currency_prefix'=> $this->string(16)->null()->defaultValue(null),
                'currency_suffix'=> $this->string(16)->null()->defaultValue(null),
            ],$tableOptions);


        $this->createTable('{{%works_cost}}',[
            'id'=> $this->primaryKey(11),
            'description'=> $this->string(100)->notNull(),
            'costnumber'=> $this->string(10)->notNull(),
            'frequency'=> "enum('Daily', 'Weekly', 'Fortnightly', 'Monthly', 'Every two months', 'Other') NOT NULL",
            'listprice'=> $this->decimal(7, 2)->notNull(),
            'costcategory_id'=> $this->integer(11)->notNull(),
            'costsubcategory_id'=> $this->integer(11)->notNull(),
            'costcodefirsthalf'=> $this->string(4)->notNull(),
            'costcodesecondhalf'=> $this->string(3)->notNull(),
            'coststartdate'=> $this->timestamp()->null()->defaultValue(null),
            'costenddate'=> $this->date()->null()->defaultValue('2099-12-31'),
            'discontinueddate'=> $this->timestamp()->null()->defaultValue(null),
            'modifieddate'=> $this->timestamp()->null()->defaultExpression("CURRENT_TIMESTAMP"),
        ], $tableOptions);

        $this->createIndex('fk_cost_costsubcategory_idx','{{%works_cost}}',['costsubcategory_id'],false);
        $this->createIndex('costsubcategory_id','{{%works_cost}}',['costsubcategory_id'],false);
        $this->createIndex('costcategory_id','{{%works_cost}}',['costcategory_id'],false);

        $this->createTable('{{%works_costcategory}}',[
            'id'=> $this->primaryKey(11),
            'name'=> $this->string(50)->notNull(),
            'description'=> $this->string(50)->null()->defaultValue(null),
            'tax_id'=> $this->integer(2)->notNull(),
            'modifieddate'=> $this->timestamp()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
        ], $tableOptions);

        $this->createIndex('tax_id','{{%works_costcategory}}',['tax_id'],false);

        $this->createTable('{{%works_costdetail}}',[
            'cost_header_id'=> $this->integer(11)->notNull(),
            'cost_detail_id'=> $this->primaryKey(11),
            'paymenttype'=> "enum('Cash', 'Cheque', 'Paypal', 'Debitcard', 'Creditcard', 'Other') NOT NULL",
            'paymentreference'=>$this->string(20)->null()->defaultValue(null),
            'nextcost_date'=> $this->date()->notNull(),
            'costcategory_id'=> $this->integer(11)->notNull(),
            'costsubcategory_id'=> $this->integer(11)->notNull(),
            'cost_id'=> $this->integer(11)->notNull(),
            'carousal_id'=> $this->integer(11)->null()->defaultValue(null),
            'order_qty'=> $this->integer(11)->notNull()->defaultValue(1),
            'unit_price'=> $this->decimal(9, 2)->notNull(),
            'line_total'=> $this->integer(11)->notNull(),
            'paid'=> $this->decimal(9, 2)->notNull(),
            'modified_date'=> $this->timestamp()->null()->defaultExpression("CURRENT_TIMESTAMP"),
        ], $tableOptions);

        $this->createIndex('cost_detail_id','{{%works_costdetail}}',['cost_detail_id'],true);
        $this->createIndex('fk_costdetail_costheader_idx','{{%works_costdetail}}',['cost_header_id'],false);
        $this->createIndex('fk_costdetail_cost_idx','{{%works_costdetail}}',['cost_id'],false);
        $this->createIndex('fk_costdetail_carousal_idx','{{%works_costdetail}}',['carousal_id'],false);
        $this->createIndex('nextcost_date','{{%works_costdetail}}',['nextcost_date'],false);
        $this->createIndex('cost_header_id','{{%works_costdetail}}',['cost_header_id'],false);
        $this->createIndex('cost_header_detail_id_1','{{%works_costdetail}}',['cost_detail_id'],false);

        $this->createTable('{{%works_costheader}}',[
            'cost_header_id'=> $this->primaryKey(11),
            'status'=> $this->string(20)->notNull(),
            'statusfile'=> $this->string(20)->notNull(),
            'employee_id'=> $this->integer(11)->notNull(),
            'cost_date'=> $this->date()->notNull(),
            'sub_total'=> $this->decimal(7, 2)->null()->defaultValue(null),
            'tax_amt'=> $this->decimal(7, 2)->null()->defaultValue(null),
            'total_due'=> $this->decimal(7, 2)->null()->defaultValue(null),
            'modified_date'=> $this->timestamp()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
        ], $tableOptions);

        $this->createIndex('fk_costheader_employee_idx','{{%works_costheader}}',['employee_id'],false);

        $this->createTable('{{%works_costsubcategory}}',[
            'id'=> $this->primaryKey(11),
            'costcategory_id'=> $this->integer(11)->notNull(),
            'name'=> $this->string(50)->notNull(),
            'modifieddate'=> $this->timestamp()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
        ], $tableOptions);

        $this->createIndex('fk_costsubcategory_costcategory_idx','{{%works_costsubcategory}}',['costcategory_id'],false);

        $this->createTable('{{%works_development}}',[
            'id'=> $this->primaryKey(11),
            'url'=> $this->string(300)->notNull(),
            'description'=> $this->string(300)->notNull(),
            'code'=> $this->string(2000)->notNull(),
        ], $tableOptions);


        $this->createTable('{{%works_employee}}',[
            'id'=> $this->primaryKey(11),
            'nationalinsnumber'=> $this->string(9)->notNull(),
            'contact_telno'=> $this->string(11)->null()->defaultValue(null),
            'title'=> $this->string(50)->notNull(),
            'birthdate'=> $this->date()->notNull()->defaultValue('1980-01-01'),
            'maritalstatus'=> $this->string(8)->notNull(),
            'gender'=> $this->string(6)->notNull(),
            'hiredate'=> $this->date()->notNull()->defaultValue('1980-01-01'),
            'salariedflag'=> $this->string(30)->notNull(),
            'vacationhours'=> $this->integer(11)->notNull(),
            'sickleavehours'=> $this->integer(11)->notNull(),
            'currentflag'=> $this->string(11)->notNull(),
            'modifieddate'=> $this->timestamp()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
        ], $tableOptions);

        $this->createIndex('nationalinsnumber','{{%works_employee}}',['nationalinsnumber'],true);

        $this->createTable('{{%works_gocardless_invoice}}',[
            'id'=> $this->primaryKey(11),
            'invoicenumber'=> $this->string(25)->notNull(),
            'product_id'=> $this->integer(11)->notNull(),
            'payment_id'=> $this->string(20)->notNull(),
            'date'=> $this->datetime()->notNull(),
            'amount'=> $this->decimal(9, 2)->notNull(),
        ], $tableOptions);

        $this->createIndex('product_id','{{%works_gocardless_invoice}}',['product_id'],false);

        $this->createTable('{{%works_instruction}}',[
            'id'=> $this->primaryKey(11),
            'code'=> $this->string(10)->notNull()->defaultValue('E'),
            'code_meaning'=> $this->string(100)->notNull(),
            'include'=> $this->tinyInteger(1)->notNull()->defaultValue(1),
            'modified_date'=> $this->timestamp()->null()->defaultExpression("CURRENT_TIMESTAMP"),
        ], $tableOptions);


        $this->createTable('{{%works_messagelog}}',[
            'id'=> $this->primaryKey(11),
            'message'=> $this->string(255)->notNull(),
            'date'=> $this->date()->notNull(),
            'phoneto'=> $this->string(20)->notNull(),
            'salesorderdetail_id'=> $this->integer(11)->notNull(),
            'product_id'=> $this->integer(11)->notNull(),
        ], $tableOptions);

        $this->createIndex('salesorderdetail_id','{{%works_messagelog}}',['salesorderdetail_id'],false);
        $this->createIndex('product_id','{{%works_messagelog}}',['product_id'],false);

        $this->createTable('{{%works_messaging}}',[
            'id'=> $this->primaryKey(11),
            'message'=> $this->string(255)->notNull(),
        ], $tableOptions);


        $this->createTable('{{%works_paymentrequest}}',[
            'id'=> $this->primaryKey(11),
            'sales_order_detail_id'=> $this->integer(11)->notNull(),
            'gc_payment_request_id'=> $this->string(7)->notNull(),
            'status'=> $this->string(25)->notNull(),
            'modified_date'=> $this->timestamp()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
        ], $tableOptions);

        $this->createIndex('gc_payment_request_id','{{%works_paymentrequest}}',['gc_payment_request_id'],false);
        $this->createIndex('sales_order_detail_id','{{%works_paymentrequest}}',['sales_order_detail_id'],false);

        $this->createTable('{{%works_product}}',[
            'id'=> $this->primaryKey(11),
            'name'=> $this->string(60)->notNull(),
            'surname'=> $this->string(60)->notNull(),
            'email'=> $this->string(50)->notNull(),
            'productnumber'=> $this->string(10)->notNull(),
            'contactmobile'=> $this->string(11)->notNull(),
            'specialrequest'=> $this->string(100)->notNull(),
            'frequency'=> "enum('Weekly', 'Fortnightly', 'Monthly', 'Every two months', 'Not applicable') NOT NULL",
            'listprice'=> $this->decimal(7, 2)->notNull(),
            'productcategory_id'=> $this->integer(11)->notNull(),
            'productsubcategory_id'=> $this->integer(11)->notNull(),
            'postcodefirsthalf'=> $this->string(4)->notNull(),
            'postcodesecondhalf'=> $this->string(3)->notNull(),
            'mandate'=> $this->string(250)->null()->defaultValue(null),
            'gc_number'=> $this->string(50)->null()->defaultValue(null),
            'confirmation_url'=> $this->string(100)->null()->defaultValue(null),
            'sellstartdate'=> $this->timestamp()->null()->defaultValue(null),
            'sellenddate'=> $this->date()->null()->defaultValue('2099-12-31'),
            'discontinueddate'=> $this->timestamp()->null()->defaultValue(null),
            'modifieddate'=> $this->timestamp()->null()->defaultExpression("CURRENT_TIMESTAMP"),
            'isactive'=> $this->tinyInteger(1)->notNull()->defaultValue(1),
            'jobcode'=> $this->string(20)->null()->defaultValue(null),
        ], $tableOptions);

        $this->createIndex('productsubcategory_id','{{%works_product}}',['productsubcategory_id'],false);
        $this->createIndex('productcategory_id','{{%works_product}}',['productcategory_id'],false);

        $this->createTable('{{%works_productcategory}}',[
            'id'=> $this->primaryKey(11),
            'name'=> $this->string(250)->notNull(),
            'description'=> $this->string(50)->notNull(),
            'tax_id'=> $this->integer(2)->notNull(),
            'modifieddate'=> $this->timestamp()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
        ], $tableOptions);

        $this->createIndex('tax_id','{{%works_productcategory}}',['tax_id'],false);

        $this->createTable('{{%works_productsubcategory}}',[
            'id'=> $this->primaryKey(11),
            'productcategory_id'=> $this->integer(11)->notNull(),
            'name'=> $this->string(250)->notNull(),
            'lat_start'=> $this->double(10, 7)->notNull(),
            'lng_start'=> $this->double(10, 7)->notNull(),
            'lat_finish'=> $this->double(10, 7)->notNull(),
            'lng_finish'=> $this->double(10, 7)->notNull(),
            'directions_to_next_productsubcategory'=> $this->string(5000)->null()->defaultValue(null),
            'sort_order'=> $this->integer(11)->notNull(),
            'modifieddate'=> $this->timestamp()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
            'isactive'=> $this->tinyInteger(1)->notNull()->defaultValue(1),
        ], $tableOptions);

        $this->createIndex('fk_productsubcategory_productcategory_idx','{{%works_productsubcategory}}',['productcategory_id'],false);

        $this->createTable('{{%works_quicknote}}',
            [
                'id'=> $this->primaryKey(11),
                'note'=> $this->string(5000)->notNull(),
                'created_at'=> $this->timestamp()->null()->defaultValue(null),
                'updated_at'=> $this->timestamp()->null()->defaultValue(null),
                'modified_at'=> $this->timestamp()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
            ],$tableOptions
        );
        
        $this->createTable('{{%works_quotation}}',[
            'id'=> $this->primaryKey(11),
            'email'=> $this->string(100)->notNull(),
            'mobile'=> $this->string(11)->notNull(),
            'postalcode'=> $this->string(10)->notNull(),
            'housenumber'=> $this->integer(11)->notNull(),
            'streetname'=> $this->string(100)->notNull(),
            'specialrequest'=> $this->string(500)->notNull(),
            'preferredquoteamount'=> $this->integer(2)->notNull(),
            'building'=> $this->string(100)->notNull(),
            'windowsnumber'=> $this->integer(2)->notNull(),
            'regularity'=> $this->string(50)->notNull(),
            'quoteamount'=> $this->integer(2)->notNull(),
            'acceptedamount'=> $this->integer(2)->notNull(),
        ], $tableOptions);

        $this->createTable('{{%works_salesorderdetail}}',[
            'sales_order_id'=> $this->integer(11)->notNull(),
            'sales_order_detail_id'=> $this->primaryKey(11),
            'cleaned'=> "enum('Cleaned', 'Missed', 'Not cleaned', 'Fronts Done Only', 'Backs Done Only') NOT NULL",
            'instruction_id'=> $this->integer(11)->notNull()->defaultValue(1),
            'nextclean_date'=> $this->date()->notNull(),
            'productcategory_id'=> $this->integer(11)->notNull(),
            'productsubcategory_id'=> $this->integer(11)->notNull(),
            'product_id'=> $this->integer(11)->notNull(),
            'order_qty'=> $this->integer(11)->notNull()->defaultValue(1),
            'pre_payment'=> $this->decimal(7, 2)->notNull()->defaultValue('0.00'),
            'unit_price'=> $this->decimal(9, 2)->notNull(),
            'line_total'=> $this->integer(11)->notNull(),
            'paid'=> $this->decimal(9, 2)->notNull()->defaultValue('0.00'),
            'advance_payment'=> $this->decimal(9, 2)->notNull()->defaultValue('0.00'),
            'tip'=> $this->decimal(7, 2)->notNull()->defaultValue('0.00'),
            'modified_date'=> $this->timestamp()->null()->defaultExpression("CURRENT_TIMESTAMP"),
        ], $tableOptions);

        $this->createIndex('sales_order_detail_id','{{%works_salesorderdetail}}',['sales_order_detail_id'],true);
        $this->createIndex('fk_salesorderdetail_salesorderheader_idx','{{%works_salesorderdetail}}',['sales_order_id'],false);
        $this->createIndex('fk_salesorderdetail_product_idx','{{%works_salesorderdetail}}',['product_id'],false);
        $this->createIndex('nextclean_date','{{%works_salesorderdetail}}',['nextclean_date'],false);
        $this->createIndex('sales_order_id','{{%works_salesorderdetail}}',['sales_order_id'],false);

        $this->createTable('{{%works_salesorderheader}}',[
            'sales_order_id'=> $this->primaryKey(11),
            'status'=> $this->string(20)->notNull(),
            'statusfile'=> $this->string(20)->null()->defaultValue(null),
            'employee_id'=> $this->integer(11)->notNull(),
            'carousal_id'=> $this->integer(11)->notNull()->defaultValue(1),
            'clean_date'=> $this->date()->notNull(),
            'hoursworked'=> $this->decimal(7, 2)->notNull()->defaultValue('8.00'),
            'sub_total'=> $this->decimal(7, 2)->null()->defaultValue(null),
            'tax_amt'=> $this->decimal(7, 2)->null()->defaultValue(null),
            'total_due'=> $this->decimal(7, 2)->null()->defaultValue(null),
            'income_per_hour'=> $this->decimal(7, 2)->null()->defaultValue(null),
            'modified_date'=> $this->timestamp()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
        ], $tableOptions);

        $this->createIndex('fk_salesorderheader_employee_idx','{{%works_salesorderheader}}',['employee_id'],false);
        $this->createIndex('fx_salesorderheader_carousal_idx','{{%works_salesorderheader}}',['carousal_id'],false);

        $this->createTable('{{%works_tax}}',[
            'tax_id'=> $this->primaryKey(2),
            'tax_type'=> $this->string(2)->notNull(),
            'tax_name'=> $this->string(30)->notNull(),
            'tax_percentage'=> $this->decimal(10, 2)->notNull(),
        ], $tableOptions);

        $this->createIndex('tax_id','{{%works_tax}}',['tax_id'],false);
        $this->addForeignKey(
            'fk_works_cost_costsubcategory_id',
            '{{%works_cost}}', 'costsubcategory_id',
            '{{%works_costsubcategory}}', 'id',
            'NO ACTION', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_works_cost_costcategory_id',
            '{{%works_cost}}', 'costcategory_id',
            '{{%works_costcategory}}', 'id',
            'NO ACTION', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_works_costcategory_tax_id',
            '{{%works_costcategory}}', 'tax_id',
            '{{%works_tax}}', 'tax_id',
            'NO ACTION', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_works_costdetail_cost_id',
            '{{%works_costdetail}}', 'cost_id',
            '{{%works_cost}}', 'id',
            'NO ACTION', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_works_costdetail_cost_header_id',
            '{{%works_costdetail}}', 'cost_header_id',
            '{{%works_costheader}}', 'cost_header_id',
            'NO ACTION', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_works_costheader_employee_id',
            '{{%works_costheader}}', 'employee_id',
            '{{%works_employee}}', 'id',
            'NO ACTION', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_works_costsubcategory_costcategory_id',
            '{{%works_costsubcategory}}', 'costcategory_id',
            '{{%works_costcategory}}', 'id',
            'NO ACTION', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_works_gocardless_invoice_product_id',
            '{{%works_gocardless_invoice}}', 'product_id',
            '{{%works_product}}', 'id',
            'NO ACTION', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_works_messagelog_product_id',
            '{{%works_messagelog}}', 'product_id',
            '{{%works_product}}', 'id',
            'NO ACTION', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_works_messagelog_salesorderdetail_id',
            '{{%works_messagelog}}', 'salesorderdetail_id',
            '{{%works_salesorderdetail}}', 'sales_order_detail_id',
            'NO ACTION', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_works_product_productsubcategory_id',
            '{{%works_product}}', 'productsubcategory_id',
            '{{%works_productsubcategory}}', 'id',
            'NO ACTION', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_works_product_productcategory_id',
            '{{%works_product}}', 'productcategory_id',
            '{{%works_productcategory}}', 'id',
            'NO ACTION', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_works_productcategory_tax_id',
            '{{%works_productcategory}}', 'tax_id',
            '{{%works_tax}}', 'tax_id',
            'NO ACTION', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_works_productsubcategory_productcategory_id',
            '{{%works_productsubcategory}}', 'productcategory_id',
            '{{%works_productcategory}}', 'id',
            'NO ACTION', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_works_salesorderdetail_product_id',
            '{{%works_salesorderdetail}}', 'product_id',
            '{{%works_product}}', 'id',
            'NO ACTION', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_works_salesorderdetail_sales_order_id',
            '{{%works_salesorderdetail}}', 'sales_order_id',
            '{{%works_salesorderheader}}', 'sales_order_id',
            'NO ACTION', 'NO ACTION'
        );
        $this->addForeignKey(
            'fk_works_salesorderheader_employee_id',
            '{{%works_salesorderheader}}', 'employee_id',
            '{{%works_employee}}', 'id',
            'NO ACTION', 'NO ACTION'
        );
    }

    public function safeDown()
    {
            $this->dropForeignKey('fk_works_cost_costsubcategory_id', '{{%works_cost}}');
            $this->dropForeignKey('fk_works_cost_costcategory_id', '{{%works_cost}}');
            $this->dropForeignKey('fk_works_costcategory_tax_id', '{{%works_costcategory}}');
            $this->dropForeignKey('fk_works_costdetail_cost_id', '{{%works_costdetail}}');
            $this->dropForeignKey('fk_works_costdetail_cost_header_id', '{{%works_costdetail}}');
            $this->dropForeignKey('fk_works_costheader_employee_id', '{{%works_costheader}}');
            $this->dropForeignKey('fk_works_costsubcategory_costcategory_id', '{{%works_costsubcategory}}');
            $this->dropForeignKey('fk_works_gocardless_invoice_product_id', '{{%works_gocardless_invoice}}');
            $this->dropForeignKey('fk_works_messagelog_product_id', '{{%works_messagelog}}');
            $this->dropForeignKey('fk_works_messagelog_salesorderdetail_id', '{{%works_messagelog}}');
            $this->dropForeignKey('fk_works_product_productsubcategory_id', '{{%works_product}}');
            $this->dropForeignKey('fk_works_product_productcategory_id', '{{%works_product}}');
            $this->dropForeignKey('fk_works_productcategory_tax_id', '{{%works_productcategory}}');
            $this->dropForeignKey('fk_works_productsubcategory_productcategory_id', '{{%works_productsubcategory}}');
            $this->dropForeignKey('fk_works_salesorderdetail_product_id', '{{%works_salesorderdetail}}');
            $this->dropForeignKey('fk_works_salesorderdetail_sales_order_id', '{{%works_salesorderdetail}}');
            $this->dropForeignKey('fk_works_salesorderheader_employee_id', '{{%works_salesorderheader}}');
            $this->dropTable('{{%works_carousal}}');
            $this->dropTable('{{%works_company}}');
            $this->dropTable('{{%works_cost}}');
            $this->dropTable('{{%works_costcategory}}');
            $this->dropTable('{{%works_costdetail}}');
            $this->dropTable('{{%works_costheader}}');
            $this->dropTable('{{%works_costsubcategory}}');
            $this->dropTable('{{%works_development}}');
            $this->dropTable('{{%works_employee}}');
            $this->dropTable('{{%works_gocardless_invoice}}');
            $this->dropTable('{{%works_instruction}}');
            $this->dropTable('{{%works_messagelog}}');
            $this->dropTable('{{%works_messaging}}');
            $this->dropTable('{{%works_paymentrequest}}');
            $this->dropTable('{{%works_product}}');
            $this->dropTable('{{%works_productcategory}}');
            $this->dropTable('{{%works_productsubcategory}}');
            $this->dropTable('{{%works_quicknote}}');
            $this->dropTable('{{%works_quotation}}');        
            $this->dropTable('{{%works_salesorderdetail}}');
            $this->dropTable('{{%works_salesorderheader}}');
            $this->dropTable('{{%works_tax}}');
    }
}
