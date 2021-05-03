<?php
namespace frontend\modules\invoice\application\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\invoice\application\models\SalesinvoiceMerchantResponse;

/**
 * SalesinvoicePaymentSearch represents the model behind the search form of `frontend\models\SalesinvoicePayment`.
 */
class SalesinvoiceMerchantResponseSearch extends SalesinvoiceMerchantResponse
{
    public function rules()
    {
        return [
            [['invoice_id', 'merchant_response_date'], 'required'],
            [['invoice_id', 'merchant_response_successful'], 'integer'],
            [['merchant_response_date'], 'safe'],
            [['merchant_response_driver'], 'string', 'max' => 35],
            [['merchant_response', 'merchant_response_reference'], 'string', 'max' => 255],
        ];
    }   
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = SalesinvoiceMerchantResponse::find();
        $dataProviderMerchantResponse = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProviderMerchantResponse;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'invoice_id' => $this->invoice_id,    
        ]);     
        
        return $dataProviderMerchantResponse;
    }
}
