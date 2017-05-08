<?php

use yii\db\Migration;

class m161215_174834_add_seller_id_to_product extends Migration
{
    public function up()
    {
      $this->addColumn('products', 'seller_id', $this->integer());
    }

    public function down()
    {
      $this->dropColumn('products', 'seller_id');
    }
}
