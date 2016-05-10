<?php

use yii\db\Migration;

class m160510_114233_language extends Migration
{
    public function up()
    {
        $this->addForeignKey(
            'fk-mission_translations-language_id',
            'mission_translations',
            'language_id',
            'languages',
            'id',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk-activity_translations-language_id',
            'activity_translations',
            'language_id',
            'languages',
            'id',
            'CASCADE'
        );
        
        $this->renameColumn(
            'mission_translations',
            'created',
            'created_at'
        );
        
       $this->renameColumn(
            'mission_translations',
            'modified',
            'updated_at'
        );
        
        $this->renameColumn(
            'activity_translations',
            'created',
            'created_at'
        );
        
        $this->renameColumn(
            'activity_translations',
            'modified',
            'updated_at'
        );
    }

    public function down()
    {
        echo "m160510_114233_language cannot be reverted.\n";

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
