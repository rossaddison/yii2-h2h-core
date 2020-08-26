<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Costdetail;

class CostdetailSearch extends Costdetail
{
    /**
     * @inheritdoc
     */
    public $cost;
    public $costsubcategory;
    
   
    
    public function rules()
    {
        return [
            [['cost_header_id', 'cost_detail_id', 'cost_id', 'paid'], 'integer'],
            [['cost_id'], 'integer'],
            [['nextcost_date', 'modified_date','cost','costsubcategory'], 'safe'],
            [['unit_price'], 'number'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        
        $query = Costdetail::find();
        $query->joinWith(['costsubcategory','cost']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'db' => \frontend\components\Utilities::userdb(),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        
        $dataProvider->sort->attributes['costsubcategory'] = [
        'asc' => ['costsubcategory.name' => SORT_ASC],
        'desc' => ['costsubcategory.name' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['cost'] = [
        'asc' => ['cost.costnumber' => SORT_ASC],
        'desc' => ['cost.costnumber' => SORT_DESC],
        ];
                
        // grid filtering conditions
        $query->andFilterWhere([
            'cost_header_id'  => Yii::$app->session['cost_header_id'],
            'cost_detail_id' => $this->cost_detail_id,
            'nextcost_date' => $this->nextcost_date,
            'cost_id' => $this->cost_id,
            'costcategory_id' => $this->costcategory_id,
            'costsubcategory_id'=> $this->costsubcategory_id,
            'unit_price' => $this->unit_price,
            'paid' => $this->paid,
            'modified_date' => $this->modified_date,
        ]);
        
        $query->andFilterWhere(['like', 'works_cost.productnumber', $this->cost]);
        $query->andFilterWhere(['like', 'works_costsubcategory.name', $this->costsubcategory]);
        
        return $dataProvider;
    }
}
