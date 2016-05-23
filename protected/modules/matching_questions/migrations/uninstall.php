<?php

use yii\db\Migration;

class uninstall extends Migration
{

    public function up()
    {
        $this->dropTable('user_matching_answers');^M
        $this->dropTable('matching_answers');^M
        $this->dropTable('matching_questions');
 
      
        $this->dropTable('qualities');
        $this->dropTable('superhero_identities');
        
        $this->dropTable('matching_question_translations');
        $this->dropTable('matching_answer_translations');
        $this->dropTable('quality_translations');
        $this->dropTable('superhero_identity_translations');
        

        

        $this->dropColumn('user','superhero_identity_id');
        
        $this->dropForeignKey(
            'fk-user-super_hero_id',
            'user'
        );
        $this->dropTable('superhero_identities');
        $this->dropTable('qualities');
    }

    public function down()
    {
        echo "uninstall does not support migration down.\n";
        return false;
    }

}
