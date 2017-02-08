<?php

use yii\helpers\Html;
use \yii\helpers\Url;
use app\modules\missions\models\Votes;

$reviews = Votes::find()
    ->where(['user_id' => Yii::$app->user->getIdentity()->id])
    ->all();

// echo $review->evidence->title.'<br>';
//                 echo $review->activity->title.'<br>';
//                 echo $review->value.'<br>';
//                 echo ($review->flag == 1) ? 'Yes' : 'No';

?>

<div class="panel panel-default">

    <div class="panel-heading">
        <h5 class = "display-inline"><?php echo Yii::t('MissionsModule.base', "Evidences I've Reviewed"); ?></h5>
    </div>

    <div class="panel-body row">

        <ol>
            <?php foreach($reviews as $review): ?>

            <li>
                <span><?php echo Html::a(Yii::t('MissionsModule.base', "Evidence: {evidence}", array('evidence' => $review->evidence->title)), ['/content/perma', 'id' => $review->evidence->getContentObject()->id]); ?></span>
                <span style="float:right; margin-right:30px">
                <?php 
                if($review->flag == 1){
                    // echo Yii::t('MissionsModule.base', "<strong>Review:</strong> {vote} with {points} points", array('vote' => Yii::t('MissionsModule.base', "Yes"), 'points' => $review->value));
                    echo Yii::t('MissionsModule.base', "<strong>Review:</strong> {points} evocoin(s)", array('vote' => Yii::t('MissionsModule.base', "Yes"), 'points' => $review->value));
                } else {
                    echo Yii::t('MissionsModule.base', "<strong>Review:</strong> {vote}", array('evidence' => $review->evidence->title, 'vote' => Yii::t('MissionsModule.base', "No")));
                } ?>
                </span>
            </li>
            
            <?php endforeach; ?>
        </ol>
    </div>
</div>