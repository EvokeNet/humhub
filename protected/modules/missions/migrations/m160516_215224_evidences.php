<?php

use yii\db\Migration;

class m160516_215224_evidences extends Migration
{
    public function up()
    {

        $this->createTable('evidence', array(
            'id' => 'pk',
            'title' => 'varchar(120) NOT NULL',
            'type' => 'varchar(255) NOT NULL',
            'main_content' => 'text NOT NULL',
            'content' => 'text NOT NULL',
            'user_id' => 'int(11) NOT NULL',
            'activities_id' => 'int(11) NOT NULL',
            'space_id' => 'int(11) NOT NULL',
            'created' => 'datetime NOT NULL',
            'modified' => 'datetime NOT NULL',
                ), '');

        $this->addForeignKey(
            'fk-evidence-user_id',
            'evidence',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-evidence-activities_id',
            'evidence',
            'activities_id',
            'activities',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-evidence-space_id',
            'evidence',
            'space_id',
            'space',
            'id',
            'CASCADE'
        );


    }

    public function down()
    {
        $this->dropTable('evidence');

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
