<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;

$this->title = Yii::t('MatchingModule.base', 'Quality Powers');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MatchingModule.base', 'Qualities'), 'url' => ['index-qualities']];
$this->params['breadcrumbs'][] = Yii::t('MatchingModule.base', 'Quality').' '.$quality->name;
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

        <div style="position: absolute; top: 10px; right: 10px;"><?php echo Html::a(Yii::t('MatchingModule.base', 'Add new Power'), ['create-quality-powers', 'id' => $quality->id], array('class' => 'btn btn-success')); ?></div>
        
        <br><br>
        
        <?php if (count($quality_powers) != 0): ?>
        
            <table class="table">
                <tr>
                    <th><?php echo Yii::t('MatchingModule.base', 'Title'); ?></th>
                    <th><?php echo Yii::t('MatchingModule.base', 'Description'); ?></th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($quality_powers as $power): ?>
                    <tr>
                        <td><?php echo $power->power->title; ?></td>
                        <td><?php echo $power->power->description; ?></td>
                        <td>
                            <?php echo Html::a(
                                Yii::t('MatchingModule.base', 'Update'),
                                ['update-quality-powers', 'id' => $power->id], array('class' => 'btn btn-warning btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MatchingModule.base', 'Delete'),
                                ['delete-quality-powers', 'id' => $power->id], array(
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => Yii::t('MatchingModule.base', 'Are you sure you want to delete this power?'),
                                    'method' => 'post',
                                ],
                                )); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php else: ?>

            <p><?php echo Yii::t('MatchingModule.base', 'No quality powers created yet!'); ?></p>


        <?php endif; ?>

    </div>
</div>
