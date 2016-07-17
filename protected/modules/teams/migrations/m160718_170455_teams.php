<?php

use yii\db\Migration;

class m160718_170455_teams extends Migration
{
    public function up()
    {
        $this->addColumn('space', 'is_team', $this->boolean());
    }

    public function down()
    {
        $this->dropColumn('space', 'is_team');

        return true;
    }

}
