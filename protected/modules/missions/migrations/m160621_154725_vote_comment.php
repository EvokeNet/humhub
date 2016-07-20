<?php

use yii\db\Migration;

class m160621_154725_vote_comment extends Migration
{
    public function up()
    {
        $this->addColumn(
            'votes',
            'comment',
            'text DEFAULT NULL'
        );
    }

    public function down()
    {
        $this->dropColumn('votes', 'comment');
        return true;
    }

}
