<?php

use yii\db\Migration;

class m161026_202557_add_group_flag_to_activities extends Migration
{
    public function up()
    {
      $this->addColumn('activities', 'is_group', $this->boolean());
    }

    public function down()
    {
      $this->removeColumn('activities', 'is_group');
    }
}
