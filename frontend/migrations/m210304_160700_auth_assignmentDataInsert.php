<?php
Namespace frontend\migrations;

use yii\db\Migration;

class m210304_160700_auth_assignmentDataInsert extends Migration
{

    public function safeUp()
    {
        $this->batchInsert('{{%auth_assignment}}',
                           ["item_name", "user_id", "created_at"],
                            [
    [
        'item_name' => 'admin',
        'user_id' => '1',
        'created_at' => '1580918286',
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%auth_assignment}} CASCADE');
    }
}
