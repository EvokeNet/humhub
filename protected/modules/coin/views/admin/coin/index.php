<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\widgets\Breadcrumbs;

$this->title = Yii::t('CoinModule.base', 'Coin');
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo $this->title; ?></h3>
    </div>
    <div class="panel-body">
        <?php if (count($wallets) != 0): ?>

            <table class="table">
                <tr>
                    <th><?php echo Yii::t('CoinModule.base', 'Owner'); ?></th>
                    <th><?php echo Yii::t('CoinModule.base', 'Amount') ?></th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($wallets as $wallet): ?>
                    <tr>
                        <!--<td><?php //echo $coin->id_code; ?></td>-->
                        <td><?php echo $wallet->getOwner()->username; ?></td>
                        <td><?php echo $wallet->amount; ?></td>
                        <td>
                            <?php echo Html::a(
                                Yii::t('CoinModule.base', 'Change'),
                                ['update', 'id' => $wallet->id], array('class' => 'btn btn-primary btn-sm')); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>

            <p><?php echo Yii::t('CoinModule.base', 'No coins created yet!'); ?></p>
            <?php echo Html::a(Yii::t('CoinModule.base', 'Create'), ['create'], array('class' => 'btn btn-success')); ?>


        <?php endif; ?>

    </div>
</div>
