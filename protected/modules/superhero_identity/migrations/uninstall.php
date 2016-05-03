<?php

use yii\db\Migration;

class uninstall extends Migration
{

    public function up()
    {

        $this->dropTable('matching_answers');
        $this->dropTable('matching_questions');
        $this->dropTable('social_innovator_qualities');
        $this->dropTable('superhero_identities');
    }

    public function down()
    {
        echo "m160503_201316_initial does not support migration down.\n";
        return false;
    }

}
