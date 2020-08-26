<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Cost;

class Costsearch extends Cost
{
    
    public function rules()
    {
        return [
            [['id','costcategory_id', 'costsubcategory_id'], 'integer'],
            [['description', 'coststartdate', 'costenddate', 'discontinueddate', 'modifieddate'], 'safe'],
            [['listprice'], 'number'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','Cost'),
            'description' => Yii::t('app','Description'),
            'listprice' => Yii::t('app','Price'),
            'costnumber'=>Yii::t('app','Cost Number'),
            'costcategory_id' => Yii::t('app','Costcode (eg. DIR - Direct Expenses)'),
            'costcode' =>Yii::t('app','Costcode'),
            'costsubcategory_id' => Yii::t('app','eg. Labour'),
            'coststartdate' => Yii::t('app','First cost date'),
            'costenddate' => Yii::t('app','Cost End date'),
            'discontinueddate' => Yii::t('app','Discontinued Date'),           
        ];
    }
    
    public function search($params)
    {
        $query = Cost::find();
        
        $dataProvider = new ActiveDataProvider([
          'pagination' => ['pageSize' => 5],
          'query' => $query,
          'db' => \frontend\components\Utilities::userdb(),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        
        $dataProvider->sort->attributes['costcategory_id'] = [
        'asc' => ['costcategory_id' => SORT_ASC],
        'desc' => ['costcategory_id' => SORT_DESC],
        ];
        
        $query->andFilterWhere([
            'id' => $this->id,
            'listprice' => $this->listprice,
            'costcategory_id' => $this->costcategory_id,
            'costsubcategory_id' => $this->costsubcategory_id,
            'coststartdate' => $this->coststartdate,
            'costenddate' => $this->costenddate,
            'discontinueddate' => $this->discontinueddate,
            'modifieddate' => $this->modifieddate,
        ]);
        $query->andFilterWhere(['like', 'description', $this->description]);
        return $dataProvider;
    }
}
