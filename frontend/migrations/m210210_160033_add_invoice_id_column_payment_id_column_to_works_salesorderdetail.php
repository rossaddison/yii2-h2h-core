<?php
Namespace frontend\migrations;

use yii\db\Migration;

class m210210_160033_add_invoice_id_column_payment_id_column_to_works_salesorderdetail extends Migration
{

    public function safeUp()
    {
         $this->addColumn('works_salesorderdetail','invoice_id',  $this->integer(11)->null()->defaultValue(null));
         $this->addColumn('works_salesorderdetail','payment_id',  $this->integer(11)->null()->defaultValue(null));
    }

    public function safeDown()
    {
        $this->dropColumn('works_salesorderdetail','invoice_id');
        $this->dropColumn('works_salesorderdetail','payment_id');        
    }
}
