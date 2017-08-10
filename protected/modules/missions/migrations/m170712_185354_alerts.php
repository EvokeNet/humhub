<?php

use yii\db\Migration;

class m170712_185354_alerts extends Migration
{
    public function up()
    {
        $this->createTable('alerts', array(
            'id' => 'pk',
            'type' => 'varchar(120) NOT NULL',
            'object_model' => 'varchar(120) NOT NULL',
            'object_id' => 'int(11) NOT NULL',
            'user_id' => 'int(11) NOT NULL',
                ), '');

        $this->addForeignKey(
            'fk-alert-user_id',
            'alerts',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

    }   

    public function down()
    {
        $this->dropForeignKey('fk-alert-user_id', 'alerts');
        $this->dropTable('alerts');

        return true;
    }

}
    