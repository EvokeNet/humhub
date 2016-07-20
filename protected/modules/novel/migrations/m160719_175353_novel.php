<?php

use yii\db\Migration;

class m160719_175353_novel extends Migration
{
    public function up()
    {
      $this->addColumn('user', 'has_read_novel', $this->boolean()->defaultValue(false));

      $this->createTable('novel', [
        'id' => $this->primaryKey(),
        'page_image' => $this->string(),
        'page_number' => $this->integer(),
      ]);
    }

    public function down()
    {
      $this->dropColumn('user', 'has_read_novel');

      $this->dropTable('novel');
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
