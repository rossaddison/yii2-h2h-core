<?php
/**
 * Contains the language translations for the payment gateways
 */
$lang = array(
    // General strings
    'online_payment'                     => 'Platební brána',
    'online_payments'                    => 'Platební brány',
    'online_payment_for'                 => 'Platební brána pro',
    'online_payment_for_invoice'         => 'Online platba faktury',
    'online_payment_method'              => 'Způsob platební brány',
    'online_payment_creditcard_hint'     => 'Pokud si přejete zaplatit pomocí kreditní karty zadejte níže informace. <br/> Informace o platební kartě nejsou uloženy na našich serverech a budou převedeny na platební brány pomocí zabezpečeného připojení.',
    'enable_online_payments'             => 'Povolit online platby',
    'payment_provider'                   => 'Poskytovatel online plateb',
    'add_payment_provider'               => 'Přidat poskytovatele plateb',
    'transaction_reference'              => 'Odkaz transakce',
    'payment_description'                => 'Platba za fakturu číslo %s',

    // Credit card strings
    'creditcard_cvv'                     => 'CVV / CSC',
    'creditcard_details'                 => 'Podrobnosti o kreditní kartě',
    'creditcard_expiry_month'            => 'Měsíc expirace',
    'creditcard_expiry_year'             => 'Rok expirace',
    'creditcard_number'                  => 'Číslo kreditní karty',
    'online_payment_card_invalid'        => 'Tato kreditní karta je neplatná. Zkontrolujte prosím zadané informace.',

    // Payment Gateway Fields
    'online_payment_apiLoginId'          => 'Přihlašovací ID API', // Field for AuthorizeNet_AIM
    'online_payment_transactionKey'      => 'Transakční klíč', // Field for AuthorizeNet_AIM
    'online_payment_testMode'            => 'Testovací režim', // Field for AuthorizeNet_AIM
    'online_payment_developerMode'       => 'Vývojářský režim', // Field for AuthorizeNet_AIM
    'online_payment_websiteKey'          => 'Klíč webové stránky', // Field for Buckaroo_Ideal
    'online_payment_secretKey'           => 'Tajný klíč', // Field for Buckaroo_Ideal
    'online_payment_merchantId'          => 'ID obchodníka', // Field for CardSave
    'online_payment_password'            => 'Heslo', // Field for CardSave
    'online_payment_apiKey'              => 'API klíč', // Field for Coinbase
    'online_payment_secret'              => 'Tajný klíč', // Field for Coinbase
    'online_payment_accountId'           => 'ID účtu', // Field for Coinbase
    'online_payment_storeId'             => 'ID obchodu', // Field for FirstData_Connect
    'online_payment_sharedSecret'        => 'Sdílený tajný klíč', // Field for FirstData_Connect
    'online_payment_appId'               => 'ID aplikace', // Field for GoCardless
    'online_payment_appSecret'           => 'Tajný klíč aplikace', // Field for GoCardless
    'online_payment_accessToken'         => 'Přístupový token', // Field for GoCardless
    'online_payment_merchantAccessCode'  => 'Přístupový kód obchodníka', // Field for Migs_ThreeParty
    'online_payment_secureHash'          => 'Tajný hash', // Field for Migs_ThreeParty
    'online_payment_siteId'              => 'ID stránky', // Field for MultiSafepay
    'online_payment_siteCode'            => 'Kód stránky', // Field for MultiSafepay
    'online_payment_accountNumber'       => 'Číslo účtu', // Field for NetBanx
    'online_payment_storePassword'       => 'Uložit heslo', // Field for NetBanx
    'online_payment_merchantKey'         => 'Klíč obchodníka', // Field for PayFast
    'online_payment_pdtKey'              => 'PDT klíč', // Field for PayFast
    'online_payment_username'            => 'Uživatelské jméno', // Field for Payflow_Pro
    'online_payment_vendor'              => 'Dodavatel', // Field for Payflow_Pro
    'online_payment_partner'             => 'Partner', // Field for Payflow_Pro
    'online_payment_pxPostUsername'      => 'Uživatelské jméno Px Post', // Field for PaymentExpress_PxPay
    'online_payment_pxPostPassword'      => 'Px Post heslo', // Field for PaymentExpress_PxPay
    'online_payment_signature'           => 'Podpis', // Field for PayPal_Express
    'online_payment_referrerId'          => 'Referrer ID', // Field for SagePay_Direct
    'online_payment_transactionPassword' => 'Transakční heslo', // Field for SecurePay_DirectPost
    'online_payment_subAccountId'        => 'ID účtu', // Field for TargetPay_Directebanking
    'online_payment_secretWord'          => 'Tajné slovo', // Field for TwoCheckout
    'online_payment_installationId'      => 'Instalační ID', // Field for WorldPay
    'online_payment_callbackPassword'    => 'Callback heslo', // Field for WorldPay

    // Status / Error Messages
    'online_payment_payment_cancelled'   => 'Platba zrušena.',
    'online_payment_payment_failed'      => 'Platba se nezdařila. Zkuste to prosím znovu.',
    'online_payment_payment_successful'  => 'Platba za fakturu číslo %s proběhla úspěšně!',
    'online_payment_payment_redirect'    => 'Počkejte prosím, budete přesměrování na stránku platební brány...',
    'online_payment_3dauth_redirect'     => 'Počkejte prosím, pro ověření budete přesměrování na stránky vydavatele Vaší karty...'
);