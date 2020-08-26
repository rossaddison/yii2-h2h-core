<?php

namespace frontend\models;
use Yii;

class Costheader extends \yii\db\ActiveRecord
{
    
   public static function getDb()
   {
       return \frontend\components\Utilities::userdb();
   }
    
    public static function tableName()
    {
        return 'works_costheader';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status','employee_id', 'cost_date'], 'required'],
            [['status'], 'string'],
            [['employee_id' ], 'integer'],
            [['cost_date', 'modified_date'], 'safe'],
            [['sub_total', 'tax_amt', 'total_due'], 'number'],
            [['sub_total', 'tax_amt', 'total_due'],'default','value'=>0.00],
            [['statusfile'], 'string', 'max' => 20],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'id']],
            
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cost_header_id' => Yii::t('app','No.'),
            'status' => Yii::t('app','Cost Code'),
            'statusfile' => Yii::t('app','Cost Code Suffix'),
            'employee_id' => Yii::t('app','Employee ID'),
            'cost_date' => Yii::t('app','Cost Date'),
            'sub_total' => Yii::t('app','Sub Total'),
            'tax_amt' => Yii::t('app','Tax Amt'),
            'total_due' => Yii::t('app','Total Due'),
            'modified_date' => Yii::t('app','Modified Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCostdetails()
    {
        return $this->hasMany(Costdetail::className(), ['cost_header_id' => 'cost_header_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employee_id']);
    }
    
    
    
}
