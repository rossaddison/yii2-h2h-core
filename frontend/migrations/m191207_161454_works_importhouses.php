<?php
Namespace frontend\migrations;

use yii\db\Migration;

class m191207_161454_works_importhouses extends Migration
{

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable('{{%works_importhouses}}',[
            'id'=> $this->primaryKey(11),
            'importfile_source_filename'=> $this->string(255)->notNull(),
            'importfile_web_filename'=> $this->string(255)->notNull(),
        ], $tableOptions);

    }

    public function safeDown()
    {
            $this->dropTable('{{%works_importhouses}}');
    }
}
