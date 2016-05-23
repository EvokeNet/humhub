<?php


namespace app\modules\matching_questions\models;




use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

use app\modules\matching_questions\models\Qualities;




/**
 * QualitiesSearch represents the model behind the search form about `app\modules\matching_questions\models\Qualities`.
 */
class QualitiesSearch extends Qualities
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'short_name', 'description', 'created', 'modified'], 'safe'],
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
        $query = Qualities::find();

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
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'short_name', $this->short_name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
