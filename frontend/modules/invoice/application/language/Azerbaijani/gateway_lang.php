<?php
/**
 * Contains the language translations for the payment gateways
 */
$lang = array(
    // General strings
    'online_payment'                     => 'Onlayn ödəmə',
    'online_payments'                    => 'Onlayn ödəmələr',
    'online_payment_for'                 => '%s üçün onlayn ödəmə',
    'online_payment_for_invoice'         => 'Faktura üçün ödəmə',
    'online_payment_method'              => 'Onlayn ödəmə növü',
    'online_payment_creditcard_hint'     => 'Əgər Siz kredit kartı vasitəsilə ödəniş etmək istəyirsinizsə, lütfən aşağıdakı məlumatları daxil edin.<br/>Kredit kartı haqqında məlumat bizim serverlərdə saxlanılmır və təhlükəsiz bağlantı vasitəsilə onlayn ödəmə xidmətinə yönləndiriləcək.',
    'enable_online_payments'             => 'Onlayn ödəmələri aktiv edin',
    'payment_provider'                   => 'Ödəmə aqreqatı',
    'add_payment_provider'               => 'Ödəmə aqreqatı əlavə et',
    'transaction_reference'              => 'Tranzaksiya istinadı',
    'payment_description'                => '%s fakturası üçün ödəmə',

    // Credit card strings
    'creditcard_cvv'                     => 'CVV / CSC',
    'creditcard_details'                 => 'Kredit kartının məlumatları',
    'creditcard_expiry_month'            => 'Son ay',
    'creditcard_expiry_year'             => 'Son il',
    'creditcard_number'                  => 'Kredit kartının nömrəsi',
    'online_payment_card_invalid'        => 'Bu kredit kartı etibarsızdır. Xahiş edirik təqdim edilən məlumatları yoxlayın.',

    // Payment Gateway Fields
    'online_payment_apiLoginId'          => 'Api giriş ID', // Field for AuthorizeNet_AIM
    'online_payment_transactionKey'      => 'Əməliyyat açarı', // Field for AuthorizeNet_AIM
    'online_payment_testMode'            => 'Sınaq rejimi', // Field for AuthorizeNet_AIM
    'online_payment_developerMode'       => 'Developer rejimi', // Field for AuthorizeNet_AIM
    'online_payment_websiteKey'          => 'Vebsayt açarı', // Field for Buckaroo_Ideal
    'online_payment_secretKey'           => 'Məxfi açar', // Field for Buckaroo_Ideal
    'online_payment_merchantId'          => 'Satıcı ID', // Field for CardSave
    'online_payment_password'            => 'Şifrə', // Field for CardSave
    'online_payment_apiKey'              => 'API açar', // Field for Coinbase
    'online_payment_secret'              => 'Məxfi', // Field for Coinbase
    'online_payment_accountId'           => 'ID hesab', // Field for Coinbase
    'online_payment_storeId'             => 'Mağaza ID', // Field for FirstData_Connect
    'online_payment_sharedSecret'        => 'Paylaşılan məxfi', // Field for FirstData_Connect
    'online_payment_appId'               => 'Tətbiq ID', // Field for GoCardless
    'online_payment_appSecret'           => 'Tətbiq üçün şifrə', // Field for GoCardless
    'online_payment_accessToken'         => 'Giriş markeri', // Field for GoCardless
    'online_payment_merchantAccessCode'  => 'Satıcının giriş kodu', // Field for Migs_ThreeParty
    'online_payment_secureHash'          => 'Kriptoqrafik heş', // Field for Migs_ThreeParty
    'online_payment_siteId'              => 'Sayt ID', // Field for MultiSafepay
    'online_payment_siteCode'            => 'Saytın kodu', // Field for MultiSafepay
    'online_payment_accountNumber'       => 'Hesab nömrəsi', // Field for NetBanx
    'online_payment_storePassword'       => 'Mağaza şifrəsi', // Field for NetBanx
    'online_payment_merchantKey'         => 'Satıcı açarı', // Field for PayFast
    'online_payment_pdtKey'              => 'Pdt açarı', // Field for PayFast
    'online_payment_username'            => 'İstifadəçi adı', // Field for Payflow_Pro
    'online_payment_vendor'              => 'Təchizatçı', // Field for Payflow_Pro
    'online_payment_partner'             => 'Partnyor', // Field for Payflow_Pro
    'online_payment_pxPostUsername'      => 'PX istifadəçi adı', // Field for PaymentExpress_PxPay
    'online_payment_pxPostPassword'      => 'PX istifadəçinin şifrəsi', // Field for PaymentExpress_PxPay
    'online_payment_signature'           => 'İmza', // Field for PayPal_Express
    'online_payment_referrerId'          => 'Sorğu qaynağının ID-si', // Field for SagePay_Direct
    'online_payment_transactionPassword' => 'Əməliyyat şifrəsi', // Field for SecurePay_DirectPost
    'online_payment_subAccountId'        => 'Sub-hesab ID-si', // Field for TargetPay_Directebanking
    'online_payment_secretWord'          => 'Məxfi söz', // Field for TwoCheckout
    'online_payment_installationId'      => 'Sehrbaz ID-si', // Field for WorldPay
    'online_payment_callbackPassword'    => '"Callback" üçün şifrə', // Field for WorldPay

    // Status / Error Messages
    'online_payment_payment_cancelled'   => 'Ödəniş ləğv edildi.',
    'online_payment_payment_failed'      => 'Ödəniş keçmədi. Lütfən, bir daha sınayın.',
    'online_payment_payment_successful'  => '%s fakturası üzrə ödəmə müvəffəqiyyətlə keçdi!',
    'online_payment_payment_redirect'    => 'Ödəmə səhifəsinə yönəldilirsiniz, lütfən gözləyin...',
    'online_payment_3dauth_redirect'     => 'Sənədi doğrulamaq üçün kart emitentinizə istiqamətləndirərkən xahiş edirik gözləyin ...'
);