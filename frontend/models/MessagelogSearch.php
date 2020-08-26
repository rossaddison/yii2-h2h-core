<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Messagelog;

/**
 * MessagelogSearch represents the model behind the search form of `frontend\models\Messagelog`.
 */
class MessagelogSearch extends Messagelog
{
    /**
     * @inheritdoc
     */
    public $product;
    public $salesorderdetail;
    
    public function rules()
    {
        return [
            [['id', 'salesorderdetail_id', 'product_id'], 'integer'],
            [['message', 'date', 'phoneto'], 'safe'],
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
        $query = Messagelog::find();
        
        $query->joinWith(['salesorderdetail','product']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        $dataProvider->sort->attributes['salesorderdetail'] = [
        'asc' => ['salesorderdetail.sales_order_detail_id' => SORT_ASC],
        'desc' => ['salesorderdetail.sales_order_detail_id' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['product'] = [
        'asc' => ['product.name' => SORT_ASC],
        'desc' => ['product.name' => SORT_DESC],
        ];
                
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'salesorderdetail_id' => $this->salesorderdetail_id,
            'product_id' => $this->product_id,
        ]);

        $query->andFilterWhere(['like', 'works_product.name', $this->product])
              ->andFilterWhere(['like', 'works_salesorderdetail.sales_order_detail_id', $this->salesorderdetail]);

        return $dataProvider;
    }
}
