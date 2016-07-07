<?php

namespace app\modules\missions\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\missions\models\Evokations;

/**
 * EvokationsSearch represents the model behind the search form about `app\modules\missions\models\Evokations`.
 */
class EvokationsSearch extends Evokations
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'mission_id', 'created_by', 'updated_by'], 'integer'],
            [['title', 'description', 'youtube_url', 'gdrive_url', 'created_at', 'updated_at'], 'safe'],
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
        $query = Evokations::find();

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
            'mission_id' => $this->mission_id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'youtube_url', $this->youtube_url])
            ->andFilterWhere(['like', 'gdrive_url', $this->gdrive_url]);

        return $dataProvider;
    }
}
