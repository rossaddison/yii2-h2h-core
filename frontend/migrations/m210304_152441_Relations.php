<?php

use yii\db\Schema;
use yii\db\Migration;

class m210304_152441_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_message_id',
            '{{%message}}','id',
            '{{%source_message}}','id',
            'NO ACTION','NO ACTION'
         );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_message_id', '{{%message}}');
    }
}
