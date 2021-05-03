<?php
/**
 * Contains the language translations for the payment gateways
 */
$lang = array(
    // General strings
    'online_payment'                     => 'Pagamento Online',
    'online_payments'                    => 'Pagamentos Online',
    'online_payment_for'                 => 'Pagamento Online para',
    'online_payment_for_invoice'         => 'Pagamento de Fatura Online',
    'online_payment_method'              => 'Método de pagamento on-line',
    'online_payment_creditcard_hint'     => 'Se você quiser pagar com cartão de crédito insira as informações abaixo.<br/>As informações do cartão de crédito não são armazenadas em nossos servidores e serão enviadas ao Gateway de pagamento através de uma conexão segura.',
    'enable_online_payments'             => 'Habilitar Pagamentos Online',
    'payment_provider'                   => 'Provedor de Pagamentos',
    'add_payment_provider'               => 'Adicionar Provedor de Pagamentos',
    'transaction_reference'              => 'Referência de transação',
    'payment_description'                => 'Pagamento da Fatura %s',

    // Credit card strings
    'creditcard_cvv'                     => 'Código de Segurança',
    'creditcard_details'                 => 'Cartão de Crédito',
    'creditcard_expiry_month'            => 'Mês de expiração',
    'creditcard_expiry_year'             => 'Ano de expiração',
    'creditcard_number'                  => 'Número do Cartão de Crédito',
    'online_payment_card_invalid'        => 'Este cartão de crédito é inválido. Por favor, verifique as informações fornecidas.',

    // Payment Gateway Fields
    'online_payment_apiLoginId'          => 'API Login ID', // Field for AuthorizeNet_AIM
    'online_payment_transactionKey'      => 'Chave de transação', // Field for AuthorizeNet_AIM
    'online_payment_testMode'            => 'Modo de Teste', // Field for AuthorizeNet_AIM
    'online_payment_developerMode'       => 'Modo de desenvolvedor', // Field for AuthorizeNet_AIM
    'online_payment_websiteKey'          => 'Chave do site', // Field for Buckaroo_Ideal
    'online_payment_secretKey'           => 'Chave Secreta', // Field for Buckaroo_Ideal
    'online_payment_merchantId'          => 'ID de Vendedor', // Field for CardSave
    'online_payment_password'            => 'Senha', // Field for CardSave
    'online_payment_apiKey'              => 'Chave de API', // Field for Coinbase
    'online_payment_secret'              => 'Segredo', // Field for Coinbase
    'online_payment_accountId'           => 'Id da Conta', // Field for Coinbase
    'online_payment_storeId'             => 'ID da loja', // Field for FirstData_Connect
    'online_payment_sharedSecret'        => 'Chave Secreta Partilhada', // Field for FirstData_Connect
    'online_payment_appId'               => 'ID do Applicativo', // Field for GoCardless
    'online_payment_appSecret'           => 'Chave Segredo App', // Field for GoCardless
    'online_payment_accessToken'         => 'Token de acesso', // Field for GoCardless
    'online_payment_merchantAccessCode'  => 'Código de Acesso de Vendedor', // Field for Migs_ThreeParty
    'online_payment_secureHash'          => 'Hash seguro', // Field for Migs_ThreeParty
    'online_payment_siteId'              => 'ID do site', // Field for MultiSafepay
    'online_payment_siteCode'            => 'Código do Site', // Field for MultiSafepay
    'online_payment_accountNumber'       => 'Número da conta', // Field for NetBanx
    'online_payment_storePassword'       => 'Armazenar senha', // Field for NetBanx
    'online_payment_merchantKey'         => 'Chave de Vendedor', // Field for PayFast
    'online_payment_pdtKey'              => 'Chave Pdt', // Field for PayFast
    'online_payment_username'            => 'Usuário', // Field for Payflow_Pro
    'online_payment_vendor'              => 'Fornecedor', // Field for Payflow_Pro
    'online_payment_partner'             => 'Parceiro', // Field for Payflow_Pro
    'online_payment_pxPostUsername'      => 'Usuário Post Px', // Field for PaymentExpress_PxPay
    'online_payment_pxPostPassword'      => 'Senha Post Px', // Field for PaymentExpress_PxPay
    'online_payment_signature'           => 'Assinatura', // Field for PayPal_Express
    'online_payment_referrerId'          => 'ID de referência', // Field for SagePay_Direct
    'online_payment_transactionPassword' => 'Senha de transação', // Field for SecurePay_DirectPost
    'online_payment_subAccountId'        => 'Id da Subconta', // Field for TargetPay_Directebanking
    'online_payment_secretWord'          => 'Palavra secreta', // Field for TwoCheckout
    'online_payment_installationId'      => 'ID Instalação', // Field for WorldPay
    'online_payment_callbackPassword'    => 'Retorno de chamada da Senha', // Field for WorldPay

    // Status / Error Messages
    'online_payment_payment_cancelled'   => 'Pagamento cancelado.',
    'online_payment_payment_failed'      => 'Falha no pagamento. Por favor, tente novamente.',
    'online_payment_payment_successful'  => 'O pagamento da fatura %s foi feito com sucesso!',
    'online_payment_payment_redirect'    => 'Aguarde enquanto redirecionamos você para a opção de pagamento escolhida...',
    'online_payment_3dauth_redirect'     => 'Aguarde enquanto redirecionamos você ao emissor do cartão para a autenticação...'
);