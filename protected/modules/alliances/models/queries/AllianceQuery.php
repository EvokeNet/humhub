<?php

namespace app\modules\alliances\models\queries;

use yii\db\ActiveQuery;

class AllianceQuery extends ActiveQuery
{
    public function findByTeam($team_id)
    {
        $this->where(['team_1' => $team_id])
             ->orWhere(['team_2' => $team_id]);

        return $this;
    }
}
