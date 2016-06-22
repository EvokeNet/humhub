<?php

use yii\db\Migration;

class m160622_222905_create_wallets_table extends Migration
{
    public function up()
    {
        $this->createTable('wallet', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer()->notNull(),
            'coin_id' => $this->integer()->notNull(),
            'amount' => $this->integer()
        ]);

        // create index for column `owner_id`
        $this->createIndex(
          'idx-wallet-owner_id',
          'wallet',
          'owner_id'
        );

        // add foreign key for table users
        $this->addForeignKey(
          'fk-wallet-owner_id',
          'wallet',
          'owner_id',
          'user',
          'id',
          'CASCADE'
        );

        // creates index for column `coin_id`
        $this->createIndex(
          'idx-wallet-coin_id',
          'wallet',
          'coin_id'
        );

        // add foreign key for table coins
        $this->addForeignKey(
          'fk-wallet-coin_id',
          'wallet',
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
          'fk-wallet-owner_id',
          'wallet'
        );

        // drop index for column `owner_id`
        $this->dropIndex(
          'idx-wallet-owner_id',
          'wallet'
        );

        // drop foreign key for table `coins`
        $this->dropForeignKey(
          'fk-wallet-coin_id',
          'wallet'
        );

        // drop index for column `coin_id`
        $this->dropIndex(
          'idx-wallet-coin_id',
          'wallet'
        );

        $this->dropTable('wallet');
    }
}
