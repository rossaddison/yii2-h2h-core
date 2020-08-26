<?php
Namespace frontend\migrations;

use yii\db\Migration;

class m200708_152727_create_productnumber_index_works_product extends Migration
{

    public function safeUp()
    {
        //the name of the index is called productnumber 
        $this->createIndex('productnumber','works_product','productnumber', false);
    }

    public function safeDown()
    {
        $this->dropIndex('productnumber','works_product');             
    }
}
