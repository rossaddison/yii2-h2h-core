<?php

namespace frontend\modules\invoice\application\models;

/**
 * This is the model class for table "works_salesinvoicesetting".
 *
 * @property int $setting_id
 * @property string $setting_key
 * @property string $setting_value
 */
class Settings extends \yii\db\ActiveRecord
{
    public static function getDb()
    {
       return \frontend\components\Utilities::userdb();
    } 
    
    public static function tableName()
    {
        return 'works_salesinvoicesetting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['setting_key', 'setting_value'], 'required'],
            [['setting_value'], 'string'],
            [['setting_key'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'setting_id' => 'Setting ID',
            'setting_key' => 'Setting Key',
            'setting_value' => 'Setting Value',
        ];
    }
}
