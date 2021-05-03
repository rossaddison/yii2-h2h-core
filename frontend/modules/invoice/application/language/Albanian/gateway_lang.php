<?php
/**
 * Contains the language translations for the payment gateways
 */
$lang = array(
    // General strings
    'online_payment'                     => 'Pagesa Online',
    'online_payments'                    => 'Pagesat Online',
    'online_payment_for'                 => 'Pagesa online per',
    'online_payment_for_invoice'         => 'Pagesa Online per faturen',
    'online_payment_method'              => 'Metoda e pageses online',
    'online_payment_creditcard_hint'     => 'Nese deshiron te paguash me kredit-kartel ju lutem fut informatat me poshte.<br/> Informatat e kredit karteles nuk do te ruhen ne serverin tone por do te kycen permes linjes se sigurt per kredit kartela.',
    'enable_online_payments'             => 'Lejo pagesat online',
    'payment_provider'                   => 'Ofruesi i Pageses',
    'add_payment_provider'               => 'Shto nje ofrues te pagesave',
    'transaction_reference'              => 'Referenca e transaksionit',
    'payment_description'                => 'Pagesa per faturen %s',

    // Credit card strings
    'creditcard_cvv'                     => 'CVV / CSC',
    'creditcard_details'                 => 'Detajet e Kartes se Kreditit',
    'creditcard_expiry_month'            => 'Muaji Skadues',
    'creditcard_expiry_year'             => 'Viti Skadues',
    'creditcard_number'                  => 'Numri i kredit kartes',
    'online_payment_card_invalid'        => 'KJo kredit karte eshte jo valide. Ju lutem kontrollo informatat e ofruesit.',

    // Payment Gateway Fields
    'online_payment_apiLoginId'          => 'Id Kyqese API', // Field for AuthorizeNet_AIM
    'online_payment_transactionKey'      => 'Qelesi i transaksionit', // Field for AuthorizeNet_AIM
    'online_payment_testMode'            => 'Modi TEST', // Field for AuthorizeNet_AIM
    'online_payment_developerMode'       => 'Modeli i Zhvillimit te programit', // Field for AuthorizeNet_AIM
    'online_payment_websiteKey'          => 'Qelesi i Uebsajtit', // Field for Buckaroo_Ideal
    'online_payment_secretKey'           => 'Qelesi sekret', // Field for Buckaroo_Ideal
    'online_payment_merchantId'          => 'IDa e Tregtarit:', // Field for CardSave
    'online_payment_password'            => 'Fjalekalimi', // Field for CardSave
    'online_payment_apiKey'              => 'Qelesi API', // Field for Coinbase
    'online_payment_secret'              => 'Sekret', // Field for Coinbase
    'online_payment_accountId'           => 'Konto Nr.', // Field for Coinbase
    'online_payment_storeId'             => 'Id Ruajtse', // Field for FirstData_Connect
    'online_payment_sharedSecret'        => 'Sekrete te shperndara', // Field for FirstData_Connect
    'online_payment_appId'               => 'App ID', // Field for GoCardless
    'online_payment_appSecret'           => 'Sekretet App', // Field for GoCardless
    'online_payment_accessToken'         => 'Qasje Token', // Field for GoCardless
    'online_payment_merchantAccessCode'  => 'Kodi i kyqjes se tregtarit', // Field for Migs_ThreeParty
    'online_payment_secureHash'          => 'Siguria Hash', // Field for Migs_ThreeParty
    'online_payment_siteId'              => 'ID e faqes', // Field for MultiSafepay
    'online_payment_siteCode'            => 'Kodi i faqes', // Field for MultiSafepay
    'online_payment_accountNumber'       => 'Numri Llogarisë', // Field for NetBanx
    'online_payment_storePassword'       => 'Fajekalmi i ruajtur', // Field for NetBanx
    'online_payment_merchantKey'         => 'Çelësi Tregtarit', // Field for PayFast
    'online_payment_pdtKey'              => 'Qelesi Pdt', // Field for PayFast
    'online_payment_username'            => 'Perdoruesi', // Field for Payflow_Pro
    'online_payment_vendor'              => 'Shitës', // Field for Payflow_Pro
    'online_payment_partner'             => 'Partner', // Field for Payflow_Pro
    'online_payment_pxPostUsername'      => 'Perdoruesi Px Post', // Field for PaymentExpress_PxPay
    'online_payment_pxPostPassword'      => 'Fjalekalmi Px Post', // Field for PaymentExpress_PxPay
    'online_payment_signature'           => 'Nenshkrimi', // Field for PayPal_Express
    'online_payment_referrerId'          => 'ID Referuese', // Field for SagePay_Direct
    'online_payment_transactionPassword' => 'Fjalekalmi i Transaksionit', // Field for SecurePay_DirectPost
    'online_payment_subAccountId'        => 'Numri i ID-se se nen-llogarise', // Field for TargetPay_Directebanking
    'online_payment_secretWord'          => 'Fjale sekrete', // Field for TwoCheckout
    'online_payment_installationId'      => 'ID e instalimit', // Field for WorldPay
    'online_payment_callbackPassword'    => 'Fjalekalimi kthyes', // Field for WorldPay

    // Status / Error Messages
    'online_payment_payment_cancelled'   => 'Pagesa u anuluar',
    'online_payment_payment_failed'      => 'Pagesa deshtoj. Ju lutem provoni perseri.',
    'online_payment_payment_successful'  => 'Pagese per faturen %s ishte e sukseseshme!',
    'online_payment_payment_redirect'    => 'Ju lutem prsni derisa te ju drejtojm ne faqen per pagese...',
    'online_payment_3dauth_redirect'     => 'Ju lutem prsni deri te ju drejtojme ne autoidentifikimin e kartes.'
);