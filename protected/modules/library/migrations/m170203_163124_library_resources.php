<?php

use yii\db\Migration;

class m170203_163124_library_resources extends Migration
{
    public function up()
    {
      $this->createTable('library_resources', [
          'id' => $this->primaryKey(),
          'name' => $this->string()->notNull(),
          'link' => $this->string()->notNull(),
          'description' => $this->string(),
          'created_at' => $this->dateTime()->notNull(),
      ]);
    }

    public function down()
    {
        $this->dropTable('library_resources');

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
