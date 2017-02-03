<?php

use yii\db\Migration;

class m161214_164523_bought_products extends Migration
{
    public function up()
    {
      $this->createTable( 'bought_products', [
        'id' => $this->primaryKey(),
        'user_id' => $this->integer()->notNull(),
        'product_id' => $this->integer()->notNull(),
        'fulfilled' => $this->boolean()->defaultValue(false)
      ]);

      // create index for column `user_id`
      $this->createIndex(
        'idx-bought_products-user_id',
        'bought_products',
        'user_id'
      );

      // add foreign key for table users
      $this->addForeignKey(
        'fk-bought_products-user_id',
        'bought_products',
        'user_id',
        'user',
        'id',
        'CASCADE'
      );

      // create index for column `product_id`
      $this->createIndex(
        'idx-bought_products-product_id',
        'bought_products',
        'product_id'
      );

      // add foreign key for table prize
      $this->addForeignKey(
        'fk-bought_products-product_id',
        'bought_products',
        'product_id',
        'products',
        'id',
        'CASCADE'
      );
    }

    public function down()
    {
      // drop foreign key for table `user`
      $this->dropForeignKey(
        'fk-bought_products-user_id',
        'bought_products'
      );

      // drop index for column `user_id`
      $this->dropIndex(
        'idx-bought_products-user_id',
        'bought_products'
      );

      // drop foreign key for table `products`
      $this->dropForeignKey(
        'fk-bought_products-product_id',
        'bought_products'
      );

      // drop index for column `product_id`
      $this->dropIndex(
        'idx-bought_products-product_id',
        'bought_products'
      );

      $this->dropTable('bought_products');

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
