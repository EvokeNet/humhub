<?php

use yii\db\Migration;

class m160722_151252_add_image_to_powers extends Migration
{
    public function up()
    {
      $this->addColumn('powers', 'image', $this->string());
    }

    public function down()
    {
      $this->dropColumn('powers', 'image');
    }
}
