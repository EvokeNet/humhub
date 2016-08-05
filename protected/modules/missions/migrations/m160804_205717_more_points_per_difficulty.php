<?php

use yii\db\Migration;

class m160804_205717_more_points_per_difficulty extends Migration
{
    public function up()
    {
      $this->delete('difficulty_levels');

      $this->insert('difficulty_levels', [
          'title' => 'Easy',
          'points' => 10,
      ]);

      $this->insert('difficulty_levels', [
          'title' => 'Medium',
          'points' => 50,
      ]);

      $this->insert('difficulty_levels', [
          'title' => 'Hard',
          'points' => 100,
      ]);
    }

    public function down()
    {
        echo "m160804_205717_more_points_per_difficulty cannot be reverted.\n";

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
