<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\widgets\Breadcrumbs;

$this->title = Yii::t('PowersModule.base', 'Powers');
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

        <?php echo Html::a(Yii::t('PowersModule.base', 'Create new Power'), ['create'], array('class' => 'btn btn-success')); ?>
        
        <br><br>
        
        <?php if (count($powers) != 0): ?>
        
            <table class="table">
                <tr>
                    <!--<th><?php //echo Yii::t('PowersModule.base', 'ID Code'); ?></th>-->
                    <th><?php echo Yii::t('PowersModule.base', 'Title'); ?></th>
                    <th><?php echo Yii::t('PowersModule.base', 'Description'); ?></th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($powers as $power): ?>
                    <tr>
                        <!--<td><?php //echo $power->id_code; ?></td>-->
                        <td><?php echo $power->title; ?></td>
                        <td><?php echo $power->description; ?></td>
                        <td>
                            <?php echo Html::a(
                                Yii::t('PowersModule.base', 'View translations'),
                                ['index-power-translations', 'id' => $power->id], array('class' => 'btn btn-warning btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('PowersModule.base', 'Update'),
                                ['update', 'id' => $power->id], array('class' => 'btn btn-primary btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('PowersModule.base', 'Delete'),
                                ['delete', 'id' => $power->id], array(
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => Yii::t('PowersModule.base', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],
                                )); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php else: ?>

            <p><?php echo Yii::t('PowersModule.base', 'No matching questions created yet!'); ?></p>


        <?php endif; ?>

    </div>
</div>
