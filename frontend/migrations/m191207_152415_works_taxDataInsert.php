<?php
Namespace frontend\migrations;

use yii\db\Migration;

class m191207_152415_works_taxDataInsert extends Migration
{

    public function safeUp()
    {
        $this->batchInsert('{{%works_tax}}',
                           ["tax_id", "tax_type", "tax_name", "tax_percentage"],
                            [
    [
        'tax_id' => '1',
        'tax_type' => '00',
        'tax_name' => 'Zero',
        'tax_percentage' => '0.00',
    ],
    [
        'tax_id' => '2',
        'tax_type' => '01',
        'tax_name' => 'Standard',
        'tax_percentage' => '0.20',
    ],
    [
        'tax_id' => '3',
        'tax_type' => '02',
        'tax_name' => 'Exempt',
        'tax_percentage' => '0.00',
    ],
    [
        'tax_id' => '4',
        'tax_type' => '03',
        'tax_name' => 'Available',
        'tax_percentage' => '0.00',
    ],
    [
        'tax_id' => '5',
        'tax_type' => '04',
        'tax_name' => 'Available',
        'tax_percentage' => '0.00',
    ],
    [
        'tax_id' => '6',
        'tax_type' => '05',
        'tax_name' => 'Reduced',
        'tax_percentage' => '0.05',
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%works_tax}} CASCADE');
    }
}
