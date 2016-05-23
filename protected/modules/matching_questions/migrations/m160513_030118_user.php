<?php

use yii\db\Migration;

class m160513_030118_user extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'superhero_identity_id', $this->integer());
        $this->addForeignKey(
            'fk-user-super_hero_id',
            'user',
            'superhero_identity_id',
            'superhero_identities',
            'id',
            'CASCADE'
        );

    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-user-super_hero_id',
            'user'
        );
        $this->dropColumn('user', 'superhero_identity_id');

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
