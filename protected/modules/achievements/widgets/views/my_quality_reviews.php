<?php

use yii\helpers\Html;
use \yii\helpers\Url;
use app\modules\missions\models\Votes;

$reviews = Votes::find()
    ->where(['user_id' => Yii::$app->user->getIdentity()->id, 'quality' => '1'])
    ->all();

// echo $review->evidence->title.'<br>';
//                 echo $review->activity->title.'<br>';
//                 echo $review->value.'<br>';
//                 echo ($review->flag == 1) ? 'Yes' : 'No';

?>

<div class="panel panel-default">

    <div class="panel-heading">
        <h4 class = "display-inline"><?php echo Yii::t('AchievementsModule.base', "My Quality Reviews"); ?></h4>
    </div>

    <div class="panel-body row">

        <ol>
            <?php foreach($reviews as $review): ?>

            <li>
                <span><?php echo Html::a(Yii::t('AchievementsModule.base', "Evidence: {evidence}", array('evidence' => $review->evidence->title)), ['/content/perma', 'id' => $review->evidence->getContentObject()->id]); ?></span>
                <span class="my-quality-review">
                <?php 
                if($review->flag == 1){
                    // echo Yii::t('AchievementsModule.base', "<strong>Review:</strong> {vote} with {points} points", array('vote' => Yii::t('AchievementsModule.base', "Yes"), 'points' => $review->value));
                    echo '<br />';
                    echo Yii::t('AchievementsModule.base', "<strong>Review:</strong> {points} points", array('vote' => Yii::t('AchievementsModule.base', "Yes"), 'points' => $review->value));
                    echo '<br />';
                    echo Yii::t('AchievementsModule.base', "<strong>Comment:</strong> {comment}", array('vote' => Yii::t('AchievementsModule.base', "Yes"), 'comment' => $review->comment));
                } else {
                    echo Yii::t('AchievementsModule.base', "<strong>Review:</strong> {vote}", array('evidence' => $review->evidence->title, 'vote' => Yii::t('AchievementsModule.base', "No")));
                } ?>
                </span>
            </li>
            
            <?php endforeach; ?>
        </ol>
    </div>
</div>