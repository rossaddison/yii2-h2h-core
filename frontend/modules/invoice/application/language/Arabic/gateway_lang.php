<?php
/**
 * Contains the language translations for the payment gateways
 */
$lang = array(
    // General strings
    'online_payment'                     => 'الدفع الالكتروني',
    'online_payments'                    => 'الدفع الالكتروني',
    'online_payment_for'                 => 'الدفع الالكتروني لـ',
    'online_payment_for_invoice'         => 'الدفع الإلكتروني للفاتورة',
    'online_payment_method'              => 'طريقة الدفع عبر الإنترنت',
    'online_payment_creditcard_hint'     => 'إذا كنت تود الدفع عبر بطاقة الإئتمان, الرجاء إدخال المعلومات المدرجة.<br/> بيانات بطاقة الإئتمان لن تكون محفوظة في سيرفراتنا وسيتم تحويلك لبوابة الدفع بإستخدام إتصال آمن ومشفر.',
    'enable_online_payments'             => 'تمكين الدفع عبر الإنترنت',
    'payment_provider'                   => 'مزود خدمة الدفع',
    'add_payment_provider'               => 'إضافة موفر الدفع',
    'transaction_reference'              => 'رقم قيد الحركة',
    'payment_description'                => 'الدفع للفاتورة %s',

    // Credit card strings
    'creditcard_cvv'                     => 'الرقم CVV',
    'creditcard_details'                 => 'تفاصيل بطاقة الائتمان',
    'creditcard_expiry_month'            => 'شهر الانتهاء',
    'creditcard_expiry_year'             => 'سنة الإنتهاء',
    'creditcard_number'                  => 'رقم بطاقة الائتمان',
    'online_payment_card_invalid'        => 'هذه البطاقة غير صالحة. الرجاء التحقق من المعلومات المقدمة.',

    // Payment Gateway Fields
    'online_payment_apiLoginId'          => 'معرف تسجيل الدخول Api', // Field for AuthorizeNet_AIM
    'online_payment_transactionKey'      => 'رقم العملية', // Field for AuthorizeNet_AIM
    'online_payment_testMode'            => 'وضع الاختبار', // Field for AuthorizeNet_AIM
    'online_payment_developerMode'       => 'وضع المطور', // Field for AuthorizeNet_AIM
    'online_payment_websiteKey'          => 'مفتاح الموقع', // Field for Buckaroo_Ideal
    'online_payment_secretKey'           => 'المفتاح السري', // Field for Buckaroo_Ideal
    'online_payment_merchantId'          => 'معرف التاجر', // Field for CardSave
    'online_payment_password'            => 'كلمة المرور', // Field for CardSave
    'online_payment_apiKey'              => 'Api', // Field for Coinbase
    'online_payment_secret'              => 'الرمز السري', // Field for Coinbase
    'online_payment_accountId'           => 'معرف الحساب', // Field for Coinbase
    'online_payment_storeId'             => 'معرف المخزن', // Field for FirstData_Connect
    'online_payment_sharedSecret'        => 'الرمز السري المشترك', // Field for FirstData_Connect
    'online_payment_appId'               => 'معرف التطبيق', // Field for GoCardless
    'online_payment_appSecret'           => 'كلمة سر التطبيق', // Field for GoCardless
    'online_payment_accessToken'         => 'رمزالوصول المميز', // Field for GoCardless
    'online_payment_merchantAccessCode'  => 'رمز وصول التاجر', // Field for Migs_ThreeParty
    'online_payment_secureHash'          => 'تجزئة آمنة', // Field for Migs_ThreeParty
    'online_payment_siteId'              => 'معرف الموقع', // Field for MultiSafepay
    'online_payment_siteCode'            => 'موقع التعليمات البرمجية', // Field for MultiSafepay
    'online_payment_accountNumber'       => 'رقم الحساب', // Field for NetBanx
    'online_payment_storePassword'       => 'تخزين كلمات المرور', // Field for NetBanx
    'online_payment_merchantKey'         => 'مفتاح التاجر', // Field for PayFast
    'online_payment_pdtKey'              => 'مفتاح Pdt', // Field for PayFast
    'online_payment_username'            => 'اسم المستخدم', // Field for Payflow_Pro
    'online_payment_vendor'              => 'المورد', // Field for Payflow_Pro
    'online_payment_partner'             => 'الشريك', // Field for Payflow_Pro
    'online_payment_pxPostUsername'      => 'اسم المستخدم ل Px Post', // Field for PaymentExpress_PxPay
    'online_payment_pxPostPassword'      => 'كلمة المرور ل Px Post', // Field for PaymentExpress_PxPay
    'online_payment_signature'           => 'التوقيع', // Field for PayPal_Express
    'online_payment_referrerId'          => 'معرف المرجع', // Field for SagePay_Direct
    'online_payment_transactionPassword' => 'كلمة مرور المعاملة', // Field for SecurePay_DirectPost
    'online_payment_subAccountId'        => 'معرف الحساب الفرعي', // Field for TargetPay_Directebanking
    'online_payment_secretWord'          => 'كلمة سر', // Field for TwoCheckout
    'online_payment_installationId'      => 'رمز التثبيت', // Field for WorldPay
    'online_payment_callbackPassword'    => 'كلمة المرور Callback', // Field for WorldPay

    // Status / Error Messages
    'online_payment_payment_cancelled'   => 'تم إلغاء الدفع.',
    'online_payment_payment_failed'      => 'فشل الدفع. الرجاء المحاولة مرة أخرى.',
    'online_payment_payment_successful'  => 'نجح الدفع للفاتورة %s!',
    'online_payment_payment_redirect'    => 'الرجاء الانتظار بينما يتم توجيهك إلى صفحة الدفع...',
    'online_payment_3dauth_redirect'     => 'الرجاء الانتظار بينما يتم إعادة توجيهك إلى المتحقق من البطاقة للمصادقة...'
);