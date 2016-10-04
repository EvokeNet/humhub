<?php

use yii\helpers\Html;
$activity = null;

$this->pageTitle = Yii::t('MissionsModule.event', 'Review Evidences');

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
            <?php echo Html::a($e['title'], ['show', 'guid' => $e['id']], ['class' => 'profile-link']); ?>
        <?php endforeach; ?>
    </div>
</div>