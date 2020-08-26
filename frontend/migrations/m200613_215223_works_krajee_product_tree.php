<?php
Namespace frontend\migrations;

use yii\db\Migration;

class m200613_215223_works_krajee_product_tree extends Migration
{

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%works_krajee_product_tree}}',
            [
                'id'=> $this->primaryKey(11),
                'root'=> $this->integer(11)->null()->defaultValue(null),
                'lft'=> $this->integer(11)->notNull(),
                'rgt'=> $this->integer(11)->notNull(),
                'lvl'=> $this->smallInteger(5)->notNull(),
                'name'=> $this->string(60)->notNull(),
                'icon'=> $this->string(255)->null()->defaultValue(null),
                'icon_type'=> $this->tinyInteger(1)->notNull()->defaultValue(1),
                'active'=> $this->tinyInteger(1)->notNull()->defaultValue(1),
                'selected'=> $this->tinyInteger(1)->notNull()->defaultValue(0),
                'disabled'=> $this->tinyInteger(1)->notNull()->defaultValue(0),
                'readonly'=> $this->tinyInteger(1)->notNull()->defaultValue(0),
                'visible'=> $this->tinyInteger(1)->notNull()->defaultValue(1),
                'collapsed'=> $this->tinyInteger(1)->notNull()->defaultValue(0),
                'movable_u'=> $this->tinyInteger(1)->notNull()->defaultValue(1),
                'movable_d'=> $this->tinyInteger(1)->notNull()->defaultValue(1),
                'movable_l'=> $this->tinyInteger(1)->notNull()->defaultValue(1),
                'movable_r'=> $this->tinyInteger(1)->notNull()->defaultValue(1),
                'removable'=> $this->tinyInteger(1)->notNull()->defaultValue(1),
                'removable_all'=> $this->tinyInteger(1)->notNull()->defaultValue(0),
                'child_allowed'=> $this->tinyInteger(1)->notNull()->defaultValue(0),
            ],$tableOptions
        );
        $this->createIndex('tbl_product_NK1','{{%works_krajee_product_tree}}',['root'],false);
        $this->createIndex('tbl_product_NK2','{{%works_krajee_product_tree}}',['lft'],false);
        $this->createIndex('tbl_product_NK3','{{%works_krajee_product_tree}}',['rgt'],false);
        $this->createIndex('tbl_product_NK4','{{%works_krajee_product_tree}}',['lvl'],false);
        $this->createIndex('tbl_product_NK5','{{%works_krajee_product_tree}}',['active'],false);
    }

    public function safeDown()
    {
        $this->dropIndex('tbl_product_NK1', '{{%works_krajee_product_tree}}');
        $this->dropIndex('tbl_product_NK2', '{{%works_krajee_product_tree}}');
        $this->dropIndex('tbl_product_NK3', '{{%works_krajee_product_tree}}');
        $this->dropIndex('tbl_product_NK4', '{{%works_krajee_product_tree}}');
        $this->dropIndex('tbl_product_NK5', '{{%works_krajee_product_tree}}');
        $this->dropTable('{{%works_krajee_product_tree}}');
    }
}
