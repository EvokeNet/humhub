<?php

namespace app\modules\matching_questions\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use humhub\modules\matching_questions\models\MatchingAnswerTranslations;

/**
 * MatchingAnswerTranslationsSearch represents the model behind the search form about `humhub\modules\matching_questions\models\MatchingAnswerTranslations`.
 */
class MatchingAnswerTranslationsSearch extends MatchingAnswerTranslations
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'matching_answer_id', 'language_id'], 'integer'],
            [['description', 'created_at', 'updated_at'], 'safe'],
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
        $query = MatchingAnswerTranslations::find();

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
            'matching_answer_id' => $this->matching_answer_id,
            'language_id' => $this->language_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
