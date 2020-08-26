<?php
namespace frontend\modules\google3translateclient\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\google3translateclient\models\Google3translateclient;

class Google3translateclientSearch extends Google3translateclient
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['language', 'translation'], 'string'],
            [['message_table_filter'], 'safe'],
        ];
    }
    
    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Google3translateclient::find()->indexBy('id');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        //searching with message relation: line 2 
        //https://stackoverflow.com/questions/33508570/yii2-sort-and-filter-by-one-to-many-to-one-relation-in-gridview
        $query->joinWith('extracted');
        
        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'language' => $this->language,
            'translation' => $this->translation,
            //specify tablename.tablefield for relations to work in _search
            'source_message.message'=> $this->message_table_filter
        ]);

        $query->andFilterWhere(['like', 'language', $this->language])
              ->andFilterWhere(['like', 'translation', $this->translation])
              ->andFilterWhere(['like', 'source_message.message', $this->message_table_filter]);

        return $dataProvider;
    }
}
