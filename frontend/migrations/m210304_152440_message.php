<?php

use yii\db\Schema;
use yii\db\Migration;

class m210304_152440_message extends Migration
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
            '{{%message}}',
            [
                'id'=> $this->integer(11)->notNull(),
                'language'=> $this->string(16)->notNull(),
                'translation'=> $this->text()->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('idx_message_language','{{%message}}',['language'],false);
        $this->addPrimaryKey('pk_on_message','{{%message}}',['id','language']);

    }

    public function safeDown()
    {
    $this->dropPrimaryKey('pk_on_message','{{%message}}');
        $this->dropIndex('idx_message_language', '{{%message}}');
        $this->dropTable('{{%message}}');
    }
}
