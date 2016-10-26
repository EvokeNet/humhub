<?php

use yii\db\Migration;

class m161026_164932_achievements extends Migration
{
    public function up()
    {
        $this->createTable('achievements', array(
            'id' => 'pk',
            'code' => 'varchar(256) NOT NULL',
            'title' => 'varchar(256) NOT NULL',
            'description' => 'text NULL',
            'image' => 'varchar(256)',
            'created_at' => 'datetime NULL',
            'updated_at' => 'datetime NULL',
                ), '');

    }

    public function down()
    {
        $this->dropTable('achievements');
        return true;
    }

}
