<?php
return [
    'components' => [
    ],
    'params' => [
                'invoice_cryptkey'=>'This is my key',
                'default_invoice_gateway_currency_code'=>'GBP',
                'default_disable_setup'=>false,
                //version 3 gateways on https://github.com/thephpleague/omnipay
                'payment_gateways' => [
                    'Braintree'=>[
                        'merchantId' => [
                            'type' => 'text',
                            'label' => 'Merchant Id',
                        ],
                        'publicKey' => [
                            'type' => 'password',
                            'label' => 'Public Key'
                        ],
                        'privateKey' => [
                            'type' => 'password',
                            'label' => 'Private Key'
                        ],
                        'testMode'=>[
                            'type' => 'checkbox',
                            'label' => 'Test Mode'
                        ]
                    ],
                    'Converge'=>[
                        'merchantId'=>[
                            'type'=>'text',
                            'label' => 'Merchant Id'
                        ],
                        'username'=>[
                            'type'=>'text',
                            'label' => 'Username'
                        ],
                        'password'=>[
                            'type'=>'password',
                            'label' => 'Password' 
                        ],
                        'testMode'=>[
                            'type'=>'checkbox',
                            'label'=> 'Test Mode' 
                        ]
                    ],
                    'Cybersource' => [
                        'profileId' => [
                            'type'=>  'text',
                            'label'=> 'Profile Id'
                        ],
                        'secretKey' => [
                            'type' =>  'text',
                            'label' => 'Secret Key',
                        ],
                        'accessKey' => [
                            'type' =>  'text',
                            'label' => 'Access Key',
                        ],
                        'testMode' => [
                            'type'=>'checkbox',
                            'label'=> 'Test Mode'
                        ],
                    ],
                    'Stripe' => [
                        'apiKey' => [
                            'type' => 'password',
                            'label' => 'Api Key',
                        ],
                    ],  
                    'WorldPay' => [
                        'installationId' => [
                            'type' => 'text',
                            'label' => 'Installation Id',
                        ],
                        'accountId' => [
                            'type' => 'text',
                            'label' => 'Account Id',
                        ],
                        'secretWord' => [
                            'type' => 'password',
                            'label' => 'Secret Word',
                        ],
                        'callbackPassword' => [
                            'type' => 'password',
                            'label' => 'Callback Password',
                        ],
                        'testMode' => [
                            'type' => 'checkbox',
                            'label' => 'Test Mode',
                        ],
                    ],
                ],    
                'number_formats' => [
                'number_format_us_uk' =>
                    [
                        'label' => 'number_format_us_uk',
                        'decimal_point' => '.',
                        'thousands_separator' => ',',
                    ],
                'number_format_european' =>
                    [
                        'label' => 'number_format_european',
                        'decimal_point' => ',',
                        'thousands_separator' => '.',
                    ],
                'number_format_iso80k1_point' =>
                    [
                        'label' => 'number_format_iso80k1_point',
                        'decimal_point' => '.',
                        'thousands_separator' => ' ',
                    ],
                'number_format_iso80k1_comma' =>
                    [
                        'label' => 'number_format_iso80k1_comma',
                        'decimal_point' => ',',
                        'thousands_separator' => ' ',
                    ],
                'number_format_compact_point' =>
                    [
                        'label' => 'number_format_compact_point',
                        'decimal_point' => '.',
                        'thousands_separator' => '',
                    ],
                'number_format_compact_comma' =>
                    [
                        'label' => 'number_format_compact_comma',
                        'decimal_point' => ',',
                        'thousands_separator' => '',
                    ],
                ]
    ],
];