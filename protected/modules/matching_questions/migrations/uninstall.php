<?php

use yii\db\Migration;

class uninstall extends Migration
{

    public function up()
    {

        $this->dropTable('matching_answers');
        $this->dropTable('matching_questions');
        $this->dropTable('user_matching_answers');
        $this->dropTable('qualities');
        $this->dropColumn('user','superhero_identity_id');
        $this->dropForeignKey(
            'fk-user-super_hero_id',
            'user'
        );
        $this->dropTable('superhero_identities');
    }

    public function down()
    {
        echo "m160507_112009_matching does not support migration down.\n";
        return false;
    }

}
