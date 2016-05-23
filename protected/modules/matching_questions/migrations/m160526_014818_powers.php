<?php

use yii\db\Migration;

class m160526_014818_powers extends Migration
{
    public function up()
    {
        $this->createTable('powers', array(
            'id' => 'pk',
            'name' => 'varchar(255) NOT NULL',
            'tier' => 'int(11) NOT NULL',
            'created_at' => 'datetime NULL',
            'modified_at' => 'datetime NULL',
                ), '');

        $this->createTable('skills', array(
            'id' => 'pk',
            'name' => 'varchar(255) NOT NULL',
            'created_at' => 'datetime NULL',
            'modified_at' => 'datetime NULL',
                ), '');

        $this->createTable('powers_skills', array(
            'id' => 'pk',
            'skill_id' => 'int(11) NOT NULL',
            'power_id' => 'int(11) NOT NULL',
            'level' => 'int(11) NOT NULL',
            'created_at' => 'datetime NULL',
            'modified_at' => 'datetime NULL',
                ), '');

        $this->addForeignKey(
            'fk-powers_skills-skills',
            'powers_skills',
            'skill_id',
            'skills',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-powers_skills-powers',
            'powers_skills',
            'power_id',
            'powers',
            'id',
            'CASCADE'
        );

        $this->createTable('user_skills', array(
            'id' => 'pk',
            'user_id' => 'int(11) NOT NULL',
            'skill_id' => 'int(11) NOT NULL',
            'points' => 'int(11) NOT NULL',
            'level' => 'int(11) NOT NULL',
            'created_at' => 'datetime NULL',
            'modified_at' => 'datetime NULL',
                ), '');

        $this->addForeignKey(
            'fk-user_skills-user',
            'user_skills',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-user_skills-user',
            'user_skills',
            'skill_id',
            'skills',
            'id',
            'CASCADE'
        );

        $this->createTable('player_classes', array(
            'id' => 'pk',
            'quality_id' => 'int(11) NOT NULL',
            'level' => 'int(11) NOT NULL',
            'created_at' => 'datetime NULL',
            'modified_at' => 'datetime NULL',
                ), '');

        $this->addForeignKey(
            'fk-player_classes-quality',
            'player_classes',
            'quality_id',
            'qualities',
            'id',
            'CASCADE'
        );


        $this->createTable('classes_powers', array(
            'id' => 'pk',
            'class_id' => 'int(11) NOT NULL',
            'power_id' => 'int(11) NOT NULL',
            'created_at' => 'datetime NULL',
            'modified_at' => 'datetime NULL',
                ), '');

        $this->addForeignKey(
            'fk-classes_powers-class',
            'classes_powers',
            'class_id',
            'player_classes',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-classes_powers-power',
            'classes_powers',
            'power_id',
            'powers',
            'id',
            'CASCADE'
        );


    }

    public function down()
    {   
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
