<?php

namespace frontend\models;

use Yii;
use yii\data\Sort;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Salesorderheader;
use frontend\models\Company;

/**
 * SalesorderheaderSearch represents the model behind the search form about `frontend\models\Salesorderheader`.
 */
class SalesorderheaderSearch extends Salesorderheader
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sales_order_id', 'employee_id','carousal_id'], 'integer'],
            [['status', 'statusfile', 'clean_date', 'modified_date'], 'safe'],
            [['sub_total', 'tax_amt', 'total_due'], 'number'],
            [['hoursworked'],'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $excludefullypaid = 0;
        if (Company::find()->count() == 0) {} else {$excludefullypaid = Company::findOne(1)->salesorderheader_excludefullypaid;} 
        if ($excludefullypaid === 1)
        {
            $query = Salesorderheader::find()
            ->joinWith('salesorderdetails')
            ->where(['works_salesorderdetail.paid'=>0.00]);
        }
        else
        {
            $query = Salesorderheader::find()
            //->indexBy('sales_order_id');
            //->andFilterWhere(['>=','clean_date',"2018"."-"."09"."-"."01"])
           ->orderBy('clean_date');
            //->all();
        }
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'db' => \frontend\components\Utilities::userdb(),
        ]);
        
        

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        //this will sort the column which we do not want. We want to sort dropdown
        //you will need this code if you intend to use 'group' in a data column.
        $dataProvider->sort->attributes['status'] = [
        'asc' => ['status' => SORT_ASC],
        'desc' => ['status' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['clean_date'] = [
           'asc' => ['clean_date' => SORT_DESC],
           'desc' => ['clean_date' => SORT_ASC],
        ];
        
        // grid filtering conditions
        $query->andFilterWhere([
            'sales_order_id' => $this->sales_order_id,
            'status'=> $this->status,
            'employee_id' => $this->employee_id,
            //'clean_date' => $this->clean_date,
            'sub_total' => $this->sub_total,
            'tax_amt' => $this->tax_amt,
            'total_due' => $this->total_due,
            'modified_date' => $this->modified_date,])
            ->andFilterWhere(['>=','clean_date',$this->clean_date,])
            ->orderBy('clean_date')
            ->all()
            
            ;

        //$query->andFilterWhere(['like', 'status', $this->status])
        //    ->andFilterWhere(['like', 'statusfile', $this->statusfile]);
        
        

        return $dataProvider;
    }
}
