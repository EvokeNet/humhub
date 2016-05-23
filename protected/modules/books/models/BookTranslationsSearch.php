<?php

namespace app\modules\books\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\books\models\BookTranslations;

/**
 * BookTranslationsSearch represents the model behind the search form about `app\modules\books\models\BookTranslations`.
 */
class BookTranslationsSearch extends BookTranslations
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'book_id'], 'integer'],
            [['title', 'abstract'], 'safe'],
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
        $query = BookTranslations::find();

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
            'book_id' => $this->book_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'abstract', $this->abstract]);

        return $dataProvider;
    }
}
