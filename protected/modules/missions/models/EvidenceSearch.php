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
            [['id', 'user_id', 'activities_id', 'space_id'], 'integer'],
            [['title', 'type', 'main_content', 'content', 'created', 'modified'], 'safe'],
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
            'user_id' => $this->user_id,
            'activities_id' => $this->activities_id,
            'space_id' => $this->space_id,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'main_content', $this->main_content])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
