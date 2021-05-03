<?php

namespace frontend\modules\invoice\application\models;

use Yii;

/**
 * This is the model class for table "works_salesinvoicestatus".
 *
 * @property int $id
 * @property string $code
 * @property string $code_meaning
 * @property int $include
 * @property string|null $modified_date
 */
class SalesinvoiceStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'works_salesinvoicestatus';
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
            [['code_meaning'], 'required'],
            [['include'], 'integer'],
            [['modified_date'], 'safe'],
            [['code'], 'string', 'max' => 10],
            [['code_meaning'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'code_meaning' => Yii::t('app', 'Code Meaning'),
            'include' => Yii::t('app', 'Include'),
            'modified_date' => Yii::t('app', 'Modified Date'),
        ];
    }
}
