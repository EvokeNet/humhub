<?php

use yii\db\Migration;

class m160715_032941_create_prizes_table extends Migration
{
    public function up()
    {
        $this->createTable('prizes', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'week_of' => $this->date()->notNull(),
            'weight' => $this->integer()->defaultValue(1), // adjusts the base probability of it showing (>1 means more likely)
            'quantity' => $this->integer()->defaultValue(0),
        ]);
    }

    public function down()
    {
        $this->dropTable('prizes');
    }
}
