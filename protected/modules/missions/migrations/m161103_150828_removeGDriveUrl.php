<?php

use yii\db\Migration;

class m161103_150828_removeGDriveUrl extends Migration
{
    public function up()
    {
        $this->dropColumn('evokations', 'gdrive_url');
    }

    public function down()
    {
        $this->addColumn('evokations', 'gdrive_url', 'varchar(256) NOT NULL');

        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
