<?php

use yii\db\Migration;

class m170719_163252_default_order extends Migration
{
    public function up()
    {
        $this->alterColumn('user_matching_answers', 'order', 'int(11) NOT NULL default 0');
    }

    public function down()
    {
        $this->alterColumn('user_matching_answers', 'order', 'int(11) NOT NULL');

        return true;
    }
}
