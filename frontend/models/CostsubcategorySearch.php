<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Costsubcategory;

class CostsubcategorySearch extends Costsubcategory
{
    
    public function rules()
    {
        return [
            [['id', 'costcategory_id'], 'integer'],
            [['name', 'modifieddate'], 'safe'],
        ];
    }
    
    public function scenarios()
    {
        
        return Model::scenarios();
    }
    
    public function search($params)
    {
        $query = Costsubcategory::find()->orderBy('name');
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'db' => \frontend\components\Utilities::userdb(),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        
        $query->andFilterWhere([
            'costcategory_id' => $this->costcategory_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
