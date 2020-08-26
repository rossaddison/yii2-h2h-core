<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Product;

class ProductImport extends Product
{
    
    public function rules()
    {
        return [
            [['id','productcategory_id', 'productsubcategory_id'], 'integer'],
            [['name', 'surname','frequency','contactmobile','specialrequest', 'sellstartdate', 'sellenddate', 'discontinueddate', 'modifieddate'], 'safe'],
            [['listprice'], 'number'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','House'),
            'name' => Yii::t('app','Firstname'),
            'surname' => Yii::t('app','Surname'),
            'contactmobile' => Yii::t('app','Contact Mobile'),
            'specialrequest' => Yii::t('app','Special Request'),
            'listprice' => Yii::t('app','Price'),
            'productnumber'=>Yii::t('app','House Number'),
            'productcategory_id' => Yii::t('app','Postcode Area (eg. G32 - Carntyne)'),
            'postcode' =>Yii::t('app','Postcode'),
            'productsubcategory_id' => Yii::t('app','Street'),
            'sellstartdate' => Yii::t('app','First clean date'),
            'sellenddate' => Yii::t('app','Next Clean date'),
            'discontinueddate' => Yii::t('app','Discontinued Date'),           
        ];
    }
    
    public function search($params)
    {
        
        $query = Product::find();
        
        $dataProvider = new ActiveDataProvider([
          'pagination' => ['pageSize' => 10],
          'query' => $query,
          'db'=> \frontend\components\Utilities::userdb(),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // Error: Call to a member function getSchema() on null therefore uncomment the following line
            //$query->where('0=1');
            return $dataProvider;
        }
         
        $dataProvider->sort->attributes['productcategory_id'] = [
        'asc' => ['productcategory_id' => SORT_ASC],
        'desc' => ['productcategory_id' => SORT_DESC],
        ];
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'listprice' => $this->listprice,
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
        //->andFilterWhere(['>=', 'productcategory_id',$this->productcategory_id,])
        //    ->orderBy('productcategory_id')
        ->all();
        
        return $dataProvider;
    }
}
