<?php
namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Product;

class ProductSearch extends Product
{
    public function rules()
    {
        return [
            [['id','productcategory_id', 'productsubcategory_id'], 'integer'],
            [['name', 'surname','frequency','contactmobile', 'productnumber','gc_number','specialrequest', 'sellstartdate', 'sellenddate', 'discontinueddate', 'modifieddate'], 'safe'],
            [['listprice'], 'number'],
            [['isactive'],'boolean'],
        ];
    }
    
    public function scenarios()
    {
        return Model::scenarios();
    }
    
    public function search($params)
    {
        $query = Product::find()->orderBy('productnumber ASC');
        
        $dataProvider = new ActiveDataProvider([
          'pagination' => ['pageSize' => 10],
          'query' => $query,
          'db'=> \frontend\components\Utilities::userdb(),
        ]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $dataProvider->sort->attributes['productnumber'] = [
        'asc' => ['productnumber' => SORT_ASC],
        'desc' => ['productnumber' => SORT_DESC],
        ]; 
        $dataProvider->sort->attributes['productcategory_id'] = [
        'asc' => ['productcategory_id' => SORT_ASC],
        'desc' => ['productcategory_id' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['productsubcategory_id'] = [
        'asc' => ['productsubcategory_id' => SORT_ASC],
        'desc' => ['productsubcategory_id' => SORT_DESC],
        ];
        
        if (!isset($this->isactive)) {$this->isactive = 1;}
        
        $query->andFilterWhere([
            'id' => $this->id,
            'listprice' => $this->listprice,
            'isactive'=>$this->isactive,
            'productnumber'=>$this->productnumber,
            'productcategory_id' => $this->productcategory_id,
            'productsubcategory_id' => $this->productsubcategory_id,
            'frequency'=>$this->frequency,
            'name'=>$this->name,
            'surname'=>$this->surname,
            'gc_number'=>$this->gc_number,
            'sellstartdate' => $this->sellstartdate,
            'sellenddate' => $this->sellenddate,
            'discontinueddate' => $this->discontinueddate,
            'modifieddate' => $this->modifieddate,
        ])
        ->all();
        return $dataProvider;
    }
}

