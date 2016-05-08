<?php

use yii\db\Migration;

class m160508_030317_timestamp extends Migration
{
    public function up()
    {
        $this->renameColumn(
            'missions',
            'created',
            'created_at'
        );
        
       $this->renameColumn(
            'missions',
            'modified',
            'updated_at'
        );
        
        $this->renameColumn(
            'activities',
            'created',
            'created_at'
        );
        
        $this->renameColumn(
            'activities',
            'modified',
            'updated_at'
        );
    }

    public function down()
    {
        echo "m160508_030317_timestamp cannot be reverted.\n";

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
