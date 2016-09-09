<?php

use yii\db\Migration;

class m160909_153618_trackUserSlotMachineUses extends Migration
{
    public function up()
    {
      $this->addColumn('user', 'slot_machine_uses', $this->integer()->defaultValue(0));
    }

    public function down()
    {
      $this->dropColumn('user', 'slot_machine_uses');
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
