<?php
namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Sessiondetail;

class SessiondetailSearch extends Sessiondetail
{
    
    public function rules()
    {
        return [
            [['session_detail_id', 'product_id'], 'integer'],
            [['session_id', 'redirect_flow_id', 'db'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Sessiondetail::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'session_detail_id' => $this->session_detail_id,
            'product_id' => $this->product_id,
        ]);

        $query->andFilterWhere(['like', 'session_id', $this->session_id])
            ->andFilterWhere(['like', 'redirect_flow_id', $this->redirect_flow_id])
            ->andFilterWhere(['like', 'db', $this->db]);

        return $dataProvider;
    }
}
