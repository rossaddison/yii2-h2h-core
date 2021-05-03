<?php
/**
 * Contains the language translations for the payment gateways
 */
$lang = array(
    // General strings
    'online_payment'                     => 'Tiešsaistes maksājums',
    'online_payments'                    => 'Tiešsaistes maksājumi',
    'online_payment_for'                 => 'Tiešsaistes maksājums par',
    'online_payment_for_invoice'         => 'Tiešsaistes maksājums par rēķinu',
    'online_payment_method'              => 'Tiešsaistes maksājuma metode',
    'online_payment_creditcard_hint'     => 'Ja jūs vēlaties maksāt ar kredītkarti, lūdzu, ievadiet informāciju zemāk.<br/> Kredītkartes informācija netiek saglabāta mūsu serveros un tiks nodota tiešsaistes maksājumu vārtejai, izmantojot drošu savienojumu.',
    'enable_online_payments'             => 'Iespējot tiešsaistes maksājumus',
    'payment_provider'                   => 'Maksājumu pakalpojumu sniedzējs',
    'add_payment_provider'               => 'Pievienot maksājumu pakalpojumu sniedzēju',
    'transaction_reference'              => 'Darījuma atskaite',
    'payment_description'                => 'Samaksa par rēķinu %s',

    // Credit card strings
    'creditcard_cvv'                     => 'CVV / CSC',
    'creditcard_details'                 => 'Kredītkartes dati',
    'creditcard_expiry_month'            => 'Beigu termiņa mēnesis',
    'creditcard_expiry_year'             => 'Beigu termiņa gads',
    'creditcard_number'                  => 'Kredītkartes numurs',
    'online_payment_card_invalid'        => 'Šī kredītkarte ir nederīga. Lūdzu pārbaudiet iesniegto informāciju.',

    // Payment Gateway Fields
    'online_payment_apiLoginId'          => 'API autorizācijas ID', // Field for AuthorizeNet_AIM
    'online_payment_transactionKey'      => 'Transakcijas atslēga', // Field for AuthorizeNet_AIM
    'online_payment_testMode'            => 'Testa režīms', // Field for AuthorizeNet_AIM
    'online_payment_developerMode'       => 'Izstrādātāja režīms', // Field for AuthorizeNet_AIM
    'online_payment_websiteKey'          => 'Mājas lapas atslēga', // Field for Buckaroo_Ideal
    'online_payment_secretKey'           => 'Slepenā atslēga', // Field for Buckaroo_Ideal
    'online_payment_merchantId'          => 'Tirgotāja ID', // Field for CardSave
    'online_payment_password'            => 'Parole', // Field for CardSave
    'online_payment_apiKey'              => 'API atslēga', // Field for Coinbase
    'online_payment_secret'              => 'Noslēpums', // Field for Coinbase
    'online_payment_accountId'           => 'Konta ID', // Field for Coinbase
    'online_payment_storeId'             => 'Veikala ID', // Field for FirstData_Connect
    'online_payment_sharedSecret'        => 'Dalītais noslēpums', // Field for FirstData_Connect
    'online_payment_appId'               => 'Lietotnes ID', // Field for GoCardless
    'online_payment_appSecret'           => 'Lietotnes noslēpums', // Field for GoCardless
    'online_payment_accessToken'         => 'Piekļuves žetons', // Field for GoCardless
    'online_payment_merchantAccessCode'  => 'Tirgotāja piekļuves kods', // Field for Migs_ThreeParty
    'online_payment_secureHash'          => 'Droša HASH vērtība', // Field for Migs_ThreeParty
    'online_payment_siteId'              => 'Vietnes ID', // Field for MultiSafepay
    'online_payment_siteCode'            => 'Vietnes kods', // Field for MultiSafepay
    'online_payment_accountNumber'       => 'Konta numurs', // Field for NetBanx
    'online_payment_storePassword'       => 'Veikala parole', // Field for NetBanx
    'online_payment_merchantKey'         => 'Tirgotāja atslēga', // Field for PayFast
    'online_payment_pdtKey'              => 'PDT atslēga', // Field for PayFast
    'online_payment_username'            => 'Lietotājvārds', // Field for Payflow_Pro
    'online_payment_vendor'              => 'Piegādātājs', // Field for Payflow_Pro
    'online_payment_partner'             => 'Partneris', // Field for Payflow_Pro
    'online_payment_pxPostUsername'      => 'Px Post lietotājvārds', // Field for PaymentExpress_PxPay
    'online_payment_pxPostPassword'      => 'Px Post parole', // Field for PaymentExpress_PxPay
    'online_payment_signature'           => 'Paraksts', // Field for PayPal_Express
    'online_payment_referrerId'          => 'Norādītāja ID', // Field for SagePay_Direct
    'online_payment_transactionPassword' => 'Tranzakcijas parole', // Field for SecurePay_DirectPost
    'online_payment_subAccountId'        => 'Apakškonta ID', // Field for TargetPay_Directebanking
    'online_payment_secretWord'          => 'Slepenais vārds', // Field for TwoCheckout
    'online_payment_installationId'      => 'Instalācijas ID', // Field for WorldPay
    'online_payment_callbackPassword'    => 'Atzvanīšanas parole', // Field for WorldPay

    // Status / Error Messages
    'online_payment_payment_cancelled'   => 'Maksājums ir atcelts.',
    'online_payment_payment_failed'      => 'Maksājums neizdevās. Lūdzu mēģiniet vēlreiz.',
    'online_payment_payment_successful'  => 'Samaksa par rēķinu %s veiksmīga!',
    'online_payment_payment_redirect'    => 'Lūdzu uzgaidiet, kamēr mēs jūs novirzīsim uz maksājumu lapu...',
    'online_payment_3dauth_redirect'     => 'Lūdzu uzgaidiet, kamēr mēs jūs novirzīsim uz kartes autentifikācijai pie tās izdevēja...'
);