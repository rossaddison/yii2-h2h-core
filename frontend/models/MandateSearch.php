<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Mandate;

/**
 * MandateSearch represents the model behind the search form of `frontend\models\Mandate`.
 */
class MandateSearch extends Mandate
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mandate_id', 'redirect_flow_id'], 'integer'],
            [['company_access_token', 'environment', 'session_token', 'customer_email_redirect_url', 'timestamp_sent', 'timestamp_mandate_approval', 'mandate_number', 'customer_gocardless_number', 'confirmation_url'], 'safe'],
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
        $query = Mandate::find();

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
            'mandate_id' => $this->mandate_id,
            'redirect_flow_id' => $this->redirect_flow_id,
            'timestamp_sent' => $this->timestamp_sent,
            'timestamp_mandate_approval' => $this->timestamp_mandate_approval,
        ]);

        $query->andFilterWhere(['like', 'company_access_token', $this->company_access_token])
            ->andFilterWhere(['like', 'environment', $this->environment])
            ->andFilterWhere(['like', 'session_token', $this->session_token])
            ->andFilterWhere(['like', 'customer_email_redirect_url', $this->customer_email_redirect_url])
            ->andFilterWhere(['like', 'mandate_number', $this->mandate_number])
            ->andFilterWhere(['like', 'customer_gocardless_number', $this->customer_gocardless_number])
            ->andFilterWhere(['like', 'confirmation_url', $this->confirmation_url]);

        return $dataProvider;
    }
}
