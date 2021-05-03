<?php
/**
 * Contains the language translations for the payment gateways
 */
$lang = array(
    // General strings
    'online_payment'                     => 'Elektronisk betaling',
    'online_payments'                    => 'Elektroniske betalinger',
    'online_payment_for'                 => 'Elektronisk betaling for',
    'online_payment_for_invoice'         => 'Elektronisk betaling for faktura',
    'online_payment_method'              => 'Elektronisk betalingsmetode',
    'online_payment_creditcard_hint'     => 'Hvis du ønsker å betale med kredittkort Skriv inn informasjonen under. <br/> Kredittkortinformasjonen er ikke lagret på våre servere og overføres til elektronisk betaling inngangsport ved hjelp av en sikker tilkobling.',
    'enable_online_payments'             => 'Aktiver elektronisk betaling',
    'payment_provider'                   => 'Betalingsformidler',
    'add_payment_provider'               => 'Legge til en betalingsformidler',
    'transaction_reference'              => 'Transaksjonen referanse',
    'payment_description'                => 'Betaling for faktura %s',

    // Credit card strings
    'creditcard_cvv'                     => 'CVV / CSC',
    'creditcard_details'                 => 'Kredittkortdetaljer',
    'creditcard_expiry_month'            => 'Utløpsmåned',
    'creditcard_expiry_year'             => 'Utløpsår',
    'creditcard_number'                  => 'Kredittkortnummer',
    'online_payment_card_invalid'        => 'Dette kredittkortet er ugyldig. Kontroller gitt informasjon.',

    // Payment Gateway Fields
    'online_payment_apiLoginId'          => 'API påloggings-ID', // Field for AuthorizeNet_AIM
    'online_payment_transactionKey'      => 'Transaksjonsnøkkel', // Field for AuthorizeNet_AIM
    'online_payment_testMode'            => 'Testmodus', // Field for AuthorizeNet_AIM
    'online_payment_developerMode'       => 'Utviklermodus', // Field for AuthorizeNet_AIM
    'online_payment_websiteKey'          => 'Nettstedsnøkkel', // Field for Buckaroo_Ideal
    'online_payment_secretKey'           => 'Hemmelig nøkkel', // Field for Buckaroo_Ideal
    'online_payment_merchantId'          => 'Kjøpmann-ID', // Field for CardSave
    'online_payment_password'            => 'Passord', // Field for CardSave
    'online_payment_apiKey'              => 'API-nøkkel', // Field for Coinbase
    'online_payment_secret'              => 'Hemmelig', // Field for Coinbase
    'online_payment_accountId'           => 'Konto-ID', // Field for Coinbase
    'online_payment_storeId'             => 'Butikk ID', // Field for FirstData_Connect
    'online_payment_sharedSecret'        => 'Delt hemmelighet', // Field for FirstData_Connect
    'online_payment_appId'               => 'Applikasjon-ID', // Field for GoCardless
    'online_payment_appSecret'           => 'Applikasjonshemmelighet', // Field for GoCardless
    'online_payment_accessToken'         => 'Tilgangstoken', // Field for GoCardless
    'online_payment_merchantAccessCode'  => 'Kjøpmann tilgangskode', // Field for Migs_ThreeParty
    'online_payment_secureHash'          => 'Sikker Hash', // Field for Migs_ThreeParty
    'online_payment_siteId'              => 'Område-ID', // Field for MultiSafepay
    'online_payment_siteCode'            => 'Områdekode', // Field for MultiSafepay
    'online_payment_accountNumber'       => 'Kontonummer', // Field for NetBanx
    'online_payment_storePassword'       => 'Lagre passord', // Field for NetBanx
    'online_payment_merchantKey'         => 'Kjøpmann nøkkel', // Field for PayFast
    'online_payment_pdtKey'              => 'PDT nøkkel', // Field for PayFast
    'online_payment_username'            => 'Brukernavn', // Field for Payflow_Pro
    'online_payment_vendor'              => 'Leverandør', // Field for Payflow_Pro
    'online_payment_partner'             => 'Partner', // Field for Payflow_Pro
    'online_payment_pxPostUsername'      => 'Px Post brukernavn', // Field for PaymentExpress_PxPay
    'online_payment_pxPostPassword'      => 'Px Post passord', // Field for PaymentExpress_PxPay
    'online_payment_signature'           => 'Signatur', // Field for PayPal_Express
    'online_payment_referrerId'          => 'Referent ID', // Field for SagePay_Direct
    'online_payment_transactionPassword' => 'Transaksjon passord', // Field for SecurePay_DirectPost
    'online_payment_subAccountId'        => 'Underkonto-ID', // Field for TargetPay_Directebanking
    'online_payment_secretWord'          => 'Hemmelig ord', // Field for TwoCheckout
    'online_payment_installationId'      => 'Installasjons-ID', // Field for WorldPay
    'online_payment_callbackPassword'    => 'Tilbakeringingpassord', // Field for WorldPay

    // Status / Error Messages
    'online_payment_payment_cancelled'   => 'Betalingen avbrutt.',
    'online_payment_payment_failed'      => 'Betaling mislyktes. Prøv på nytt.',
    'online_payment_payment_successful'  => 'Betaling for faktura %s vellykket!',
    'online_payment_payment_redirect'    => 'Vent mens vi viderekoble deg til betalingssiden...',
    'online_payment_3dauth_redirect'     => 'Vent mens vi viderekoble deg til kortutstederen for godkjenning...'
);