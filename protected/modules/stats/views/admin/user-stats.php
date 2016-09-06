<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->title = Yii::t('StatsModule.base', 'User Statistics');
$this->params['breadcrumbs'][] = ['label' => Yii::t('StatsModule.base', 'Statistics Reports'), 'url' => ['index']];
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
        
        <table class="table">
            <tr>
                <th><?php echo Yii::t('StatsModule.base', 'Name'); ?></th>
                <!--<th><?php //echo Yii::t('StatsModule.base', 'Username'); ?></th>-->
                <th><?php echo Yii::t('StatsModule.base', '# of Evocoins'); ?></th>
                <th><?php echo Yii::t('StatsModule.base', '# of Followers'); ?></th>
                <th><?php echo Yii::t('StatsModule.base', '# of Followees'); ?></th>
                <th><?php echo Yii::t('StatsModule.base', '# of Reviews'); ?></th>
                <th><?php echo Yii::t('StatsModule.base', '# of Evidences'); ?></th>
                <th><?php echo Yii::t('StatsModule.base', 'User or Mentor'); ?></th>
                <th><?php echo Yii::t('StatsModule.base', 'Has Read Novel?'); ?></th>
                <!--<th><?php //echo Yii::t('MissionsModule.base', 'Description'); ?></th>-->
            </tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['firstname'].' '.$user['lastname']; ?></td>
                    <!--<td><?php //echo $user['username']; ?></td>-->
                    <td><?php echo $user['coins']; ?></td>
                    <td><?php echo $user['followers']; ?></td>
                    <td><?php echo $user['following']; ?></td>
                    <td><?php echo $user['votes']; ?></td>
                    <td><?php echo $user['evidences']; ?></td>
                    <td><?php echo ($user['group_id'] == 1) ? Yii::t('StatsModule.base', 'User') : Yii::t('StatsModule.base', 'Mentor'); ?></td>
                    <td><?php echo ($user['has_read_novel'] == 1) ? Yii::t('StatsModule.base', 'Yes') : Yii::t('StatsModule.base', 'No'); ?></td>
                    <!--<td><?php //echo $mission->description; ?></td>-->
                </tr>
            <?php endforeach; ?>
        </table>
        
    </div>
</div>