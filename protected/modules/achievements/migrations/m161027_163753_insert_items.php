<?php

use yii\db\Migration;

class m161027_163753_insert_items extends Migration
{
    public function up()
    {
        $this->insert('achievements', [
            'id' => 1,
            'code' => 'evidence_6',
            'title' => 'Submitted 6 evidences',
            'description' => 'You have to submit 6 evidences to unlock this achievement',
            'image' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);

        $this->insert('achievements', [
            'id' => 2,
            'code' => 'evidence_12',
            'title' => 'Submitted 12 evidences',
            'description' => 'You have to submit 12 evidences to unlock this achievement',
            'image' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);

        $this->insert('achievements', [
            'id' => 3,
            'code' => 'evidence_24',
            'title' => 'Submitted 24 evidences',
            'description' => 'You have to submit 24 evidences to unlock this achievement',
            'image' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);

        $this->insert('achievements', [
            'id' => 4,
            'code' => 'evidence_48',
            'title' => 'Submitted 48 evidences',
            'description' => 'You have to submit 48 evidences to unlock this achievement',
            'image' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);

        $this->insert('achievements', [
            'id' => 5,
            'code' => 'evokation_vote',
            'title' => 'Vote on an evokation',
            'description' => 'You have to vote on an evokation to unlock this achievement',
            'image' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);

        $this->insert('achievements', [
            'id' => 6,
            'code' => 'quality_review',
            'title' => 'Give a Quality Review',
            'description' => 'You have to give a quality review to unlock this achievement',
            'image' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
    }

    public function down()
    {
        echo "m161027_163753_insert_items cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
