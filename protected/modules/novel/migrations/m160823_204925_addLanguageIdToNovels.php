<?php

use yii\db\Migration;

class m160823_204925_addLanguageIdToNovels extends Migration
{
    public function up()
    {
      $this->addColumn('novel', 'language_id', $this->integer(16));
    }

    public function down()
    {
        $this->dropColumn('novel', 'language_id');
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
