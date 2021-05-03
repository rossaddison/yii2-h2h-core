<?php
/**
 * Contains the language translations for the payment gateways
 */
$lang = array(
    // General strings
    'online_payment'                     => 'Ηλεκτρονική Πληρωμή',
    'online_payments'                    => 'Ηλεκτρονικές Πληρωμές',
    'online_payment_for'                 => 'Ηλεκτρονική Πληρωμή για',
    'online_payment_for_invoice'         => 'Online πληρωμή τιμολογίου',
    'online_payment_method'              => 'Μέθοδος Ηλεκτρονικής Πληρωμής',
    'online_payment_creditcard_hint'     => 'Για συναλλαγή μέσω πιστωτικής κάρτας παρακαλώ εισάγετε τα παρακάτω στοιχεία.<br />
Τα στοιχεία της πιστωτικής κάρτας δεν αποθηκεύονται στους διακομιστές μας και θα μεταφερθούν στην ηλεκτρονική πύλη πληρωμής μέσω ασφαλούς σύνδεσης.',
    'enable_online_payments'             => 'Ενεργοποίηση Online πληρωμών',
    'payment_provider'                   => 'Πάροχος Υπηρεσίας Πληρωμής',
    'add_payment_provider'               => 'Προσθέσετε μια υπηρεσία παροχής πληρωμής',
    'transaction_reference'              => 'Αναφορά συναλλαγής',
    'payment_description'                => 'Πληρωμή τιμολογίου %s',

    // Credit card strings
    'creditcard_cvv'                     => 'AEK / KAK',
    'creditcard_details'                 => 'Στοιχεία Πιστωτικής Κάρτας',
    'creditcard_expiry_month'            => 'Μήνας Λήξης',
    'creditcard_expiry_year'             => 'Έτος Λήξης',
    'creditcard_number'                  => 'Αριθμός Πιστωτικής Κάρτας',
    'online_payment_card_invalid'        => 'Η πιστωτική κάρτα δεν είναι έγκυρη. Παρακαλούμε ελέγξτε τις πληροφορίες που δώσατε.',

    // Payment Gateway Fields
    'online_payment_apiLoginId'          => 'Αναγνωριστικό σύνδεσης API', // Field for AuthorizeNet_AIM
    'online_payment_transactionKey'      => 'Κλειδί Συναλλαγής', // Field for AuthorizeNet_AIM
    'online_payment_testMode'            => 'Δοκιμαστική Λειτουργία', // Field for AuthorizeNet_AIM
    'online_payment_developerMode'       => 'Λειτουργία Προγραμματιστή', // Field for AuthorizeNet_AIM
    'online_payment_websiteKey'          => 'Κλειδί Ιστοσελίδας', // Field for Buckaroo_Ideal
    'online_payment_secretKey'           => 'Μυστικό Κλειδί', // Field for Buckaroo_Ideal
    'online_payment_merchantId'          => 'Αναγνωριστικό Εμπόρου', // Field for CardSave
    'online_payment_password'            => 'Συνθηματικό', // Field for CardSave
    'online_payment_apiKey'              => 'Κλειδί API', // Field for Coinbase
    'online_payment_secret'              => 'Μυστικό', // Field for Coinbase
    'online_payment_accountId'           => 'Αναγνωριστικό λογαριασμού', // Field for Coinbase
    'online_payment_storeId'             => 'Αναγνωριστικό καταστήματος', // Field for FirstData_Connect
    'online_payment_sharedSecret'        => 'Διαμοιραζόμενο μυστικό κλειδί', // Field for FirstData_Connect
    'online_payment_appId'               => 'Αναγνωριστικό εφαρμογής', // Field for GoCardless
    'online_payment_appSecret'           => 'Μυστικό Εφαρμογής', // Field for GoCardless
    'online_payment_accessToken'         => 'Διακριτικό Πρόσβασης', // Field for GoCardless
    'online_payment_merchantAccessCode'  => 'Κωδικός Πρόσβασης Εμπόρου', // Field for Migs_ThreeParty
    'online_payment_secureHash'          => 'Κωδικοποίηση Hash', // Field for Migs_ThreeParty
    'online_payment_siteId'              => 'Αναγνωριστικό ιστοσελίδας', // Field for MultiSafepay
    'online_payment_siteCode'            => 'Κωδικός ιστοσελίδας', // Field for MultiSafepay
    'online_payment_accountNumber'       => 'Αριθμός Λογαριασμού', // Field for NetBanx
    'online_payment_storePassword'       => 'Αποθήκευση Συνθηματικού', // Field for NetBanx
    'online_payment_merchantKey'         => 'Κλειδί εμπόρου', // Field for PayFast
    'online_payment_pdtKey'              => 'Κλειδί PDT', // Field for PayFast
    'online_payment_username'            => 'Όνομα Χρήστη', // Field for Payflow_Pro
    'online_payment_vendor'              => 'Προμηθευτής', // Field for Payflow_Pro
    'online_payment_partner'             => 'Συνεργάτης', // Field for Payflow_Pro
    'online_payment_pxPostUsername'      => 'Px Post Όνομα Χρήστη', // Field for PaymentExpress_PxPay
    'online_payment_pxPostPassword'      => 'Px Post Συνθηματικό Πρόσβασης', // Field for PaymentExpress_PxPay
    'online_payment_signature'           => 'Υπογραφή', // Field for PayPal_Express
    'online_payment_referrerId'          => 'Αναγνωριστικό Αναφοράς', // Field for SagePay_Direct
    'online_payment_transactionPassword' => 'Συνθηματικό Συναλλαγής', // Field for SecurePay_DirectPost
    'online_payment_subAccountId'        => 'Αναγνωριστικό Υπό Λογαριασμού', // Field for TargetPay_Directebanking
    'online_payment_secretWord'          => 'Μυστική Φράση', // Field for TwoCheckout
    'online_payment_installationId'      => 'Αναγνωριστικό Εγκατάστασης', // Field for WorldPay
    'online_payment_callbackPassword'    => 'Συνθηματικό Επιστροφής Κλήσης', // Field for WorldPay

    // Status / Error Messages
    'online_payment_payment_cancelled'   => 'Ακύρωση Πληρωμής.',
    'online_payment_payment_failed'      => 'Η πληρωμή απέτυχε. Παρακαλούμε ξαναπροσπαθήστε.',
    'online_payment_payment_successful'  => 'Επιτυχής πληρωμή τιμολογίου %s!',
    'online_payment_payment_redirect'    => 'Παρακαλώ περιμένετε ενώ σας ανακατευθύνουμε στην σελίδα πληρωμής...',
    'online_payment_3dauth_redirect'     => 'Παρακαλώ περιμένετε ενώ σας ανακατευθύνουμε τον εκδότη της κάρτας σας για έλεγχο ταυτότητας...'
);