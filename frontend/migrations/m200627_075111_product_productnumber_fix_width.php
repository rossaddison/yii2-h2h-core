<?php
Namespace frontend\migrations;

use frontend\models\Product;
use yii\db\Migration;

class m200627_075111_product_productnumber_fix_width extends Migration
{
    public function safeUp()
    {
	$this->alterColumn(
            Product::tableName(),
            'productnumber',
            'VARCHAR(25) NOT NULL'
        );
    }

    public function safeDown()
    {
        $this->alterColumn(
            Product::tableName(),
            'productnumber',
            'VARCHAR(10) NOT NULL'
        );
    }
}
