<?php

use yii\db\Migration;

class m160720_193747_add_description_to_prizes extends Migration
{
    public function up()
    {
      $this->addColumn('prizes', 'description', $this->string());
    }

    public function down()
    {
      $this->dropColumn('prizes', 'description');
    }
}
