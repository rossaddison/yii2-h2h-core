<?php

Namespace frontend\migrations;

use yii\db\Migration;

class m210503_215541_works_salesinvoicemethodpayDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%works_salesinvoicemethodpay}}',
                           ["payment_method_id", "payment_method_name"],
                            [
    [
        'payment_method_id' => '1',
        'payment_method_name' => 'Cash',
    ],
    [
        'payment_method_id' => '2',
        'payment_method_name' => 'Credit Card',
    ],
    [
        'payment_method_id' => '3',
        'payment_method_name' => 'BACS',
    ],
    [
        'payment_method_id' => '4',
        'payment_method_name' => 'Braintree',
    ],
    [
        'payment_method_id' => '5',
        'payment_method_name' => 'Elavon',
    ],                            
    [
        'payment_method_id' => '6',
        'payment_method_name' => 'Cybersource',
    ],
    [
        'payment_method_id' => '7',
        'payment_method_name' => 'Worldpay',
    ],                            
    ]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%works_salesinvoicemethodpay}} CASCADE');
    }
}
