<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Salesorderdetail;

class SalesorderdetailSearch extends Salesorderdetail
{
    public function rules()
    {
        return [
            [['sales_order_id', 'sales_order_detail_id', 'product_id','productcategory_id','productsubcategory_id','paid'], 'integer'],
            [['nextclean_date','modified_date'], 'safe'],
            [['unit_price'], 'number'],
        ];
    }
   
    public function scenarios()
    {
        return Model::scenarios();
    }
    
    public function search($params)
    {
        $query = Salesorderdetail::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'db' => \frontend\components\Utilities::userdb(),
        ]);

        $this->load($params);
        $query->andFilterWhere([
            'sales_order_id'  => Yii::$app->session['sales_order_id'],
            'sales_order_detail_id' => $this->sales_order_detail_id,
            'nextclean_date' => $this->nextclean_date,
            'product_id' => $this->product_id,
            'productcategory_id' => $this->productcategory_id,
            'productsubcategory_id'=> $this->productsubcategory_id,
            'unit_price' => $this->unit_price,
            'paid' => $this->paid,
            'modified_date' => $this->modified_date,
        ])->all();
        return $dataProvider;
    }
}
