<?php
/**
 * Contains the language translations for the payment gateways
 */
$lang = array(
    // General strings
    'online_payment'                     => 'Online Ödeme',
    'online_payments'                    => 'Online Ödemeler',
    'online_payment_for'                 => '%s için online ödeme',
    'online_payment_for_invoice'         => 'Fatura için online ödeme',
    'online_payment_method'              => 'Online ödeme yöntemi',
    'online_payment_creditcard_hint'     => 'Eğer kredi kartı ile ödeme yapmak istiyorsanız lütfen aşağıdaki bilgileri doldurunuz.<br/>Kredi kartı bilgileriniz sunucularımızda kayıt edilmez. Güvenli bir bağlantı kullanılarak sadece ödeme anında kullanılır.',
    'enable_online_payments'             => 'Online Ödemeyi Etkinleştir',
    'payment_provider'                   => 'Ödeme Sağlayıcısı',
    'add_payment_provider'               => 'Ödeme Sağlayıcısı Ekle',
    'transaction_reference'              => 'Ödeme referansı',
    'payment_description'                => 'Fatura %s için ödeme',

    // Credit card strings
    'creditcard_cvv'                     => 'CVV / CSC',
    'creditcard_details'                 => 'Kredi Kartı Bilgileri',
    'creditcard_expiry_month'            => 'Son Ay',
    'creditcard_expiry_year'             => 'Bitiş yılı',
    'creditcard_number'                  => 'Kredi kartı numarası',
    'online_payment_card_invalid'        => 'Kredi kartı geçerli değil. Lütfen girdiğiniz bilgileri kontrol ediniz.',

    // Payment Gateway Fields
    'online_payment_apiLoginId'          => 'Api oturum açma kimliği', // Field for AuthorizeNet_AIM
    'online_payment_transactionKey'      => 'Ödeme anahtarı', // Field for AuthorizeNet_AIM
    'online_payment_testMode'            => 'Test modu', // Field for AuthorizeNet_AIM
    'online_payment_developerMode'       => 'Geliştirici modu', // Field for AuthorizeNet_AIM
    'online_payment_websiteKey'          => 'Web Sitesi Anahtarı', // Field for Buckaroo_Ideal
    'online_payment_secretKey'           => 'Gizli Anahtar', // Field for Buckaroo_Ideal
    'online_payment_merchantId'          => 'Ticari Kimlik', // Field for CardSave
    'online_payment_password'            => 'Şifre', // Field for CardSave
    'online_payment_apiKey'              => 'Api anahtarı', // Field for Coinbase
    'online_payment_secret'              => 'Gizli', // Field for Coinbase
    'online_payment_accountId'           => 'Hesap Id', // Field for Coinbase
    'online_payment_storeId'             => 'Mağaza Id', // Field for FirstData_Connect
    'online_payment_sharedSecret'        => 'Gizli Paylaşılmış', // Field for FirstData_Connect
    'online_payment_appId'               => 'Uygulama Kimliği', // Field for GoCardless
    'online_payment_appSecret'           => 'App Secret', // Field for GoCardless
    'online_payment_accessToken'         => 'Erişim Anahtarı', // Field for GoCardless
    'online_payment_merchantAccessCode'  => 'Ticari Erişim Kodu', // Field for Migs_ThreeParty
    'online_payment_secureHash'          => 'Secure Hash', // Field for Migs_ThreeParty
    'online_payment_siteId'              => 'Site Kimliği', // Field for MultiSafepay
    'online_payment_siteCode'            => 'Site kodu', // Field for MultiSafepay
    'online_payment_accountNumber'       => 'Hesap numarası', // Field for NetBanx
    'online_payment_storePassword'       => 'Mağaza Parolası', // Field for NetBanx
    'online_payment_merchantKey'         => 'Ticari Anahtar', // Field for PayFast
    'online_payment_pdtKey'              => 'Pdt Anahtarı', // Field for PayFast
    'online_payment_username'            => 'Kullanıcı adı', // Field for Payflow_Pro
    'online_payment_vendor'              => 'Satıcı', // Field for Payflow_Pro
    'online_payment_partner'             => 'İş Ortağı', // Field for Payflow_Pro
    'online_payment_pxPostUsername'      => 'Px Mesaj Kullanıcı adı', // Field for PaymentExpress_PxPay
    'online_payment_pxPostPassword'      => 'Px Mesaj Şifresi', // Field for PaymentExpress_PxPay
    'online_payment_signature'           => 'İmza', // Field for PayPal_Express
    'online_payment_referrerId'          => 'Yönlendirme Kimliği', // Field for SagePay_Direct
    'online_payment_transactionPassword' => 'İşlem şifresi', // Field for SecurePay_DirectPost
    'online_payment_subAccountId'        => 'Alt Hesap Kimliği', // Field for TargetPay_Directebanking
    'online_payment_secretWord'          => 'Gizli Kelime', // Field for TwoCheckout
    'online_payment_installationId'      => 'Yükleme Kimliği', // Field for WorldPay
    'online_payment_callbackPassword'    => 'Geri Arama Parolası', // Field for WorldPay

    // Status / Error Messages
    'online_payment_payment_cancelled'   => 'Ödeme iptal edildi.',
    'online_payment_payment_failed'      => 'Ödeme başarısız oldu. Lütfen yeniden deneyin.',
    'online_payment_payment_successful'  => '%s fatura ödemesi gerçekleşti!',
    'online_payment_payment_redirect'    => 'Ödeme sayfasına tekrar yönlendirirken lütfen bekleyiniz...',
    'online_payment_3dauth_redirect'     => 'Seçtiğiniz kartınızı veren kuruluşa, kimlik doğrulaması için yönlendirilirken lütfen bekleyin...'
);