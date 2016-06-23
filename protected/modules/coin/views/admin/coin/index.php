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

        <?php echo Html::a(Yii::t('CoinModule.base', 'Create'), ['create'], array('class' => 'btn btn-success')); ?>

        <br><br>

        <?php if (count($coins) != 0): ?>

            <table class="table">
                <tr>
                    <th><?php echo Yii::t('CoinModule.base', 'Name'); ?></th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($coins as $coin): ?>
                    <tr>
                        <!--<td><?php //echo $coin->id_code; ?></td>-->
                        <td><?php echo $coin->name; ?></td>
                        <td>
                            <?php echo Html::a(
                                Yii::t('CoinModule.base', 'Update'),
                                ['update', 'id' => $coin->id], array('class' => 'btn btn-primary btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('CoinModule.base', 'Delete'),
                                ['delete', 'id' => $coin->id], array(
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => Yii::t('CoinModule.base', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],
                                )); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php else: ?>

            <p><?php echo Yii::t('CoinModule.base', 'No coins created yet!'); ?></p>


        <?php endif; ?>

    </div>
</div>
