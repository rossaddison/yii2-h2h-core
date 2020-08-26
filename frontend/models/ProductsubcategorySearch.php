<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Productsubcategory;

/**
 * ProductsubcategorySearch represents the model behind the search form about `frontend\models\Productsubcategory`.
 */
class ProductsubcategorySearch extends Productsubcategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'productcategory_id'], 'integer'],
            [['name', 'modifieddate'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Productsubcategory::find()->indexBy('id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'db' => \frontend\components\Utilities::userdb(),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
       // $dataProvider->sort->attributes['name'] = [
       //    'asc' => ['name' => SORT_ASC],
      //     'desc' => ['name' => SORT_DESC],
     //   ];
      $dataProvider->sort->attributes['sort_order'] = [
         'asc' => ['sort_order' => SORT_ASC],
         'desc' => ['sort_order' => SORT_DESC],
      ];
        // grid filtering conditions
        $query->andFilterWhere(['productcategory_id' => $this->productcategory_id,])
              ->andFilterWhere(['like', 'name', $this->name])
              ->andFilterWhere(['>=','sort_order',$this->sort_order])
              ->orderBy('sort_order')
              ->all();

        return $dataProvider;
    }
}
