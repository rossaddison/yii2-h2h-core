<?php
Namespace frontend\migrations;

use yii\db\Migration;

class m200521_152727_works_historyline extends Migration
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
            '{{%works_historyline}}',
            [
                'id'=> $this->primaryKey(11),
                'start'=> $this->date()->null()->defaultValue(null),
                'stop'=> $this->date()->null()->defaultValue(null),
                'post_start'=> $this->date()->null()->defaultValue(null),
                'pre_stop'=> $this->date()->null()->defaultValue(null),
                'class'=> $this->string(100)->null()->defaultValue(null),
                'text'=> $this->string(100)->null()->defaultValue(null),
                'controller_name'=> $this->string(25)->null()->defaultValue(null),
                'controller_action'=> $this->string(25)->null()->defaultValue(null),
                'controller_action_id'=> $this->string(25)->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%works_historyline}}');
    }
}
