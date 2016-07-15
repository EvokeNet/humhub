<?php

use yii\db\Migration;

class m160715_065149_create_won_prizes extends Migration
{
    public function up()
    {
        $this->createTable('won_prizes', [
            'id' => $this->primaryKey(),
            'prize_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull()
        ]);

        // create index for column `user_id`
        $this->createIndex(
          'idx-won_prizes-user_id',
          'won_prizes',
          'user_id'
        );

        // add foreign key for table users
        $this->addForeignKey(
          'fk-won_prizes-user_id',
          'won_prizes',
          'user_id',
          'user',
          'id',
          'CASCADE'
        );

        // create index for column `prize_id`
        $this->createIndex(
          'idx-won_prizes-prize_id',
          'won_prizes',
          'prize_id'
        );

        // add foreign key for table prize
        $this->addForeignKey(
          'fk-won_prizes-prize_id',
          'won_prizes',
          'prize_id',
          'prizes',
          'id',
          'CASCADE'
        );
    }

    public function down()
    {

      // drop foreign key for table `user`
      $this->dropForeignKey(
        'fk-won_prizes-user_id',
        'won_prizes'
      );

      // drop index for column `user_id`
      $this->dropIndex(
        'idx-won_prizes-user_id',
        'won_prizes'
      );

      // drop foreign key for table `prize`
      $this->dropForeignKey(
        'fk-won_prizes-prize_id',
        'won_prizes'
      );

      // drop index for column `prize_id`
      $this->dropIndex(
        'idx-won_prizes-prize_id',
        'won_prizes'
      );

      $this->dropTable('won_prizes');
    }
}
