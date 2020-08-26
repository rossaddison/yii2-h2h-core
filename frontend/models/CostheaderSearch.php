<?php

namespace frontend\models;

use Yii;
use yii\data\Sort;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Costheader;
use frontend\models\Company;

class CostheaderSearch extends Costheader
{
    
   public static function getDb()
   {
       return \frontend\components\Utilities::userdb();
   }
    
    public function rules()
    {
        return [
            [['cost_header_id', 'employee_id'], 'integer'],
            [['status', 'statusfile', 'cost_date', 'modified_date'], 'safe'],
            [['sub_total', 'tax_amt', 'total_due'], 'number'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $excludefullypaid = Company::findOne(1)->costheader_excludefullypaid; 
        if ($excludefullypaid === 1)
        {
            $query = Costheader::find()
            ->joinWith('costdetails')
            ->where(['works_costdetail.paid'=>0.00]);
        }
        else
        {
            $query = Costheader::find();
        }
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'db' => \frontend\components\Utilities::userdb(),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        
        $dataProvider->sort->attributes['status'] = [
        'asc' => ['status' => SORT_ASC],
        'desc' => ['status' => SORT_DESC],
        ];
        
        $query->andFilterWhere([
            'cost_header_id' => $this->cost_header_id,
            'status'=> $this->status,
            'employee_id' => $this->employee_id,
            'sub_total' => $this->sub_total,
            'tax_amt' => $this->tax_amt,
            'total_due' => $this->total_due,
            'modified_date' => $this->modified_date,])
            ->andFilterWhere(['>=','cost_date',$this->cost_date,])
            ->orderBy('cost_date')
            ->all()
            ;
        return $dataProvider;
    }
}
