<?php

use yii\db\Migration;

class m160623_075033_evokations_categories extends Migration
{
    public function up()
    {
        $this->addColumn('activities', 'evokation_category_id', $this->integer('16'));
        
        $this->createTable('evokation_categories', array(
            'id' => 'pk',
            'title' => 'varchar(256) NOT NULL',
            'description' => 'text NOT NULL',
            'created_at' => 'datetime NULL',
            'updated_at' => 'datetime NULL',
                ), '');
        
        // $this->createTable('activity_categories', array(
        //     'id' => 'pk',
        //     'mission_id' => 'int(16) NOT NULL',
        //     'activity_id' => 'int(16) NOT NULL',
        //     'evokation_category_id' => 'int(16) NOT NULL',
        //     'created_at' => 'datetime NULL',
        //     'updated_at' => 'datetime NULL',
        //         ), '');
        
        $this->createTable('evokation_category_translations', array(
            'id' => 'pk',
            'evokation_category_id' => 'int(16) NOT NULL',
            'title' => 'varchar(256) NOT NULL',
            'description' => 'text NOT NULL',
            'language_id' => 'int(16) NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'updated_at' => 'datetime NOT NULL',
                ), '');
                        
        $this->addForeignKey(
        'fk-activities-evokation_category_id',
        'activities',
        'evokation_category_id',
        'evokation_categories',
        'id',
        'CASCADE'
        );
        
        // $this->addForeignKey(
        // 'fk-activity_categories-activity_id',
        // 'activity_categories',
        // 'activity_id',
        // 'activities',
        // 'id',
        // 'CASCADE'
        // );
        
        $this->addForeignKey(
        'fk-evokation_category_translations-evokation_category_id',
        'evokation_category_translations',
        'evokation_category_id',
        'evokation_categories',
        'id',
        'CASCADE'
        );
    }

    public function down()
    {
        //echo "m160623_075033_evokations_categories cannot be reverted.\n";
        
        $this->dropForeignKey('fk-activities-evokation_category_id', 'activities');
        $this->dropForeignKey('fk-evokation_category_translations-evokation_category_id', 'evokation_category_translations');
        
        $this->dropTable('evokation_category_translations');
        $this->dropTable('evokation_categories');
        
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
