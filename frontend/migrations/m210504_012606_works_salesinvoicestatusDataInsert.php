<?php

Namespace frontend\migrations;

use yii\db\Migration;

class m210504_012606_works_salesinvoicestatusDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%works_salesinvoicestatus}}',
                           ["id", "const", "code", "code_meaning", "include", "modified_date"],
                            [
    [
        'id' => '1',
        'const' => '10',
        'code' => 'D',
        'code_meaning' => 'Draft',
        'include' => '1',
        'modified_date' => '2020-11-07 18:28:30',
    ],
    [
        'id' => '2',
        'const' => '20',
        'code' => 'S',
        'code_meaning' => 'Sent',
        'include' => '1',
        'modified_date' => '2020-11-07 18:28:30',
    ],
    [
        'id' => '3',
        'const' => '30',
        'code' => 'V',
        'code_meaning' => 'Viewed',
        'include' => '1',
        'modified_date' => '2020-11-07 18:29:52',
    ],
    [
        'id' => '4',
        'const' => '40',
        'code' => 'P',
        'code_meaning' => 'Paid',
        'include' => '1',
        'modified_date' => '2020-11-07 18:29:52',
    ],
    [
        'id' => '5',
        'const' => '50',
        'code' => 'C',
        'code_meaning' => 'Cancelled',
        'include' => '1',
        'modified_date' => '2021-02-05 21:33:02',
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%works_salesinvoicestatus}} CASCADE');
    }
}
