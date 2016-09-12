<?php

use yii\db\Migration;

class m160909_152951_trackSlotMachineUses extends Migration
{
    public function up()
    {
      $this->createTable('slot_machine_stats', [
        'id' => $this->primaryKey(),
        'uses' => $this->integer()->defaultValue(0),
        'evocoin_created' => $this->integer()->defaultValue(0),
      ]);
    }

    public function down()
    {
      $this->dropTable('slot_machine_stats');
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
