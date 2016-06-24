<?php

use yii\db\Migration;

class m160525_235847_rubric extends Migration
{
    public function up()
    {
        $this->addColumn('activities', 'rubric', $this->text('256'));
        $this->addColumn('activity_translations', 'rubric', $this->text('256'));
    }

    public function down()
    {
        echo "m160525_235847_rubric cannot be reverted.\n";

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
