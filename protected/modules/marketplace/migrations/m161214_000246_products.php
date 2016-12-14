<?php

use yii\db\Migration;

class m161214_000246_products extends Migration
{
    public function up()
    {
      $this->createTable('products', [
          'id' => $this->primaryKey(),
          'name' => $this->string()->notNull(),
          'description' => $this->string(),
          'created_at' => $this->dateTime()->notNull(),
          'price' => $this->integer() . ' UNSIGNED NOT NULL',
          'quantity' => $this->integer()->defaultValue(0),
      ]);
    }

    public function down()
    {
        $this->dropTable('products');

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
