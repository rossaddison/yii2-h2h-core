<?php

namespace frontend\models;

use Yii;


class Company extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function getDb()
    {
       return \frontend\components\Utilities::userdb();
    }  
    
       
    public static function tableName()
    {
        return 'works_company';
    }

     public function rules()
    {
        return [
            [['name'], 'required'],
            [['salesorderheader_excludefullypaid', 'costheader_excludefullypaid', 'smtp_transport_port'], 'integer'],
            [['gc_live_or_sandbox', 'smtp_transport_encryption'], 'string'],
            [['name', 'external_website_url', 'sic_name', 'sic2_name'], 'string', 'max' => 100],
            [['address_street', 'address_area1', 'address_area2', 'gc_accesstoken', 'smtp_transport_host', 'smtp_transport_username', 'smtp_transport_password'], 'string', 'max' => 50],
            [['address_areacode'], 'string', 'max' => 9],
            [['google_translate_json_filename_and_path'], 'string', 'max' => 200],
            [['telephone', 'twilio_telephone'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 128],
            [['fax', 'corp_tax_duedate'], 'string', 'max' => 11],
            [['language','currency_prefix','currency_suffix'],'string','max'=>16],
            [['finyear_start_date', 'finyear_end_date', 'alt_expiry_date', 'alt2_expiry_date'], 'string', 'max' => 20],
            [['company_regno'], 'string', 'max' => 8],
            [['vat_no', 'alt_reg_no', 'alt2_reg_no', 'sic_code', 'sic2_code'], 'string', 'max' => 10],
            [['alt_reg_name', 'alt2_reg_name'], 'string', 'max' => 25],
            [['homepage'], 'string', 'max' => 10000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'name' => Yii::t('app','Name'),
            'address_street' => Yii::t('app','Address Street'),
            'address_area1' => Yii::t('app','Address Area1 eg. Glasgow'),
            'address_area2' => Yii::t('app','Address Area2 eg. Lanarkshire'),
            'address_areacode' => Yii::t('app','Address Postcode'),
            'telephone' => Yii::t('app','Telephone'),
            'external_website_url' => Yii::t('app','External Website Url'),
            'email' => Yii::t('app','Email'),
            'twilio_telephone' => Yii::t('app','Twilio Telephone eg. eg. "+441315103755" if in the UK. The zero is dropped between the second 4 and the 1'),
            'fax' => Yii::t('app','Fax'),
            'finyear_start_date' => Yii::t('app','Financial Year Start Date'),
            'finyear_end_date' => Yii::t('app','Financial Year End Date'),
            'corp_tax_duedate' => Yii::t('app','Corporation Tax Due Date'),
            'company_regno' => Yii::t('app','Company Registration Number'),
            'vat_no' => Yii::t('app','Vat No'),
            'alt_reg_name' => Yii::t('app','Alternative Registration Name'),
            'alt_reg_no' => Yii::t('app','Alternative Registration No.'),
            'alt_expiry_date' => Yii::t('app','Alt Expiry Date'),
            'alt2_reg_name' => Yii::t('app','Alt2 Registration Name'),
            'alt2_reg_no' => Yii::t('app','Alt2 Registration No'),
            'alt2_expiry_date' => Yii::t('app','Alt2 Expiry Date'),
            'sic_name' => Yii::t('app','Sic Name'),
            'sic_code' => Yii::t('app','Sic Code'),
            'sic2_name' => Yii::t('app','Sic2 Name'),
            'sic2_code' => Yii::t('app','Sic2 Code'),
            'salesorderheader_excludefullypaid' => Yii::t('app','Exclude Fully Paid Daily Cleans from List'),
            'costheader_excludefullypaid' => Yii::t('app','Exclude Fully Paid Daily Costs from List'),
            'homepage' => Yii::t('app','Notes visible on Home Page when worker is logged in.'),
            'gc_accesstoken' => Yii::t('app','Gocardless Accesstoken'),
            'gc_live_or_sandbox' => Yii::t('app','Gocardless Live Or Sandbox eg. Live'),
            'smtp_transport_host' => Yii::t('app','Smtp Transport Host eg. send.one.com'),
            'smtp_transport_username' => Yii::t('app','Smtp Transport Username'),
            'smtp_transport_password' => Yii::t('app','Smtp Transport Password'),
            'smtp_transport_port' => Yii::t('app','Smtp Transport Port'),
            'smtp_transport_encryption' => Yii::t('app','Smtp Transport Encryption'),
            'google_translate_json_filename_and_path' => 'Google Translate JSON '. Yii::t('app','filename and path with the quotes and with forward slashes eg. "c:/path/filename.json"'),
            'language'=>Yii::t('app','Language eg. af (Use the code that you used in Google Translate grid.)'),
            'currency_prefix'=>Yii::t('app','Currency prefix eg. $'),
            'currency_suffix'=>Yii::t('app','Currency suffix eg. c'),
        ];
    }
}
