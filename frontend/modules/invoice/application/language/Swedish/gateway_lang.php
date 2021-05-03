<?php
/**
 * Contains the language translations for the payment gateways
 */
$lang = array(
    // General strings
    'online_payment'                     => 'Onlinebetalning',
    'online_payments'                    => 'Onlinebetalningar',
    'online_payment_for'                 => 'Onlinebetalning för',
    'online_payment_for_invoice'         => 'Online betalning för fakturan',
    'online_payment_method'              => 'Metod för online betalningar',
    'online_payment_creditcard_hint'     => 'Om du vill betala med kontokort var god skriv in informationen nedan.<br/>Kortinformationen sparas inte på våra servrar och kommer att vidarebefordras till online-betalservicen över krypterad anslutning.',
    'enable_online_payments'             => 'Aktivera Online betalningar',
    'payment_provider'                   => 'Betalningsleverantör',
    'add_payment_provider'               => 'Lägga till en betalningsleverantör',
    'transaction_reference'              => 'Transaktionsreferens',
    'payment_description'                => 'Betalning för faktura %s',

    // Credit card strings
    'creditcard_cvv'                     => 'CVV / CSC',
    'creditcard_details'                 => 'Kreditkortsuppgifter',
    'creditcard_expiry_month'            => 'Utgångsmånad',
    'creditcard_expiry_year'             => 'Utgångsår',
    'creditcard_number'                  => 'Kreditkortsnummer',
    'online_payment_card_invalid'        => 'Detta kreditkort är ogiltig. Vänligen kontrollera den angivna informationen.',

    // Payment Gateway Fields
    'online_payment_apiLoginId'          => 'Api inloggnings-Id', // Field for AuthorizeNet_AIM
    'online_payment_transactionKey'      => 'Transaktionsnyckel', // Field for AuthorizeNet_AIM
    'online_payment_testMode'            => 'Testläge', // Field for AuthorizeNet_AIM
    'online_payment_developerMode'       => 'Utvecklarläge', // Field for AuthorizeNet_AIM
    'online_payment_websiteKey'          => 'Nyckel till webbsida', // Field for Buckaroo_Ideal
    'online_payment_secretKey'           => 'Hemlig nyckel', // Field for Buckaroo_Ideal
    'online_payment_merchantId'          => 'Handlare-Id', // Field for CardSave
    'online_payment_password'            => 'Lösenord', // Field for CardSave
    'online_payment_apiKey'              => 'Api-nyckel', // Field for Coinbase
    'online_payment_secret'              => 'Hemlighet', // Field for Coinbase
    'online_payment_accountId'           => 'Konto-Id', // Field for Coinbase
    'online_payment_storeId'             => 'Lagrings-Id', // Field for FirstData_Connect
    'online_payment_sharedSecret'        => 'Delad hemlighet', // Field for FirstData_Connect
    'online_payment_appId'               => 'App-Id', // Field for GoCardless
    'online_payment_appSecret'           => 'App hemlighet', // Field for GoCardless
    'online_payment_accessToken'         => 'Access Token', // Field for GoCardless
    'online_payment_merchantAccessCode'  => 'Köpman åtkomstkod', // Field for Migs_ThreeParty
    'online_payment_secureHash'          => 'Secure Hash', // Field for Migs_ThreeParty
    'online_payment_siteId'              => 'Sajt-id', // Field for MultiSafepay
    'online_payment_siteCode'            => 'Platskod', // Field for MultiSafepay
    'online_payment_accountNumber'       => 'Kontonummer', // Field for NetBanx
    'online_payment_storePassword'       => 'Spara lösenord', // Field for NetBanx
    'online_payment_merchantKey'         => 'Handlarnyckel', // Field for PayFast
    'online_payment_pdtKey'              => 'Pdt nyckel', // Field for PayFast
    'online_payment_username'            => 'Användarnamn', // Field for Payflow_Pro
    'online_payment_vendor'              => 'Försäljare', // Field for Payflow_Pro
    'online_payment_partner'             => 'Partner', // Field for Payflow_Pro
    'online_payment_pxPostUsername'      => 'Px Post användarnamn', // Field for PaymentExpress_PxPay
    'online_payment_pxPostPassword'      => 'Px Post lösenord', // Field for PaymentExpress_PxPay
    'online_payment_signature'           => 'Signatur', // Field for PayPal_Express
    'online_payment_referrerId'          => 'Värvaren Id', // Field for SagePay_Direct
    'online_payment_transactionPassword' => 'Transaktion lösenord', // Field for SecurePay_DirectPost
    'online_payment_subAccountId'        => 'Sub konto-Id', // Field for TargetPay_Directebanking
    'online_payment_secretWord'          => 'Hemligt ord', // Field for TwoCheckout
    'online_payment_installationId'      => 'Installations-Id', // Field for WorldPay
    'online_payment_callbackPassword'    => 'Motringning lösenord', // Field for WorldPay

    // Status / Error Messages
    'online_payment_payment_cancelled'   => 'Betalning avbruten.',
    'online_payment_payment_failed'      => 'Betalning misslyckades. Försök igen.',
    'online_payment_payment_successful'  => 'Betalning för faktura %s lyckades!',
    'online_payment_payment_redirect'    => 'Vänta medan vi omdirigerar dig till betalningssidan...',
    'online_payment_3dauth_redirect'     => 'Vänta medan vi omdirigera dig till din kortutgivare för autentisering...'
);