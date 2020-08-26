<?php

namespace frontend\models;

use frontend\models\Salesorderheader;

use Yii;

class Employee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    public static function getDb()
   {
       return \frontend\components\Utilities::userdb();
   }
   
    public static function tableName()
    {
        return 'works_employee';
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['vacationhours', 'sickleavehours'], 'integer'],
            [['vacationhours'],'default','value'=>0],
            [['nationalinsnumber'], 'string', 'max' => 9],
            [['hiredate','birthdate'],'safe'],
            [['contact_telno'], 'string', 'max' => 11],
            [['title'], 'string', 'max' => 50],
            [['maritalstatus'], 'string', 'max' =>8],
            [['gender'], 'string', 'max' =>6],
            [['sickleavehours'],'default','value'=> 0],
            [['salariedflag'], 'string', 'max' =>30], 
            [['nationalinsnumber'],'unique'],
            [['currentflag'],'string','max' => 11]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'nationalinsnumber' => Yii::t('app','Unique identification Number'),
            'contact_telno' => Yii::t('app','Contact Telephone Number'),
            'title' => Yii::t('app','Title'),
            'birthdate' => Yii::t('app','Birth Date'),
            'maritalstatus' => Yii::t('app','Marital Status'),
            'gender' => Yii::t('app','Gender'),
            'hiredate' => Yii::t('app','Hire date'),
            'salariedflag' => Yii::t('app','Salaried flag'),
            'vacationhours' => Yii::t('app','Vacation hours'),
            'sickleavehours' => Yii::t('app','Sickleave hours'),
            'currentflag' => Yii::t('app','Current flag'),
            'modifieddate' => Yii::t('app','Modified date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesorderheaders()
    {
        return $this->hasMany(Salesorderheader::className(), ['employee_id' => 'id']);
    }
}
