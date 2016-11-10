<?php

use yii\db\Migration;

class m161104_002732_deadlineType extends Migration
{
    public function up()
    {
        $this->addColumn('evokation_deadline', 'code', 'varchar(256) NOT NULL');
    }

    public function down()
    {
        $this->dropColumn('evokation_deadline', 'code');

        return true;
    }
}
