<?php

return [

    'components' => [

        'db' => [

            'class' => 'yii\db\Connection',

            'dsn' => 'mysql:host=localhost;dbname=h2h_db',

            'username' => 'root',

            'password' => '',

            'charset' => 'utf8',

            'enableSchemaCache' => true,

            'schemaCacheDuration' => 3600,

            'schemaCache' => 'cache',

        ],

    ],    

];
