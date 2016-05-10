<?php

use yii\db\Migration;

class m160510_032302_missions_id extends Migration
{
    public function up()
    {
        $this->addColumn('missions', 'id_code', $this->text());
        $this->addColumn('activities', 'id_code', $this->text());
    }

    public function down()
    {
        echo "m160510_032302_missions_id cannot be reverted.\n";

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
