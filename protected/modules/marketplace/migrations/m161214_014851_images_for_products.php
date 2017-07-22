<?php

use yii\db\Migration;

class m161214_014851_images_for_products extends Migration
{
    public function up()
    {
      $this->addColumn('products', 'image', $this->string());
    }

    public function down()
    {
      $this->dropColumn('products', 'image');

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
