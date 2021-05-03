<?php
namespace console\migrations\auth;

use yii\db\Migration;

class m200413_085036_auth_ruleDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%auth_rule}}',
                           ["name", "data", "created_at", "updated_at"],
                            [
    [
        'name' => 'hasNotRole',
        'data' => 'O:29:"sjaakp\\pluto\\rbac\\NotRoleRule":3:{s:4:"name";s:10:"hasNotRole";s:9:"createdAt";i:1577666562;s:9:"updatedAt";i:1577666562;}',
        'created_at' => '1577666562',
        'updated_at' => '1577666562',
    ],
    [
        'name' => 'hasRole',
        'data' => 'O:26:"sjaakp\\pluto\\rbac\\RoleRule":3:{s:4:"name";s:7:"hasRole";s:9:"createdAt";i:1577666562;s:9:"updatedAt";i:1577666562;}',
        'created_at' => '1577666562',
        'updated_at' => '1577666562',
    ],
    [
        'name' => 'isCreator',
        'data' => 'O:29:"sjaakp\\pluto\\rbac\\CreatorRule":3:{s:4:"name";s:9:"isCreator";s:9:"createdAt";i:1577666562;s:9:"updatedAt";i:1577666562;}',
        'created_at' => '1577666562',
        'updated_at' => '1577666562',
    ],
    [
        'name' => 'isCreatorOrUpdater',
        'data' => 'O:38:"sjaakp\\pluto\\rbac\\CreatorOrUpdaterRule":3:{s:4:"name";s:18:"isCreatorOrUpdater";s:9:"createdAt";i:1577666562;s:9:"updatedAt";i:1577666562;}',
        'created_at' => '1577666562',
        'updated_at' => '1577666562',
    ],
    [
        'name' => 'isUpdater',
        'data' => 'O:29:"sjaakp\\pluto\\rbac\\UpdaterRule":3:{s:4:"name";s:9:"isUpdater";s:9:"createdAt";i:1577666562;s:9:"updatedAt";i:1577666562;}',
        'created_at' => '1577666562',
        'updated_at' => '1577666562',
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%auth_rule}} CASCADE');
    }
}
