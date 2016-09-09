<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->title = Yii::t('StatsModule.base', 'Statistics Overview');
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

$num_words = 0;
$num_evidences = 0;

foreach($evidences as $key => $evidence){
    $num_words += str_word_count($evidence->text);
    $num_evidences++;
}

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
        &nbsp;&nbsp;
        <?php echo Html::a(
            Yii::t('StatsModule.base', 'Activities Statistics'),
            ['activities-stats'], array('class' => 'btn btn-info')); ?>
        &nbsp;&nbsp;
        <?php echo Html::a(
            Yii::t('StatsModule.base', 'Evocoin Statistics'),
            ['evocoin-stats'], array('class' => 'btn btn-standard')); ?>

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
            <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Number of Evidences: {list}', array('list' => $num_evidences)); ?></span></li>
            <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Average Number of evidences per player: {list}', array('list' => number_format((float)($num_evidences/$agents), 2, '.', ''))); ?></span></li>
            <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Number of Status Updates (Posts): {list}', array('list' => $posts)); ?></span></li>
            <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Number of Spaces Created: {list}', array('list' => $spaces)); ?></span></li>
            <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Number of Teams: {list}', array('list' => $teams)); ?></span></li>
            <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Number of Images Posted: {list}', array('list' => $images)); ?></span></li>
            <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Number of Videos Posted: {list}', array('list' => $videos)); ?></span></li>
            <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Average size of evidence in number of words: {list}', array('list' => round($num_words/$num_evidences))); ?></span></li>

            <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Total number of comments provided'); ?></span></li>
            <ul>
                <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'By mentors: {list}', array('list' => $comments_mentor)); ?></span></li>
                <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'By players: {list}', array('list' => $comments_user)); ?></span></li>
                <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Number of comments/user: {list}', array('list' => $comments/$users)); ?></span></li>
            </ul>

        </ul><br><br>

        <h4><?php echo Yii::t('StatsModule.base', 'Reviews'); ?></h4><br>
        <ul>
            <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Number of Reviews'); ?></span></li>
            <ul>
                <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Average by Agents: {list}', array('list' => number_format((float)($votes_agents/$agents), 2, '.', ''))); ?></span></li>
                <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Average by Mentors: {list}', array('list' => number_format((float)($votes_mentors/$mentors), 2, '.', ''))); ?></span></li>
            </ul>

            <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Average number of reviews received per player: {list}', array('list' => number_format((float)(($votes_agents+$votes_mentors)/$users), 2, '.', ''))); ?></span></li>

            <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Average number of reviews per evidence: {list}', array('list' => number_format((float)(($votes_agents+$votes_mentors)/$num_evidences), 2, '.', ''))); ?></span></li>

            <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Number of Comments Given'); ?></span></li>
            <ul>
                <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'By Agents: {list}', array('list' => $comments_agents)); ?></span></li>
                <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'By Mentors: {list}', array('list' => $comments_mentors)); ?></span></li>
            </ul>

            <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Number of Likes Given: {list}', array('list' => $likes)); ?></span></li>
            <ul>
                <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Player comments: {list}', array('list' => $like_comment_user)); ?></span></li>
                <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Mentors comments: {list}', array('list' => $like_comment_mentor)); ?></span></li>
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
