<?php

use yii\db\Migration;

class m160622_222905_create_coin_wallet_table extends Migration
{
    public function up()
    {
        $this->createTable('coin_wallet', [
            'id'         => $this->primaryKey(),
            'owner_id'   => $this->integer()->notNull(),
            'coin_id'    => $this->integer()->notNull(),
            'amount'     => $this->integer(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ]);

        // create index for column `owner_id`
        $this->createIndex(
          'idx-coin_wallet-owner_id',
          'coin_wallet',
          'owner_id'
        );

        // add foreign key for table users
        $this->addForeignKey(
          'fk-coin_wallet-owner_id',
          'coin_wallet',
          'owner_id',
          'user',
          'id',
          'CASCADE'
        );

        // creates index for column `coin_id`
        $this->createIndex(
          'idx-coin_wallet-coin_id',
          'coin_wallet',
          'coin_id'
        );

        // add foreign key for table coins
        $this->addForeignKey(
          'fk-coin_wallet-coin_id',
          'coin_wallet',
          'coin_id',
          'coin',
          'id',
          'CASCADE'
        );
    }

    public function down()
    {
        // drop foreign key for table `user`
        $this->dropForeignKey(
          'fk-coin_wallet-owner_id',
          'coin_wallet'
        );

        // drop index for column `owner_id`
        $this->dropIndex(
          'idx-coin_wallet-owner_id',
          'coin_wallet'
        );

        // drop foreign key for table `coins`
        $this->dropForeignKey(
          'fk-coin_wallet-coin_id',
          'coin_wallet'
        );

        // drop index for column `coin_id`
        $this->dropIndex(
          'idx-coin_wallet-coin_id',
          'coin_wallet'
        );

        $this->dropTable('coin_wallet');
    }
}
