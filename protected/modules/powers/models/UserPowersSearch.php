<?php

namespace app\modules\powers\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\powers\models\UserPowers;

/**
 * UserPowersSearch represents the model behind the search form about `app\modules\powers\models\UserPowers`.
 */
class UserPowersSearch extends UserPowers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'power_id', 'value'], 'integer'],
            [['created_at', 'modified_at'], 'safe'],
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
        $query = UserPowers::find();

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
            'power_id' => $this->power_id,
            'value' => $this->value,
            'created_at' => $this->created_at,
            'modified_at' => $this->modified_at,
        ]);

        return $dataProvider;
    }
}
