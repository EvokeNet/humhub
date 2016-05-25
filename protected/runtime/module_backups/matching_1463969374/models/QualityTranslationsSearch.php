<?php

namespace app\modules\matching_questions\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\matching_questions\models\QualityTranslations;

/**
 * QualityTranslationsSearch represents the model behind the search form about `app\modules\matching_questions\models\QualityTranslations`.
 */
class QualityTranslationsSearch extends QualityTranslations
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'quality_id', 'language_id'], 'integer'],
            [['name', 'short_name', 'description', 'created_at', 'updated_at'], 'safe'],
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
        $query = QualityTranslations::find();

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
            'quality_id' => $this->quality_id,
            'language_id' => $this->language_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'short_name', $this->short_name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
