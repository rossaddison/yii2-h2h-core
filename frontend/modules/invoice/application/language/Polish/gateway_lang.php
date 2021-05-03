<?php
/**
 * Contains the language translations for the payment gateways
 */
$lang = array(
    // General strings
    'online_payment'                     => 'Płatność Online',
    'online_payments'                    => 'Płatności Online',
    'online_payment_for'                 => 'Płatność Online dla',
    'online_payment_for_invoice'         => 'Płatności online dla faktury',
    'online_payment_method'              => 'Metoda Płatności Online',
    'online_payment_creditcard_hint'     => 'Jeśli zamierzasz płacić kartą, uzupełnij poniższe informacje.<br/>Informacje dot. karty kredytowej nie są przechowywane na naszych serwerach i będą przesłane do bramki płatniczej przy użyciu bezpieczengo połączenia szyfrowanego.',
    'enable_online_payments'             => 'Włącz płatności on-line',
    'payment_provider'                   => 'Dostawca płatności',
    'add_payment_provider'               => 'Dodaj usługę płatniczą',
    'transaction_reference'              => 'Transaction Reference',
    'payment_description'                => 'Płatność za fakturę %s',

    // Credit card strings
    'creditcard_cvv'                     => 'CVV / CSC',
    'creditcard_details'                 => 'Szczegóły Karty Kredytowej',
    'creditcard_expiry_month'            => 'Miesiąc Ważności',
    'creditcard_expiry_year'             => 'Rok Ważności',
    'creditcard_number'                  => 'Numer Karty Kredytowej',
    'online_payment_card_invalid'        => 'Ta karta kredytowa jest nieprawidłowa. Prosimy sprawdzić podane informacje.',

    // Payment Gateway Fields
    'online_payment_apiLoginId'          => 'Login/ID API', // Field for AuthorizeNet_AIM
    'online_payment_transactionKey'      => 'Klucz transakcji', // Field for AuthorizeNet_AIM
    'online_payment_testMode'            => 'Tryb Testowy', // Field for AuthorizeNet_AIM
    'online_payment_developerMode'       => 'Tryb Deweloperski', // Field for AuthorizeNet_AIM
    'online_payment_websiteKey'          => 'Klucz strony internetowej', // Field for Buckaroo_Ideal
    'online_payment_secretKey'           => 'Tajny Klucz', // Field for Buckaroo_Ideal
    'online_payment_merchantId'          => 'Id Handlowca', // Field for CardSave
    'online_payment_password'            => 'Hasło', // Field for CardSave
    'online_payment_apiKey'              => 'Klucz Api', // Field for Coinbase
    'online_payment_secret'              => 'Klucz', // Field for Coinbase
    'online_payment_accountId'           => 'Id Konta', // Field for Coinbase
    'online_payment_storeId'             => 'ID magazynu', // Field for FirstData_Connect
    'online_payment_sharedSecret'        => 'Klucz wspólny', // Field for FirstData_Connect
    'online_payment_appId'               => 'Id Aplikacji', // Field for GoCardless
    'online_payment_appSecret'           => 'Klucz Aplikacji', // Field for GoCardless
    'online_payment_accessToken'         => 'Klucz Dostępu', // Field for GoCardless
    'online_payment_merchantAccessCode'  => 'Merchant Access Code', // Field for Migs_ThreeParty
    'online_payment_secureHash'          => 'Secure Hash', // Field for Migs_ThreeParty
    'online_payment_siteId'              => 'Id Strony', // Field for MultiSafepay
    'online_payment_siteCode'            => 'Kod Strony', // Field for MultiSafepay
    'online_payment_accountNumber'       => 'Numer Konta', // Field for NetBanx
    'online_payment_storePassword'       => 'Zachowaj hasło', // Field for NetBanx
    'online_payment_merchantKey'         => 'Identyfikator handlowca', // Field for PayFast
    'online_payment_pdtKey'              => 'Klucz PDT', // Field for PayFast
    'online_payment_username'            => 'Nazwa użytkownika', // Field for Payflow_Pro
    'online_payment_vendor'              => 'Vendor', // Field for Payflow_Pro
    'online_payment_partner'             => 'Partner', // Field for Payflow_Pro
    'online_payment_pxPostUsername'      => 'Px Post Username', // Field for PaymentExpress_PxPay
    'online_payment_pxPostPassword'      => 'Px Post Password', // Field for PaymentExpress_PxPay
    'online_payment_signature'           => 'Signature', // Field for PayPal_Express
    'online_payment_referrerId'          => 'Referrer Id', // Field for SagePay_Direct
    'online_payment_transactionPassword' => 'Hasło transakcji', // Field for SecurePay_DirectPost
    'online_payment_subAccountId'        => 'Identyfikator subkonta', // Field for TargetPay_Directebanking
    'online_payment_secretWord'          => 'Tajne słowo', // Field for TwoCheckout
    'online_payment_installationId'      => 'Identyfikator instalacji', // Field for WorldPay
    'online_payment_callbackPassword'    => 'Callback Password', // Field for WorldPay

    // Status / Error Messages
    'online_payment_payment_cancelled'   => 'Płatność anulowana.',
    'online_payment_payment_failed'      => 'Płatność nie powiodła się. Spróbuj ponownie.',
    'online_payment_payment_successful'  => 'Płatność za fakturę %s udana!',
    'online_payment_payment_redirect'    => 'Proszę czekać, trwa przekierowanie do strony płatności...',
    'online_payment_3dauth_redirect'     => 'Proszę czekać... Przekierowujemy Cię do wystawcy twojej karty w celu uwierzytelnienia...'
);