<?php

use yii\db\Migration;

class m160525_125930_power extends Migration
{
    public function up()
    {
        $this->addForeignKey(
            'fk-power_translations-power_id',
            'power_translations',
            'power_id',
            'powers',
            'id',
            'CASCADE'
          );
    }

    public function down()
    {
        //echo "m160525_125930_power cannot be reverted.\n";

        $this->dropForeignKey('fk-power_translations-power_id', 'power_translations');

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
