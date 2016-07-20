<?php

use yii\db\Migration;

class uninstall extends Migration
{

    public function up()
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

      $this->dropTable('coin');
      $this->dropTable('coin_wallet');
    }

    public function down()
    {
      echo "uninstall does not support migration down.\n";
      return false;
    }

}
