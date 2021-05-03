<?php

namespace frontend\modules\invoice\application\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\invoice\application\models\SalesinvoicePayment;

/**
 * SalesinvoicePaymentSearch represents the model behind the search form of `frontend\models\SalesinvoicePayment`.
 */
class SalesinvoicePaymentSearch extends SalesinvoicePayment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['payment_id', 'invoice_id', 'payment_method_id'], 'integer'],
            [['payment_date', 'payment_note'], 'safe'],
            [['payment_amount'], 'number'],
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
        $query = SalesinvoicePayment::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'db'=> \frontend\components\Utilities::userdb(),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'payment_id' => $this->payment_id,
            'invoice_id' => $this->invoice_id,
            'payment_method_id' => $this->payment_method_id,
            'payment_date' => $this->payment_date,
            'payment_amount' => $this->payment_amount,
        ]);

        $query->andFilterWhere(['like', 'payment_note', $this->payment_note]);

        return $dataProvider;
    }
}
