<?php

namespace frontend\modules\invoice\application\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\invoice\application\models\Salesinvoiceuploads;

/**
 * SalesinvoicemethodpaySearch represents the model behind the search form of `frontend\modules\invoice\application\models\Salesinvoiceuploads`.
 */
class SalesinvoicemethodpaySearch extends Salesinvoiceuploads
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['upload_id', 'product_id'], 'integer'],
            [['url_key', 'file_name_original', 'file_name_new', 'uploaded_date'], 'safe'],
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
        $query = Salesinvoiceuploads::find();

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
            'upload_id' => $this->upload_id,
            'product_id' => $this->product_id,
            'uploaded_date' => $this->uploaded_date,
        ]);

        $query->andFilterWhere(['like', 'url_key', $this->url_key])
            ->andFilterWhere(['like', 'file_name_original', $this->file_name_original])
            ->andFilterWhere(['like', 'file_name_new', $this->file_name_new]);

        return $dataProvider;
    }
}
