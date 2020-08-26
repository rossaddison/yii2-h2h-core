<?php
namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Session;

class SessionSearch extends Session
{
    public function rules()
    {
        return [
            [['id', 'data', 'db', 'gc_rid'], 'safe'],
            [['expire', 'user_id'], 'integer'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Session::find();

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
            'expire' => $this->expire,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'data', $this->data])
            ->andFilterWhere(['like', 'db', $this->db])
            ->andFilterWhere(['like', 'gc_rid', $this->gc_rid]);

        return $dataProvider;
    }
}
