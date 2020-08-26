<?php
Namespace frontend\migrations;

use yii\db\Migration;

class m200611_152727_add_image_source_filename_column_image_web_filename_column_to_works_product extends Migration
{

    public function safeUp()
    {
         $this->addColumn('works_product','image_source_filename',  $this->string(255)->null()->defaultValue(null));
         $this->addColumn('works_product','image_web_filename',  $this->string(255)->null()->defaultValue(null));
    }

    public function safeDown()
    {
        $this->dropColumn('works_product','image_source_filename');
        $this->dropColumn('works_product','image_web_filename');
    }
}
