<?php

use yii\helpers\Html;
$activity = null;

$this->pageTitle = Yii::t('MissionsModule.event', 'Review Evidences');
$user = Yii::$app->user->getIdentity();

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 style="margin-top:10px"><?php echo Yii::t('MissionsModule.base', 'Review Evidence'); ?></h4>
        <?php if($activity): ?>
        <h6><?php echo Yii::t('MissionsModule.base', '{first} of {total}', array('first' => ($evidence_count - $evidence_to_review_count + 1), 'total' => $evidence_count)); ?></h6>
        <?php endif; ?>
    </div>
    <div class="panel-body">
        <?php foreach($evidences as $e): ?>
            <p><?php //echo $e['title'].'<br />'; ?></p> 
            <?php if($e['user_vote'] == Yii::$app->user->getIdentity()->id): ?>
                <div style="color: #28C503; display: inline; float: right;" data-toggle="tooltip" title="<?php echo Yii::t('MissionsModule.base', "You've reviewed this evidence"); ?>">
                    <i class="fa fa-check-circle-o fa-2x" aria-hidden="true"></i>
                </div>
            <?php endif; ?>
            
            <?php echo Html::a($e['title'], ['show', 'sguid' => $contentContainer['guid'], 'id' => $e['id']], ['class' => 'profile-link', 'style' => 'font-size:12pt']); ?>

        <?php endforeach; ?>
    </div>
</div>