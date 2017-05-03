<?php

use yii\db\Migration;

class m161103_071204_achievements_translation extends Migration
{
    public function up()
    {
        $this->createTable('achievement_translations', array(
            'id' => 'pk',
            'achievement_id' => 'int(16) NOT NULL',
            'title' => 'varchar(256) NOT NULL',
            'description' => 'text NULL',
            'language_id' => 'int(16) NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'updated_at' => 'datetime',
                ), '');

        $this->addForeignKey(
            'fk-achievement_translations-achievement_id',
            'achievement_translations',
            'achievement_id',
            'achievements',
            'id',
            'CASCADE'
        ); 
    }

    public function down()
    {
        // echo "m161103_071204_achievements_translation cannot be reverted.\n";

        $this->dropTable('achievement_translations');
        return true;

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
