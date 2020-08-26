<?php
Namespace frontend\migrations;

use yii\db\Migration;

class m200621_152727_add_product_id_column_productsubcategory_id_column_productcategory_id_column_to_works_krajee_product_tree extends Migration
{

    public function safeUp()
    {
         $this->addColumn('works_krajee_product_tree','product_id',  $this->integer(11)->null()->defaultValue(null));
         $this->addColumn('works_krajee_product_tree','productsubcategory_id',  $this->integer(11)->null()->defaultValue(null));
         $this->addColumn('works_krajee_product_tree','productcategory_id',  $this->integer(11)->null()->defaultValue(null));
    }

    public function safeDown()
    {
        $this->dropColumn('works_krajee_product_tree','product_id');
        $this->dropColumn('works_krajee_product_tree','productsubcategory_id');
        $this->dropColumn('works_krajee_product_tree','productcategory_id');        
    }
}
