<?php
/**
 * Contains the language translations for the payment gateways
 */
$lang = array(
    // General strings
    'online_payment'                     => 'Veebimakse',
    'online_payments'                    => 'Veebimaksed',
    'online_payment_for'                 => 'Veebimakse - ',
    'online_payment_for_invoice'         => 'Veebimakse arvele',
    'online_payment_method'              => 'Veebimakse meetod',
    'online_payment_creditcard_hint'     => 'Kui sa soovid maksta krediitkaardiga, siis palun sisesta info allapoole.<br/>Krediitkaardi infot meie serverites ei talletata ning see edastatakse üle turvaliste ühenduste.',
    'enable_online_payments'             => 'Luba veebimaksed',
    'payment_provider'                   => 'Makseteenuse pakkuja',
    'add_payment_provider'               => 'Lisa maksete pakkujaks',
    'transaction_reference'              => 'Tehingu viide',
    'payment_description'                => 'Arve %s makse',

    // Credit card strings
    'creditcard_cvv'                     => 'CVV / CSC',
    'creditcard_details'                 => 'Krediitkaardi andmed',
    'creditcard_expiry_month'            => 'Aegumise kuu',
    'creditcard_expiry_year'             => 'Aegumise aasta',
    'creditcard_number'                  => 'Krediitkaardi number',
    'online_payment_card_invalid'        => 'See krediitkaart pole korrektne. Palun kontrollige sisestatud infot.',

    // Payment Gateway Fields
    'online_payment_apiLoginId'          => 'API sisselogimise ID', // Field for AuthorizeNet_AIM
    'online_payment_transactionKey'      => 'Tehingu võti', // Field for AuthorizeNet_AIM
    'online_payment_testMode'            => 'Testirežiim', // Field for AuthorizeNet_AIM
    'online_payment_developerMode'       => 'Arendaja režiim', // Field for AuthorizeNet_AIM
    'online_payment_websiteKey'          => 'Veebilehe võti', // Field for Buckaroo_Ideal
    'online_payment_secretKey'           => 'Salajane võti', // Field for Buckaroo_Ideal
    'online_payment_merchantId'          => 'Kaupmehe ID', // Field for CardSave
    'online_payment_password'            => 'Salasõna', // Field for CardSave
    'online_payment_apiKey'              => 'API võti', // Field for Coinbase
    'online_payment_secret'              => 'Salajane', // Field for Coinbase
    'online_payment_accountId'           => 'Konto ID', // Field for Coinbase
    'online_payment_storeId'             => 'Poe ID', // Field for FirstData_Connect
    'online_payment_sharedSecret'        => 'Jagatud võti', // Field for FirstData_Connect
    'online_payment_appId'               => 'Rakenduse ID', // Field for GoCardless
    'online_payment_appSecret'           => 'Rakenduse võti', // Field for GoCardless
    'online_payment_accessToken'         => 'Juurdepääsuluba', // Field for GoCardless
    'online_payment_merchantAccessCode'  => 'Kaupmehe ligipääsu kood', // Field for Migs_ThreeParty
    'online_payment_secureHash'          => 'Turvaline räsi', // Field for Migs_ThreeParty
    'online_payment_siteId'              => 'Saidi ID', // Field for MultiSafepay
    'online_payment_siteCode'            => 'Saidi kood', // Field for MultiSafepay
    'online_payment_accountNumber'       => 'Konto number', // Field for NetBanx
    'online_payment_storePassword'       => 'Poe salasõna', // Field for NetBanx
    'online_payment_merchantKey'         => 'Kaupmehe võti', // Field for PayFast
    'online_payment_pdtKey'              => 'PDT võti', // Field for PayFast
    'online_payment_username'            => 'Kasutajanimi', // Field for Payflow_Pro
    'online_payment_vendor'              => 'Tarnija', // Field for Payflow_Pro
    'online_payment_partner'             => 'Partner', // Field for Payflow_Pro
    'online_payment_pxPostUsername'      => 'Px Posti kasutajanimi', // Field for PaymentExpress_PxPay
    'online_payment_pxPostPassword'      => 'Px posti salasõna', // Field for PaymentExpress_PxPay
    'online_payment_signature'           => 'Allkiri', // Field for PayPal_Express
    'online_payment_referrerId'          => 'Viitaja ID', // Field for SagePay_Direct
    'online_payment_transactionPassword' => 'Tehingu salasõna', // Field for SecurePay_DirectPost
    'online_payment_subAccountId'        => 'Alamkonto ID', // Field for TargetPay_Directebanking
    'online_payment_secretWord'          => 'Salasõna', // Field for TwoCheckout
    'online_payment_installationId'      => 'Installatsiooni ID', // Field for WorldPay
    'online_payment_callbackPassword'    => 'Callback parool', // Field for WorldPay

    // Status / Error Messages
    'online_payment_payment_cancelled'   => 'Makse on tühistatud.',
    'online_payment_payment_failed'      => 'Makse ebaõnnestus. Palun proovi uuesti.',
    'online_payment_payment_successful'  => 'Arve %s makse on tehtud!',
    'online_payment_payment_redirect'    => 'Palun oodake, suundume maksmise lehele...',
    'online_payment_3dauth_redirect'     => 'Palun oodake, kuni suundume sinu kaardi väljaandja juurde autentimiseks...'
);