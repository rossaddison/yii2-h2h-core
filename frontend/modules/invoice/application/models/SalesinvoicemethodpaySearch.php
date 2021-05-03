<?php

namespace frontend\modules\invoice\application\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\invoice\application\models\Salesinvoicemethodpay;

/**
 * SalesinvoicemethodpaySearch represents the model behind the search form of `frontend\modules\invoice\application\models\Salesinvoicemethodpay`.
 */
class SalesinvoicemethodpaySearch extends Salesinvoicemethodpay
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['payment_method_id'], 'integer'],
            [['payment_method_name'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Salesinvoicemethodpay::find();

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
            'payment_method_id' => $this->payment_method_id,
        ]);

        $query->andFilterWhere(['like', 'payment_method_name', $this->payment_method_name]);

        return $dataProvider;
    }
}
