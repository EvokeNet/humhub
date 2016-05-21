<?php

use yii\db\Migration;

class m160507_112009_matching extends Migration
{
    public function up()
    {
        $this->createTable('matching_questions', array(
            'id' => 'pk',
            'description' => 'varchar(1000) NOT NULL',
            'type' => 'varchar(255) NOT NULL',
            'created' => 'datetime NULL',
            'modified' => 'datetime NULL',
                ), '');
                
        $this->createTable('matching_answers', array(
            'id' => 'pk',
            'description' => 'varchar(255) NOT NULL',
            'matching_question_id' => 'int(11) NOT NULL',
            'quality_id' => 'int(11) NOT NULL',
            'created' => 'datetime NULL',
            'modified' => 'datetime NULL',
                ), '');

        $this->createTable('user_matching_answers', array(
            'id' => 'pk',
            'user_id' => 'int(11) NOT NULL',
            'matching_question_id' => 'int(11) NOT NULL',
            'matching_aswer_id' => 'int(11) NOT NULL',
            'description' => 'varchar(255) NOT NULL',
            'order' => 'int(11) NOT NULL',
            'created' => 'datetime NOT NULL',
            'modified' => 'datetime NOT NULL',
                ), '');

        $this->createTable('qualities', array(
            'id' => 'pk',
            'name' => 'varchar(255) NOT NULL',
            'short_name' => 'varchar(255) NOT NULL',
            'description' => 'varchar(255) NOT NULL',
            'created' => 'datetime NULL',
            'modified' => 'datetime NULL',
                ), '');

        $this->createTable('superhero_identities', array(
            'id' => 'pk',
            'name' => 'varchar(255) NOT NULL',
            'description' => 'varchar(255) NOT NULL',
            'quality_1' => 'int(11) NOT NULL',
            'quality_2' => 'int(11) NOT NULL',
            'primary_power' => 'int(11) NOT NULL',
            'secondary_power' => 'int(11) NOT NULL',
            'created' => 'datetime NULL',
            'modified' => 'datetime  NULL',
                ), '');
                
        $this->addForeignKey(
            'fk-matching_answers-matching_question_id',
            'matching_answers',
            'matching_question_id',
            'matching_questions',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-user_matching_answers-matching_question_id',
            'user_matching_answers',
            'matching_question_id',
            'matching_questions',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-user_matching_answers-matching_answer_id',
            'user_matching_answers',
            'matching_aswer_id',
            'matching_answers',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-user_matching_answers-user_id',
            'user_matching_answers',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-matching_answers_quality',
            'matching_answers',
            'quality_id',
            'qualities',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-superhero_quality_1',
            'superhero_identities',
            'quality_1',
            'qualities',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-superhero_quality_2',
            'superhero_identities',
            'quality_2',
            'qualities',
            'id',
            'CASCADE'
        );

        $this->insert('matching_questions', [
            'id' => 4,
            'description' => '<p class="text-color-highlight">Agent, we have received an urgent evoke to help save protected land in your community.  You are called to action, how will you respond?  A large public space in your community is about to be approved for commercial development.  Poor families will lose a green park space and birds and frogs are at risk of losing their habitat.  The private developer will profit enormously and there are good reasons to believe that the politicians who have made the decision to allow the land to be developed will be rewarded by the developer. </p>
                <p class="text-color-highlight">What will you do? Input these answers in order of how you are most likely to respond (1 - 4) </p>',
            'type' => 'order',
            'created' => NULL,
            'modified' => NULL,
        ]);

        $this->insert('matching_questions', [
            'id' => 5,
            'description' => '<p class="text-color-highlight">Agent, we have learned of an epidemic in a community next to yours that hits very close to your heart. You learn that your cousin has cancer. She further tells you that her next door neighbor and childhood friend died from the same cancer last year. In fact the incidence of people suffering from this precise cancer in this particular neighborhood seems far above what you would expect. Your cousin’s medical expenses will far exceed her resources. Which of the following would you be most likely to do? </p>
                <p class="text-color-highlight">What would be your preferred action to help? Order the following responses according to your top three preferences.</p>
                <p class="text-color-highlight">
                Input these actions in order of what would be your preference in helping (1 - 4).
                </p>',
            'type' => 'order',
            'created' => NULL,
            'modified' => NULL,
        ]);

        $this->insert('matching_questions', [
            'id' => 6,
            'description' => 'Are you best described as:',
            'type' => 'single-choice',
            'created' => NULL,
            'modified' => NULL,
        ]);

        $this->insert('matching_questions', [
            'id' => 7,
            'description' => 'Are you best described as:',
            'type' => 'single-choice',
            'created' => NULL,
            'modified' => NULL,
        ]);

        $this->insert('matching_questions', [
            'id' => 8,
            'description' => 'Are you best described as:',
            'type' => 'single-choice',
            'created' => NULL,
            'modified' => NULL,
        ]);

        $this->insert('matching_questions', [
            'id' => 9,
            'description' => 'Are you best described as:',
            'type' => 'single-choice',
            'created' => NULL,
            'modified' => NULL,
        ]);

        $this->insert('matching_questions', [
            'id' => 10,
            'description' => 'Are you best described as:',
            'type' => 'single-choice',
            'created' => NULL,
            'modified' => NULL,
        ]);

        $this->insert('matching_questions', [
            'id' => 11,
            'description' => 'Are you best described as:',
            'type' => 'single-choice',
            'created' => NULL,
            'modified' => NULL,
        ]);

        $this->insert('qualities', [
            'id' => 1,
            'name' => 'Creative Visionary',
            'short_name' => 'CV',
            'description' => 'Creative Visionary',
            'created' => NULL,
            'modified' => NULL,
        ]);

        $this->insert('qualities', [
            'id' => 2,
            'name' => 'Deep Collaborator',
            'short_name' => 'DC',
            'description' => 'Deep Collaborator',
            'created' => NULL,
            'modified' => NULL,
        ]);

        $this->insert('qualities', [
            'id' => 3,
            'name' => 'Systems Thinker',
            'short_name' => 'ST',
            'description' => 'Systems Thinker',
            'created' => NULL,
            'modified' => NULL,
        ]);

        $this->insert('qualities', [
            'id' => 4,
            'name' => 'Empathetic Activist',
            'short_name' => 'EA',
            'description' => 'Empathetic Activist',
            'created' => NULL,
            'modified' => NULL,
        ]);
     

        $this->insert('matching_answers', [
            'id' => 1,
            'description' => 'Someone who loves ideas',
            'matching_question_id' => 6,
            'quality_id' => 1,
            'created' => NULL,
            'modified' => NULL,
        ]);

        $this->insert('matching_answers', [
            'id' => 2,
            'description' => 'Someone who inspires others',
            'matching_question_id' => 6,
            'quality_id' => 4,
            'created' => NULL,
            'modified' => NULL,
        ]);

        $this->insert('matching_answers', [
            'id' => 3,
            'description' => 'A networker',
            'matching_question_id' => 7,
            'quality_id' => 2,
            'created' => NULL,
            'modified' => NULL,
        ]);

        $this->insert('matching_answers', [
            'id' => 4,
            'description' => 'A problem solver',
            'matching_question_id' => 7,
            'quality_id' => 3,
            'created' => NULL,
            'modified' => NULL,
        ]);

        $this->insert('matching_answers', [
            'id' => 5,
            'description' => 'An original thinker',
            'matching_question_id' => 8,
            'quality_id' => 1,
            'created' => NULL,
            'modified' => NULL,
        ]);

        $this->insert('matching_answers', [
            'id' => 6,
            'description' => 'A pattern recognizer',
            'matching_question_id' => 8,
            'quality_id' => 3,
            'created' => NULL,
            'modified' => NULL,
        ]);

        $this->insert('matching_answers', [
            'id' => 7,
            'description' => 'Someone who brings people together',
            'matching_question_id' => 9,
            'quality_id' => 2,
            'created' => NULL,
            'modified' => NULL,
        ]);

        $this->insert('matching_answers', [
            'id' => 8,
            'description' => 'Someone who brings concepts together',
            'matching_question_id' => 9,
            'quality_id' => 1,
            'created' => NULL,
            'modified' => NULL,
        ]);
          

        $this->insert('matching_answers', [
            'id' => 9,
            'description' => 'Someone who analyzes',
            'matching_question_id' => 10,
            'quality_id' => 3,
            'created' => NULL,
            'modified' => NULL,
        ]);

        $this->insert('matching_answers', [
            'id' => 10,
            'description' => 'Someone who does',
            'matching_question_id' => 10,
            'quality_id' => 4,
            'created' => NULL,
            'modified' => NULL,
        ]);           

        $this->insert('matching_answers', [
            'id' => 11,
            'description' => 'Someone who connects people',
            'matching_question_id' => 11,
            'quality_id' => 2,
            'created' => NULL,
            'modified' => NULL,
        ]);

        $this->insert('matching_answers', [
            'id' => 12,
            'description' => 'Someone who understands people',
            'matching_question_id' => 11,
            'quality_id' => 4,
            'created' => NULL,
            'modified' => NULL,
        ]);

        $this->insert('matching_answers', [
            'id' => 13,
            'description' => 'You engage your network and tweet or post the story on social media.',
            'matching_question_id' => 4,
            'quality_id' => 2,
            'created' => NULL,
            'modified' => NULL,
        ]);

        $this->insert('matching_answers', [
            'id' => 14,
            'description' => 'You text your friends asking to meet with them to discuss ways to prevent the development.',
            'matching_question_id' => 4,
            'quality_id' => 4,
            'created' => NULL,
            'modified' => NULL,
        ]);        

        $this->insert('matching_answers', [
            'id' => 15,
            'description' => 'You develop and write about an alternative proposal for the location of the commercial development.',
            'matching_question_id' => 4,
            'quality_id' => 1,
            'created' => NULL,
            'modified' => NULL,
        ]);

        $this->insert('matching_answers', [
            'id' => 16,
            'description' => 'You investigate and analyze the developer’s business operations and past dealings in other communities.',
            'matching_question_id' => 4,
            'quality_id' => 3,
            'created' => NULL,
            'modified' => NULL,
        ]);

        $this->insert('matching_answers', [
            'id' => 17,
            'description' => 'You organize a party to raise money for your cousin’s hospital bills.',
            'matching_question_id' => 5,
            'quality_id' => 2,
            'created' => NULL,
            'modified' => NULL,
        ]);

        $this->insert('matching_answers', [
            'id' => 18,
            'description' => 'You spend a couple of hours talking to your cousin and 5 others from the community suffering from cancer to better understand their lives.',
            'matching_question_id' => 5,
            'quality_id' => 4,
            'created' => NULL,
            'modified' => NULL,
        ]);

        $this->insert('matching_answers', [
            'id' => 19,
            'description' => 'You research hospitals that are engaged in experimental studies related to this cancer.',
            'matching_question_id' => 5,
            'quality_id' => 1,
            'created' => NULL,
            'modified' => NULL,
        ]);

        $this->insert('matching_answers', [
            'id' => 20,
            'description' => 'You study whether this number of cancers is statistically significant and if there can be an environmental cause.',
            'matching_question_id' => 5,
            'quality_id' => 3,
            'created' => NULL,
            'modified' => NULL,
        ]);   

        $this->insert('superhero_identities', [
            'id' => 1,
            'name' => 'Imaginator',
            'description' => 'Imaginator',
            'quality_1' => 1,
            'quality_2' => 2,
            'primary_power' => 0,
            'secondary_power' => 0,
            'created' =>  NULL,
            'modified' => NULL,
        ]);  

        $this->insert('superhero_identities', [
            'id' => 2,
            'name' => 'Ideator',
            'description' => 'Ideator',
            'quality_1' => 1,
            'quality_2' => 3,
            'primary_power' => 0,
            'secondary_power' => 0,
            'created' =>  NULL,
            'modified' => NULL,
        ]);  

        $this->insert('superhero_identities', [
            'id' => 3,
            'name' => 'Activator',
            'description' => 'Activator',
            'quality_1' => 1,
            'quality_2' => 4,
            'primary_power' => 0,
            'secondary_power' => 0,
            'created' =>  NULL,
            'modified' => NULL,
        ]);  

        $this->insert('superhero_identities', [
            'id' => 4,
            'name' => 'Networker',
            'description' => 'Networker',
            'quality_1' => 2,
            'quality_2' => 3,
            'primary_power' => 0,
            'secondary_power' => 0,
            'created' =>  NULL,
            'modified' => NULL,
        ]);  

        $this->insert('superhero_identities', [
            'id' => 5,
            'name' => 'Connector',
            'description' => 'Connector',
            'quality_1' => 2,
            'quality_2' => 4,
            'primary_power' => 0,
            'secondary_power' => 0,
            'created' =>  NULL,
            'modified' => NULL,
        ]);  

        $this->insert('superhero_identities', [
            'id' => 6,
            'name' => 'Synthesizer',
            'description' => 'Synthesizer',
            'quality_1' => 3,
            'quality_2' => 4,
            'primary_power' => 0,
            'secondary_power' => 0,
            'created' =>  NULL,
            'modified' => NULL,
        ]);  

        $this->insert('superhero_identities', [
            'id' => 7,
            'name' => 'Conductor',
            'description' => 'Conductor',
            'quality_1' => 2,
            'quality_2' => 1,
            'primary_power' => 0,
            'secondary_power' => 0,
            'created' =>  NULL,
            'modified' => NULL,
        ]);  

        $this->insert('superhero_identities', [
            'id' => 8,
            'name' => 'Logician',
            'description' => 'Logician',
            'quality_1' => 3,
            'quality_2' => 1,
            'primary_power' => 0,
            'secondary_power' => 0,
            'created' =>  NULL,
            'modified' => NULL,
        ]);        

        $this->insert('superhero_identities', [
            'id' => 9,
            'name' => 'Possibilist',
            'description' => 'Possibilist',
            'quality_1' => 4,
            'quality_2' => 1,
            'primary_power' => 0,
            'secondary_power' => 0,
            'created' =>  NULL,
            'modified' => NULL,
        ]);  

        $this->insert('superhero_identities', [
            'id' => 10,
            'name' => 'Mission Controller',
            'description' => 'Mission Controller',
            'quality_1' => 3,
            'quality_2' => 2,
            'primary_power' => 0,
            'secondary_power' => 0,
            'created' =>  NULL,
            'modified' => NULL,
        ]);  

        $this->insert('superhero_identities', [
            'id' => 11,
            'name' => 'Mobilizer',
            'description' => 'Mobilizer',
            'quality_1' => 4,
            'quality_2' => 2,
            'primary_power' => 0,
            'secondary_power' => 0,
            'created' =>  NULL,
            'modified' => NULL,
        ]);  

        $this->insert('superhero_identities', [
            'id' => 12,
            'name' => 'Orchestrator',
            'description' => 'Orchestrator',
            'quality_1' => 4,
            'quality_2' => 3,
            'primary_power' => 0,
            'secondary_power' => 0,
            'created' =>  NULL,
            'modified' => NULL,
        ]);  


    }

    public function down()
    {
        $this->dropTable('user_matching_answers');
        $this->dropTable('matching_answers');
        $this->dropTable('matching_questions');
        $this->dropTable('superhero_identities');
        $this->dropTable('qualities');
        return true;
    }
}