<?php

use yii\db\Migration;

class m160713_153356_portfolio extends Migration
{
    public function up()
    {

        $this->createTable('portfolio', array(
            'id' => 'pk',
            'user_id' => 'int(16) NOT NULL',
            'evokation_id' => 'int(16) NOT NULL',
            'investment' => 'int(16) NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'updated_at' => 'datetime NOT NULL',
                ), '');

        $this->addForeignKey(
            'fk-portfolio-user_id',
            'portfolio',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-portfolio-evokation_id',
            'portfolio',
            'evokation_id',
            'evokations',
            'id',
            'CASCADE'
        );

    }

    public function down()
    {
        $this->dropTable('portfolio');

        return true;
    }
    
}
