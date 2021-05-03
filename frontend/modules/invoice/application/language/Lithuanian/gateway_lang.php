<?php
/**
 * Contains the language translations for the payment gateways
 */
$lang = array(
    // General strings
    'online_payment'                     => 'Internetinis mokėjimas',
    'online_payments'                    => 'Internetiniai mokėjimai',
    'online_payment_for'                 => 'Mokėjimas internetu už',
    'online_payment_for_invoice'         => 'Sąskaitos apmokėjimas internetu',
    'online_payment_method'              => 'Internetinio mokėjimo būdas',
    'online_payment_creditcard_hint'     => 'If you want to pay via credit card please enter the information below.<br/>The credit card information are not stored on our servers and will be transferred to the online payment gateway using a secure connection.',
    'enable_online_payments'             => 'Įjungti atsiskaitymą internetu',
    'payment_provider'                   => 'Mokėjimo paslaugų teikėjas',
    'add_payment_provider'               => 'Įtraukti mokėjimo paslaugų teikėją',
    'transaction_reference'              => 'Transaction Reference',
    'payment_description'                => 'Payment for Invoice %s',

    // Credit card strings
    'creditcard_cvv'                     => 'CVV / CSC',
    'creditcard_details'                 => 'Kredito kortelės duomenys',
    'creditcard_expiry_month'            => 'Galiojimo mėnuo',
    'creditcard_expiry_year'             => 'Galiojimo metai',
    'creditcard_number'                  => 'Kredito kortelės numeris',
    'online_payment_card_invalid'        => 'This credit card is invalid. Please check the provided information.',

    // Payment Gateway Fields
    'online_payment_apiLoginId'          => 'API prisijungimo ID', // Field for AuthorizeNet_AIM
    'online_payment_transactionKey'      => 'Sandorio raktas', // Field for AuthorizeNet_AIM
    'online_payment_testMode'            => 'Testavimo rėžimas', // Field for AuthorizeNet_AIM
    'online_payment_developerMode'       => 'Programavimo rėžimas', // Field for AuthorizeNet_AIM
    'online_payment_websiteKey'          => 'Svetainės raktas', // Field for Buckaroo_Ideal
    'online_payment_secretKey'           => 'Slaptas raktas', // Field for Buckaroo_Ideal
    'online_payment_merchantId'          => 'Programavimo rėžimas', // Field for CardSave
    'online_payment_password'            => 'Slaptažodis', // Field for CardSave
    'online_payment_apiKey'              => 'API raktas', // Field for Coinbase
    'online_payment_secret'              => 'Secret', // Field for Coinbase
    'online_payment_accountId'           => 'Account Id', // Field for Coinbase
    'online_payment_storeId'             => 'Parduotuvės ID', // Field for FirstData_Connect
    'online_payment_sharedSecret'        => 'Shared Secret', // Field for FirstData_Connect
    'online_payment_appId'               => 'Programos ID', // Field for GoCardless
    'online_payment_appSecret'           => 'App Secret', // Field for GoCardless
    'online_payment_accessToken'         => 'Access Token', // Field for GoCardless
    'online_payment_merchantAccessCode'  => 'Merchant Access Code', // Field for Migs_ThreeParty
    'online_payment_secureHash'          => 'Secure Hash', // Field for Migs_ThreeParty
    'online_payment_siteId'              => 'Svetainės Id', // Field for MultiSafepay
    'online_payment_siteCode'            => 'Svetainės kodas', // Field for MultiSafepay
    'online_payment_accountNumber'       => 'Sąskaitos numeris', // Field for NetBanx
    'online_payment_storePassword'       => 'Parduotuvės slaptažodis', // Field for NetBanx
    'online_payment_merchantKey'         => 'Tiekėjo raktas', // Field for PayFast
    'online_payment_pdtKey'              => 'Pdt Key', // Field for PayFast
    'online_payment_username'            => 'Vartotojo vardas', // Field for Payflow_Pro
    'online_payment_vendor'              => 'Tiekėjas', // Field for Payflow_Pro
    'online_payment_partner'             => 'Partneris', // Field for Payflow_Pro
    'online_payment_pxPostUsername'      => 'Px Post Username', // Field for PaymentExpress_PxPay
    'online_payment_pxPostPassword'      => 'Px Post Password', // Field for PaymentExpress_PxPay
    'online_payment_signature'           => 'Parašas', // Field for PayPal_Express
    'online_payment_referrerId'          => 'Referrer Id', // Field for SagePay_Direct
    'online_payment_transactionPassword' => 'Sandorio slaptažodis', // Field for SecurePay_DirectPost
    'online_payment_subAccountId'        => 'Sub Account Id', // Field for TargetPay_Directebanking
    'online_payment_secretWord'          => 'Prekybininko slaptas žodis', // Field for TwoCheckout
    'online_payment_installationId'      => 'Diegimo ID', // Field for WorldPay
    'online_payment_callbackPassword'    => 'Callback Password', // Field for WorldPay

    // Status / Error Messages
    'online_payment_payment_cancelled'   => 'Mokėjimas atšauktas.',
    'online_payment_payment_failed'      => 'Mokėjimas nepavyko. Bandykite dar kartą.',
    'online_payment_payment_successful'  => 'Payment for Invoice %s successful!',
    'online_payment_payment_redirect'    => 'Palaukite, kol mes Jus nukreipsime į mokėjimų puslapį...',
    'online_payment_3dauth_redirect'     => 'Please wait while we redirect you to your card issuer for authentication...'
);