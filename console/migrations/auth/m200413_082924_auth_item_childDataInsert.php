<?php
namespace console\migrations\auth;

use yii\db\Migration;

class m200413_082924_auth_item_childDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%auth_item_child}}',
                           ["parent", "child"],
                            [
    [
        'parent' => 'admin',
        'child' => 'Access db',
    ],
    [
        'parent' => 'Mdb0',
        'child' => 'Access db',
    ],
    [
        'parent' => 'Udb',
        'child' => 'Access db',
    ],
    [
        'parent' => 'Mdb1',
        'child' => 'Access db1',
    ],
    [
        'parent' => 'admin',
        'child' => 'Access paypalagreement',
    ],
    [
        'parent' => 'admin',
        'child' => 'Access Session',
    ],
    [
        'parent' => 'admin',
        'child' => 'Access Sessiondetail',
    ],
    [
        'parent' => 'admin',
        'child' => 'Backup Database',
    ],
    [
        'parent' => 'admin',
        'child' => 'Create Carousal',
    ],
    [
        'parent' => 'manager',
        'child' => 'Create Carousal',
    ],
    [
        'parent' => 'support',
        'child' => 'Create Carousal',
    ],
    [
        'parent' => 'admin',
        'child' => 'Create Company',
    ],
    [
        'parent' => 'admin',
        'child' => 'Create Daily Clean',
    ],
    [
        'parent' => 'manager',
        'child' => 'Create Daily Clean',
    ],
    [
        'parent' => 'support',
        'child' => 'Create Daily Clean',
    ],
    [
        'parent' => 'admin',
        'child' => 'Create Daily Job Sheet',
    ],
    [
        'parent' => 'manager',
        'child' => 'Create Daily Job Sheet',
    ],
    [
        'parent' => 'support',
        'child' => 'Create Daily Job Sheet',
    ],
    [
        'parent' => 'admin',
        'child' => 'Create Employee',
    ],
    [
        'parent' => 'manager',
        'child' => 'Create Employee',
    ],
    [
        'parent' => 'support',
        'child' => 'Create Employee',
    ],
    [
        'parent' => 'admin',
        'child' => 'Create Gocardlesscustomer',
    ],
    [
        'parent' => 'manager',
        'child' => 'Create Gocardlesscustomer',
    ],
    [
        'parent' => 'support',
        'child' => 'Create Gocardlesscustomer',
    ],
    [
        'parent' => 'admin',
        'child' => 'Create House',
    ],
    [
        'parent' => 'manager',
        'child' => 'Create House',
    ],
    [
        'parent' => 'support',
        'child' => 'Create House',
    ],
    [
        'parent' => 'admin',
        'child' => 'Create Instruction',
    ],
    [
        'parent' => 'manager',
        'child' => 'Create Instruction',
    ],
    [
        'parent' => 'support',
        'child' => 'Create Instruction',
    ],
    [
        'parent' => 'admin',
        'child' => 'Create Legal',
    ],
    [
        'parent' => 'manager',
        'child' => 'Create Legal',
    ],
    [
        'parent' => 'support',
        'child' => 'Create Legal',
    ],                            
    [
        'parent' => 'admin',
        'child' => 'Create Mandate',
    ],
    [
        'parent' => 'manager',
        'child' => 'Create Mandate',
    ],
    [
        'parent' => 'support',
        'child' => 'Create Mandate',
    ],
    [
        'parent' => 'admin',
        'child' => 'Create Messagelog',
    ],
    [
        'parent' => 'manager',
        'child' => 'Create Messagelog',
    ],
    [
        'parent' => 'support',
        'child' => 'Create Messagelog',
    ],
    [
        'parent' => 'admin',
        'child' => 'Create Messaging',
    ],
    [
        'parent' => 'manager',
        'child' => 'Create Messaging',
    ],
    [
        'parent' => 'support',
        'child' => 'Create Messaging',
    ],
    [
        'parent' => 'admin',
        'child' => 'Create Postalcode',
    ],
    [
        'parent' => 'manager',
        'child' => 'Create Postalcode',
    ],
    [
        'parent' => 'support',
        'child' => 'Create Postalcode',
    ],
    [
        'parent' => 'admin',
        'child' => 'Create Street',
    ],
    [
        'parent' => 'manager',
        'child' => 'Create Street',
    ],
    [
        'parent' => 'support',
        'child' => 'Create Street',
    ],
    [
        'parent' => 'admin',
        'child' => 'Create Tax',
    ],
    [
        'parent' => 'manager',
        'child' => 'Create Tax',
    ],
    [
        'parent' => 'support',
        'child' => 'Create Tax',
    ],
    [
        'parent' => 'admin',
        'child' => 'createItem',
    ],
    [
        'parent' => 'admin',
        'child' => 'Delete Carousal',
    ],
    [
        'parent' => 'manager',
        'child' => 'Delete Carousal',
    ],
    [
        'parent' => 'support',
        'child' => 'Delete Carousal',
    ],
    [
        'parent' => 'admin',
        'child' => 'Delete Company',
    ],
    [
        'parent' => 'admin',
        'child' => 'Delete Daily Clean',
    ],
    [
        'parent' => 'manager',
        'child' => 'Delete Daily Clean',
    ],
    [
        'parent' => 'support',
        'child' => 'Delete Daily Clean',
    ],
    [
        'parent' => 'admin',
        'child' => 'Delete Daily Job Sheet',
    ],
    [
        'parent' => 'manager',
        'child' => 'Delete Daily Job Sheet',
    ],
    [
        'parent' => 'support',
        'child' => 'Delete Daily Job Sheet',
    ],
    [
        'parent' => 'admin',
        'child' => 'Delete Employee',
    ],
    [
        'parent' => 'manager',
        'child' => 'Delete Employee',
    ],
    [
        'parent' => 'support',
        'child' => 'Delete Employee',
    ],
    [
        'parent' => 'admin',
        'child' => 'Delete House',
    ],
    [
        'parent' => 'manager',
        'child' => 'Delete House',
    ],
    [
        'parent' => 'support',
        'child' => 'Delete House',
    ],
    [
        'parent' => 'admin',
        'child' => 'Delete Instruction',
    ],
    [
        'parent' => 'manager',
        'child' => 'Delete Instruction',
    ],
    [
        'parent' => 'support',
        'child' => 'Delete Instruction',
    ],
    [
        'parent' => 'admin',
        'child' => 'Delete Mandate',
    ],
    [
        'parent' => 'manager',
        'child' => 'Delete Mandate',
    ],
    [
        'parent' => 'support',
        'child' => 'Delete Mandate',
    ],
    [
        'parent' => 'admin',
        'child' => 'Delete Messagelog',
    ],
    [
        'parent' => 'manager',
        'child' => 'Delete Messagelog',
    ],
    [
        'parent' => 'support',
        'child' => 'Delete Messagelog',
    ],
    [
        'parent' => 'admin',
        'child' => 'Delete Messaging',
    ],
    [
        'parent' => 'manager',
        'child' => 'Delete Messaging',
    ],
    [
        'parent' => 'support',
        'child' => 'Delete Messaging',
    ],
    [
        'parent' => 'admin',
        'child' => 'Delete Postalcode',
    ],
    [
        'parent' => 'manager',
        'child' => 'Delete Postalcode',
    ],
    [
        'parent' => 'support',
        'child' => 'Delete Postalcode',
    ],
    [
        'parent' => 'admin',
        'child' => 'Delete Street',
    ],
    [
        'parent' => 'manager',
        'child' => 'Delete Street',
    ],
    [
        'parent' => 'support',
        'child' => 'Delete Street',
    ],
    [
        'parent' => 'admin',
        'child' => 'Delete Tax',
    ],
    [
        'parent' => 'manager',
        'child' => 'Delete Tax',
    ],
    [
        'parent' => 'support',
        'child' => 'Delete Tax',
    ],
    [
        'parent' => 'admin',
        'child' => 'deleteItem',
    ],
    [
        'parent' => 'admin',
        'child' => 'Google Translate',
    ],
    [
        'parent' => 'admin',
        'child' => 'Import Houses',
    ],
    [
        'parent' => 'manager',
        'child' => 'Import Houses',
    ],
    [
        'parent' => 'support',
        'child' => 'Import Houses',
    ],
    [
        'parent' => 'admin',
        'child' => 'Manage Admin',
    ],
    [
        'parent' => 'manager',
        'child' => 'Manage Admin',
    ],
    [
        'parent' => 'Mdb0',
        'child' => 'Manage Admin',
    ],
    [
        'parent' => 'Mdb1',
        'child' => 'Manage Admin',
    ],
    [
        'parent' => 'admin',
        'child' => 'Manage Basic',
    ],
    [
        'parent' => 'employee',
        'child' => 'Manage Basic',
    ],
    [
        'parent' => 'manager',
        'child' => 'Manage Basic',
    ],
    [
        'parent' => 'Mdb1',
        'child' => 'Manage Basic',
    ],
    [
        'parent' => 'support',
        'child' => 'Manage Basic',
    ],
    [
        'parent' => 'Udb',
        'child' => 'Manage Basic',
    ],
    [
        'parent' => 'admin',
        'child' => 'Manage Money',
    ],
    [
        'parent' => 'support',
        'child' => 'Manage Money',
    ],
    [
        'parent' => 'admin',
        'child' => 'manageRoles',
    ],
    [
        'parent' => 'admin',
        'child' => 'manageUsers',
    ],
    [
        'parent' => 'Mdb0',
        'child' => 'manageUsers',
    ],
    [
        'parent' => 'support',
        'child' => 'manageUsers',
    ],
    [
        'parent' => 'admin',
        'child' => 'See Prices',
    ],
    [
        'parent' => 'support',
        'child' => 'See Prices',
    ],
    [
        'parent' => 'Mdb0',
        'child' => 'support',
    ],
    [
        'parent' => 'Mdb1',
        'child' => 'support',
    ],
    [
        'parent' => 'admin',
        'child' => 'Update Carousal',
    ],
    [
        'parent' => 'manager',
        'child' => 'Update Carousal',
    ],
    [
        'parent' => 'support',
        'child' => 'Update Carousal',
    ],
    [
        'parent' => 'admin',
        'child' => 'Update Company',
    ],
    [
        'parent' => 'manager',
        'child' => 'Update Company',
    ],
    [
        'parent' => 'support',
        'child' => 'Update Company',
    ],
    [
        'parent' => 'admin',
        'child' => 'Update Daily Clean',
    ],
    [
        'parent' => 'manager',
        'child' => 'Update Daily Clean',
    ],
    [
        'parent' => 'support',
        'child' => 'Update Daily Clean',
    ],
    [
        'parent' => 'admin',
        'child' => 'Update Daily Job Sheet',
    ],
    [
        'parent' => 'manager',
        'child' => 'Update Daily Job Sheet',
    ],
    [
        'parent' => 'support',
        'child' => 'Update Daily Job Sheet',
    ],
    [
        'parent' => 'admin',
        'child' => 'Update Employee',
    ],
    [
        'parent' => 'manager',
        'child' => 'Update Employee',
    ],
    [
        'parent' => 'support',
        'child' => 'Update Employee',
    ],
    [
        'parent' => 'admin',
        'child' => 'Update House',
    ],
    [
        'parent' => 'manager',
        'child' => 'Update House',
    ],
    [
        'parent' => 'support',
        'child' => 'Update House',
    ],
    [
        'parent' => 'admin',
        'child' => 'Update Instruction',
    ],
    [
        'parent' => 'manager',
        'child' => 'Update Instruction',
    ],
    [
        'parent' => 'support',
        'child' => 'Update Instruction',
    ],
    [
        'parent' => 'admin',
        'child' => 'Update Mandate',
    ],
    [
        'parent' => 'manager',
        'child' => 'Update Mandate',
    ],
    [
        'parent' => 'support',
        'child' => 'Update Mandate',
    ],
    [
        'parent' => 'admin',
        'child' => 'Update Messagelog',
    ],
    [
        'parent' => 'manager',
        'child' => 'Update Messagelog',
    ],
    [
        'parent' => 'support',
        'child' => 'Update Messagelog',
    ],
    [
        'parent' => 'admin',
        'child' => 'Update Messaging',
    ],
    [
        'parent' => 'manager',
        'child' => 'Update Messaging',
    ],
    [
        'parent' => 'support',
        'child' => 'Update Messaging',
    ],
    [
        'parent' => 'admin',
        'child' => 'Update Postalcode',
    ],
    [
        'parent' => 'manager',
        'child' => 'Update Postalcode',
    ],
    [
        'parent' => 'support',
        'child' => 'Update Postalcode',
    ],
    [
        'parent' => 'admin',
        'child' => 'Update Street',
    ],
    [
        'parent' => 'manager',
        'child' => 'Update Street',
    ],
    [
        'parent' => 'support',
        'child' => 'Update Street',
    ],
    [
        'parent' => 'admin',
        'child' => 'Update Tax',
    ],
    [
        'parent' => 'manager',
        'child' => 'Update Tax',
    ],
    [
        'parent' => 'support',
        'child' => 'Update Tax',
    ],
    [
        'parent' => 'support',
        'child' => 'updateCommonUser',
    ],
    [
        'parent' => 'admin',
        'child' => 'updateCreatedItem',
    ],
    [
        'parent' => 'admin',
        'child' => 'updateItem',
    ],
    [
        'parent' => 'updateCreatedItem',
        'child' => 'updateItem',
    ],
    [
        'parent' => 'admin',
        'child' => 'updateUser',
    ],
    [
        'parent' => 'updateCommonUser',
        'child' => 'updateUser',
    ],
    [
        'parent' => 'admin',
        'child' => 'View Bulletin Board',
    ],
    [
        'parent' => 'manager',
        'child' => 'View Bulletin Board',
    ],
    [
        'parent' => 'support',
        'child' => 'View Bulletin Board',
    ],
    [
        'parent' => 'admin',
        'child' => 'View Carousal',
    ],
    [
        'parent' => 'manager',
        'child' => 'View Carousal',
    ],
    [
        'parent' => 'support',
        'child' => 'View Carousal',
    ],
    [
        'parent' => 'admin',
        'child' => 'View Company',
    ],
    [
        'parent' => 'manager',
        'child' => 'View Company',
    ],
    [
        'parent' => 'support',
        'child' => 'View Company',
    ],
    [
        'parent' => 'admin',
        'child' => 'View Daily Clean',
    ],
    [
        'parent' => 'manager',
        'child' => 'View Daily Clean',
    ],
    [
        'parent' => 'support',
        'child' => 'View Daily Clean',
    ],
    [
        'parent' => 'Udb',
        'child' => 'View Daily Clean',
    ],
    [
        'parent' => 'Udb3',
        'child' => 'View Daily Clean',
    ],
    [
        'parent' => 'Udb4',
        'child' => 'View Daily Clean',
    ],
    [
        'parent' => 'admin',
        'child' => 'View House',
    ],
    [
        'parent' => 'support',
        'child' => 'View House',
    ],
    [
        'parent' => 'admin',
        'child' => 'View Instruction',
    ],
    [
        'parent' => 'manager',
        'child' => 'View Instruction',
    ],
    [
        'parent' => 'support',
        'child' => 'View Instruction',
    ],
    [
        'parent' => 'admin',
        'child' => 'View Mandate',
    ],
    [
        'parent' => 'manager',
        'child' => 'View Mandate',
    ],
    [
        'parent' => 'support',
        'child' => 'View Mandate',
    ],
    [
        'parent' => 'admin',
        'child' => 'View Revenue Reports',
    ],
    [
        'parent' => 'manager',
        'child' => 'View Revenue Reports',
    ],
    [
        'parent' => 'support',
        'child' => 'View Revenue Reports',
    ],
    ]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%auth_item_child}} CASCADE');
    }
}
