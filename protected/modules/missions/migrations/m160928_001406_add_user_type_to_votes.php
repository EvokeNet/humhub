<?php

use yii\db\Migration;
use app\modules\missions\models\Votes;
use humhub\modules\user\models\User;
use humhub\modules\user\models\Group;

class m160928_001406_add_user_type_to_votes extends Migration
{
    public function up()
    {
      $this->addColumn('votes', 'user_type', $this->string());

      $votes = Votes::find()->all();

      foreach ($votes as $vote) {
        $user = User::find()->where(['id' => $vote->user_id])->one();

        $vote->user_type = $user->group->name;
        $vote->save();
      }
    }

    public function down()
    {
      $this->dropColumn('votes', 'user_type');
    }
}
