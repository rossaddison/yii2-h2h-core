<?php
namespace frontend\modules\invoice\application\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\invoice\application\models\Salesinvoice;

class SalesinvoiceSearch extends Salesinvoice
{
    public $payment_method_name;
    
    public function rules()
    {
        return [
            [['invoice_id', 'invoice_status_id', 'is_read_only', 'payment_method_id','product_id'], 'integer'],
            [['invoice_date_created', 'invoice_url_key','reference',
              //relation paymentmethod in model\salesinvoice
              'payment_method_name'
              ], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    
    public function search($params)
    {   
        $query = Salesinvoice::find()->orderBy('invoice_id ASC');
        
        $dataProvider = new ActiveDataProvider([
            'pagination' => ['pageSize' => 10],
            'query' => $query,
            'db'=> \frontend\components\Utilities::userdb(),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'invoice_id' => $this->invoice_id,
            'invoice_status_id' => $this->invoice_status_id,
            'is_read_only' => $this->is_read_only,
            'reference'=> $this->reference,
            'invoice_date_created' => $this->invoice_date_created,
            'invoice_date_modified' => $this->invoice_date_modified,
            'invoice_date_due' => $this->invoice_date_due,
            'payment_method_id' => $this->payment_method_id,
            'product_id'=>$this->product_id
        ]);

        return $dataProvider;
    }
}
