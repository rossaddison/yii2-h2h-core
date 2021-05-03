<?php
/**
 * Contains the language translations for the payment gateways
 */
$lang = array(
    // General strings
    'online_payment'                     => 'ชำระเงินออนไลน์',
    'online_payments'                    => 'ชำระเงินออนไลน์',
    'online_payment_for'                 => 'ชำระเงินออนไลน์สำหรับ',
    'online_payment_for_invoice'         => 'การชำระเงินสำหรับใบแจ้งหนี้',
    'online_payment_method'              => 'วิธีการชำระเงินออนไลน์',
    'online_payment_creditcard_hint'     => 'ถ้าคุณต้องการชำระผ่านบัตรเครดิต กรุณากรอกข้อมูลด้านล่างนี้ <br/> ข้อมูลบัตรเครดิตไม่ได้เก็บอยู่บนเซิร์ฟเวอร์ของเรา และจะโอนไปยังประตูการชำระเงินออนไลน์ที่ใช้การเชื่อมต่อที่ปลอดภัย',
    'enable_online_payments'             => 'เปิดใช้งานการชำระเงินออนไลน์',
    'payment_provider'                   => 'ผู้ให้บริการชำระเงิน',
    'add_payment_provider'               => 'เพิ่มผู้ให้บริการชำระเงิน',
    'transaction_reference'              => 'อ้างอิงธุรกรรม',
    'payment_description'                => 'การชำระเงินสำหรับใบแจ้งหนี้ %s',

    // Credit card strings
    'creditcard_cvv'                     => 'รหัส CVV/CSC',
    'creditcard_details'                 => 'รายละเอียดบัตรเครดิต',
    'creditcard_expiry_month'            => 'เดือนที่หมดอายุ',
    'creditcard_expiry_year'             => 'ปีหมดอายุ',
    'creditcard_number'                  => 'หมายเลขบัตรเครดิต',
    'online_payment_card_invalid'        => 'บัตรเครดิตนี้ไม่ถูกต้อง กรุณาตรวจสอบข้อมูล.',

    // Payment Gateway Fields
    'online_payment_apiLoginId'          => 'ชื่อผู้ใช้งาน Api', // Field for AuthorizeNet_AIM
    'online_payment_transactionKey'      => 'คีย์ธุรกรรม', // Field for AuthorizeNet_AIM
    'online_payment_testMode'            => 'โหมดทดสอบ', // Field for AuthorizeNet_AIM
    'online_payment_developerMode'       => 'โหมดสำหรับนักพัฒนา', // Field for AuthorizeNet_AIM
    'online_payment_websiteKey'          => 'คีย์เว็บไซต์', // Field for Buckaroo_Ideal
    'online_payment_secretKey'           => 'คีย์ลับ', // Field for Buckaroo_Ideal
    'online_payment_merchantId'          => 'Id ร้านค้า', // Field for CardSave
    'online_payment_password'            => 'รหัสผ่าน', // Field for CardSave
    'online_payment_apiKey'              => 'คีย์ของ API', // Field for Coinbase
    'online_payment_secret'              => 'รหัสความปลอดภัย', // Field for Coinbase
    'online_payment_accountId'           => 'เลขที่บัญชี', // Field for Coinbase
    'online_payment_storeId'             => 'รหัสร้านค้า', // Field for FirstData_Connect
    'online_payment_sharedSecret'        => 'ความลับที่ใช้ร่วมกัน', // Field for FirstData_Connect
    'online_payment_appId'               => 'ID ของแอพ', // Field for GoCardless
    'online_payment_appSecret'           => 'รหัสลับของ App', // Field for GoCardless
    'online_payment_accessToken'         => 'โทเค็นการเข้าถึง', // Field for GoCardless
    'online_payment_merchantAccessCode'  => 'รหัสการเข้าถึงร้านค้า', // Field for Migs_ThreeParty
    'online_payment_secureHash'          => 'Hash ที่ปลอดภัย', // Field for Migs_ThreeParty
    'online_payment_siteId'              => 'ID ของไซต์', // Field for MultiSafepay
    'online_payment_siteCode'            => 'รหัสไซต์', // Field for MultiSafepay
    'online_payment_accountNumber'       => 'หมายเลขบัญชี', // Field for NetBanx
    'online_payment_storePassword'       => 'บันทึกรหัสผ่าน', // Field for NetBanx
    'online_payment_merchantKey'         => 'คีย์ร้านค้า', // Field for PayFast
    'online_payment_pdtKey'              => 'คีย์ Pdt', // Field for PayFast
    'online_payment_username'            => 'ชื่อผู้ใช้', // Field for Payflow_Pro
    'online_payment_vendor'              => 'ผู้จัดจำหน่าย', // Field for Payflow_Pro
    'online_payment_partner'             => 'หุ้นส่วน', // Field for Payflow_Pro
    'online_payment_pxPostUsername'      => 'ชื่อผู้ใช้ Px Post', // Field for PaymentExpress_PxPay
    'online_payment_pxPostPassword'      => 'รหัสผ่าน px Post', // Field for PaymentExpress_PxPay
    'online_payment_signature'           => 'ลายเซ็น', // Field for PayPal_Express
    'online_payment_referrerId'          => 'รหัสอ้างอิง', // Field for SagePay_Direct
    'online_payment_transactionPassword' => 'รหัสธุรกรรม', // Field for SecurePay_DirectPost
    'online_payment_subAccountId'        => 'รหัสบัญชีย่อย', // Field for TargetPay_Directebanking
    'online_payment_secretWord'          => 'ความลับคำ', // Field for TwoCheckout
    'online_payment_installationId'      => 'Id การติดตั้ง', // Field for WorldPay
    'online_payment_callbackPassword'    => 'รหัสผ่านการเรียกกลับ', // Field for WorldPay

    // Status / Error Messages
    'online_payment_payment_cancelled'   => 'ยกเลิกการชำระเงิน',
    'online_payment_payment_failed'      => 'ชำระเงินล้มเหลว โปรดลองอีกครั้ง',
    'online_payment_payment_successful'  => 'การชำระเงินสำหรับใบแจ้งหนี้ %s ประสบความสำเร็จ',
    'online_payment_payment_redirect'    => 'กรุณารอขณะที่เราเปลี่ยนเส้นทางคุณไปยังหน้าชำระเงิน...',
    'online_payment_3dauth_redirect'     => 'กรุณารอขณะที่เราเปลี่ยนเส้นทางคุณไปออกบัตรรับรองความถูกต้อง...'
);