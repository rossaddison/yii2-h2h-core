<?php
namespace frontend\models;

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\models\Employee;
use Yii;

class Salesorderheader extends \yii\db\ActiveRecord
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
        return 'works_salesorderheader';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status','employee_id'], 'required'],
            [['status'], 'string','max'=>20],
            [['employee_id','carousal_id'], 'integer'],
            [['modified_date','clean_date'], 'safe'],
            [['hoursworked','sub_total', 'tax_amt', 'total_due'],'number'],
            [['clean_date'],'default','value'=> date("Y-m-d H:i:s")],
            [['sub_total', 'tax_amt', 'total_due'],'default','value'=>0],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'id']],
            
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'sales_order_id' => Yii::t('app','No.'),
            'status' => Yii::t('app','Job Code eg. BL'),
            'statusfile' => Yii::t('app','Job Code Suffix'),
            'employee_id' => Yii::t('app','Employee ID'),
            'carousal_id' => Yii::t('app','Carousal ID'),
            'clean_date' => Yii::t('app','Clean Date'),
            'sub_total' => Yii::t('app','Sub Total'),
            'tax_amt' => Yii::t('app','Tax Amt'),
            'total_due' => Yii::t('app','Total Due'),
            'hoursworked' =>Yii::t('app','Hrs'),
            'income_per_hour' => Yii::t('app','Income hr'),
            'modified_date' => Yii::t('app','Modified Date'),
        ];
    }
    
    public function getSalesorderdetailsLink() {

       $url = Url::to(['/salesorderdetail/index', 'id'=>$this->sales_order_id]); // your url code to retrieve the profile view

       $options = []; // any HTML attributes for your link

    return Html::a('MyLink', $url, $options); // assuming you have a relation called profile

    }

    public function getSalesorderdetails()
    {
        return $this->hasMany(Salesorderdetail::className(), ['sales_order_id' => 'sales_order_id']);
    }
    

    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employee_id']);
    }
    
    public function getCarousalimage()
    {
        return $this->hasOne(Carousal::className(), ['id' => 'carousal_id']);
    }
    
}
