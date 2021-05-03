<?php

namespace frontend\modules\invoice\application\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\invoice\application\models\Settings;

/**
 * SalesinvoicesettingSearch represents the model behind the search form of `frontend\modules\invoice\application\models\Salesinvoicesetting`.
 */
class SettingsSearch extends Settings
{
    /**
     * {@inheritdoc}
     */
    
    public function rules()
    {
        return [
            [['setting_id'], 'integer'],
            [['setting_key', 'setting_value'], 'safe'],
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
        $query = Settings::find()->orderBy('setting_key');        

        $dataProvider = new ActiveDataProvider([
            //'pagination' => ['pageSize' => 10],
            'query' => $query,
            'db'=> \frontend\components\Utilities::userdb(),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        
        $dataProvider->sort->attributes['setting_id'] = [
        'asc' => ['setting_id' => SORT_ASC],
        'desc' => ['setting_id' => SORT_DESC],
        ];
        
        
        $dataProvider->sort->attributes['setting_key'] = [
        'asc' => ['setting_key' => SORT_ASC],
        'desc' => ['setting_key' => SORT_DESC],
        ]; 
        
        $dataProvider->sort->attributes['setting_value'] = [
        'asc' => ['setting_value' => SORT_ASC],
        'desc' => ['setting_value' => SORT_DESC],
        ]; 

        $query->andFilterWhere([
            'setting_id' => $this->setting_id,
            'setting_key' => $this->setting_key,
            'setting_value' => $this->setting_value]);
        
        return $dataProvider;
    }
}
