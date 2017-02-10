<?php

use yii\db\Migration;

class m170210_162958_alliances extends Migration
{
    public function up()
    {
      $this->createTable('alliances', [
          'id' => $this->primaryKey(),
          'team_1' => $this->integer()->notNull(),
          'team_2' => $this->integer()->notNull(),
          'created_at' => $this->dateTime()->notNull(),
      ]);

      $this->addForeignKey(
        'fk-alliances-team_1',
        'alliances',
        'team_1',
        'space',
        'id',
        'CASCADE'
      );

      $this->addForeignKey(
        'fk-alliances-team_2',
        'alliances',
        'team_2',
        'space',
        'id',
        'CASCADE'
      );
    }

    public function down()
    {
      $this->dropForeignKey(
        'fk-alliances-team_1',
        'alliances'
      );

      $this->dropForeignKey(
        'fk-alliances-team_2',
        'alliances'
      );

      $this->dropTable('alliances');

      return false;
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
