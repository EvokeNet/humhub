<?php

use yii\db\Migration;

class uninstall extends Migration
{

    public function up()
    {
      $this->dropTable('products');
      $this->dropTable('bought_products');
    }

    public function down()
    {
      echo "uninstall does not support migration down.\n";
      return false;
    }

}
