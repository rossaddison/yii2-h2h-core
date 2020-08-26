<?php
return [
    'language' => 'en-GB',
    'components' => [
        'cache' => [
            'class' => 'yii\\caching\\FileCache',
            'keyPrefix' => 'h2h',
        ],
    ],
    'modules' => [
        'core' => [
            'serverName' => 'localhost',
            'serverPort' => '80',
        ],
    ],
];
