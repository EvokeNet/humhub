<?php

use yii\db\Migration;

class m160727_131328_add_default_level extends Migration
{
    public function up()
    {
      $this->alterColumn('user_powers', 'level', $this->integer(11)->defaultValue(0));
    }

    public function down()
    {
        echo "m160727_131328_add_default_level cannot be reverted.\n";

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
