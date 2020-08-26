<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Costcategory;

class CostcategorySearch extends Costcategory
{
    
    public function rules()
    {
        return [
            [['id', 'tax_id'], 'integer'],
            [['name', 'modifieddate'], 'safe'],
        ];
    }
    
    public function scenarios()
    {
        return Model::scenarios();
    }
    
    public function search($params)
    {
        $query = Costcategory::find()->orderBy('name');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'db' => \frontend\components\Utilities::userdb(),
        ]);
        
        $this->load($params);
        
        if (!$this->validate()) {
            return $dataProvider;
        }
        
        $query->andFilterWhere([
            'id' => $this->id,
            'tax_id' => $this->tax_id,
            'modifieddate' => $this->modifieddate,
        ]);
        
        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
