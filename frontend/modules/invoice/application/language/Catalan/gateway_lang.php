<?php
/**
 * Contains the language translations for the payment gateways
 */
$lang = array(
    // General strings
    'online_payment'                     => 'Pagament en línia',
    'online_payments'                    => 'Pagaments en línia',
    'online_payment_for'                 => 'Pagament en línia per a',
    'online_payment_for_invoice'         => 'Pagament en línia per factura',
    'online_payment_method'              => 'Mètode de pagament en línia',
    'online_payment_creditcard_hint'     => 'Si voleu pagar mitjançant targeta de crèdit si us plau introdueix la informació a continuació.<br/>Les dades de la targeta de crèdit no s\'emmagatzemen en els nostres servidors i es transferiran a la passarel·la de pagament en línia mitjançant una connexió segura.',
    'enable_online_payments'             => 'Permetre pagaments en línia',
    'payment_provider'                   => 'Proveïdor de pagament',
    'add_payment_provider'               => 'Afegir un proveïdor de pagament',
    'transaction_reference'              => 'Referència de transacció',
    'payment_description'                => 'Pagament de la factura %s',

    // Credit card strings
    'creditcard_cvv'                     => 'CVV / CSC',
    'creditcard_details'                 => 'Detalls de la targeta de crèdit',
    'creditcard_expiry_month'            => 'Mes de caducitat',
    'creditcard_expiry_year'             => 'Any de caducitat',
    'creditcard_number'                  => 'Número de la targeta de crèdit',
    'online_payment_card_invalid'        => 'Aquesta targeta de crèdit no és vàlida. Cal que reviseu la informació proporcionada.',

    // Payment Gateway Fields
    'online_payment_apiLoginId'          => 'ID de connexió de l\'API', // Field for AuthorizeNet_AIM
    'online_payment_transactionKey'      => 'Clau de la transacció', // Field for AuthorizeNet_AIM
    'online_payment_testMode'            => 'Mode de proves', // Field for AuthorizeNet_AIM
    'online_payment_developerMode'       => 'Mode desenvolupador', // Field for AuthorizeNet_AIM
    'online_payment_websiteKey'          => 'Clau de la web', // Field for Buckaroo_Ideal
    'online_payment_secretKey'           => 'Clau secreta', // Field for Buckaroo_Ideal
    'online_payment_merchantId'          => 'ID del minorista', // Field for CardSave
    'online_payment_password'            => 'Contrasenya', // Field for CardSave
    'online_payment_apiKey'              => 'Clau de l\'API', // Field for Coinbase
    'online_payment_secret'              => 'Codi secret', // Field for Coinbase
    'online_payment_accountId'           => 'ID del compte', // Field for Coinbase
    'online_payment_storeId'             => 'ID de la botiga', // Field for FirstData_Connect
    'online_payment_sharedSecret'        => 'Secret compartit', // Field for FirstData_Connect
    'online_payment_appId'               => 'ID de l\'App', // Field for GoCardless
    'online_payment_appSecret'           => 'Clau secreta de l\'App', // Field for GoCardless
    'online_payment_accessToken'         => 'Identificador d\'accés', // Field for GoCardless
    'online_payment_merchantAccessCode'  => 'Codi d\'accés del minorista', // Field for Migs_ThreeParty
    'online_payment_secureHash'          => 'Hash segur', // Field for Migs_ThreeParty
    'online_payment_siteId'              => 'ID del lloc', // Field for MultiSafepay
    'online_payment_siteCode'            => 'Codi del lloc', // Field for MultiSafepay
    'online_payment_accountNumber'       => 'Número de compte', // Field for NetBanx
    'online_payment_storePassword'       => 'Desar la contrasenya', // Field for NetBanx
    'online_payment_merchantKey'         => 'ID del minorista', // Field for PayFast
    'online_payment_pdtKey'              => 'Clau PDT', // Field for PayFast
    'online_payment_username'            => 'Nom d\'usuari', // Field for Payflow_Pro
    'online_payment_vendor'              => 'Venedor', // Field for Payflow_Pro
    'online_payment_partner'             => 'Soci', // Field for Payflow_Pro
    'online_payment_pxPostUsername'      => 'Nom d\'usuari de Px Post', // Field for PaymentExpress_PxPay
    'online_payment_pxPostPassword'      => 'Contrasenya de Px Post', // Field for PaymentExpress_PxPay
    'online_payment_signature'           => 'Signatura', // Field for PayPal_Express
    'online_payment_referrerId'          => 'ID del referent', // Field for SagePay_Direct
    'online_payment_transactionPassword' => 'Contrasenya de la transacció', // Field for SecurePay_DirectPost
    'online_payment_subAccountId'        => 'ID del subcompte', // Field for TargetPay_Directebanking
    'online_payment_secretWord'          => 'Paraula secreta', // Field for TwoCheckout
    'online_payment_installationId'      => 'ID d\'instal·lació', // Field for WorldPay
    'online_payment_callbackPassword'    => 'Contrasenya del Callback', // Field for WorldPay

    // Status / Error Messages
    'online_payment_payment_cancelled'   => 'Pagament cancel·lat.',
    'online_payment_payment_failed'      => 'Pagament erroni. Torna-ho a provar.',
    'online_payment_payment_successful'  => 'Pagament de la factura %s exitós!',
    'online_payment_payment_redirect'    => 'Si us plau, espera mentre et redirigim a la pàgina de pagament...',
    'online_payment_3dauth_redirect'     => 'Si us plau, espera mentre et redirigim al teu emissor de la targeta per a l\'autenticació...'
);