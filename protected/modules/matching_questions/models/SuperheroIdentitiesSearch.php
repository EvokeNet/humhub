<?php

namespace app\modules\matching_questions\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\matching_questions\models\SuperheroIdentities;

/**
 * SuperheroIdentitiesSearch represents the model behind the search form about `app\modules\matching_questions\models\SuperheroIdentities`.
 */
class SuperheroIdentitiesSearch extends SuperheroIdentities
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'quality_1', 'quality_2', 'primary_power', 'secondary_power'], 'integer'],
            [['name', 'description', 'created', 'modified'], 'safe'],
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
        $query = SuperheroIdentities::find();

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
            'quality_1' => $this->quality_1,
            'quality_2' => $this->quality_2,
            'primary_power' => $this->primary_power,
            'secondary_power' => $this->secondary_power,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
