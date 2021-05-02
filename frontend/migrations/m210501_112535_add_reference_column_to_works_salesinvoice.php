<?php
Namespace frontend\migrations;

use yii\db\Migration;

class m210501_112535_add_reference_column_to_works_salesinvoice extends Migration
{

    public function safeUp()
    {
         $this->addColumn('works_salesinvoice','reference',  $this->string(8)->notNull());
    }

    public function safeDown()
    {
        $this->dropColumn('works_salesinvoice','reference');        
    }
}
