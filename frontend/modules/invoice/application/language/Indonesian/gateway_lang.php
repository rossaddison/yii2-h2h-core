<?php
/**
 * Contains the language translations for the payment gateways
 */
$lang = array(
    // General strings
    'online_payment'                     => 'Pembayaran Online',
    'online_payments'                    => 'Pembayaran Online',
    'online_payment_for'                 => 'Pembayaran Online untuk',
    'online_payment_for_invoice'         => 'Pembayaran Online untuk Faktur',
    'online_payment_method'              => 'Metode Pembayaran Online',
    'online_payment_creditcard_hint'     => 'Jika Anda ingin membayar melalui kartu kredit, masukkan informasi di bawah ini.<br/>Informasi kartu kredit tidak disimpan di server kami dan akan diteruskan ke jalur pembayaran online menggunakan sambungan aman.',
    'enable_online_payments'             => 'Aktifkan Pembayaran Online',
    'payment_provider'                   => 'Penyedia Pembayaran',
    'add_payment_provider'               => 'Tambahkan Penyedia Pembayaran',
    'transaction_reference'              => 'Referensi Transaksi',
    'payment_description'                => 'Pembayaran untuk Faktur %s',

    // Credit card strings
    'creditcard_cvv'                     => 'CVV / CSC',
    'creditcard_details'                 => 'Rincian kartu kredit',
    'creditcard_expiry_month'            => 'Bulan kadaluarsa',
    'creditcard_expiry_year'             => 'Tahun kedaluwarsa',
    'creditcard_number'                  => 'Nomor Kartu Kredit',
    'online_payment_card_invalid'        => 'Kartu kredit ini tidak valid Silakan periksa informasi yang diberikan.',

    // Payment Gateway Fields
    'online_payment_apiLoginId'          => 'Nomor login Api', // Field for AuthorizeNet_AIM
    'online_payment_transactionKey'      => 'Kunci Transaksi', // Field for AuthorizeNet_AIM
    'online_payment_testMode'            => 'Mode Uji', // Field for AuthorizeNet_AIM
    'online_payment_developerMode'       => 'Mode pengembang', // Field for AuthorizeNet_AIM
    'online_payment_websiteKey'          => 'Kunci Website', // Field for Buckaroo_Ideal
    'online_payment_secretKey'           => 'Kunci Rahasia', // Field for Buckaroo_Ideal
    'online_payment_merchantId'          => 'Merchant Id', // Field for CardSave
    'online_payment_password'            => 'Kata sandi', // Field for CardSave
    'online_payment_apiKey'              => 'Api Key', // Field for Coinbase
    'online_payment_secret'              => 'Rahasia', // Field for Coinbase
    'online_payment_accountId'           => 'Account Id', // Field for Coinbase
    'online_payment_storeId'             => 'Store Id', // Field for FirstData_Connect
    'online_payment_sharedSecret'        => 'Rahasia yang dibagikan', // Field for FirstData_Connect
    'online_payment_appId'               => 'App Id', // Field for GoCardless
    'online_payment_appSecret'           => 'App Secret', // Field for GoCardless
    'online_payment_accessToken'         => 'Access Token', // Field for GoCardless
    'online_payment_merchantAccessCode'  => 'Kode Akses Pedagang', // Field for Migs_ThreeParty
    'online_payment_secureHash'          => 'Secure Hash', // Field for Migs_ThreeParty
    'online_payment_siteId'              => 'Site Id', // Field for MultiSafepay
    'online_payment_siteCode'            => 'Site Code', // Field for MultiSafepay
    'online_payment_accountNumber'       => 'Nomor akun', // Field for NetBanx
    'online_payment_storePassword'       => 'Store Password', // Field for NetBanx
    'online_payment_merchantKey'         => 'Kunci pedagang', // Field for PayFast
    'online_payment_pdtKey'              => 'Pdt Key', // Field for PayFast
    'online_payment_username'            => 'Nama pengguna', // Field for Payflow_Pro
    'online_payment_vendor'              => 'Penjaja', // Field for Payflow_Pro
    'online_payment_partner'             => 'Pasangan', // Field for Payflow_Pro
    'online_payment_pxPostUsername'      => 'Px Post Username', // Field for PaymentExpress_PxPay
    'online_payment_pxPostPassword'      => 'Px Post Password', // Field for PaymentExpress_PxPay
    'online_payment_signature'           => 'Tanda tangan', // Field for PayPal_Express
    'online_payment_referrerId'          => 'Referrer Id', // Field for SagePay_Direct
    'online_payment_transactionPassword' => 'Password Transaksi', // Field for SecurePay_DirectPost
    'online_payment_subAccountId'        => 'Sub Account Id', // Field for TargetPay_Directebanking
    'online_payment_secretWord'          => 'Kata rahasia', // Field for TwoCheckout
    'online_payment_installationId'      => 'Id penginstalan', // Field for WorldPay
    'online_payment_callbackPassword'    => 'Kata sandi panggil balik', // Field for WorldPay

    // Status / Error Messages
    'online_payment_payment_cancelled'   => 'Pembayaran dibatalkan.',
    'online_payment_payment_failed'      => 'Pembayaran gagal. Silahkan coba lagi.',
    'online_payment_payment_successful'  => 'Pembayaran untuk Faktur %s berhasil!',
    'online_payment_payment_redirect'    => 'Harap tunggu sementara kami mengarahkan Anda ke halaman pembayaran...',
    'online_payment_3dauth_redirect'     => 'Harap tunggu sementara kami mengarahkan Anda ke penerbit kartu Anda untuk otentikasi...'
);