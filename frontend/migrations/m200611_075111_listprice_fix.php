<?php
Namespace frontend\migrations;

use frontend\models\Product;
use yii\db\Migration;

class m200611_075111_listprice_fix extends Migration
{
    public function safeUp()
    {
	$this->alterColumn(
            Product::tableName(),
            'listprice',
            'DECIMAL(7,2) NOT NULL'
        );
    }

    public function safeDown()
    {
        $this->alterColumn(
            Product::tableName(),
            'listprice',
            'DECIMAL(4,2) NOT NULL'
        );
    }
}
