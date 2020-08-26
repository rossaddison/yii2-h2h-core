<?php
namespace console\migrations\auth;

use yii\db\Migration;

class m200413_074000_auth_item_child extends Migration
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
            '{{%auth_item_child}}',
            [
                'parent'=> $this->string(64)->notNull(),
                'child'=> $this->string(64)->notNull(),
            ],$tableOptions
        );
        $this->createIndex('child','{{%auth_item_child}}',['child'],false);
        $this->addPrimaryKey('pk_on_auth_item_child','{{%auth_item_child}}',['parent','child']);

    }

    public function safeDown()
    {
    $this->dropPrimaryKey('pk_on_auth_item_child','{{%auth_item_child}}');
        $this->dropIndex('child', '{{%auth_item_child}}');
        $this->dropTable('{{%auth_item_child}}');
    }
}
