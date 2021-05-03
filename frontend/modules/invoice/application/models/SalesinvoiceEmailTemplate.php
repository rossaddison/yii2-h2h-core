<?php
namespace frontend\modules\invoice\application\models;

use Yii;

class SalesinvoiceEmailTemplate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'works_salesinvoiceemailtemplate';
    }
    
    public static function getDb()
    {
       return \frontend\components\Utilities::userdb();
    }  

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email_template_title', 'email_template_body', 'email_template_subject', 'email_template_from_name', 'email_template_cc', 'email_template_bcc'], 'string'],
            [['email_template_title','email_template_body','email_template_subject', 'email_template_from_name'], 'required'],
            [['email_template_type', 'email_template_pdf_template'], 'string', 'max' => 255],
            [['email_template_id'], 'number'],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'email_template_id' => Yii::t('app', 'Email Template ID'),
            'email_template_title' => Yii::t('app', 'Email Template Title'),
            'email_template_type' => Yii::t('app', 'Email Template Type'),
            'email_template_body' => Yii::t('app', 'Email Template Body'),
            'email_template_subject' => Yii::t('app', 'Email Template Subject'),
            'email_template_from_name' => Yii::t('app', 'Email Template From Name'),
            'email_template_cc' => Yii::t('app', 'Email Template Cc'),
            'email_template_bcc' => Yii::t('app', 'Email Template Bcc'),
            'email_template_pdf_template' => Yii::t('app', 'Email Template Pdf Template'),
        ];
    }       
}
