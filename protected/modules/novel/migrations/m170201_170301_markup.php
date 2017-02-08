<?php

use yii\db\Migration;

class m170201_170301_markup extends Migration
{
    public function up()
    {
        $this->addColumn('novel', 'markup', $this->text());
    }

    public function down()
    {
        $this->dropColumn('novel', 'markup');

        return true;
    }
}
