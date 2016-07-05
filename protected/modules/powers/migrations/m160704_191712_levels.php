<?php

use yii\db\Migration;

class m160704_191712_levels extends Migration
{
    public function up()
    {
        $this->renameColumn('user_qualities', 'total_value', 'level');
        $this->addColumn('user_powers', 'level', 'int(11) NOT NULL');
        $this->addColumn('powers', 'improve_multiplier', 'float NOT NULL');
        $this->addColumn('powers', 'improve_offset', 'float NOT NULL');
    }

    public function down()
    {
        $this->renameColumn('user_qualities', 'level', 'total_value');
        $this->dropColumn('user_powers', 'level');
        $this->dropColumn('powers', 'improve_multiplier');
        $this->dropColumn('powers', 'improve_offset');
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
