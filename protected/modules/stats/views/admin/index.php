<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->title = Yii::t('StatsModule.base', 'Statistics Overview');
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo Yii::t('StatsModule.base', 'Statistics Overview'); ?></h3>
        
        <?php echo Html::a(
            Yii::t('StatsModule.base', 'User Statistics'), 
            ['user-stats'], array('class' => 'btn btn-warning')); ?>
        &nbsp;&nbsp;
        <?php echo Html::a(
            Yii::t('StatsModule.base', 'Space Statistics'), 
            ['space-stats'], array('class' => 'btn btn-success')); ?>

    </div>
    <div class="panel-body">
        <h4><?php echo Yii::t('StatsModule.base', 'Participation'); ?></h4><br>
        <ul>
            <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Total Number of Users: {list}', array('list' => $users)); ?></span></li>
            <ul>
                <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Agents: {list}', array('list' => $agents)); ?></span></li>
                <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Mentors: {list}', array('list' => $mentors)); ?></span></li>
            </ul>
        </ul><br><br>
        
        <h4><?php echo Yii::t('StatsModule.base', 'Content Creation'); ?></h4><br>
        <ul>
            <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Number of Evidences: {list}', array('list' => $evidences)); ?></span></li>
            <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Average Number of evidences per player: {list}', array('list' => number_format((float)($evidences/$agents), 2, '.', ''))); ?></span></li>
        </ul><br><br>
        
        <h4><?php echo Yii::t('StatsModule.base', 'Reviews'); ?></h4><br>
        <ul>
            <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Number of Reviews'); ?></span></li>
            <ul>
                <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Average by Agents: {list}', array('list' => number_format((float)($votes_agents/$agents), 2, '.', ''))); ?></span></li>
                <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Average by Mentors: {list}', array('list' => number_format((float)($votes_mentors/$mentors), 2, '.', ''))); ?></span></li>
            </ul>
            
            <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Average number of reviews received per player: {list}', array('list' => number_format((float)(($votes_agents+$votes_mentors)/$users), 2, '.', ''))); ?></span></li>
            
            <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Average number of reviews per evidence: {list}', array('list' => number_format((float)(($votes_agents+$votes_mentors)/$evidences), 2, '.', ''))); ?></span></li>
            
            <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Number of Comments Given'); ?></span></li>
            <ul>
                <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'By Agents: {list}', array('list' => $comments_agents)); ?></span></li>
                <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'By Mentors: {list}', array('list' => $comments_mentors)); ?></span></li>
            </ul>
            
        </ul><br><br>
        
        <h4><?php echo Yii::t('StatsModule.base', 'Evocoins'); ?></h4><br>
        <ul>
            <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Total Number of Evocoins: {list}', array('list' => $coins_agents+$coins_mentors)); ?></span></li>
            <ul>
                <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Total Number Earned by Agents: {list}', array('list' => $coins_agents)); ?></span></li>
                <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Total Number Earned by Mentors: {list}', array('list' => $coins_mentors)); ?></span></li>
            </ul>
            
            <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Average number of Evocoin per total number of Participants'); ?></span></li>
            <ul>
                <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Average Earned by Agents: {list}', array('list' => number_format((float)($coins_agents/$agents), 2, '.', ''))); ?></span></li>
                <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Average Earned by Mentors: {list}', array('list' => number_format((float)($coins_mentors/$mentors), 2, '.', ''))); ?></span></li>
            </ul>
        </ul><br><br>
        
    </div>
</div>