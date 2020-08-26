<?php
Namespace frontend\migrations;

use yii\db\Migration;

class m200822_212212_session_detail extends Migration
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
            '{{%session_detail}}',
            [
                'session_detail_id'=> $this->primaryKey(11),
                'session_id'=> $this->char(40)->notNull(),
                'redirect_flow_id'=> $this->string(50)->notNull(),
                'db'=> $this->string(50)->notNull(),
                'product_id'=> $this->integer(11)->notNull(),
                'user_id'=> $this->integer(11)->notNull(),
                'customer_approved'=> $this->tinyInteger(1)->notNull()->defaultValue(0),
                'administrator_acknowledged'=> $this->tinyInteger(1)->notNull()->defaultValue(0),
            ],$tableOptions
        );
        $this->createIndex('fk_session_detail_to_session_idx','{{%session_detail}}',['session_id'],false);
        $this->createIndex('redirect_flow_id','{{%session_detail}}',['redirect_flow_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('fk_session_detail_to_session_idx', '{{%session_detail}}');
        $this->dropIndex('redirect_flow_id', '{{%session_detail}}');
        $this->dropTable('{{%session_detail}}');
    }
}
