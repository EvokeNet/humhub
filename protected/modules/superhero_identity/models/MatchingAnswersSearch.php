<?php

namespace app\modules\superhero_identity\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\superhero_identity\models\MatchingAnswers;

/**
 * MatchingAnswersSearch represents the model behind the search form about `app\modules\superhero_identity\models\MatchingAnswers`.
 */
class MatchingAnswersSearch extends MatchingAnswers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'matching_question_id', 'quality_id'], 'integer'],
            [['description', 'created', 'modified'], 'safe'],
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
        $query = MatchingAnswers::find();

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
            'matching_question_id' => $this->matching_question_id,
            'quality_id' => $this->quality_id,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
