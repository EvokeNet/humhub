<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\missions\models\EvokationDeadlineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Evokation Deadlines');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
    <div class="panel-heading">

        <h3><?= Html::encode($this->title) ?></h3h1>
    
    </div>
    <div class="panel-body">
        
        <table class="table">
        <thead>
            <tr>
                <th><?= Yii::t('MissionsModule.base', 'Deadline') ?></th>
                <th><?= Yii::t('MissionsModule.base', 'Start Date') ?></th>
                <th><?= Yii::t('MissionsModule.base', 'Close Date') ?></th>
                <th><?= Yii::t('MissionsModule.base', 'Options') ?></th>
            </tr>
        </thead>
            <tbody>
                <?php if (isset($evokation_deadline)): ?>
                    <tr>
                        <td scope="row"><?php echo Yii::t('MissionsModule.base', 'Evokation'); ?></td>
                        <td><?= date_format(date_create($evokation_deadline->start_date), "d/M/Y") ?></td>
                        <td><?= date_format(date_create($evokation_deadline->finish_date), "d/M/Y") ?></td>
                        <td><?= Html::a(Yii::t('MissionsModule.base', 'Update'), ['update-deadline', 'id' => $evokation_deadline->id], ['class' => 'btn btn-primary']) ?>
                            <?= Html::a(Yii::t('MissionsModule.base', 'Delete'), ['delete-deadline', 'id' => $evokation_deadline->id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => Yii::t('MissionsModule.base', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],
                            ]) 
                            ?>
                        </td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td colspan="3">
                            <p>
                                <?php echo Yii::t('MissionsModule.base', 'No evokation deadline defined yet!'); ?>
                            </p>
                        </td>
                        <td>
                            <?= Html::a(Yii::t('MissionsModule.base', 'Create Evokation Deadline'), ['create-deadline'], ['class' => 'btn btn-success', 'style' => 'width: 200px']) ?>
                        </td>
                    </tr>                
                <?php endif; ?>
                <?php if (isset($voting_deadline)): ?>
                    <tr>
                        <td scope="row"><?php echo Yii::t('MissionsModule.base', 'Voting'); ?></td>
                        <td><?= date_format(date_create($voting_deadline->start_date), "d/M/Y") ?></td>
                        <td><?= date_format(date_create($voting_deadline->finish_date), "d/M/Y") ?></td>
                        <td><?= Html::a(Yii::t('MissionsModule.base', 'Update'), ['update-deadline', 'id' => $voting_deadline->id], ['class' => 'btn btn-primary']) ?>
                            <?= Html::a(Yii::t('MissionsModule.base', 'Delete'), ['delete-deadline', 'id' => $voting_deadline->id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => Yii::t('MissionsModule.base', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],
                            ]) 
                            ?>
                        </td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td colspan="3">
                            <p>
                                <?php echo Yii::t('MissionsModule.base', 'No voting deadline defined yet!'); ?>
                            </p>
                        </td>
                        <td>
                            <?= Html::a(Yii::t('MissionsModule.base', 'Create Voting Deadline'), ['create-voting-deadline'], ['class' => 'btn btn-success', 'style' => 'width: 200px']) ?>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>    
    </div>
</div>
