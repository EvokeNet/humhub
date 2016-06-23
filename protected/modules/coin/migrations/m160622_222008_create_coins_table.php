<?php

use yii\db\Migration;

class m160622_222008_create_coins_table extends Migration
{
    public function up()
    {
      $this->createTable('coin', [
        'id'   => $this->primaryKey(),
        'name' => $this->string()->notNull()
      ])
    }

    public function down()
    {
        $this->dropTable('coin');

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
