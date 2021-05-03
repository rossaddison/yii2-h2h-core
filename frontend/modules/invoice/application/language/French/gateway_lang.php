<?php
/**
 * Contains the language translations for the payment gateways
 */
$lang = array(
    // General strings
    'online_payment'                     => 'Paiement en ligne',
    'online_payments'                    => 'Paiements en ligne',
    'online_payment_for'                 => 'Paiement en ligne pour',
    'online_payment_for_invoice'         => 'Paiement en ligne pour la facture',
    'online_payment_method'              => 'Méthode de paiement en ligne',
    'online_payment_creditcard_hint'     => 'Si vous souhaitez payer par carte bancaire, veuillez saisir les informations suivantes.<br/>Ces données confidentielles ne sont jamais sauvegardées dans nos serveurs mais sont transmises à la passerelle de paiement en ligne à travers une connexion sécurisée.',
    'enable_online_payments'             => 'Activer les paiements en ligne',
    'payment_provider'                   => 'Système de paiement',
    'add_payment_provider'               => 'Ajouter un système de paiement',
    'transaction_reference'              => 'Référence de la transaction',
    'payment_description'                => 'Paiement de facture %s',

    // Credit card strings
    'creditcard_cvv'                     => 'Numéro de vérification de carte',
    'creditcard_details'                 => 'Données carte bancaire',
    'creditcard_expiry_month'            => 'Mois d\'expiration',
    'creditcard_expiry_year'             => 'Année d\'expiration',
    'creditcard_number'                  => 'Numéro de carte de crédit',
    'online_payment_card_invalid'        => 'Données rejetées, veuillez vérifier votre saisie.',

    // Payment Gateway Fields
    'online_payment_apiLoginId'          => 'Id de connexion Api', // Field for AuthorizeNet_AIM
    'online_payment_transactionKey'      => 'Identifiant de transaction', // Field for AuthorizeNet_AIM
    'online_payment_testMode'            => 'Mode test', // Field for AuthorizeNet_AIM
    'online_payment_developerMode'       => 'Mode Développeur', // Field for AuthorizeNet_AIM
    'online_payment_websiteKey'          => 'Clé du site Internet', // Field for Buckaroo_Ideal
    'online_payment_secretKey'           => 'Clé secrète', // Field for Buckaroo_Ideal
    'online_payment_merchantId'          => 'Identifiant marchand', // Field for CardSave
    'online_payment_password'            => 'Mot de passe', // Field for CardSave
    'online_payment_apiKey'              => 'Clé Api', // Field for Coinbase
    'online_payment_secret'              => 'Confidentiel', // Field for Coinbase
    'online_payment_accountId'           => 'Identifiant du compte', // Field for Coinbase
    'online_payment_storeId'             => 'Code magasin', // Field for FirstData_Connect
    'online_payment_sharedSecret'        => 'Information confidentielle', // Field for FirstData_Connect
    'online_payment_appId'               => 'Identifiant d\'application', // Field for GoCardless
    'online_payment_appSecret'           => 'Application confidentielle', // Field for GoCardless
    'online_payment_accessToken'         => 'Jeton d\'authentification', // Field for GoCardless
    'online_payment_merchantAccessCode'  => 'Code d’accès vendeur', // Field for Migs_ThreeParty
    'online_payment_secureHash'          => 'Hachage sécurisé', // Field for Migs_ThreeParty
    'online_payment_siteId'              => 'Identifiant du Site', // Field for MultiSafepay
    'online_payment_siteCode'            => 'Code de site', // Field for MultiSafepay
    'online_payment_accountNumber'       => 'Numéro du compte', // Field for NetBanx
    'online_payment_storePassword'       => 'Enregistrer le mot de passe', // Field for NetBanx
    'online_payment_merchantKey'         => 'Identifiant marchand', // Field for PayFast
    'online_payment_pdtKey'              => 'Clé produit', // Field for PayFast
    'online_payment_username'            => 'Nom d\'utilisateur', // Field for Payflow_Pro
    'online_payment_vendor'              => 'Vendeur', // Field for Payflow_Pro
    'online_payment_partner'             => 'Partenaire', // Field for Payflow_Pro
    'online_payment_pxPostUsername'      => 'Nom d\'utilisateur (envoi paiement express)', // Field for PaymentExpress_PxPay
    'online_payment_pxPostPassword'      => 'Mot de passe (envoi paiement express)', // Field for PaymentExpress_PxPay
    'online_payment_signature'           => 'Signature', // Field for PayPal_Express
    'online_payment_referrerId'          => 'Identifiant de suivi', // Field for SagePay_Direct
    'online_payment_transactionPassword' => 'Mot de passe transaction', // Field for SecurePay_DirectPost
    'online_payment_subAccountId'        => 'Identifiant de sous compte', // Field for TargetPay_Directebanking
    'online_payment_secretWord'          => 'Mot secret', // Field for TwoCheckout
    'online_payment_installationId'      => 'Id d\'installation', // Field for WorldPay
    'online_payment_callbackPassword'    => 'Rappel mot de passe', // Field for WorldPay

    // Status / Error Messages
    'online_payment_payment_cancelled'   => 'Paiement annulé.',
    'online_payment_payment_failed'      => 'Échec paiement, veuillez renouveler votre demande.',
    'online_payment_payment_successful'  => 'Paiement de facture %s réussie !',
    'online_payment_payment_redirect'    => 'Merci de patienter pendant votre redirection vers la page de paiement...',
    'online_payment_3dauth_redirect'     => 'Veuillez patienter pendant que nous vous redirigeons vers l\'émetteur de votre carte pour authentification...'
);