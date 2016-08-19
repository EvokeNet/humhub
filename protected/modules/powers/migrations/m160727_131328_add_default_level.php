<?php

use yii\db\Migration;

class m160727_131328_add_default_level extends Migration
{
    public function up()
    {
      $this->alterColumn('user_powers', 'level', $this->integer(11)->defaultValue(0));
    }

    public function down()
    {
        $this->alterColumn('user_powers', 'level', 'int(11) NOT NULL');

        return true;
    }
}
