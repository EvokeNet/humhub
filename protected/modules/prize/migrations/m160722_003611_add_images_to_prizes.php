<?php

use yii\db\Migration;

class m160722_003611_add_images_to_prizes extends Migration
{
    public function up()
    {
      $this->addColumn('prizes', 'image', $this->string());
    }

    public function down()
    {
      $this->addColumn('prizes', 'image', $this->string());
    }
}
