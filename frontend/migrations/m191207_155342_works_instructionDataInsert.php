<?php
Namespace frontend\migrations;

use yii\db\Migration;

class m191207_155342_works_instructionDataInsert extends Migration
{

    public function safeUp()
    {
        $this->batchInsert('{{%works_instruction}}',
                           ["id", "code", "code_meaning", "include", "modified_date"],
                            [
    [
        'id' => '1',
        'code' => 'E',
        'code_meaning' => 'Everything',
        'include' => '1',
        'modified_date' => '2019-02-08 15:16:55',
    ],
    [
        'id' => '2',
        'code' => 'B',
        'code_meaning' => 'Back',
        'include' => '0',
        'modified_date' => '2019-02-08 15:52:36',
    ],
    [
        'id' => '3',
        'code' => 'F',
        'code_meaning' => 'Front',
        'include' => '1',
        'modified_date' => '2019-02-08 15:53:00',
    ],
    [
        'id' => '4',
        'code' => 'S',
        'code_meaning' => 'Side',
        'include' => '1',
        'modified_date' => '2019-02-08 15:53:21',
    ],
    [
        'id' => '5',
        'code' => 'FS',
        'code_meaning' => 'Front and Sides',
        'include' => '1',
        'modified_date' => '2019-02-08 15:53:45',
    ],
    [
        'id' => '6',
        'code' => 'FB',
        'code_meaning' => 'Front and Back',
        'include' => '0',
        'modified_date' => '2019-02-08 15:54:23',
    ],
    [
        'id' => '7',
        'code' => 'FBS',
        'code_meaning' => 'Front  Back   Sides',
        'include' => '1',
        'modified_date' => '2019-02-08 15:54:55',
    ],
    [
        'id' => '8',
        'code' => 'END',
        'code_meaning' => 'Everything Not Door',
        'include' => '0',
        'modified_date' => '2019-02-08 15:58:24',
    ],
    [
        'id' => '9',
        'code' => 'ED',
        'code_meaning' => 'Everything Especially the Door',
        'include' => '1',
        'modified_date' => '2019-02-08 15:59:08',
    ],
    [
        'id' => '10',
        'code' => 'ENC',
        'code_meaning' => 'Everything Not Conservatory',
        'include' => '1',
        'modified_date' => '2019-12-01 19:20:41',
    ],
    [
        'id' => '11',
        'code' => 'EV',
        'code_meaning' => 'Everything Especially  Veluxes',
        'include' => '1',
        'modified_date' => '2019-12-01 19:23:37',
    ],
    [
        'id' => '12',
        'code' => 'ENV',
        'code_meaning' => 'Everything Not Veluxes',
        'include' => '1',
        'modified_date' => '2019-12-01 19:37:56',
    ],                          
    [
        'id' => '13',
        'code' => 'G',
        'code_meaning' => 'Gutters',
        'include' => '1',
        'modified_date' => '2019-12-01 19:29:45',
    ],
    [
        'id' => '14',
        'code' => 'F',
        'code_meaning' => 'Facias',
        'include' => '1',
        'modified_date' => '2019-12-01 19:32:02',
    ],
    [
        'id' => '15',
        'code' => 'GF',
        'code_meaning' => 'Gutters and Facias',
        'include' => '1',
        'modified_date' => '2019-12-01 19:33:44',
    ],
    [
        'id' => '16',
        'code' => 'DNC',
        'code_meaning' => 'Do Not Clean',
        'include' => '1',
        'modified_date' => '2019-12-01 19:37:56',
    ],
    [
        'id' => '17',
        'code' => 'DNCO',
        'code_meaning' => 'Do Not Clean Owes',
        'include' => '1',
        'modified_date' => '2019-12-01 19:37:56',
    ],
    [
        'id' => '18',
        'code' => 'DNCNTD',
        'code_meaning' => 'Do Not Clean No Time Today',
        'include' => '1',
        'modified_date' => '2019-12-01 19:37:56',
    ],                                
    [
        'id' => '19',
        'code' => 'ePICS',
        'code_meaning' => 'Clean as usual and email photos as evidence of clean from mobilephone.',
        'include' => '1',
        'modified_date' => '2019-12-01 19:37:56',
    ],                          
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%works_instruction}} CASCADE');
    }
}
