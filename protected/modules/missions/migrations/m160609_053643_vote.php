<?php

use yii\db\Migration;

class m160609_053643_vote extends Migration
{
    public function up()
    {    
        $this->createTable('votes', array(
            'id' => 'pk',
            'activity_id' => 'int(16) NOT NULL',
            'evidence_id' => 'int(16) NOT NULL',
            'user_id' => 'int(16) NOT NULL',
            'flag' => 'int(16) NOT NULL', // flag to indicate if it's a yes/no vote
            'value' => 'int(32) NOT NULL', // 0 to 5 value
            'created_at' => 'datetime NULL',
            'updated_at' => 'datetime NULL',
                ), '');
                
        $this->addForeignKey(
            'fk-votes-activity_id',
            'votes',
            'activity_id',
            'activities',
            'id',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk-votes-evidence_id',
            'votes',
            'evidence_id',
            'evidence',
            'id',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk-votes-user_id',
            'votes',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        //echo "m160609_053643_vote cannot be reverted.\n";
        
        $this->dropForeignKey('fk-votes-activity_id', 'votes');
        $this->dropForeignKey('fk-votes-evidence_id', 'votes');
        $this->dropForeignKey('fk-votes-user_id', 'votes');

        $this->dropTable('votes');
        
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
