<?php

use yii\db\Schema;
use yii\db\Migration;

class m210304_152321_source_message extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%source_message}}',
            [
                'id'=> $this->primaryKey(11),
                'category'=> $this->string(255)->null()->defaultValue(null),
                'message'=> $this->text()->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('idx_source_message_category','{{%source_message}}',['category'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('idx_source_message_category', '{{%source_message}}');
        $this->dropTable('{{%source_message}}');
    }
}
