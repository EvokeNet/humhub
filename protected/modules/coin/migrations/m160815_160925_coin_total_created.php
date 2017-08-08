<?php

use yii\db\Migration;

class m160815_160925_coin_total_created extends Migration
{
    public function up()
    {
      $this->addColumn('coin', 'total_created', $this->integer());
    }

    public function down()
    {
      $this->dropColumn('coin', 'total_created');
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
