<?php

use yii\db\Migration;

class m161026_170310_user_achievements extends Migration
{
    public function up()
    {
        $this->createTable('user_achievements', array(
            'user_id' => 'int NOT NULL',
            'achievement_id' => 'int NOT NULL',
            'created_at' => 'datetime NULL',
            'updated_at' => 'datetime NULL',
                ), '');

        $this->addPrimaryKey('user_achievements_pk', 'user_achievements', ['user_id', 'achievement_id']);

        $this->addForeignKey(
        'fk-user_id',
        'user_achievements',
        'user_id',
        'user',
        'id',
        'CASCADE'
        );

        $this->addForeignKey(
        'fk-achievement_id',
        'user_achievements',
        'achievement_id',
        'achievements',
        'id',
        'CASCADE'
        );

    }

    public function down()
    {
        $this->dropForeignKey('fk-achievement_id', 'user_achievements');
        $this->dropForeignKey('fk-user_id', 'user_achievements');
        $this->dropPrimaryKey('user_achievements_pk', 'user_achievements');
        $this->dropTable('user_achievements');
        return true;
    }
}
