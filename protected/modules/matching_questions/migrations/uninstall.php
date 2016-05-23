<?php

use yii\db\Migration;

class uninstall extends Migration
{

    public function up()
    {
<<<<<<< HEAD
=======

       $this->dropForeignKey(
           'fk-classes_powers-class',
          'classes_powers'
       );
       $this->dropForeignKey(
          'fk-classes_powers-power',
          'classes_powers'
       );
       
       $this->dropTable('classes_powers');
       $this->dropForeignKey(
          'fk-player_classes-quality',
          'player_classes'
       );

       $this->dropTable('player_classes');

       $this->dropForeignKey(
          'fk-user_skills-user',
          'user_skills'
       );
       $this->dropForeignKey(
          'fk-user_skills-user',
          'user_skills'
       );
       $this->dropTable('user_skills');
       $this->dropForeignKey(
          'fk-powers_skills-skills',
          'powers_skills'
       );
       $this->dropForeignKey(
          'fk-powers_skills-powers',
          'powers_skills'
       );
       $this->dropTable('powers_skills');
       $this->dropTable('skills');
       $this->dropTable('powers');

       //above for powers migration

>>>>>>> origin/gf-evidences
       $this->dropTable('user_matching_answers');
       $this->dropTable('matching_answer_translations');
       $this->dropTable('matching_answers');
       $this->dropTable('matching_question_translations');
       $this->dropTable('matching_questions');
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
  
