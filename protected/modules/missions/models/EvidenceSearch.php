<?php

namespace app\modules\missions\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\missions\models\Evidence;

/**
 * EvidenceSearch represents the model behind the search form about `app\modules\missions\models\Evidence`.
 */
class EvidenceSearch extends Evidence
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'activities_id', 'created_by', 'updated_by'], 'integer'],
            [['title', 'text', 'created_at', 'updated_at'], 'safe'],
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
        $query = Evidence::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'activities_id' => $this->activities_id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
