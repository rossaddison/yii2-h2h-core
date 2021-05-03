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
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%works_salesinvoicemethodpay}} CASCADE');
    }
}
