<?php
Namespace frontend\migrations;

use yii\db\Migration;

class m210303_210035_add_user_id_column_to_works_product extends Migration
{

    public function safeUp()
    {
         $this->addColumn('works_product','user_id',  $this->integer(11)->null()->defaultValue(null));
    }

    public function safeDown()
    {
        $this->dropColumn('works_product','user_id');        
    }
}
