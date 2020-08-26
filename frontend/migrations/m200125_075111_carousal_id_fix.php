<?php
Namespace frontend\migrations;

use frontend\models\Salesorderheader;
use yii\db\Migration;

class m200125_075111_carousal_id_fix extends Migration
{
    public function safeUp()
    {
	$this->alterColumn(
            Salesorderheader::tableName(),
            'carousal_id',
            'INT(11) NULL DEFAULT NULL'
        );
    }

    public function safeDown()
    {
        $this->alterColumn(
            Salesorderheader::tableName(),
            'carousal_id',
            'INT(11) NOT NULL DEFAULT 1'
        );
    }
}
