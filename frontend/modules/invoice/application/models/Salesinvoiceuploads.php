<?php

namespace frontend\modules\invoice\application\models;

use Yii;

/**
 * This is the model class for table "works_salesinvoiceuploads".
 *
 * @property int $upload_id
 * @property int $product_id
 * @property string $url_key
 * @property string $file_name_original
 * @property string $file_name_new
 * @property string $uploaded_date
 */
class Salesinvoiceuploads extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'works_salesinvoiceuploads';
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
            [['product_id', 'url_key', 'file_name_original', 'file_name_new', 'uploaded_date'], 'required'],
            [['product_id'], 'integer'],
            [['file_name_original', 'file_name_new'], 'string'],
            [['uploaded_date'], 'safe'],
            [['url_key'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'upload_id' => Yii::t('app', 'Upload ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'url_key' => Yii::t('app', 'Url Key'),
            'file_name_original' => Yii::t('app', 'File Name Original'),
            'file_name_new' => Yii::t('app', 'File Name New'),
            'uploaded_date' => Yii::t('app', 'Uploaded Date'),
        ];
    }
}
